     <form class="form-valide" id="tourism_zone-form" action="@yield('tourism_zone_action')" method="post">
        {{ csrf_field() }}
        @section('method_field')
        @show
        <div class="row">
            <div class="col-xl-12">
                @include('admin.tourism-zones.partials.basic-card', ['tourism_zone'=>$tourism_zone ?? null])

                @include('admin.tourism-zones.partials.tourism-zone-options', ['tourism_zone'=>$tourism_zone ?? null])

                @include('admin.tourism-zones.partials.tourism-zone-states', ['tourism_zone'=>$tourism_zone ?? null])

                {{--@include('admin.partials.cards.users_section', ['users'=> $users , 'selected'=>$tourism_zone->users->pluck('id')->toArray() ?? []])--}}
                
                @include('admin.tourism-zones.partials.publish-card', ['tourism_zone'=>$tourism_zone ?? null])
            </div>
        </div>


        <button type="submit" class="btn btn-primary">@isset($tourism_zone->id)Update @else Save @endisset</button>
        @if(!isset($tourism_zone->id))
        <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
        @endif

                        </form> <!-- Form End -->