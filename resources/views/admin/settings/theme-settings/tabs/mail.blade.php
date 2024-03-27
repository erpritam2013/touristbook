@section('setting_action_mail', route('admin.settings.theme-settings.store','mail'))
<form class="form-valide" id="setting-form-mail" action="@yield('setting_action_mail')" method="post"><!-- Form Start -->
     {{ csrf_field() }}
  @yield('setting_form_method')
<div class="border p-2 mb-2 ">
    <h4>Add email for mail</h4>
    @php  $emails = exploreJsonData(get_settings_option_value('email_address')); @endphp
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $emails ?? null, 'type' => 'email_address', 'btnTitle' => 'Add New'])
</div>
<button type="submit" class="btn btn-primary">Save</button>
</form> <!-- Form End -->