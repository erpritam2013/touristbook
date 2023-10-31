 @php
 $sidebar_position = [
 (object)['id'=>'left','value'=>"Left"],
 (object)['id'=>'right','value'=>"Right"]
 ];
 $sidebar = (object)[
 (object)['id'=>'blog-sidebar','value'=>"Blog Sidebar"]
 ];

 
 @endphp
 <!-- Sidebar position -->
 @include('admin.partials.utils.select_box', ['items' => $sidebar_position, 'name'=> 'page_sidebar_pos','selected'=>$page->page_sidebar_pos,'lebal'=>'Sidebar position','desc'=>'You can choose no sidebar, left sidebar and right sidebar','first_option_text'=>'No'])
<!-- Choose sidebar -->
 @include('admin.partials.utils.select_box', ['items' => $sidebar, 'name'=> 'page_sidebar','selected'=>$page->page_sidebar,'lebal'=>'Choose sidebar'])