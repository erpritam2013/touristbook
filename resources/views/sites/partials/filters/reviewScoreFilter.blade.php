<div class="mb-left">
    <div class="mb-left-title">
        <label for="form_reviews" class="form-label">Review Score</label>
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
     @if(!empty($filterReviewScore))
 
        <ul class="list-unstyled mb-0 review-score-filter">
            @foreach($filterReviewScore as $key => $reviewScore)
            <li>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="review_{{$key}}" name="rating[]"
                    class="custom-control-input filter-option filter-rating" value="{{$reviewScore['value']}}">
                    <label for="review_{{$key}}" class="custom-control-label">
                      @for ($i =0; $i < $reviewScore['value']; $i++)
                      <span class="real-star"><i class="fa fa-star"></i></span>
                      @endfor
                      @if(!empty($reviewScore['fake']))
                      @for ($i =0; $i < $reviewScore['fake']; $i++)
                      <span class="fake-star"><i class="fa fa-star"></i></span>
                      @endfor
                      @endif
                  </label>
              </div>
          </li>
          @endforeach
      </ul>
      @endif


  </div>

</div>
