<?php

use App\Models\Conversion;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

// boolean (true)
if (!function_exists('get_settings_option_value')) {
    function get_settings_option_value($field)
    {

        $set_value=Setting::get_setting($field);
            return $set_value;
    }
}

if (!function_exists('isJson')) {    
function isJson($string) {
    
    return Str::isJson($string);
}
}
if (!function_exists('get_single_value_of_col_in_setting')) {
    function get_single_value_of_col_in_setting($data,$field)
    {

        $result = '';
        if (!empty($data)) {
        if (isJson($data)) {
           $get_data = exploreJsonData($data);
           $collection = collect($get_data);
           $result = $collection->get($field);
    
        }else{
            if (!empty($data)) {
           $collection = collect($data);
           $result = $collection->get($field);
            }
        }
        }
        return $result;
    }
}
if (!function_exists('purify_html')) {
    function purify_html($html)
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($html);
    }
}
if (!function_exists('purify_string')) {
    function purify_string($string,$case="")
    {
        if (!empty($string)) {
            $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);
            $string = str_replace('-', " ", $string);
            $string = str_replace('_', " ", $string);
            if (!empty($case)) {
                if ($case == 'ucwords') {
                     $string = ucwords($string);
                }elseif ($case == 'upper') {
                   $string = strtoupper($string);
                }
            }
        }

        return $string;
    }
}


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
if (!function_exists('shortDescription')) {
 function shortDescription($text,$length=150)
 {
  $result = "";
  $result = mb_strimwidth($text, 0, $length, "......");
  return $result;
}
}
if (!function_exists('touristbook_sanitize_title')) {
    function touristbook_sanitize_title($value="",$extra_txt='')
    {
        if (!empty($value)) {
            if (!empty($extra_txt)) {
               $value .= ' '.$extra_txt;
           }
     $value = str_replace(' ', '-', strtolower($value)); // Replaces all spaces with hyphens.
 }else{
    return "";
}

   return preg_replace('/[^A-Za-z0-9\-]/', '', $value); // Removes special chars.
}
}
if (!function_exists('isMobileDevice')) {
    function isMobileDevice() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
            |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
            , $_SERVER["HTTP_USER_AGENT"]);
    }
}
if (!function_exists('is_featured')) {
    function is_featured($value,$title='featured') {

        if (isset($value)) {
           if ($value == 1) {

            return ' <div class="service-tag bestseller">
            <div class="feature_class st_featured featured">'.ucwords($title).'</div>
            </div>';
        }
    }

    return "";
}
}
if (!function_exists('inputTemplate')) {
    function inputTemplate($fields_data)
    {
        $html = "";
        if (!empty($fields_data) && is_array($fields_data)) {
           extract($fields_data);

           $hidden_class = (!empty($hidden_class))?$hidden_class:'';
           $value = (!empty($value))?$value:'';
           $class = (!empty($class))?$class:'';
           $control = (!empty($control))?$control:'text';
           $hidden_class = (!empty($hidden_class))?$hidden_class:'';
           $label = (!empty($label))?purify_string($label,"ucwords"):'';
           $html .='<div class="form-group row '.$hidden_class.'">';

           if(empty($id)){
             $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;
         }

         if(!isset($col)){
             $html .='<div class="col-lg-12">';
             if(isset($label) && !empty($label))
             {
                 $html .='<label class="subform-card-label" for="'.$id.'">'.$label;

                 if(isset($required) && $required){
                     $html .='<span class="text-danger">*</span>';
                 }
                 $html .='</label>';
                 if(isset($desc) && !empty($desc)){
                     $html .='<p>'.$desc.'</p>';

                 }
             }
         }else{



             if(isset($label) && !empty($label)){
                 $html .='<label class="col-lg-2 col-form-label" for="'.$id.'">'.$label;
                 if(isset($required) && $required) {
                     $html .='<span class="text-danger">*</span>';
                 }
                 $html .='</label>';
             }
             $html .='<div class="col-lg-10">';
         }
         $html .='<input type="'.$control.'" class="form-control '.$class.'" id="'.$id.'" name="'.$name.'" value="'.$value.'" placeholder="Enter a '.$label.'..">';

         $html .='</div>';
         $html .='</div>';
     }
     return $html;
 }

}

if (!function_exists('parseVideos')) {
  function parseVideos($videoString = null){
    
    // RETURN DATA
    $videos = array();
    if (!empty($videoString)) {
        // SPLIT ON LINE BREAKS
        $videoString = stripslashes(trim($videoString));
        $videoString = explode("\n", $videoString);
        $videoString = array_filter($videoString, 'trim');
        // CHECK EACH VIDEO FOR PROPER FORMATTING
        foreach ($videoString as $video) {
            // CHECK FOR IFRAME TO GET THE VIDEO URL
            if (strpos($video, 'iframe') !== FALSE) {
                // RETRIEVE THE VIDEO URL
                $anchorRegex = '/src="(.*)?"/isU';
                $results = array();
                if (preg_match($anchorRegex, $video, $results)) {
                    $link = trim($results[1]);
                }
            } else {
                // WE ALREADY HAVE A URL
                $link = $video;
            }
            // IF WE HAVE A URL, PARSE IT DOWN
            if (!empty($link)) {
                // INITIAL VALUES
                $video_id = NULL;
                $videoIdRegex = NULL;
                $results = array();
                // CHECK FOR TYPE OF YOUTUBE LINK
                if (strpos($link, 'youtu') !== FALSE) {
                    if (strpos($link, 'youtube.com') !== FALSE) {
                        if (strpos($link, 'youtube.com/watch') !== FALSE) {
                            $videoIdRegex = '/[\?\&]v=([^\?\&]+)/';
                        }else{
                            // works on:
                            // http://www.youtube.com/embed/VIDEOID
                            // http://www.youtube.com/embed/VIDEOID?modestbranding=1&rel=0
                            // http://www.youtube.com/v/VIDEO-ID?fs=1&hl=en_US
                            ///[\?\&]v=([^\?\&]+)/
                            $videoIdRegex = '/youtube.com\/(?:embed|v){1}\/([a-zA-Z0-9_]+)\??/i';
                        }
                    } else if (strpos($link, 'youtu.be') !== FALSE) {
                        // works on:
                        // http://youtu.be/daro6K6mym8
                        $videoIdRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
                    }
                    if ($videoIdRegex !== NULL) {
                        if (preg_match($videoIdRegex, $link, $results)) {
                            $video_str = 'https://www.youtube.com/embed/%s?autoplay=0';
                            $thumbnail_str = 'http://img.youtube.com/vi/%s/2.jpg';
                            $fullsize_str = 'http://img.youtube.com/vi/%s/0.jpg';
                            $video_id = $results[1];
                            $video_type = 'youtube';
                        }
                    }
                }
                // CHECK IF WE HAVE A VIDEO ID, IF SO, ADD THE VIDEO METADATA
                if (!empty($video_id)) {
                    // add to return
                    $videos = array(
                        'url' => sprintf($video_str, $video_id),
                        'thumbnail' => sprintf($fullsize_str, $video_id),
                        'video_type' => sprintf($video_type, $video_id),
                    );
                }else{
                    $videos = array(
                        'url' => null,
                        'thumbnail' => null,
                        'video_type' => '0',
                    );
                }
            }
        }
    }
    // RETURN ARRAY OF PARSED VIDEOS
    return $videos;
}
}

if (!function_exists('mediaTemplate')) {

    function mediaTemplate($fields_data)
    {
     $html = "";
     if (!empty($fields_data) && is_array($fields_data)) {
        extract($fields_data);
        $html .='<div class="form-group row">';

        if(empty($id)){
           $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;
       }
       $class = (!empty($class))?$class:'';
       $value = (!empty($value))?$value:'';
       $label = (!empty($label))?$label:'';
       $smode = (!empty($smode))?$smode:'single';
       $id = (!empty($id))?$id:'';
       if(!isset($col)){
           $html .='<div class="col-lg-12">';
           if(isset($label) && !empty($label)){
              $html .='<label class="subform-card-label" for="'.$id.'">'.$label.'</label>';
              if(isset($desc) && !empty($desc)){
                  $html .='<p>'.$desc.'</p>';
              }
          }
      }else{
          if(isset($label) && !empty($label)){
              $html .='<label class="col-lg-2 col-form-label" for="'.$id.'">'.$label.'</label>';
          }
          $html .='<div class="col-lg-10">';
      }
      $html .='<div class="media-controls">';
      
      $value_e = $value ? json_encode($value) : '';
      $html .='<input type="hidden" class="form-control media-input '.$class.' gallery-input " name="'.$name.'"
      value="'.htmlspecialchars($value_e,ENT_QUOTES).'" />';
      if($smode == 'single'){
        $value_url = '';
        
        if(is_array($value) && isset($value[0])){
            $value_url = $value[0]['url'];
        }
        $html .='<input type="url" class="form-control media-txt-only" value="'.$value_url.'" id="'.$id.'" placeholder="Enter '.$label.'..."/>';
    }
    $json_encode = is_array($value) ? json_encode($value) : "";

    $html .='<button type="button" class="btn btn-primary mt-2 add-media-btn" smode="'.$smode.'" selectedImages="'.htmlspecialchars($json_encode,ENT_QUOTES).'"  >+</button>';
    $html .='<button type="button" class="btn btn-danger mt-2 remove-media-btn">-</button>';
    $html .='<div class="media-preview">';
    if(is_array($value) && isset($value[0])){

        $html .='<img src="'.$value[0]['url'].'"  class="img" height="100" width="100" />';
    }
    $html .='</div>';
    $html .='</div>';
    $html .='</div>';
    $html .='</div>';
}
return $html;
}
}
if (!function_exists('galleryTemplate')) {

    function galleryTemplate($fields_data)
    {
     $html = "";
     if (!empty($fields_data) && is_array($fields_data)) {
        extract($fields_data);
        $html .='<div class="form-group row">';

        if(empty($id)){
           $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;
       }
       $class = (!empty($class))?$class:'';
       $value = (!empty($value))?$value:'';
       $label = (!empty($label))?$label:'';
       $smode = (!empty($smode))?$smode:'single';
       $id = (!empty($id))?$id:'';


       if (!isset($col)){
        $html .='<div class="col-lg-12">';
        if (isset($label) && !empty($label)){
            $html .='<label for="'. $id .'" class="subform-card-label">'. $label .'</label>';
            if (isset($desc) && !empty($desc)){
                $html .='<p>'. $desc .'</p>';
            }
        }
    }else{
        if (isset($label) && !empty($label)){
            $html .='<label class="col-lg-2 col-form-label subform-card-label" for="'. $id .'">'. $label .'</label>';
        }
        $html .='<div class="col-lg-10">';
    }
    $html .=' <div class="gallery-controls">';
    $json_decode__ = (!empty($value) && isset($value) && is_array($value))?json_encode($value):json_encode([]);
    $html .='<input type="hidden" class="form-control gallery-input '. $class .'" name="'. $name.'" value="'. htmlspecialchars($json_decode__,ENT_QUOTES) .'" id="'. $id .'" placeholder="Enter '. $label.'..." />';
    $html .='<button type="button" class="btn btn-primary mt-2 add-gallery-btn" smode="'.$smode.'" selectedImages="'. htmlspecialchars($json_decode__,ENT_QUOTES) .'">+</button>';
    $html .='<div class="media-preview">';

    if(!empty($value) && isset($value) && is_array($value)){
        $html .='<div class="row">';
        foreach($value as $image){
            $html .='<div class="col-xl-3">';
            if(is_array($image)){
                $html .='<img src="'.$image['url'].'" class="img" height="100" width="100" id="image-path-'.$image['id'].'" />';
            }
            $html .='</div>';
        }
        $html .='</div>';
    }
    $html .='</div>';
    $html .=' </div>';
    $html .='</div>';
    $html .='</div>';

}
return $html;
}
}
if (!function_exists('radioInputTemplate')) {

    function radioInputTemplate($fields_data)
    {
     $html = "";
     if (!empty($fields_data) && is_array($fields_data)) {
        extract($fields_data);

        $hidden_class = (!empty($hidden_class))?$hidden_class:'';
        $value = (!empty($value))?$value:'';
        $attr = (!empty($attr))?$attr:'';
        $class = (!empty($class))?$class:'';
        $desc = (!empty($desc))?$desc:'';

        $html .='<div class="form-group row '.$hidden_class.'">';

        if(empty($id)){
           $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;
       }
       $set_label_class = "";
       if(!isset($col)){
           $html .='<div class="col-lg-12">';
           if(isset($label) && !empty($label)){
               $html .='<label class="subform-card-label" for="'.$id.'">'.$label;
               if(isset($required) && $required){
                   $html .='<span class="text-danger">*</span>';
               }
               $html .='</label>';
               if(isset($desc) && !empty($desc)){
                   $html .='<p>'.$desc.'</p>';
               }else{
                   $html .='<br>';
               }
           }
       }else{
           if(isset($label) && !empty($label)){
               $html .='<label class="col-lg-2 col-form-label" for="'.$id.'">'.$label;
               if(isset($required) && $required){
                   $html .='<span class="text-danger">*</span>';
               }
               $html .='</label>';
           }
           $html .='<div class="col-lg-10">';
       }

       if(!empty($input) && is_array($input)){
        if(isset($on_off_switch)){
            $html .='<div class="on-off-switch">';
        }


        foreach($input as $input_key => $input_value){

            if(isset($item->{$name})){
                if($item->{$name} == $input_value){
                    $set_label_class = $label_class[$input_value].'-checked';
                }else{
                 $set_label_class = $label_class[$input_value];
             }
         }else{
            if($input_value == 0){
              $set_label_class = $label_class[$input_value].'-checked';
          }else{
            $set_label_class = $label_class[$input_value];
        }
    }
    $html .='<label class="col-form-label '.$set_label_class.'">
    <input type="radio" name="'.$name.'" value="'.$input_value.'" '.get_edit_select_check_pvr_old_value($name, $item ,$name,$input_value, 'checked' ).' id="'.$name.'-'.$input_value.'" class="'.$class.'" '.$attr.'>&nbsp;'.$input_key.'
    </label>';
}

if(isset($on_off_switch)){
    $html .='</div>';
}
}


$html .='</div>';
$html .='</div>';
}
return $html;
}
}
if (!function_exists('rangeInputTemplate')) {

    function rangeInputTemplate($fields_data)
    {
     $html = "";
     if (!empty($fields_data) && is_array($fields_data)) {
        extract($fields_data);

        $name = (!empty($name))?$name: '';
        $label = (!empty($label))?$label: '';
        $id = (!empty($id))?$id: '';
        $class = (!empty($class))?$class: '';
        $rows = (!empty($rows))?$rows: 8;
        $value = (!empty($value))?$value: '';
        $name = (!empty($name))?$name: '';
        $label = (!empty($label))?$label: '';
        $desc = (!empty($desc))?$desc: '';
        $control = (!empty($control))?$control: '';
        $step = (!empty($step))?$step: 0.1;
        $min = (!empty($min))?$min: 0;
        $max = (!empty($max))?$max: 5;
        if(!isset($control)){
            $html .='<div class="form-group row">';

            if(empty($id)){
               $id = $name;
           }

           if(!isset($col)){
               $html .='<div class="col-lg-12">';
               if(isset($label) && !empty($label)){
                   $html .='<label class="subform-card-label" for="'.$id.'">'.$label;
                   if(isset($required) && $required){
                       $html .='<span class="text-danger">*</span>';
                   }
                   $html .='</label>';
                   if(isset($desc) && !empty($desc)){
                     $html .=' <p>'.$desc.'</p>';
                 }
             }
         }else{
           if(isset($label) && !empty($label)){
               $html .='<label class="col-lg-2 col-form-label" for="'.$id.'">'.$label;
               if(isset($required) && $required){
                   $html .='<span class="text-danger">*</span>';
               }
               $html .='</label>';
           }
           $html .='<div class="col-lg-10">';
       }
       $html .='<div class="row">';
       $html .='<div class="col-sm-9">';
       $html .='<input type="range" min="'.$min.'" max="'.$max.'" step="'.$step.'" class="form-control '.$class.'" id="'.$id.'" name="'.$name.'" value="'.$value.'" onchange="rangeValue(this)" oninput="'.$id.'_range_input_show.value=value">';
       $html .='</div>';
       $html .='<div class="col-lg-3">';

       $html .=' <input type="number" class="form-control " readonly="" id="'.$id.'_range_input_show" oninput="'.$id.'.value=value" value="'.$value.'">';
       $html .=' </div>';
       $html .='</div>';
       $html .='</div> ';
       $html .='</div>';
   }
}
return $html;
}
}
if (!function_exists('touristbook_string_explode')) {
    function touristbook_string_explode($field)
    {
     $result = "";
     if (preg_match('/[,]/', $field) && !empty($field)) {
         $result = explode(',',$field);
     }else{
      $result = $field;
  }
  return $result;
}
}
if (!function_exists('textareaTemplate')) {

    function textareaTemplate($fields_data)
    {
     $html = "";
     if (!empty($fields_data) && is_array($fields_data)) {
        extract($fields_data);
        $name = (!empty($name))?$name: '';
        $label = (!empty($label))?$label: '';
        $id = (!empty($id))?$id: '';
        $class = (!empty($class))?$class: '';
        $rows = (!empty($rows))?$rows: 8;
        $value = (!empty($value))?$value: '';
        $name = (!empty($name))?$name: '';
        $label = (!empty($label))?$label: '';
        $desc = (!empty($desc))?$desc: '';

        $html .='<div class="form-group row">';
        if(empty($id)){
           $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;
       }
       if(!isset($col)){
        $html .='<div class="col-lg-12">';
        if(isset($label) && !empty($label)){
          $html .='<label class="subform-card-label" for="'.$id.'">'.$label.'</label>';
      }
  }else{
      if(isset($label) && !empty($label)){
          $html .='<label class="col-lg-2 col-form-label" for="'.$id.'">'.$label.'</label>';
      }
      $html .='<div class="col-lg-10">';
  }
  $html .='<textarea class="form-control '.$class.'" id="'.$id.'" name="'.$name.'" rows="'.$rows.'" placeholder="Enter '.$label.'..">'.$value.'</textarea>';

  $html .='</div>';
  $html .='</div>';
}
return $html;
}
}

if (!function_exists('selectBoxTemplate')) {

    function selectBoxTemplate($fields_data)
    {
     $html = "";
     if (!empty($fields_data) && is_array($fields_data)) {
        extract($fields_data);
        $name = (!empty($name))?$name: '';
        $label = (!empty($label))?$label: '';
        $id = (!empty($id))?$id: '';
        $class = (!empty($class))?$class: '';
        $rows = (!empty($rows))?$rows: 8;
        $value = (!empty($value))?$value: '';
        $name = (!empty($name))?$name: '';
        $label = (!empty($label))?$label: '';
        $option_attr = (!empty($option_attr))?$option_attr: '';
        $parent_class = (!empty($parent_class))?$parent_class: '';
        $attr = (!empty($attr))?$attr: '';
        $first_option_text = (!empty($first_option_text))?$first_option_text:ucwords($label);
        $html .='<div class="form-group row '.$parent_class .'">';

        if(isset($multiple) && !empty($multiple)){
          $multiple = 'multiple="multiple"';
      }else{
          $multiple = "";
      }
      if(empty($id)){
       $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;
   }

   if(!isset($col)){
    $html .='<div class="col-lg-12">';
    if(isset($label) && !empty($label)){
     $html .='<label class="subform-card-label" for="'.$id.'">'.$label.'</label>';
     if(isset($desc) && !empty($desc)){
      $html .='<p>'.$desc.'</p>';
  }
}
}else{
 if(isset($label) && !empty($label)){
  $col = ($col == 'col-lg-3')?$col:'col-lg-2';
  $html .='<label class="'.$col.' col-form-label" for="'.$id.'">'.$label.'</label>';
  if(isset($desc) && !empty($desc)){
      $html .='<p>'.$desc.'</p>';
  }
}
$col_s = ($col_s == 'col-lg-9')?$col_s:'col-lg-10';
$html .='<div class="'.$col_s.'">';
}
//$selected = (empty($items))?$selected:"";
$html .='<select class="form-control single-select-placeholder-touristbook '.$class .'" id="'.$id.'" name="'.$name.'" '.$multiple.' '.$attr.'  selected_value="'.$selected.'">';
if(!isset($first_empty_option)){
    if(isset($label) && !empty($label)){
        $html .='<option value="" '.$option_attr.'>Select '.$first_option_text.'</option>';
    }else{
        $html .='<option value="" '.$option_attr.' >--Select--</option>';
    }
}
if(!empty($items)){

    foreach($items as $item){
        if(is_array($selected)){

            $selected_attr =  in_array($item->id, $selected) ? 'selected' : "";
            $html .='<option value="'.$item->id.'" '. $selected_attr .' '.$option_attr.' >'.$item->value.'</option>';
        }else{
            $selected_attr = ($item->id == $selected) ? 'selected' : "" ;
            
            $html .='<option value="'.$item->id.'" '.$selected_attr.' '.$option_attr.' >'.$item->value.'</option>';
        }
    }
}

$html .='</select>';

if(isset($required)){
    $html .=get_form_error_msg($errors, $name);
}
$html .='</div>';
$html .='</div>';
}
return $html;
}
}

if (!function_exists('getStar')) {
    function getStar($rating)
    {
        $html_star = "";
        if ($rating != 0) {
            if ($rating == 5) {
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star blue"></i>';

            }elseif ($rating == 4) {
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star gray"></i>';
            }elseif ($rating == 3) {
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star blue"></i>';
                $html_star .='<i class="fa fa-star gray"></i>';
                $html_star .='<i class="fa fa-star gray"></i>';
            }elseif ($rating == 2) {
              $html_star .='<i class="fa fa-star blue"></i>';
              $html_star .='<i class="fa fa-star blue"></i>';
              $html_star .='<i class="fa fa-star gray"></i>';
              $html_star .='<i class="fa fa-star gray"></i>';
              $html_star .='<i class="fa fa-star gray"></i>';
          }elseif ($rating == 1) {
            $html_star .='<i class="fa fa-star blue"></i>';
            $html_star .='<i class="fa fa-star gray"></i>';
            $html_star .='<i class="fa fa-star gray"></i>';
            $html_star .='<i class="fa fa-star gray"></i>';
            $html_star .='<i class="fa fa-star gray"></i>';
        }
    }else{
        $html_star .='<i class="fa fa-star gray"></i>';
        $html_star .='<i class="fa fa-star gray"></i>';
        $html_star .='<i class="fa fa-star gray"></i>';
        $html_star .='<i class="fa fa-star gray"></i>';
        $html_star .='<i class="fa fa-star gray"></i>';
    }
    return $html_star;
}
}
if (!function_exists('get_price')) {
    function get_price($obj,$currency_symbal='₹')
    {
      
        $price_html = "";
        if (is_object($obj)) {
            $price_html .= '<span class="price">';
        }
        $priceObject = Conversion::where('currency_name', Session::get('currency'))->first();
        $price = 0;
        
        if($priceObject != null) {
            $currency_symbal = $priceObject->currency_symbol;
            if (is_object($obj)) {
                
                if (isset($obj->avg_price)) {
                    $price = $priceObject->conversion_rate * ((!empty($obj->avg_price))?round($obj->avg_price):0);
                }elseif (isset($obj->price)) {
                  $price = $priceObject->conversion_rate * ((!empty($obj->price))?round($obj->price):0);
              }else{
                $price = $obj->price;
            }
        }else{
          
           $price = $priceObject->conversion_rate * ((!empty($obj))?round($obj):0);

           
       }
   }else{
       if (is_object($obj)) {
        if (isset($obj->avg_price)) {
            $price = ((!empty($obj->avg_price))?round($obj->avg_price):0);
        }elseif (isset($obj->price)) {
          $price = ((!empty($obj->price))?round($obj->price):0);
      }else{
        $price = $obj->price;
    }
    
}else{
  $price = $obj;

}
}
$price_html .=   $currency_symbal;
if (is_float($price)) {
    $price_html .= ceil($price);
}else{
    $price_html .= $price;
}
         //$price_html .= number_format((float)$price, 2, '.', '');
if (is_object($obj)) {
    $price_html .= '</span>';
}

return $price_html;
}
}

if (!function_exists('getNewIcon')) {
    function getNewIcon($name = '', $color = '', $width = '', $height = '', $stroke = false)
    {
       $fonts = config('fonts');
         // if ($fonts) {
         //        if (isset($fonts)) {
         //            self::$fonts = $fonts;
         //        }
         //    }
       if (empty($fonts)) {
        return '';
    }
    if (!isset($fonts[$name])) {
        return '';
    }
    $icon = $fonts[$name];
    if (!empty($color)) {
        if ($stroke) {
            $icon = preg_replace('/stroke="(.{7})"/', 'stroke="' . $color . '"', $icon);
        } else {
            $icon = preg_replace('/fill="(.{7})"/', 'fill="' . $color . '"', $icon);
        }
    }

    if (!empty($width)) {
        $icon = preg_replace('/width="(\d{2}[a-z]{2})"/', 'width="' . $width . '"', $icon);
    }

    if (!empty($width)) {
        $icon = preg_replace('/height="(\d{2}[a-z]{2})"/', 'height="' . $height . '"', $icon);
    }

    $icon = str_replace(' height=""', '', $icon);
    $icon = str_replace(' width=""', '', $icon);

    return '<i class="input-icon field-icon fa">' . $icon . '</i>';
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


if (!function_exists('getImageUrl')) {
    function getImageUrl($id,$conversion_type='')
    {
         $NamespacedModel = 'App\\Models\\File';
        $NamespacedModelMedia = 'App\\Models\\Media';
       
        $media = $NamespacedModelMedia::find($id);
        if (!empty($media)) {
            $file = $NamespacedModel::find($media->model_id);
            if (!empty($file)) {
                if ($conversion_type == 'thumbnail') {
                    $width = 100;
                    $height = 100;
                    $quality = 90;
                }else{
                    $explode_type = explode('x', $conversion_type);
                    $width = $explode_type[0];
                    $height = $explode_type[1];
                    $quality = 100;
                }
                $file->addMediaConversion($conversion_type)
                ->width($width)
              ->height($height)
              ->quality($quality)
              ->keepOriginalImageFormat();
                return $file->getFirstMediaUrl('images',$conversion_type);
            }
        }
        return null;
    }
}

if (!function_exists('getConversionUrl')) {
    function getConversionUrl($id,$conversion_type=''){

        $NamespacedModel = 'App\\Models\\File';
        $NamespacedModelMedia = 'App\\Models\\Media';
        $conversion_arr = ["thumbnail","768x576","600x450","450x417"];
        if (!in_array($conversion_type, $conversion_arr)) {
            $conversion_type = "";
        }
        $media = $NamespacedModelMedia::find($id);
        if (!empty($media)) {
            $file = $NamespacedModel::find($media->model_id);
            if (!empty($file)) {
                return $file->getFirstMediaUrl('images',$conversion_type);
            }
        }
        return null;

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

if (!function_exists('getCustomIcons')) {
    function getCustomIcons($custom_icons)
    {

       $css = "<style>";
       if (isset($custom_icons) && !empty($custom_icons)) {
           foreach ($custom_icons as $key => $custom_icon) {
            $css .= ".".$custom_icon->slug."{background:url(".$custom_icon->uri.") no-repeat center!important;}";
        }
    }
    $css .="</style>";
    return $css;
}
}

if (!function_exists('touristbook_custom_grouping_val')) {
  function touristbook_custom_grouping_val($data,$field_name)
  {

    $result = array();
    $no_parent = 'activity-zone-more';

    if (is_array($data) && !empty($data)) {
      foreach ($data as $item) {
          // if (!isset($result[$parent])) {
        if (!empty($item[$field_name.'-'.'parent'])) {

          $parent = touristbook_sanitize_title(strtolower($item[$field_name.'-'.'parent']));
          $temp[$field_name.'-'.'title'] = $item[$field_name.'-'.'title'];
            // $temp['description'] = $item['description'];
            // $temp['youtube_link'] = $item['youtube_link'];
          $result[$parent][] = $temp;
      }else{
          $temp[$field_name.'-'.'title'] = $item[$field_name.'-'.'title'];
            // $temp['description'] = $item['description'];
            // $temp['youtube_link'] = $item['youtube_link'];
          $result[$no_parent][] = $temp;
      }
        // }
  }
  return $result;
}else{
  return;
}
}
}
if (!function_exists('castImageValue')) {
    function castImageValue($data,$field_name,$type)
    {
       if (!empty($data)) {
         $file_key = $field_name.'-'.$type;
         foreach ($data as $key => $value) {
            $file = json_decode($value[$file_key],true);
            if (!empty($file) && is_array($file)) {
               $data[$key][$file_key] = $file;
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

if (!function_exists('getSingleCustomIcon')) {
    function getSingleCustomIcon($id)
    {


        $icon = '';
        if (!empty($id)) {
            $NamespacedModel = 'App\\Models\\CustomIcon';
            if (is_int($id)) {
            $result = $NamespacedModel::findOrFail($id);
            if ($result) {
              $icon = $result->slug;
             }
            }else{
                $icon = $id;
            }
      }
      return $icon;
  }
}
if (!function_exists('getSingleRecord')) {
    function getSingleRecord($id,$model,$term=false)
    {
        $detail = "";
        if (!empty($model)) {
            if ($term) {
               $NamespacedModel = 'App\\Models\\Terms\\' . $model;
           }else{ 
               $NamespacedModel = 'App\\Models\\' . $model;
           }

           $detail = $NamespacedModel::findOrFail($id);
       }
       return $detail;
   }
}

if (!function_exists('GetVideoGallery')) {
    function GetVideoGallery($location)
    {
        $NamespacedModel = 'App\\Models\\VideoGallery';

        $GetVideoGallery = $NamespacedModel::where('name',ucwords($location->name))->orWhere('location_id',$location->id)->first();
        return $GetVideoGallery;
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
if (!function_exists('footer_destinations')) {
function footer_destinations()
{
    $NamespacedModel = 'App\\Models\\Location';

    $locations = $NamespacedModel::latest()->limit(5)->get(['id','slug','name']);
    return $locations;
}
}



if (!function_exists('exploreJsonData')) {
    function exploreJsonData($json_data="",$key=null){

        $result = "";
        if (!empty($json_data)) {
            if (!is_array($json_data)) {
                $json_decode = json_decode($json_data,true);
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
if (!function_exists('exploreJsonRecord')) {
    function exploreJsonRecord($json_data="",$key=null){

        $result = "";
        if (!empty($json_data)) {
           $json_decode = json_decode($json_data,true);
           $collection = collect($json_decode);
           $result = $collection->get($key);

       }
       return $result;

   }
}

if (!function_exists('exploreArrayData')) {
    function exploreArrayData($data="",$key=null){

        $result = "";
        if (!empty($data)) {
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
    function matchRouteGroupName($route_group_name, $group_type=null){
        $mm_show = "";
        if (!empty($route_group_name)) {
            $routeName = getRouteName();


            if (str_contains($routeName, $route_group_name)) {
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
if(!function_exists('get_body_error_msg')){
    function get_body_error_msg($errors){
        $form_error = "";

        foreach ($errors->all() as $error){


           $form_error .='<div class="alert alert-danger alert-dismissible alert-alt solid fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
           </button><strong>Error!</strong>&nbsp;'.$error.'</div>';
       }



       return  $form_error;
   }
}
if (!function_exists('fatchIconByErrorCodeMetch')) {

    function fatchIconByErrorCodeMetch($code)
    {
        $i_html = "";
        if ($code == '400') {
            $i_html = '<i class="fa fa-thumbs-down text-danger"></i>';
        }elseif ($code == '401') {
            $i_html = '<i class="fa fa-times-circle text-danger"></i>';
        }elseif ($code == '402') {
            $i_html = '<i class="fa fa-exclamation-triangle text-warning"></i>';
        }elseif ($code == '403') {
         $i_html = '<i class="fa fa-times-circle text-danger"></i>';
     }elseif ($code == '404') {
        $i_html = '<i class="fa fa-exclamation-triangle text-warning"></i>';
    }elseif ($code == '419') {
     $i_html = '<i class="fa fa-exclamation-triangle text-warning"></i>';
 }elseif ($code == '429') {
    $i_html = '<i class="fa fa-exclamation-triangle text-warning"></i>';
}elseif ($code == '500') {
    $i_html = '<i class="fa fa-exclamation-triangle text-warning"></i>';
}elseif ($code == '503') {
    $i_html = '<i class="fa fa-exclamation-triangle text-warning"></i>';
}else{
 $i_html = '<i class="fa fa-exclamation-triangle text-warning"></i>';
}
return $i_html;
}
}
if(!function_exists('get_form_success_msg')){
    function get_form_success_msg($success){

        $form_success='<div class="alert alert-success alert-dismissible alert-alt solid fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button><strong>Success!</strong>&nbsp;'.$success.'</div>';

        return  $form_success;
    }
}

if(!function_exists('print_error_message')){
    function print_error_message($error){

        $errMsg='<div class="alert alert-danger alert-dismissible alert-alt solid fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button><strong>Success!</strong>&nbsp;'.$error.'</div>';

        return  $errMsg;
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
    function get_array_mapping($data,$field=false,$map_type=false) {
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
         if ($map_type == true) {
            $result = $collection->map(function ($value,$key) {
               return (object)[
                'id'=> touristbook_sanitize_title($value),
                'value'=>$value
            ];
        });
        }else{

         $result = $collection->map(function (int $item, int $key) {
            return (int)$item;
        });
     }
 }
}
return $result->all();


}
}


if (!function_exists('tourist_array_mapping')) {
    function tourist_array_mapping($data)
    {
        $result = [];
        if (!empty($data)) {
            $collection = collect($data);
            $result = $collection->map(function ($value,$key) {
               return (object)[
                'id'=> $value,
                'value'=>$value
            ];
        });
        }
        return $result;

    }
}
