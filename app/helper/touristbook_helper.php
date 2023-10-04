<?php 

if (!function_exists('getRouteName')) {    
    function getRouteName(){

        $routeName = request()->route()->getName();

        return $routeName;
    }
}

if (!function_exists('customStringReplaceWithStrCase')) {    
    function customStringReplaceWithStrCase($search,$replace_value,$subject,$str_case){
        $result = "";
        if ($str_case == "ucwords") {
            $result = ucwords(str_replace($search, $replace_value, $subject));
        }elseif($str_case == "strtolower"){
           $result = strtolower(str_replace($search, $replace_value, $subject));
       }elseif($str_case == "strtoupper"){
          $result = strtoupper(str_replace($search, $replace_value, $subject));
      }else{
         $result = str_replace($search, $replace_value, $subject);
     }

     return $result;
 }
}

if (!function_exists('getCountries')) {    
    function getCountries($type='object'){

        $NamespacedModel = 'App\\Models\\Terms\\Country' ;
        $getCountries = $NamespacedModel::get(['id','countryname','code'])->map(function($country, $key) use($type){  
            if ($type == 'object') {
              return (object)[
                'id' => $country->code,
                'value' => $country->countryname
            ];                 
        }else{
            return [
                'id' => $country->code,
                'value' => $type
            ];
        }                                

    });

        return $getCountries;
    }
}
if (!function_exists('unsetValueActivityTourismZone')) {
    function unsetValueActivityTourismZone($data)
    {
     if (!empty($data)) {
      foreach ($data as $key => $value) {
       if ($data[$key]['activity_zones-url_link_status'] == 'slug') {
           unset($data[$key]['activity_zones-file']);
           unset($data[$key]['activity_zones-web_link']);
       }elseif ($data[$key]['activity_zones-url_link_status'] == 'file') {
           unset($data[$key]['activity_zones-slug']);
           unset($data[$key]['activity_zones-web_link']);
       }elseif ($data[$key]['activity_zones-url_link_status'] == 'web_link') {
          unset($data[$key]['activity_zones-file']);
          unset($data[$key]['activity_zones-slug']);
      }
  }
}


return $data;
}
}
if (!function_exists('setTermSpace')) {
  function setTermSpace($space)
  {
    $result = "";
    if ($space != 0) {
      for ($i=0; $i < $space; $i++) { 
          $result .= "&nbsp;&nbsp;&nbsp;";
      }
  }
  return $result;
}
}
if (!function_exists('getTermsForSelectBox')) {    
    function getTermsForSelectBox($model=null,$term_type=null,$type='object'){

        $getTerms = [];
        if (!empty($model)) {
            $NamespacedModel = 'App\\Models\\Terms\\' . $model;
            $getTerms_type = $NamespacedModel::get(['id','name','parent_id']);
            if (!empty($term_type)) {
                $getTerms_type = $NamespacedModel::where(['type'=>$term_type])->get(['id','name','parent_id']);
            }
            $getTerms = $getTerms_type->map(function($term, $key) use($type){ 
                if ($type == 'object') {
                    return (object)[
                        'id' => $term->id,
                        'value' => $term->name,
                        'parent_id'=>$term->parent_id
                    ];
                }else{
                    return [
                        'id' => $term->id,
                        'value' => $term->name,
                        'parent_id'=>$term->parent_id
                    ];
                }                                

            });
        }

        return $getTerms;
    }
}
if (!function_exists('getPostData')) {    
    function getPostData($model=null,$parameters=[],$type='object'){

        $getPostData = [];
        if (!empty($model) && !empty($parameters)) {
            $NamespacedModel = 'App\\Models\\' . $model;
            $getPostData = $NamespacedModel::get($parameters)->map(function($post, $key) use($type){
               if ($type == 'object') {
                   return (object)[
                    'id' => $post->id,
                    'value' => (isset($post->name))?$post->name:$post->title,
                ];
            }else{
              return [
                'id' => $post->id,
                'value' => (isset($post->name))?$post->name:$post->title,
            ];    
        }                                 

    });
        }

        return $getPostData;
    }
}

if (!function_exists('exploreJsonData')) {    
    function exploreJsonData($json_data="",$key=null){

        $result = "";
        if (!empty($json_data)) {
            if (!is_array($json_data)) {
                $json_decode = json_decode($json_data);
            }else{
                $json_decode = $json_data;
            }   
            if (empty($key)) {
                $result = $json_decode;
            }else{
             $collection = collect($json_decode);

             $result = $collection->get($key);
         }

         return $result;
     }
 }
}

if (!function_exists('exploreArrayData')) {    
    function exploreArrayData($data="",$key=null){

        $result = "";
        if (!empty($json_data)) {
            if (!empty($key)) {
             $collection = collect($data);
             $result = $collection->get($key);
         }else{
             $collection = collect($data);
             $result = $collection->get();
         }
     }
     return $result;
 }
}
if (!function_exists('matchRouteName')) {    
    function matchRouteName($current_route=null){
       $active_class = "";
       if (!empty($current_route)) {
        $routeName = getRouteName();
        if ($routeName == $current_route) {
            $active_class = 'mm-active';
        }
    }
    
    return $active_class;
}
}
if (!function_exists('matchSiteRouteName')) {    
    function matchSiteRouteName($current_route=null){
       $active_class = "";
       if (!empty($current_route)) {
        $routeName = getRouteName();
        if ($routeName == $current_route) {
            $active_class = 'active';
        }
    }
    
    return $active_class;
}
}
if (!function_exists('matchRouteNameMatch')) {    
    function matchRouteNameMatch($current_route=null){
       $active_class = false;
       if (!empty($current_route)) {
        $routeName = getRouteName();
        $arr = explode('.', $routeName);
        if (in_array($current_route, $arr)) {
            $active_class = true;
        }
    }
    
    return $active_class;
}
}

if (!function_exists('getIconColorClass')) {    
    function getIconColorClass(){

       $i_color_dashboard = config('global.i_color_dashboard');
       $get_color = array_rand($i_color_dashboard);
       return "text-".$i_color_dashboard[$get_color]." border-".$i_color_dashboard[$get_color];

   }
}
if (!function_exists('matchRouteGroupName')) {    
    function matchRouteGroupName($group_type, $route_group_name=null){
        $mm_show = "";
        if (!empty($route_group_name)) {
            $routeName = getRouteName();
            if (strpos($routeName, $route_group_name) !== false) {
                if ($group_type == 'parent') {
                    $mm_show = 'mm-active';
                }else{
                    $mm_show = 'mm-show';
                }
            }
        }

        return $mm_show;
    }
}
if(!function_exists('get_form_error_msg')){
    function get_form_error_msg($errors, $field_name){
        if($errors->has($field_name)){
            $form_error='<div id="'.$field_name.'-error" class="invalid-feedback animated fadeInUp" style="display: block;">'.$errors->first($field_name).'</div>';
            return  $form_error;
        }                        
    }
}
if(!function_exists('get_form_success_msg')){
    function get_form_success_msg($success){

        $form_success='<div class="alert alert-success alert-dismissible alert-alt solid fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button><strong>Success!</strong>&nbsp;'.$success.'</div>';
        
        return  $form_success;
    }
}

if(!function_exists('get_edit_select_check_pvr_old_value')){
    function get_edit_select_check_pvr_old_value($input,$compair_obj,$compair_prop, $current_ele, $type){
       if((!empty($compair_obj->{$compair_prop}))&&(empty(old($input)))){ 
        $select= $compair_obj->{$compair_prop};
    }else{
        $select= old($input);
    }
    if($select==$current_ele){
        if($type=='select'){
            return 'selected="true"';
        }else{
            return 'checked="true"';
        }
    }else{
        return '';
    }
}
}

if(!function_exists('setCheckboxActiveInactiveStyle')){
    function setCheckboxActiveInactiveStyle($input,$compair_obj,$compair_prop, $current_ele, $type,$class){

     if ($class == 'active-inactive') {
        if ($type != 'select') {
         return $class.'-switch';
        }else{
            return "";
        }
     }else{

       if((!empty($compair_obj->{$compair_prop}))&&(empty(old($input)))){ 
        $select= $compair_obj->{$compair_prop};
    }else{
        $select= old($input);
    }


    if($select==$current_ele){
        if($type=='select'){
            return '';
        }else{
            return $class.'-switch-checked';
        }
    }else{
        
        if ($type != 'select') {
         return $class.'-switch';
        }else{
            return "";
        }
   
    }
}
}
}



    //get_edit_select_post_types_old_value($type, $facility->facility_type ?? "",'select')

if(!function_exists('get_edit_select_post_types_old_value')){
    function get_edit_select_post_types_old_value($compair_prop, $current_ele, $type){

        if (!empty($current_ele)) {

            if ($type == 'select') {
               if ($compair_prop == $current_ele) {
                return 'selected="selected"';
            }else{
                return '';
            }
        }
    }else{
        return '';
    }
}
}

if (!function_exists('get_parent_term')) {
    function get_parent_term($facilities,$parent_id,$single_check=false)
    {

        if ($single_check) {
            $facility = $facilities->find($parent_id);
            return (!empty($facility)?$facility->name:"");
        }
        if (!empty($facilities)) {
            return (!empty($facilities->firstWhere('id', $parent_id))?$facilities->firstWhere('id', $parent_id)->name:"");
        }else{
            return "";
        }
    }
}
if (!function_exists('get_fontawesome_icon_html')) {
    function get_fontawesome_icon_html($icon,$xl_class="")
    {
        if (!empty($icon)) {
            return '<i class="'.$icon.' '.$xl_class.'"></i>';
        }else{
            return "";
        }
    }
}

if (!function_exists('get_time_format')) {
    function get_time_format($value,$with_t=false) {
        $cenvertedTime = date('d-m-Y H:i:s');
        if ($with_t) {
           $cenvertedTime = date('d-m-Y H:i:s',strtotime($value));
       }else{
           $cenvertedTime = date('d-m-Y',strtotime($value));
       }
       return $cenvertedTime;
   }
}
if (!function_exists('get_array_mapping')) {
    function get_array_mapping($data,$field=false) {
        $result = [];
        if (!empty($data)) {
           $collection = collect($data);
           if ($field) {
            $result = $collection->map(function ($value,$key) {
               return (object)[
                'id'=> $key,
                'value'=>$value
            ];
        });
        }else{

           $result = $collection->map(function (int $item, int $key) {
            return (int)$item;
        });
       }
   }
   return $result->all();


}
}


?>