<div class="row">
    @if ($hotels->isNotEmpty())
        @foreach ($hotels as $key => $hotel)
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="listroBox">
                    <figure> <a href="hotel-detailed.html" class="wishlist_bt"></a> <a href="hotel-detailed.html"><img
                                src="/sites/images/hotels/room6.jpg" class="img-fluid" alt="">
                            <div class="read_more"><span>Read more</span></div>
                        </a> </figure>
                    <div class="listroBoxmain">
                        <h3><a href="hotel-detailed.html">{{$hotel->name}}</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</p>
                        <a class="address" href="#">Get directions</a>
                    </div>
                    <ul>
                        <li>
                            <p class="card-text text-muted"><span class="h4 text-primary">$80</span> / night</p>
                        </li>
                        <li>
                            <div class="R_retings">
                                <div class="list-rat-ch list-room-rati"> <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star"
                                        aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i
                                        class="fa fa-star" aria-hidden="true"></i> </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    @else
        <h2>No Result Found</h2>

    @endif


</div>
