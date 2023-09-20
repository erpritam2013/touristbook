@if(!empty($typeData))
    @php
    $first_element = reset($typeData);
    @endphp
    <li class="subform-card">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">
                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    <span class="card-title-text">{{$first_element}}</span>
                </h4>
                <div class="float-left">
                    <a href="javascript:void(0);" class="edit-card"><i class="fa fa-edit"></i></a>
                    <a href="javascript:void(0);" class="delete-card"><i class="fa fa-times-circle"></i></a>
                </div>
            </div>

            <div class="card-body">
            @foreach($typeData as $controlId => $value)
                @if(isset($typeFields[$controlId]))
                 @php
            $elemOptions = isset($typeFields[$controlId]['options']) ? $typeFields[$controlId]['options'] : [];
            @endphp
                    @php
                        $elemClass = isset($typeFields[$controlId]['class']) ? $typeFields[$controlId]['class'] : '';
                    @endphp
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="subform-card-label">{{ $typeFields[$controlId]['label'] }}</label>
                        @if($typeFields[$controlId]['control'] == "text")
                            <input type="text" class="form-control {{$elemClass}} " name="{{$type}}[{{$key}}][{{$controlId}}]" value="{{$value ?? ''}}" id="{{$type.'-tsign-'.$key.'-tsign-'.$controlId}}" placeholder="Enter {{$typeFields[$controlId]['label']}}...">
                        @elseif($typeFields[$controlId]['control'] == "textarea")
                            <textarea class="form-control {{$elemClass}} " name="{{$type}}[{{$key}}][{{$controlId}}]"  id="{{$type.'-tsign-'.$key.'-tsign-'.$controlId}}" placeholder="Enter {{$typeFields[$controlId]['label']}}...">{{$value ?? ''}}</textarea>
                        @elseif($typeFields[$controlId]['control'] == "media")
                            <div class="media-controls">
                                <input type="text" class="form-control media-input {{$elemClass}}" name="{{$type}}[{{$key}}][{{$controlId}}]" value="{{$value ?? ''}}" id="{{$type.'-tsign-'.$key.'-tsign-'.$controlId}}" placeholder="Enter {{$typeFields[$controlId]['label']}}..."/>
                                <button type="button" class="btn btn-primary mt-2 add-media-btn" smode="single" selectedImages="{{$value ?? ''}}"  smode="single" selectedImages="{{$value ?? ''}}" >+</button>
                                <button type="button" class="btn btn-danger mt-2 remove-media-btn">-</button>
                                <div class="media-preview">
                                    @php
                                        $imgSrc = $value ?? ''
                                    @endphp
                                    <img src="{{$imgSrc}}" class="img" height="150" width="auto" />
                                </div>
                            </div>

                              @elseif($typeFields[$controlId]['control'] == "number")
                    <input type="number" class="form-control {{$elemClass}} " name="{{$type}}[{{$key}}][{{$controlId}}]" value="{{$value ?? ''}}" id="{{$type.'-tsign-'.$key.'-tsign-'.$controlId}}" placeholder="Enter {{$typeFields[$controlId]['label']}}...">

                      @elseif($typeFields[$controlId]['control'] == "select")
                    @if(is_array($elemOptions) && !empty($elemOptions))
                    <select class="form-control {{$elemClass}}" id="{{$type.'-tsign-'.$key.'-tsign-'.$controlId}}" name="{{$type}}[{{$key}}][{{$controlId}}]" placeholder="Enter {{$typeFields[$controlId]['label']}}...">
                        <option value="">--Select--</option>
                        @foreach($elemOptions as $option)
                        @php
                        $selected = "";
                        if(is_array($value)){
                          if(in_array($option->id, $value)){
                            $selected = "selected";
                        }
                    }else{
                        if($option->id == $value){
                            $selected = "selected";
                        }
                    }
                    @endphp
                    <option value="{{$option->id}}" {{$selected}} >{{$option->value}}</option>
                    @endforeach

                </select>
                @endif
                        @endif
                    </div>
                </div>
                @endif
            @endforeach
            </div>
        </div>
    </li>
@endif