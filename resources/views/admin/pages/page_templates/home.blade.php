{!!selectBoxTemplate(['items' => $hotels, 'name'=> 'extra_data[hotels][]','selected'=>$page->extra_data['hotels'] ?? "",'id'=>'home-hotels','multiple'=>true,'label'=>'Home Hotels','multi_class'=>'multi-select-placeholder'])!!}

{!!selectBoxTemplate(['items' => $tours, 'name'=> 'extra_data[tours][]','selected'=>$page->extra_data['tours'] ?? "",'id'=>'home-tours','multiple'=>true,'label'=>'Home Packages','multi_class'=>'multi-select-placeholder'])!!}

{!!selectBoxTemplate(['items' => $locations, 'name'=> 'extra_data[locations][]','selected'=>$page->extra_data['locations'] ?? "",'id'=>'home-locations','multiple'=>true,'label'=>'Home Destinations','multi_class'=>'multi-select-placeholder'])!!}

{!!selectBoxTemplate(['items' => $activities, 'name'=> 'extra_data[activities][]','selected'=>$page->extra_data['activities'] ?? "",'id'=>'home-activities','multiple'=>true,'label'=>'Home Activities','multi_class'=>'multi-select-placeholder'])!!}

{!!selectBoxTemplate(['items' => $blogs, 'name'=> 'extra_data[blogs][]','selected'=>$page->extra_data['blogs'] ?? "",'id'=>'home-blogs','multiple'=>true,'label'=>'Home Blogs','multi_class'=>'multi-select-placeholder'])!!}

