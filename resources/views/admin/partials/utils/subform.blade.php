@if(!empty($typeData))
    @foreach($typeData as $key => $card)
    <div class="card subform-card ui-state-default">
        <div class="card-header border-bottom">
            <h4 class="card-title">&nbsp;</h4>
            <div class="float-left">
                <a href="javascript:void(0);" class="edit-card"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" class="delete-card"><i class="fa fa-times-circle"></i></a>
            </div>
        </div>

        <div class="card-body">
        @foreach($card as $controlId => $value)
            @if(isset($typeFields[$controlId]))
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">{{ $typeFields[$controlId]['label'] }}</label>
                <div class="col-lg-9">
                    @if($typeFields[$controlId]['control'] == "text")
                        <input type="text" class="form-control" name="{{$type}}[{{$key}}][{{$controlId}}]" value="{{$value ?? ''}}" >
                    @elseif($typeFields[$controlId]['control'] == "textarea")
                        <textarea class="form-control" name="{{$type}}[{{$key}}][{{$controlId}}]" >{{$value ?? ''}}</textarea>
                    @endif
                </div>
            </div>
            @endif
        @endforeach
        </div>
    </div>


    @endforeach
@endif
