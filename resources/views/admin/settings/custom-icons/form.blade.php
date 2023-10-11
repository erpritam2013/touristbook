     <form class="form-valide" id="activity_zone-form" action="@yield('activity_zone_action')" method="post">
        {{ csrf_field() }}
        @section('method_field')
        @show
        <div class="row">
            <div class="col-xl-12">
                @include('admin.activity-zones.partials.basic-card', ['activity_zone'=>$activity_zone ?? null])

                @include('admin.activity-zones.partials.activity-zone-options', ['activity_zone'=>$activity_zone ?? null])

                @include('admin.activity-zones.partials.activity-zone-pdf-options', ['activity_zone'=>$activity_zone ?? null])

                {{--@include('admin.partials.cards.users_section', ['users'=> $users , 'selected'=>$activity_zone->users->pluck('id')->toArray() ?? []])--}}
                
                @include('admin.activity-zones.partials.publish-card', ['activity_zone'=>$activity_zone ?? null])
            </div>
        </div>


        <button type="submit" class="btn btn-primary">@isset($activity_zone->id)Update @else Save @endisset</button>
        @if(!isset($activity_zone->id))
        <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
        @endif

                        </form> <!-- Form End -->