     <form class="form-valide" id="activity_package-form" action="@yield('activity_package_action')" method="post">
        {{ csrf_field() }}
        @section('method_field')
        @show
        <div class="row">
            <div class="col-xl-12">
                @include('admin.activity-packages.partials.basic-card', ['activity_package'=>$activity_package ?? null])

                @include('admin.activity-packages.partials.activity-options', ['activity_package'=>$activity_package ?? null])

                @include('admin.activity-packages.partials.activity-packages-section', ['activity_package'=>$activity_package ?? null])

                @include('admin.activity-packages.partials.custom-icons', ['activity_package'=>$activity_package ?? null])


                {{--@include('admin.partials.cards.users_section', ['users'=> $users , 'selected'=>$activity_package->users->pluck('id')->toArray() ?? []])--}}
                
                @include('admin.activity-packages.partials.publish-card', ['activity_package'=>$activity_package ?? null])
            </div>
        </div>


        <button type="submit" class="btn btn-primary">@isset($activity_package->id)Update @else Save @endisset</button>
        @if(!isset($activity_package->id))
        <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
        @endif

                        </form> <!-- Form End -->