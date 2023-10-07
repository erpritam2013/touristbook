
<!-- contact info -->
@include('admin.partials.utils.select_box', ['items' => $show_agent_contact_info, 'name'=> 'contact[info]','desc'=>'Use contact info of people who upload tour || Use contact info in tour details','selected'=>$tour->detail->contact['info'] ?? "",'label'=>'Contact Info','id'=>'info'])
<!-- contact email -->
@include('admin.partials.utils.input', ['name'=> 'contact[email]','label'=>'tour Email','desc'=>'This email will received notification when have booking order','value'=>$tour->detail->contact['email'] ?? '','id' => "contact-email",'control'=>'email'])
<!-- website -->
@include('admin.partials.utils.input', ['name'=> 'contact[website]','label'=>'tour Website','desc'=>'Enter tour website','value'=>$tour->detail->contact['website'] ?? '','id' => "contact-website",'control'=>'url'])
<!-- phone number -->
@include('admin.partials.utils.input', ['name'=> 'contact[phone]','label'=>'tour Phone Number','desc'=>'Enter tour phone number','value'=>$tour->detail->contact['phone'] ?? '','id' => "contact-phone",'control'=>'number'])
<!-- fax number -->
@include('admin.partials.utils.input', ['name'=> 'contact[fax]','label'=>'tour Fax Number','desc'=>'Enter tour fax number','value'=>$tour->detail->contact['fax'] ?? '','id' => "contact-fax",'control'=>'number'])



