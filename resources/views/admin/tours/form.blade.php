<form class="form-valide" id="tour-form" action="@yield('tour_action')" method="post">
    {{ csrf_field() }}
    @yield('tour_form_method')
    <div class="row">
        <div class="col-xl-8">
            @include('admin.tours.partials.basic-card', ['tour'=>$tour ?? null])

           @include('admin.tours.partials.tour-info-card', ['tour'=>$tour ?? null])


            @include('admin.tours.partials.extra-fields-section', ['tour'=>$tour ?? null])
            @include('admin.tours.partials.helpful-fects-section', ['tour'=>$tour ?? null])

            @include('admin.tours.partials.social-link-section', ['tour'=>$tour ?? null])

            @include('admin.tours.partials.excerpt', ['tour'=>$tour ?? null])

           {{--  @include('admin.tours.partials.user', ['tour'=>$tour ?? null])--}}

        </div>
        <div class="col-xl-4">
            @include('admin.tours.partials.publish-card', ['tour'=>$tour ?? null])
             @include('admin.partials.cards.featured-image', ['item'=> $tour])
            @include('admin.partials.cards.package-types', ['package_types'=> $package_types , 'selected'=> $tour->package_types->pluck('id')->toArray() ?? []])


            @include('admin.partials.cards.other-packages', ['other_packages'=> $other_packages , 'selected'=>$tour->other_packages->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.types', ['types'=> $types , 'selected'=>$tour->types->pluck('id')->toArray() ?? []])

            @include('admin.partials.cards.languages', ['languages'=> $languages , 'selected'=>$tour->languages->pluck('id')->toArray() ?? []])

             @include('admin.partials.cards.states', ['states'=> $states , 'selected'=>$tour->states->pluck('id')->toArray() ?? []])



        </div>
    </div>


    <button type="submit" class="btn btn-primary">@isset($tour->id)Update @else Save @endisset</button>
    @if(!isset($tour->id))
    <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
    @endif

</form> <!-- Form End -->
