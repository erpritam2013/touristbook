<?php 

if (!function_exists('getRouteName')) {    
    function getRouteName(){

        $routeName = request()->route()->getName();

        return $routeName;
    }
}

if (!function_exists('exploreJsonData')) {    
    function exploreJsonData($json_data="",$key=null){

        $result = "";
        if (!empty($json_data)) {
            $json_decode = json_decode($json_data);
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
        if (isset($compair_obj) && !empty($compair_obj)) {
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
        }else{
            if ($current_ele == 1) {
                return 'checked="true"';
            }else{
                return '';
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
    function get_array_mapping($data) {
        $result = [];
        if (!empty($data)) {
           $collection = collect($data);

           $result = $collection->map(function (int $item, int $key) {
            return (int)$item;
        });
       }
       return $result->all();


   }
}


?>