<form class="form-valide" id="room-form" action="@yield('room_action')" method="post">
    {{ csrf_field() }}
    @yield('room_form_method')
    <div class="row">
        <div class="col-xl-8">
            @include('admin.rooms.partials.basic-card', ['room'=>$room ?? null])

            @include('admin.rooms.partials.room-info-card', ['room'=>$room ?? null])


            @include('admin.rooms.partials.excerpt', ['room'=>$room ?? null])
            @include('admin.rooms.partials.social-link-section', ['room'=>$room ?? null])

            {{--@include('admin.rooms.partials.user', ['room'=>$room ?? null])--}}

        </div>
        <div class="col-xl-4">
            @include('admin.rooms.partials.publish-card', ['room'=>$room ?? null])
             @include('admin.partials.cards.featured-image', ['item'=> $room])

            @include('admin.partials.cards.facilities', ['facilities'=> $facilities , 'selected'=>$room->facilities->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.types', ['types'=> $types , 'selected'=>$room->types->pluck('id')->toArray() ?? []])

        </div>
    </div>


    <button type="submit" class="btn btn-primary">@isset($room->id)Update @else Save @endisset</button>
    @if(!isset($room->id))
    <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
    @endif

</form> <!-- Form End -->
