<form class="form-valide" id="activity-form" action="@yield('activity_action')" method="post">
    {{ csrf_field() }}
    @yield('activity_form_method')
    <div class="row">
        <div class="col-xl-8">
            @include('admin.activities.partials.basic-card', ['activity'=>$activity ?? null])

            @include('admin.activities.partials.activity-info-card', ['activity'=>$activity ?? null])

            @include('admin.activities.partials.policies-section', ['activity'=>$activity ?? null])

            @include('admin.activities.partials.extra-fields-section', ['activity'=>$activity ?? null])

            @include('admin.activities.partials.social-link-section', ['activity'=>$activity ?? null])

            @include('admin.activities.partials.excerpt', ['activity'=>$activity ?? null])

            {{--@include('admin.activities.partials.user', ['activity'=>$activity ?? null])--}}

        </div>
        <div class="col-xl-4">
            @include('admin.activities.partials.publish-card', ['activity'=>$activity ?? null])
            @include('admin.partials.cards.term-activity-lists', ['term_activity_lists'=> $term_activity_lists , 'selected'=> $activity->term_activity_lists->pluck('id')->toArray() ?? []])


            @include('admin.partials.cards.attractions', ['attractions'=> $attractions , 'selected'=>$activity->attractions->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.languages', ['languages'=> $languages , 'selected'=>$activity->languages->pluck('id')->toArray() ?? []])

             @include('admin.partials.cards.states', ['states'=> $states , 'selected'=>$activity->states->pluck('id')->toArray() ?? []])



        </div>
    </div>


    <button type="submit" class="btn btn-primary">@isset($activity->id)Update @else Save @endisset</button>
    @if(!isset($activity->id))
    <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
    @endif

</form> <!-- Form End -->
