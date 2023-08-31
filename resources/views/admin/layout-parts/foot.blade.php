  @section('admin_jscript')
  <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{!! asset('admin-part/vendor/global/global.min.js') !!}"></script>
    <script src="{!! asset('admin-part/js/quixnav-init.js') !!}"></script>
    <script src="{!! asset('admin-part/js/custom.min.js') !!}"></script>

    {{-- TODO: Google Map Library; Recommended by Google --}}
    {{-- <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
          key: "AIzaSyCF8MnYK1Ft-lPa3_B6rirg2IJzptB4m1Y",
          v: "weekly",

        });
    </script> --}}

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF8MnYK1Ft-lPa3_B6rirg2IJzptB4m1Y&v=weekly&libraries=places"
        defer
    ></script>

    <script src="{!! asset('admin-part/js/touristbook-terms-custom.js') !!}"></script>
    <script src="{!! asset('admin-part/js/tourist-lib.js') !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>


    @show
