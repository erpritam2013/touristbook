<?php

namespace App\Http\Controllers;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Terms\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\TagDataTable;

class TagController extends Controller
{

      private TagRepositoryInterface $TagRepository;

    public function __construct(TagRepositoryInterface $TagRepository)
    {
        $this->tagRepository = $TagRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagDataTable $dataTable)
    {
        $tags = $this->tagRepository->getAllTags();
        $data = [
            'title'     => 'Tag List',
            'tags'     => $tags->count()
        ];
        return $dataTable->render('admin.terms.tags.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['title'] = 'Add Tag';
        //$data['tags'] = $this->tagRepository->getTagsByType();
         $data['tags'] = $this->tagRepository->getTagsByType();
        return view('admin.terms.tags.create',$data);
    }

     public function changeStatus(Request $request): JsonResponse
    {
        $tagId = $request->id;
          $tagDetails = [
            'status' => $request->status,
        ];
        $this->tagRepository->updateTag($tagId, $tagDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
         $tagDetails = [
            'name' => ucwords($request->name),
            'slug' => SlugService::createSlug(Tag::class, 'slug', $request->name),
             'tag_type' => $request->tag_type,
            'description' => $request->description,
        ];
        $this->tagRepository->createTag($tagDetails);
        Session::flash('success','Tag Created Successfully');
        return redirect()->Route('admin.terms.tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Terms\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $data['tag'] = $Tag;
        $data['title'] = 'Tag';

        if (empty($data['tag'])) {
            return back();
        }

        return view('admin.terms.tags.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Terms\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $tagId = $tag->id;

        $data['tag'] = $Tag;

        $data['title'] = 'Tag Edit';

        if (empty($data['tag'])) {
            return back();
        }
        $data['tags'] = $this->tagRepository->getTagsByType(null,$tagId);
        return view('admin.terms.tags.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagRequest  $request
     * @param  \App\Models\Terms\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
         $tagId = $tag->id;
         
         $tagDetails = [
            'name' => ucwords($request->name),
             'slug' => (!empty($request->slug) && $Tag->slug != $request->slug)?SlugService::createSlug(Tag::class, 'slug', $request->slug):$Tag->slug,
            'icon' => (!empty($request->icon))?$request->icon:"",
             'tag_type' => $request->tag_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->tagRepository->updateTag($tagId, $tagDetails);
         Session::flash('success','Tag Updated Successfully');
        return redirect()->Route('admin.terms.tags.edit',$tagId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Terms\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
         $tagId = $tag->id;
        $this->tagRepository->deleteTag($tagId);
         Session::flash('success','Tag Deleted Successfully');
        return back();
    }

     /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $tagIds = get_array_mapping(json_decode($request->ids));
        $this->tagRepository->deleteBulkTag($tagIds);
         Session::flash('success','Tag Bulk Deleted Successfully');
        }
        return back();
    }
}
