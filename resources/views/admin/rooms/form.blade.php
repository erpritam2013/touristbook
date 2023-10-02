<form class="form-valide" id="room-form" action="@yield('room_action')" method="post">
    {{ csrf_field() }}
    @yield('room_form_method')
    <div class="row">
        <div class="col-xl-8">
            @include('admin.activities.partials.basic-card', ['room'=>$room ?? null])

            @include('admin.activities.partials.room-info-card', ['room'=>$room ?? null])

            @include('admin.activities.partials.policies-section', ['room'=>$room ?? null])

            @include('admin.activities.partials.extra-fields-section', ['room'=>$room ?? null])

            @include('admin.activities.partials.social-link-section', ['room'=>$room ?? null])

            @include('admin.activities.partials.excerpt', ['room'=>$room ?? null])

            {{--@include('admin.activities.partials.user', ['room'=>$room ?? null])--}}

        </div>
        <div class="col-xl-4">
            @include('admin.activities.partials.publish-card', ['room'=>$room ?? null])
             @include('admin.partials.cards.featured-image', ['item'=> $room])
            @include('admin.partials.cards.term-room-lists', ['term_room_lists'=> $term_room_lists , 'selected'=> $room->term_room_lists->pluck('id')->toArray() ?? []])


            @include('admin.partials.cards.attractions', ['attractions'=> $attractions , 'selected'=>$room->attractions->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.languages', ['languages'=> $languages , 'selected'=>$room->languages->pluck('id')->toArray() ?? []])

             @include('admin.partials.cards.states', ['states'=> $states , 'selected'=>$room->states->pluck('id')->toArray() ?? []])



        </div>
    </div>


    <button type="submit" class="btn btn-primary">@isset($room->id)Update @else Save @endisset</button>
    @if(!isset($room->id))
    <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
    @endif

</form> <!-- Form End -->
