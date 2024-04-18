     <form class="form-valide" id="location-form" action="@yield('location_action')" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @section('method_field')
                            @show
                            <div class="row">
                                <div class="col-xl-8">
                                    @include('admin.locations.partials.basic-card', ['location'=>$location ?? null])

                                    @include('admin.locations.partials.location-settings', ['location'=>$location ?? null])

                                    @include('admin.locations.partials.extra-notes', ['location'=>$location ?? null])

                                </div>
                                <div class="col-xl-4">
                                    @include('admin.locations.partials.publish-card', ['location'=>$location ?? null])

                                     @include('admin.partials.cards.featured-image', ['item'=> $location])

                                    @include('admin.partials.cards.types', ['types'=> $types , 'selected'=>$location->types->pluck('id')->toArray() ?? []])

                                    @include('admin.partials.cards.places', ['places'=> $places , 'selected'=>$location->places->pluck('id')->toArray() ?? []])

                                    @include('admin.partials.cards.states', ['states'=> $states , 'selected'=>$location->states->pluck('id')->toArray() ?? []])

                                </div>
                            </div>


<button type="submit" class="btn btn-primary">@isset($location->id)Update @else Save @endisset</button>
                            @if(!isset($location->id))
                            <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
                            @endif

                        </form> <!-- Form End -->
