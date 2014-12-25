<!DOCTYPE html>
<html lang="en">
    <title><?php echo isset($page['pageTitle']) ? $page['pageTitle'].' | '.$page['pageNote']. " | ". CNF_APPNAME : CNF_APPNAME ;?></title>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="{{ CNF_METAKEY }}">
    <meta name="description" content="{{ CNF_METADESC }}">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    {{ HTML::style('sximo/themes/uber/css/bootstrap.min.css')}}
    {{ HTML::style('sximo/themes/uber/css/bootstrap-theme.min.css')}}
    {{ HTML::style('sximo/themes/uber/css/style.css')}}
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    {{ HTML::script('sximo/themes/uber/js/jquery.min.js') }}   
    {{ HTML::script('sximo/themes/uber/js/bootstrap.min.js') }}  
    {{ HTML::script('sximo/themes/uber/js/jquery.carouFredSel.js') }}  


  </head>
	<body>
	<header id="header">
    	<div class="container">
            <div id="logo"><a href="{{URL::to('')}}"><img src="{{ asset('sximo/themes/uber/image/logo.png')}}"></a></div>
            @include('layouts/uber/topbar')
            
         </div><!-- container -->
	</header>
    <nav id="nav">
    	<div class="container">
        	<ul class="menu">
            	<li @if(isset($menu) && $menu == "index") class="post-thread" @endif><a href="{{URL::to('')}}"><img src="{{ asset('sximo/themes/uber/image/home-icon.png')}}"></a></li>
                <li @if(isset($menu) && $menu == "tinmoi") class="post-thread" @endif><a href="{{URL::to('')}}/tin-moi-dang.html">Tin mới đăng</a></li>
                <li @if(isset($menu) && $menu == "hanhkhach") class="post-thread" @endif><a href="{{URL::to('')}}/hanh-khach.html">Hành khách</a></li>
                <li @if(isset($menu) && $menu == "taixe") class="post-thread" @endif><a href="{{URL::to('')}}/tai-xe.html">Tài xế</a></li>
            </ul>
            <ul class="member-area">
            	<li @if(isset($menu) && $menu == "dangky") class="post-thread" @endif ><a href="{{URL::to('dang-ky.html')}}">Đăng ký</a></li>
                <li @if(isset($menu) && $menu == "dangtin") class="post-thread" @endif ><a href="{{URL::to('dang-tin.html')}}">Đăng tin</a></li>
            </ul>
        </div><!-- container -->
    </nav>
    <section id="slider">
    	<div class="container clearfix">
        	<div class="text-promotion">
                <h2>Đưa đón mọi người</h2>
                <p>CHỈ CẦN ẤN NÚT VÀ BẠN SẼ ĐƯỢC ĐÓN NGAY</p>
            </div><!-- text -->
        </div>
    </section>
    @if(isset($menu) && $menu == "index" )
      @include('layouts/uber/timkiem')
    @endif
    <main id="main">
    	{{$content}}
    </main>
     @if(isset($menu) && ($menu == "index" || $menu == "tinhthanh"))
      @include('layouts/uber/tinhthanh')
    @endif
    <footer id="footer">
    	<div class="container clearfix">
        	<div class="site-info">
            	<h2>DichvuUBER.com</h2>
                <p>{{CNF_FOOTER}}<br>
            </div><!-- site-info -->
            <div class="social-links">
            	<a href="@if(CNF_fb != '') {{CNF_fb}} @else # @endif" class="fb"><img src="{{ asset('sximo/themes/uber/image/social-fb.png')}}"></a>
                <a href="@if(CNF_gg != '') {{CNF_gg}} @else # @endif" class="gp"><img src="{{ asset('sximo/themes/uber/image/social-gp.png')}}"></a>
                <a href="@if(CNF_tw != '') {{CNF_tw}} @else # @endif" class="tw"><img src="{{ asset('sximo/themes/uber/image/social-tw.png')}}"></a>
            </div>
        </div><!-- container -->
    </footer>
  </body>
</html>