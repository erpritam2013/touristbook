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

        <div class="card-body" style="display: none;">
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
    <li class="subform-card">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">
                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    <span class="card-title-text">&nbsp;</span>
                </h4>
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
    </li>


    @endforeach
@endif
