<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
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
