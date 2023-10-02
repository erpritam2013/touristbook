<div class="form-group row">

    <div class="col-lg-12">
      <label class="subform-card-label" for="book_before_day">Book before number of day
      </label>
      <p>Input number of day can book before from check in date</p>
      <div class="row">
        <div class="col-sm-9">
            <input type="range" class="form-control" min="0" max="30" id="book_before_day" name="book_before_day" step="1"  value="0" onchange="rangeValue(this)" oninput="book_before_day_range_input_show.value=value"/>
        </div>
        <div class="col-sm-3">
            <input type="number" class="form-control " value="0" readonly="" id="book_before_day_range_input_show" oninput="book_before_day.value=value">
        </div>
    </div>
</div>
</div>


<div class="form-group row">

    <div class="col-lg-12">
       <label class="subform-card-label" for="book_before_arrival">Minimum number of days to book before arrival
       </label>
       <p>Booking time period before arrival.</p>
       <div class="row">
        <div class="col-sm-9">

            <input type="range" class="form-control" min="0" max="30" id="book_before_arrival" name="book_before_arrival" step="1"  value="0" onchange="rangeValue(this)" oninput="book_before_arrival_range_input_show.value=value"/>
        </div>

        <div class="col-sm-3">

            <input type="number" class="form-control " value="0" readonly="" id="book_before_arrival_range_input_show" oninput="book_before_arrival.value=value">
        </div>
    </div>
</div>
</div>