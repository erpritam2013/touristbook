<div class="card {{(count($meetingAndEvents) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Meetings and Events</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
        @include('admin.partials.utils.nested_checkbox_list', ['items' => $meetingAndEvents, 'name'=> 'meetingAndEvents', 'selected' => $selected])
        </div>
    </div>
</div>
