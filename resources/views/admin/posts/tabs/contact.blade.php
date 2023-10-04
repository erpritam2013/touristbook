
<!-- contact info -->
@include('admin.partials.utils.select_box', ['items' => $show_agent_contact_info, 'name'=> 'contact[info]','desc'=>'Use contact info of people who upload room || Use contact info in room details','selected'=>$room->detail->contact['info'] ?? "",'label'=>'Contact Info','id'=>'info'])
<!-- contact email -->
@include('admin.partials.utils.input', ['name'=> 'contact[email]','label'=>'room Email','desc'=>'This email will received notification when have booking order','value'=>$room->detail->contact['email'] ?? '','id' => "contact-email",'control'=>'email'])
<!-- website -->
@include('admin.partials.utils.input', ['name'=> 'contact[website]','label'=>'room Website','desc'=>'Enter room website','value'=>$room->detail->contact['website'] ?? '','id' => "contact-website",'control'=>'url'])
<!-- phone number -->
@include('admin.partials.utils.input', ['name'=> 'contact[phone]','label'=>'room Phone Number','desc'=>'Enter room phone number','value'=>$room->detail->contact['phone'] ?? '','id' => "contact-phone",'control'=>'number'])
<!-- fax number -->
@include('admin.partials.utils.input', ['name'=> 'contact[fax]','label'=>'room Fax Number','desc'=>'Enter room fax number','value'=>$room->detail->contact['fax'] ?? '','id' => "contact-fax",'control'=>'number'])



