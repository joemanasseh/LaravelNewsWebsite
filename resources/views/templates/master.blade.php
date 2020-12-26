@if(!empty($message))
    {{ $message }}
@endif

<!DOCTYPE html>
<html lang="en">
    @include('partials._head')
<body>
    <!-- Facebook Login -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{1129839904080578}',
      cookie     : true,
      xfbml      : true,
      version    : '{v8.0}'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}
</script>

    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PX5C67Z"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    @include('partials._sidebar')

    <div class="pusher">
        @include('partials._nav')
        <div class="mt-30"></div>
        @yield('content')
        @include('partials._footer')
    </div>
    
    @include('partials._scripts')
</body>
</html>