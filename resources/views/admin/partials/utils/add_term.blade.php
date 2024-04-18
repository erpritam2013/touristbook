
 <div id="{{$term_id}}-term" class="accordion accordion-no-gutter accordion-bordered">
        <div class="accordion__item">
            <div class="accordion__header" data-toggle="collapse" data-target="#{{$term_id}}-term-body">
                <span class="accordion__header--text"><i class="fa fa-plus "></i>&nbsp;Add New {{$term}}</span>
            </div>
            <div id="{{$term_id}}-term-body" class="collapse accordion__body" data-parent="#{{$term_id}}-term" data-term="{{$term}}" data-term_type="{{$term_type}}" data-term_post_type="{{get_class($post_type)}}" data-term_id="{{$term_id}}" data-field_name="{{$field_name}}">
                <div class="accordion__body--text">
                    <div class="new-term-add">

                     <div class="form-group row">
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="new-{{$term_id}}-name" placeholder="Enter a name..">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <select class="form-control single-select-placeholder-touristbook" id="new-{{$term_id}}-parent-id" >
                                <option value="">Select {{$term}} Parent</option>
                            
                                @isset($terms)
                                @if($term == 'TermActivityList')
                                 @foreach($term_activity_list_parent as $parent)
                                    <option value="{{$parent}}" >{{customStringReplaceWithStrCase('-'," ",$parent,'ucwords')}}</option>
                                    @endforeach
                                @else
                                {!!getOptionsTemplate(['items' => $terms])!!}
                                @endif
                                @endisset
                            </select>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                           <button type="button" class="btn btn-primary ajax-new-term-store">New {{$term}}</button>

                       </div>
                   </div>

               </div>
           </div>
       </div>
   </div>

</div>