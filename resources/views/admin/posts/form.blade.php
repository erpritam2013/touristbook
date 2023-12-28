<form class="form-valide" id="post-form" action="@yield('post_action')" method="post">
    {{ csrf_field() }}
    @yield('post_form_method')
    <div class="row">
        <div class="col-xl-8">
            @include('admin.posts.partials.basic-card', ['post'=>$post ?? null])

            @include('admin.posts.partials.post-info-card', ['post'=>$post ?? null])


            @include('admin.posts.partials.excerpt', ['post'=>$post ?? null])
            {{-- @include('admin.posts.partials.social-link-section', ['post'=>$post ?? null])

           @include('admin.posts.partials.user', ['post'=>$post ?? null])--}}

        </div>
        <div class="col-xl-4">
            @include('admin.posts.partials.publish-card', ['post'=>$post ?? null])
             @include('admin.partials.cards.featured-image', ['item'=> $post])

            @include('admin.partials.cards.categories', ['categories'=> $categories , 'selected'=>$post->categories->pluck('id')->toArray() ?? [],'required'=>true])

            @include('admin.partials.cards.tags', ['tags'=> $tags , 'selected'=>$post->tags->pluck('id')->toArray() ?? []])

        </div>
    </div>


    <button type="submit" class="btn btn-primary">@isset($post->id)Update @else Save @endisset</button>
    @if(!isset($post->id))
    <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
    @endif

</form> <!-- Form End -->
