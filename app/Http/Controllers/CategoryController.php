<?php

namespace App\Http\Controllers;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Terms\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\CategoryDataTable;

class CategoryController extends Controller
{


      private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(CategoryDataTable $dataTable)
    {
        $data['categories']  = Category::count();
        $data['title'] = 'Category List';

        return $dataTable->render('admin.terms.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Category';
        //$data['categories']  = $this->categoryRepository->getCategoriesByType();
        return view('admin.terms.categories.create',$data);
    }

      public function getCategoriesAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->categoryRepository->getCategoriesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
       $categoryDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(Category::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'color' => (!empty($request->color))?$request->color:"",
            'category_type' => $request->category_type,
            'description' => $request->description,
        ];
        $this->categoryRepository->createCategory($categoryDetails);
        Session::flash('success','Category Created Successfully');
        return redirect()->Route('admin.terms.categories.index');
    }

      public function changeStatus(Request $request): JsonResponse
    {
        $categoryId = $request->id;
          $categoryDetails = [
            'status' => $request->status,
        ];
        $this->categoryRepository->updateCategory($categoryId, $categoryDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Terms\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
       $data['category'] = $category;
        $data['title'] = 'Category';

        if (empty($data['category'])) {
            return back();
        }

        return view('admin.terms.categories.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Terms\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
          $categoryId = $category->id;

        $data['category'] = $category;

        $data['title'] = 'Category Edit';

        if (empty($data['category'])) {
            return back();
        }
        $data['categories'] = $this->categoryRepository->getcategoriesByType($data['category']->category_type,$categoryId);
        return view('admin.terms.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Terms\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
          $categoryId = $category->id;
         
         $categoryDetails = [
            'name' => $request->name,
            'slug' => (!empty($request->slug) && $category->slug != $request->slug)?SlugService::createSlug(Category::class, 'slug', $request->slug):$category->slug,
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'color' => (!empty($request->color))?$request->color:"",
            'category_type' => $request->category_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->categoryRepository->updateCategory($categoryId, $categoryDetails);
         Session::flash('success','Category Updated Successfully');
        return redirect()->Route('admin.terms.categories.edit',$categoryId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Terms\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
       $categoryId = $category->id;
        $this->categoryRepository->deleteCategory($categoryId);
         Session::flash('success','Category Deleted Successfully');
        return back();
    }

       /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $categoryIds = get_array_mapping(json_decode($request->ids));
        $this->categoryRepository->deleteBulkCategory($categoryIds);
         Session::flash('success','Category Bulk Deleted Successfully');
        }
        return back();
    }
}
