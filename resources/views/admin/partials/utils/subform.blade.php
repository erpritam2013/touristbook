@if(!empty($typeData))
    @foreach($typeData as $key => $card)
    <div class="card subform-card">
        <div class="card-header border-bottom">
            <h4 class="card-title">&nbsp;</h4>
        </div>

        <div class="card-body">
        @foreach($card as $controlId => $value)
            @if(isset($typeFields[$controlId]))
            <div class="form-group row">
               
                <div class="col-lg-12">

                <label>{{ $typeFields[$controlId]['label'] }}</label>
                 @if(isset($typeFields[$controlId]['desc']) && !empty($typeFields[$controlId]['desc']))<p>{{$typeFields[$controlId]['desc']}}</p>
                    @endif
                    @if($typeFields[$controlId]['control'] == "text")
                        <input type="text" class="form-control" name="{{$type}}[{{$key}}][{{$controlId}}]" value="{{$value ?? ''}}" >
                    @elseif($typeFields[$controlId]['control'] == "textarea")
                    @php
                       $class = "";
                       if(isset($typeFields[$controlId]['class']) && !empty($typeFields[$controlId]['class'])){
                        $class = $typeFields[$controlId]['class'];
                       }
                     @endphp

                        <textarea class="form-control {{$class}}" name="{{$type}}[{{$key}}][{{$controlId}}]" >{{$value ?? ''}}</textarea>
                    @endif
                </div>
            </div>
           
            @endif
        @endforeach
        </div>
    </div>


    @endforeach
@endif