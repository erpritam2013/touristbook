@php 

$faqs = $location->locationMeta->faqs;

@endphp
@if(!empty($faqs))
<div class="accordion" id="accordion-faqs"> 
	<h2 class="pb-4" style="color:#07509c;font-weight:600;">Frequently Asked Questions</h2>
@foreach($faqs as $key => $faq)
	<!-- item -->
	<div class="accordion-item">

		<div class="accordion-title">
			<a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-faqs-{{$key}}" aria-expanded="false"><span class="faq-icon pr-2">{!!getNewIcon('question-help-message', '#5E6D77', '18px', '18px')!!}</span>
				{{$faq['faqs-title']}}
			</a> </div>
			<div class="collapse" id="collapse-faqs-{{$key}}" data-parent="#accordion-faqs" style="">
				<div class="accordion-content">{!!$faq['faqs-description']!!} </div>
			</div>
		</div>
	@endforeach
	</div>
	@endif