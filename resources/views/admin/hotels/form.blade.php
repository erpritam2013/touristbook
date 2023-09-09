<form class="form-valide" id="hotel-form" action="@yield('hotel_action')" method="post">
    {{ csrf_field() }}
    @yield('hotel_form_method')
    <div class="row">
        <div class="col-xl-8">
            @include('admin.hotels.partials.basic-card', ['hotel'=>$hotel ?? null])

            @include('admin.hotels.partials.hotel-info-card', ['hotel'=>$hotel ?? null])

            @include('admin.hotels.partials.corporate', ['hotel'=>$hotel ?? null])

            @include('admin.hotels.partials.food-dining', ['hotel'=>$hotel ?? null])

        </div>
        <div class="col-xl-4">
            @include('admin.hotels.partials.publish-card', ['hotel'=>$hotel ?? null])
            @include('admin.partials.cards.facilities', ['facilities'=> $facilities , 'selected'=> $hotel->facilities->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.amenities', ['amenities'=> $amenities , 'selected'=>$hotel->amenities->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.medicares', ['medicares'=> $medicares , 'selected'=>$hotel->medicare_assistances->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.top-services', ['topServices'=> $topServices , 'selected'=>$hotel->top_services->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.places', ['places'=> $places , 'selected'=>$hotel->places->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.property-types', ['propertyTypes'=> $propertyTypes , 'selected'=>$hotel->propertyTypes->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.accessibles', ['accessibles'=> $accessibles , 'selected'=>$hotel->accessibles->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.meeting-and-events', ['meetingAndEvents'=> $meetingAndEvents , 'selected'=>$hotel->meetingEvents->pluck('id')->toArray() ?? []])

             @include('admin.partials.cards.states', ['states'=> $states , 'selected'=>$hotel->states->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.occupancies', ['occupancies'=> $occupancies , 'selected'=>$hotel->occupancies->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.deal-discount', ['deals'=> $deals , 'selected'=>$hotel->deals->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.activities', ['activities'=> $activities , 'selected'=>$hotel->activities->pluck('id')->toArray() ?? []])



        </div>
    </div>


    <button type="submit" class="btn btn-primary">@isset($hotel->id)Update @else Save @endisset</button>
    @if(!isset($hotel->id))
    <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
    @endif

</form> <!-- Form End -->
