<div class="card {{(count($accessibles) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Accessible</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $accessibles, 'name'=> 'accessibles', 'selected' => $selected])
        </div>
    </div>
</div>
