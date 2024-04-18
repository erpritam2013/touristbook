     <form class="form-valide" id="activity_list-form" action="@yield('activity_list_action')" method="post">
        {{ csrf_field() }}
        @section('method_field')
        @show
        <div class="row">
            <div class="col-xl-8">
                @include('admin.activity-lists.partials.basic-card', ['activity_list'=>$activity_list ?? null])
               
            </div>

             <div class="col-xl-4">
                @include('admin.activity-lists.partials.publish-card', ['activity_list'=>$activity_list ?? null])

                 @include('admin.activity-lists.partials.custom-icons', ['activity_list'=>$activity_list ?? null])

                @include('admin.activity-lists.partials.activity-options', ['activity_list'=>$activity_list ?? null])

                {{--@include('admin.partials.cards.users_section', ['users'=> $users , 'selected'=>$activity_list->users->pluck('id')->toArray() ?? []])--}}
                

             </div>
        </div>


        <button type="submit" class="btn btn-primary">@isset($activity_list->id)Update @else Save @endisset</button>
        @if(!isset($activity_list->id))
        <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
        @endif

                        </form> <!-- Form End -->