@if(!empty($typeData))
    @foreach($typeData as $key => $card)
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">&nbsp;</h4>
        </div>

        <div class="card-body">
        @foreach($card as $singleType)
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">{{$singleType['label']}}</label>
                <div class="col-lg-9">
                    @if($singleType['control'] == "text")
                        <input type="text" class="form-control" name="{{$type}}[{{$key}}][{{$singleType['name']}}]" value="{{$singleType['value'] ?? ''}}" >
                    @elseif($singleType['control'] == "textarea")
                        <textarea class="form-control" name="{{$type}}[{{$key}}][{{$singleType['name']}}]" >{{$singleType['value'] ?? ''}}</textarea>
                    @endif
                </div>
            </div>
        @endforeach
        </div>
    </div>


    @endforeach
@endif