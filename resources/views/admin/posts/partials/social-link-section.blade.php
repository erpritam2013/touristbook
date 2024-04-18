<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Social Link Section</h4>
    </div>

    <div class="card-body">

   
        <!-- Facebook link -->
        {!!inputTemplate(['name'=> 'social_links[facebook_custom_link]','label'=>'Facebook','value'=>$post->social_links['facebook_custom_link'] ?? '','id' => "facebook-custom-link",'control' => "url"])!!}
        <!-- Twitter link -->
        {!!inputTemplate(['name'=> 'social_links[twitter_custom_link]','label'=>'Twitter','value'=>$post->social_links['twitter_custom_link'] ?? '','id' => "twitter-custom-link",'control' => "url"])!!}
        
        <!-- Instagram link -->
        {!!inputTemplate(['name'=> 'social_links[instagram_custom_link]','label'=>'Instagram','value'=> $post->social_links['instagram_custom_link'] ?? '','id' => "instagram-custom-link",'control' => "url"])!!}
       
        <!-- You Tube link -->
        {!!inputTemplate(['name'=> 'social_links[you_tube_custom_link]','label'=>'You Tube','value'=>$post->social_links['you_tube_custom_link'] ?? '','id' => "you-tube-custom-link",'control' => "url"])!!}
       

    </div>
</div>
