<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
            <div class="links">
                <a href="#">Trang chủ</a>
                <a href="#">Giới thiệu</a>
                <a href="#">Trợ giúp</a>
                <a href="#">Liên hệ</a>
            </div><!-- links -->
         </div><!-- container -->
	</header>
    <nav id="nav">
    	<div class="container">
        	<ul class="menu">
            	<li class="home"><a href="{{URL::to('')}}"><img src="{{ asset('sximo/themes/uber/image/home-icon.png')}}"></a></li>
                <li><a href="#">Tin mới đăng</a></li>
                <li><a href="#">Hành khách</a></li>
                <li><a href="#">Tài xế</a></li>
            </ul>
            <ul class="member-area">
            	<li @if(isset($menu) && $menu == "dangky") class="post-thread" @endif ><a href="{{URL::to('dang-ky.html')}}">Đăng ký</a></li>
                <li ><a href="#">Đăng tin</a></li>
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
    @if(isset($menu) && $menu != "dangky")
    <section id="search">
    	<div class="container search clearfix">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#guest" aria-controls="guest" role="tab" data-toggle="tab">Hành khách</a></li>
                <li role="presentation"><a href="#driver" aria-controls="driver" role="tab" data-toggle="tab">Tài xế</a></li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active clearfix" id="guest">
                	<div class="place start">
                    	<span>Nơi đi</span>
                        <select class="form-control">
                          <option>Tỉnh / Thành</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                        <select class="form-control">
                          <option>Quận / Huyện</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                    </div><!-- start-place -->
                    <div class="place finish">
                    	<span>Nơi đến</span>
                        <select class="form-control">
                          <option>Tỉnh / Thành</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                        <select class="form-control">
                          <option>Quận / Huyện</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                    </div><!-- finish-place -->
                    <button>Tìm kiếm</button>
                </div>
                <div role="tabpanel" class="tab-pane fade clearfix" id="driver">
               	<div class="place start">
                    	<span>Nơi đi</span>
                        <select class="form-control">
                          <option>Tỉnh / Thành</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                        <select class="form-control">
                          <option>Quận / Huyện</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                    </div><!-- start-place -->
                    <div class="place finish">
                    	<span>Nơi đến</span>
                        <select class="form-control">
                          <option>Tỉnh / Thành</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                        <select class="form-control">
                          <option>Quận / Huyện</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                    </div><!-- finish-place -->
                    <button>Tìm kiếm</button>
                </div>
            </div>
        </div><!-- container -->
    </section>
    @endif
    <main id="main">
    	{{$content}}
    </main>
     @if(isset($menu) && $menu != "dangky")
    <section id="searchby-provinces">
    	<div class="container">
        	<div class="searchby-provinces box clearfix">
                <div class="box-heading"><span>Tỉnh thành phổ biến</span></div>
                <div class="row">
                    <ul class="column column1">
                        <li><a href="#">An Giang</a></li>
                        <li><a href="#">Bà Rịa - Vũng Tàu</a></li>
                        <li><a href="#">Bắc Giang</a></li>
                        <li><a href="#">Bắc Kạn</a></li>
                        <li><a href="#">Bạc Liêu</a></li>
                        <li><a href="#">Bắc Ninh</a></li>
                        <li><a href="#">Bến Tre</a></li>
                        <li><a href="#">Bình Định</a></li>
                        <li><a href="#">Bình Dương</a></li>
                        <li><a href="#">Bình Phước</a></li>
                    </ul><!-- column1 -->
                    <ul class="column column2">
                        <li><a href="#">An Giang</a></li>
                        <li><a href="#">Bà Rịa - Vũng Tàu</a></li>
                        <li><a href="#">Bắc Giang</a></li>
                        <li><a href="#">Bắc Kạn</a></li>
                        <li><a href="#">Bạc Liêu</a></li>
                        <li><a href="#">Bắc Ninh</a></li>
                        <li><a href="#">Bến Tre</a></li>
                        <li><a href="#">Bình Định</a></li>
                        <li><a href="#">Bình Dương</a></li>
                        <li><a href="#">Bình Phước</a></li>
                    </ul><!-- column2 -->
                    <ul class="column column3">
                        <li><a href="#">An Giang</a></li>
                        <li><a href="#">Bà Rịa - Vũng Tàu</a></li>
                        <li><a href="#">Bắc Giang</a></li>
                        <li><a href="#">Bắc Kạn</a></li>
                        <li><a href="#">Bạc Liêu</a></li>
                        <li><a href="#">Bắc Ninh</a></li>
                        <li><a href="#">Bến Tre</a></li>
                        <li><a href="#">Bình Định</a></li>
                        <li><a href="#">Bình Dương</a></li>
                        <li><a href="#">Bình Phước</a></li>
                    </ul><!-- column3 -->
                    <ul class="column column4">
                        <li><a href="#">An Giang</a></li>
                        <li><a href="#">Bà Rịa - Vũng Tàu</a></li>
                        <li><a href="#">Bắc Giang</a></li>
                        <li><a href="#">Bắc Kạn</a></li>
                        <li><a href="#">Bạc Liêu</a></li>
                        <li><a href="#">Bắc Ninh</a></li>
                        <li><a href="#">Bến Tre</a></li>
                        <li><a href="#">Bình Định</a></li>
                        <li><a href="#">Bình Dương</a></li>
                        <li><a href="#">Bình Phước</a></li>
                    </ul><!-- column4 -->
                </div>
        	</div><!-- searchby-provinces -->
        </div><!-- container -->
    </section><!-- searchby-provinces -->
    @endif
    <footer id="footer">
    	<div class="container clearfix">
        	<div class="site-info">
            	<h2>DichvuUBER.com</h2>
                <p>Copyright © Du lịch Huế<br>
                Đơn vị chủ quản: Du lịch Huế<br>
                Giấy phép MXH số 05-GXN-TTDT.</p>
            </div><!-- site-info -->
            <div class="social-links">
            	<a href="#" class="fb"><img src="images/social-fb.png"></a>
                <a href="#" class="gp"><img src="images/social-gp.png"></a>
                <a href="#" class="tw"><img src="images/social-tw.png"></a>
            </div>
        </div><!-- container -->
    </footer>
  </body>
</html>