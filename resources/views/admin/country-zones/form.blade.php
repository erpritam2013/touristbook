     <form class="form-valide" id="country_zone-form" action="@yield('country_zone_action')" method="post">
        {{ csrf_field() }}
        @section('method_field')
        @show
        <div class="row">
            <div class="col-xl-12">
                @include('admin.country-zones.partials.basic-card', ['country_zone'=>$country_zone ?? null])

                @include('admin.country-zones.partials.country-zone-options', ['country_zone'=>$country_zone ?? null])

                @include('admin.country-zones.partials.country-zone-catering-options', ['country_zone'=>$country_zone ?? null])

                {{--@include('admin.partials.cards.users_section', ['users'=> $users , 'selected'=>$country_zone->users->pluck('id')->toArray() ?? []])--}}
                
                @include('admin.country-zones.partials.publish-card', ['country_zone'=>$country_zone ?? null])
            </div>
            
        </div>


        <button type="submit" class="btn btn-primary">@isset($country_zone->id)Update @else Save @endisset</button>
        @if(!isset($country_zone->id))
        <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
        @endif

                        </form> <!-- Form End -->