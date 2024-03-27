<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\DataTables\PostDataTable;
use App\DataTables\TrashedPostDataTable;
use Session;
use Auth;

class PostController extends Controller
{

    private CategoryRepositoryInterface $categoryRepository;
    private TagRepositoryInterface $tagRepository;
    private PostRepositoryInterface $postRepository;


    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        TagRepositoryInterface $tagRepository,
        PostRepositoryInterface $postRepository,
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->postRepository = $postRepository;
    }

    private function _prepareBasicData() {

        // TODO: Need to Improve here (Fetch from Cache)
        $data['categories'] = $this->categoryRepository->getActivePostCategoriesList();
        $data['tags'] = $this->tagRepository->getActivePostTagsList()->map(function($value, $key){  

          return (object)[
            'id' => $value->id,
            'value' => $value->name,
        ];                                

    });

        return $data;

    }

    public function index(PostDataTable $dataTable)
    {
       if (isset(request()->user) && !empty(request()->user)) {
        $created_by = request()->user;
        $data['posts'] = Post::where('created_by',$created_by)->count();
    }else{
        $data['posts'] = Post::count();
    }

    $data['trashed'] = Post::onlyTrashed()->count();
    $data['title'] = 'Post List';
        // dump(Post::onlyTrashed()->get());
        // dd( $data['trashed']);
    return $dataTable->render('admin.posts.index', $data);
}

public function empty_trashed(Request $request)
{

    Post::onlyTrashed()->forceDelete();
    Session::flash('success','Post Empty Trashed Successfully');
    return redirect()->back();
}

public function trashed_posts(TrashedPostDataTable $dataTable)
{

    $trashed_posts = Post::onlyTrashed()->get();
    $data['trashed_count'] = $trashed_posts->count();
        //$data['trashed_posts'] = $trashed_posts;
    $data['title'] = 'Trash Post List';
        // dump(Post::onlyTrashed()->get());
        // dd( $data['trashed']);
    return $dataTable->render('admin.posts.trashed', $data);
}

public function restore_posts(Request $request)
{
    $ids = [];
    if (!empty($request->ids)) {
       $ids =  get_array_mapping(json_decode($request->ids));

   }

   if (!empty($ids)) {
     Post::whereIn('id',$ids)->withTrashed()->restore();
 }else{
   Post::onlyTrashed()->restore();
}
Session::flash('success','Post Restored Successfully');
return redirect()->back();
}

public function restore_post(Request $request,$id)
{
    $post = Post::withTrashed()->find($id);
    if ($post == null)
    {
        abort(404);
    }

    $post->restore();
    Session::flash('success','Post Restored Successfully');
    return redirect()->back();
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Post';
        $data['post'] = new Post();
        $data = array_merge_recursive($data, $this->_prepareBasicData());

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

     // if (isset($request->featured_image)) {

     //     $request->merge([
     //        'featured_image' => json_decode($request->featured_image,true),
     //    ]);
     // }
     $postDetails = [
        'name' => $request->name,
        'description' => $request->description,
        'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
        'excerpt' => $request->excerpt,
        'gallery' => $request->gallery,
        'link' => $request->link,
            // TODO: logo and featured_image ----> S3 Integration
        'extra_price_unit' => $request->extra_price_unit,
        'featured_image' => $request->featured_image,
        'featured_image_id' => (!empty($request->featured_image_id))?$request->featured_image_id:0,
        'status' => $request->status,
        'created_by' => (Auth::check())?Auth::user()->id:null,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $post = $this->postRepository->createPost($postDetails);

    if ($post) {


        $post->categories()->attach($request->get('categories'));
        $post->tags()->attach($request->get('tag_id'));

    }
        // return $post;
    Session::flash('success','Post Created Successfully');
    return redirect()->Route('admin.posts.index');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
     $postId = $request->route('postId');

     $post = $this->postRepository->getPostById($postId);

     if (empty($post)) {
        return back();
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post->with([
            'categories', 'tags'
        ]);

        if (empty($post)) {
            return back();
        }

        if($post->isEditing()) {
            Session::flash('error','Post is being Edited. Please wait till its fully edited!');
            return redirect()->Route('admin.posts.index');
        }

        // Set Editing Status
        $post->edited();

        $data['title'] = 'Post';
        $data['post'] = $post;
        $data = array_merge_recursive($data, $this->_prepareBasicData());

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

     //  if (isset($request->featured_image)) {

     //     $request->merge([
     //        'featured_image' => json_decode($request->featured_image,true),
     //    ]);
     // }

     $postDetails = [
        'name' => $request->name,
        'description' => $request->description,
        //'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
        'excerpt' => $request->excerpt,
        'gallery' => $request->gallery,
        'link' => $request->link,
            // TODO: logo and featured_image ----> S3 Integration
        'extra_price_unit' => $request->extra_price_unit,
        'featured_image' => $request->featured_image,
        'featured_image_id' => $request->featured_image_id,
        'status' => $request->status,
        'created_by' => (Auth::check())?Auth::user()->id:null,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $this->postRepository->updatePost($post->id,$postDetails);

    if ($post) {


        $post->categories()->sync($request->get('categories'));
        $post->tags()->sync($request->get('tag_id'));

    }
        // return $post;
    Session::flash('success','Post Updated Successfully');
    if(!is_null($request->iscompleted)) {
        $post->freeEditing();
        return redirect()->Route('admin.posts.index');
    }
    return redirect()->Route('admin.posts.edit',$post->id);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function permanent_delete($id)
    {
        $this->postRepository->forceDeletePost($id);
        Session::flash('success','Post Permanent Deleted Successfully');
        return back();
    }

      public function changeStatus(Request $request): JsonResponse
{
    $postId = $request->id;
    $postDetails = [
        'status' => $request->status,
    ];
    $this->postRepository->updatePost($postId, $postDetails);

    return response()->json(['success' => 'Status change successfully.']);
}

    public function destroy(Post $post)
    {
        $this->postRepository->deletePost($post->id);
        Session::flash('success','Post Trashed Successfully');
        return back();
    }

    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $postIds = get_array_mapping(json_decode($request->ids));
            $this->postRepository->deleteBulkPost($postIds);
            Session::flash('success', 'Post Bulk Trashed Successfully');
        }
        return back();
    }
    public function bulk_force_delete(Request $request)
    {


        if (!empty($request->fd_ids)) {

            $postIds = get_array_mapping(json_decode($request->fd_ids));
            $this->postRepository->forceBulkDeletePost($postIds);
            Session::flash('success', 'Post Bulk Permanent Deleted Successfully');
        }
        return back();
    }
}
