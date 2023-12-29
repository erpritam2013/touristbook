<div class="row">
        <div class="col-xl-12">
             <input type="hidden" id="base-url" value="{{route('admin.settings.theme-settings.create')}}" />
            @include('admin.settings.theme-settings.partials.setting-info-card', ['settings'=>$settings ?? null])
        </div>
    </div>

