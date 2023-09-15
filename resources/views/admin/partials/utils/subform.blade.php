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
                        $elemClass = isset($typeFields[$controlId]['class']) ? $typeFields[$controlId]['class'] : '';
                    @endphp
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="subform-card-label">{{ $typeFields[$controlId]['label'] }}</label>
                        @if($typeFields[$controlId]['control'] == "text")
                            <input type="text" class="form-control {{$elemClass}} " name="{{$type}}[{{$key}}][{{$controlId}}]" value="{{$value ?? ''}}" id="{{$type.'-tsign-'.$key.'-tsign-'.$controlId}}" >
                        @elseif($typeFields[$controlId]['control'] == "textarea")
                            <textarea class="form-control {{$elemClass}} " name="{{$type}}[{{$key}}][{{$controlId}}]"  id="{{$type.'-tsign-'.$key.'-tsign-'.$controlId}}">{{$value ?? ''}}</textarea>
                        @elseif($typeFields[$controlId]['control'] == "media")
                            <div class="media-controls">
                                <input type="text" class="form-control media-input {{$elemClass}}" name="{{$type}}[{{$key}}][{{$controlId}}]" value="{{$value ?? ''}}" id="{{$type.'-tsign-'.$key.'-tsign-'.$controlId}}" />
                                <button type="button" class="btn btn-primary mt-2 add-media-btn">+</button>
                                <button type="button" class="btn btn-danger mt-2 remove-media-btn">-</button>
                                <div class="media-preview">
                                    @php
                                        $imgSrc = $value ?? ''
                                    @endphp
                                    <img src="{{$imgSrc}}" class="img" height="150" width="auto" />
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            @endforeach
            </div>
        </div>
    </li>
@endif