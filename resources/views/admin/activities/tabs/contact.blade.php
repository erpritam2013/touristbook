
<!-- contact info -->
@include('admin.partials.utils.select_box', ['items' => $show_agent_contact_info, 'name'=> 'contact[info]','desc'=>'Use contact info of people who upload activity || Use contact info in activity details','selected'=>$activity->detail->contact['info'] ?? "",'label'=>'Contact Info','id'=>'info'])
<!-- contact email -->
@include('admin.partials.utils.input', ['name'=> 'contact[email]','label'=>'Activity Email','desc'=>'This email will received notification when have booking order','value'=>$activity->detail->contact['email'] ?? '','id' => "contact-email",'control'=>'email'])
<!-- website -->
@include('admin.partials.utils.input', ['name'=> 'contact[website]','label'=>'Activity Website','desc'=>'Enter activity website','value'=>$activity->detail->contact['website'] ?? '','id' => "contact-website",'control'=>'url'])
<!-- phone number -->
@include('admin.partials.utils.input', ['name'=> 'contact[phone]','label'=>'Activity Phone Number','desc'=>'Enter activity phone number','value'=>$activity->detail->contact['phone'] ?? '','id' => "contact-phone",'control'=>'text'])
<!-- fax number -->
@include('admin.partials.utils.input', ['name'=> 'contact[fax]','label'=>'Activity Fax Number','desc'=>'Enter activity fax number','value'=>$activity->detail->contact['fax'] ?? '','id' => "contact-fax",'control'=>'text'])



