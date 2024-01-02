<form class="form-valide" id="page-form" action="@yield('page_action')" method="post">
    {{ csrf_field() }}
    @yield('page_form_method')
    <div class="row">
        <div class="col-xl-8">
             <input type="hidden" id="base-url" value="{{route('admin.pages.pageIndex')}}" />
            @include('admin.pages.partials.basic-card', ['page'=>$page ?? null])

            {{--@include('admin.pages.partials.page-info-card', ['page'=>$page ?? null])--}}

            @include('admin.pages.partials.extra-data', ['page'=>$page ?? null])

            @include('admin.pages.partials.excerpt', ['page'=>$page ?? null])
            @include('admin.pages.partials.social-link-section', ['page'=>$page ?? null])

            {{--@include('admin.pages.partials.user', ['page'=>$page ?? null])--}}

        </div>
        <div class="col-xl-4">
           
            @include('admin.pages.partials.publish-card', ['page'=>$page ?? null])
             @include('admin.partials.cards.featured-image', ['item'=> $page])
             @include('admin.pages.partials.types', ['item'=> $page])

        </div>
    </div>


    <button type="submit" class="btn btn-primary">@isset($page->id)Update @else Save @endisset</button>
    @if(!isset($page->id))
    <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
    @endif

</form> <!-- Form End -->
