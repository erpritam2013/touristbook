 @section('setting_action', route('admin.settings.theme-settings.store','gtranslate_setting'))
 <div class="card">
    <div class="card-header">
        <h4 class="card-title">Languages</h4>
    </div>
    <div class="card-body">
        <div class="gt-translate-form">
            <form class="form-valide" id="setting-form-gtranslate" action="@yield('gtranslate_setting')" method="post">
                 {{ csrf_field() }}
            @yield('setting_form_method')
                <div class="form-row">
                    @if(!empty($gt_languages))
                    @foreach($gt_languages as $key => $gt_language)
                    <div class="form-group col-md-3">
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="gtranslate_setting[]" value="{{$key}}" {{in_array($key,exploreJsonData(get_settings_option_value('gtranslate_setting')))?'checked':''}}>
                        <label class="form-check-label">
                            {{$gt_language}}
                        </label>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
</div>