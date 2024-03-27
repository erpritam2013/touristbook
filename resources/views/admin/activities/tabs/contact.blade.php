
<!-- contact info -->
{!!selectBoxTemplate(['items' => $show_agent_contact_info, 'name'=> 'contact[info]','desc'=>'Use contact info of people who upload activity || Use contact info in activity details','selected'=>$activity->detail->contact['info'] ?? "",'label'=>'Contact Info','id'=>'info'])!!}
<!-- contact email -->
{!!inputTemplate(['name'=> 'contact[email]','label'=>'Activity Email','desc'=>'This email will received notification when have booking order','value'=>$activity->detail->contact['email'] ?? '','id' => "contact-email",'control'=>'email'])!!}
<!-- website -->
{!!inputTemplate(['name'=> 'contact[website]','label'=>'Activity Website','desc'=>'Enter activity website','value'=>$activity->detail->contact['website'] ?? '','id' => "contact-website",'control'=>'url'])!!}
<!-- phone number -->
{!!inputTemplate(['name'=> 'contact[phone]','label'=>'Activity Phone Number','desc'=>'Enter activity phone number','value'=>$activity->detail->contact['phone'] ?? '','id' => "contact-phone",'control'=>'text'])!!}
<!-- fax number -->
{!!inputTemplate(['name'=> 'contact[fax]','label'=>'Activity Fax Number','desc'=>'Enter activity fax number','value'=>$activity->detail->contact['fax'] ?? '','id' => "contact-fax",'control'=>'text'])!!}



