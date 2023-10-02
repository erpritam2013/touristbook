<?php

namespace App\Http\Controllers;
use App\Interfaces\LanguageRepositoryInterface;
use App\Models\Terms\Language;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\LanguageDataTable;

class LanguageController extends Controller
{

     private LanguageRepositoryInterface $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(LanguageDataTable $dataTable)
    {
        // $data['languages'] = $this->languageRepository->getAllLanguages();
        $data['languages'] = Language::count();
        $data['title'] = 'Language List';

        return $dataTable->render('admin.terms.languages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Language';
        $data['languages'] = $this->languageRepository->getLanguagesByType();
        return view('admin.terms.languages.create',$data);
    }

    public function getLanguagesAjax(Request $request): JsonResponse 
    {
        $type = $request->language_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->languageRepository->getLanguagesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $languageId = $request->id;
          $languageDetails = [
            'status' => $request->status,
        ];
        $this->languageRepository->updateLanguage($languageId, $languageDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLanguageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLanguageRequest $request)
    {
       $languageDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(Language::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            // 'language_type' => $request->language_type,
            'description' => $request->description,
        ];
        $this->languageRepository->createLanguage($languageDetails);
        Session::flash('success','Language Created Successfully');
        return redirect()->Route('admin.terms.languages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        $data['language'] = $language;
        $data['title'] = 'Language';

        if (empty($data['language'])) {
            return back();
        }

        return view('admin.terms.languages.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        $languageId = $language->id;

        $data['language'] = $language;

        $data['title'] = 'Language Edit';

        if (empty($data['language'])) {
            return back();
        }
        $data['languages'] = $this->languageRepository->getLanguagesByType(null,$languageId);

        return view('admin.terms.languages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLanguageRequest  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLanguageRequest $request, Language $language)
    {
        $languageId = $language->id;
         $languageDetails = [
            'name' => $request->name,

            'slug' => (!empty($request->slug) && $language->slug != $request->slug)?SlugService::createSlug(Language::class, 'slug', $request->slug):$language->slug,
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            // 'language_type' => $request->language_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->languageRepository->updateLanguage($languageId, $languageDetails);
         Session::flash('success','Language Updated Successfully');
        return redirect()->Route('admin.terms.languages.edit',$languageId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $languageId = $language->id;
        $this->languageRepository->deleteLanguage($languageId);
         Session::flash('success','Language Deleted Successfully');
        return back();
    }

        /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */

      public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $languageIds = get_array_mapping(json_decode($request->ids));
        $this->languageRepository->deleteBulkLanguage($languageIds);
         Session::flash('success','Language Bulk Deleted Successfully');
        }
        return back();
    }
}
