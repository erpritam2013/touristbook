<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class UtilityController extends Controller
{
    public function get_template_by_type($type) {
        // Source is Config File
        $subforms = config('subform');

        if(!isset($subforms[$type])) {
            // Type Not Found
            return response()->json(['html' => '']);
        }

        $typeInfo = $subforms[$type] ?? [];
        $data = $this->generate_single_data($type);
        $html = View::make('admin.partials.utils.subform', [
            'typeData' => $data,
            'type' => $type,
            'typeFields' => $typeInfo['fields'],
            'key' => 0
        ])->render();
        return response()->json(['html' => $html]);

    }

    public function ajax_term_store(Request $request)
    {

    
        $model = $request->term;
        $selected_terms = [];
        $selected_terms = json_decode($request->selected_terms);

        $term_type = $request->term_type;
        $field_name = $request->field_name;
        $post_type = str_replace('App\\Models\\', "", $request->post_type);
        $NamespacedModel = 'App\\Models\\Terms\\' . $model;
        $existed_name = $NamespacedModel::where('name',$request->name);
        if (!empty($term_type)){
          $existed_name = $NamespacedModel::where('name',$request->name)->where($term_type,$post_type);
        }
        $existed_name = $existed_name->get();
        if (count($existed_name) > 0) {
            return response()->json(['data'=>[],'status'=>409,'msg'=>'This {'.$request->name.'} Name is existed!']);
        }
        $termDetails = [
                   'name'=>ucwords($request->name),
                   'parent_id'=>(!empty($request->parent_id))?$request->parent_id:0,
        ];
        if (!empty($term_type)) {
            $termDetails[$term_type] = $post_type;
        }
        $term = $NamespacedModel::create($termDetails);
        $terms = $NamespacedModel::latest()->get(['id','name','parent_id'])->toNested();
        if (!empty($term_type)) {
            $terms = $NamespacedModel::latest()->where($term_type,$post_type)->get(['id','name','parent_id'])->toNested();
        }
      
        $response = [];
        $ul_html = "";
        if (!empty($term)) {

              array_push($selected_terms, $term->id);
            
        $ul_html = View::make('admin.partials.utils.nested_checkbox_list', ['items' => $terms, 'name'=> $field_name,'selected' => $selected_terms])->render();

        $response = [
                 'new_term'=>['id'=>$term->id,'name'=>$term->name],
                 'ul_html' => $ul_html
        ];
        }
       return response()->json(['data'=>$response,'status'=>200,'msg'=>'New '.$request->term.' Added Successfuly']);
    }


    private function generate_single_data($type) {
        $subforms = config('subform');
        $data = [
                'subform_id' => $type
        ];
        if(isset($subforms[$type])) {
            foreach($subforms[$type]['fields'] as $key => $field) {
                $data[$key] = "";
            }
        }
        return $data;
    }

    public function get_template_by_type_old($type) {
        // Source is Config File
        $subforms = config('subform');
        if(!isset($subforms[$type])) {
            // Type Not Found
            return response()->json(['html' => '']);
        }

        $type_data = $subforms[$type] ?? [];

        $html = View::make('admin.partials.utils.subform', [
            'typeData' => $type_data['data'],
            'type' => $type,
            'typeLabels' => $type_data['labels']
        ])->render();
        return response()->json(['html' => $html]);

    }
}
