<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Interfaces\PageRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{


     private PageRepositoryInterface $pageRepository;
 private PostRepositoryInterface $postRepository;


 public function __construct(
    PageRepositoryInterface $pageRepository,
    PostRepositoryInterface $postRepository,

)
 {
    $this->pageRepository = $pageRepository;
    $this->postRepository = $postRepository;
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return redirect()->route('admin.settings.theme-settings.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           $data['title'] = 'Theme Settings';
           $settings = Setting::all();
           $data['settings'] =$settings;
           $data['hotels'] =$this->pageRepository->getPageByType('','Hotel');
           $data['homes'] =$this->pageRepository->getPageByType('','Home');
           $data['abouts'] =$this->pageRepository->getPageByType('','About');
           $data['connecting_partners'] =$this->pageRepository->getPageByType('','Connecting Partner');
           $data['hotel_details'] =$this->pageRepository->getPageByType('','hotelDetail');
           $data['blogs'] =$this->pageRepository->getPageByType('','Blog');
           $data['rooms'] =$this->pageRepository->getPageByType('','Room');
           $data['room_details'] =$this->pageRepository->getPageByType('','roomDetail');
           $data['locations'] =$this->pageRepository->getPageByType('','Location');
           $data['location_details'] =$this->pageRepository->getPageByType('','locationDetail');
           $data['tours'] =$this->pageRepository->getPageByType('','Tour');
           $data['contact_pages'] =$this->pageRepository->getPageByType('','Contact Us');
           $data['tour_details'] =$this->pageRepository->getPageByType('','tourDetail');
           $gt_languages = config('gt-languages');
           $data['gt_languages'] = $gt_languages;
           return view('admin.settings.theme-settings.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$setting)
    {

   
        $all_fields = $request->all();
        
        if (!empty($all_fields)) {
            unset($all_fields['_method']);
            unset($all_fields['_token']);
            
            foreach ($all_fields as $key => $value) {

               if (is_array($value)) {

                   $json_encode = json_encode($value);
                   Setting::save_setting($key,$json_encode);
               }else{
                  Setting::save_setting($key,$value);
               }
            }
        }
        Session::flash('success','Seting Saved Successfully');
        return redirect()->route('admin.settings.theme-settings.create');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        $data['title'] = 'Theme Settings';
         $data['settings'] = Setting::all();
         return view('admin.settings.theme-settings.edit',$data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
