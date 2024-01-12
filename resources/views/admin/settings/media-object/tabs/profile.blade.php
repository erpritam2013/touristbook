@section('setting_action', route('admin.settings.theme-settings.store','profile'))
<form class="form-valide" id="setting-form-profile" action="@yield('setting_action')" method="post">
	{{ csrf_field() }}
	@yield('setting_form_method')
	<div class="card mb-0">
		<div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
			<h4 class="card-title">Admin Profile Setting</h4>
		</div>
		<div class="card-body">
			@php 
			$profile_bg = exploreJsonData(get_settings_option_value('admin_profile_bg'));
			@endphp
			<div class="image-increase">
				{!!mediaTemplate(['name'=>'admin_profile_bg','label'=>'Admin Profile Backgourd','value'=> $profile_bg ?? ''])!!}

			</div>
		</div>

	</div>
	<button type="submit" class="btn btn-primary">Save</button>
</form>
