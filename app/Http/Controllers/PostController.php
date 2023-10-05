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
use Session;

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
        $data['posts'] = Post::count();
        $data['title'] = 'Post List';
        return $dataTable->render('admin.posts.index', $data);
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


       $postDetails = [
        'name' => $request->name,
        'description' => $request->description,
        'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
        'excerpt' => $request->excerpt,
        'gallery' => (!empty($request->gallery))?$request->gallery:Null,
        'link' => $request->link,
            // TODO: logo and featured_image ----> S3 Integration
        'extra_price_unit' => $request->extra_price_unit,
        'featured_image' => $request->featured_image,
        'featured_image_id' => (!empty($request->featured_image_id))?$request->featured_image_id:0,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $post = $this->postRepository->createPost($postDetails);

    if ($post) {


        $post->categories()->attach($request->get('categories'));
        $post->tags()->attach($request->get('tags'));

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
      $postDetails = [
        'name' => $request->name,
        'description' => $request->description,
        //'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
        'excerpt' => $request->excerpt,
        'gallery' => (!empty($request->gallery))?$request->gallery:Null,
        'link' => $request->link,
            // TODO: logo and featured_image ----> S3 Integration
        'extra_price_unit' => $request->extra_price_unit,
        'featured_image' => $request->featured_image,
        'featured_image_id' => $request->featured_image_id,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $this->postRepository->updatePost($post->id,$postDetails);

    if ($post) {


        $post->categories()->sync($request->get('categories'));
        $post->tags()->sync($request->get('tags'));

    }
        // return $post;
    Session::flash('success','Post Updated Successfully');
    return redirect()->Route('admin.posts.edit',$post->id);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->postRepository->deletePost($post->id);
        Session::flash('success','Post Deleted Successfully');
        return back();
    }

    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $postIds = get_array_mapping(json_decode($request->ids));
            $this->postRepository->deleteBulkPost($postIds);
            Session::flash('success', 'Post Bulk Deleted Successfully');
        }
        return back();
    }
}
