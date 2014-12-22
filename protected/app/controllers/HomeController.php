<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	protected  $perpage = 12;

	public function __construct() {

		parent::__construct();
		$this->lang = Session::get('lang') == '' ? CNF_LANG : Session::get('lang');
		 $this->layout = "layouts.".CNF_THEME.".index";

	}

	public function dangky(){
		$this->data['pageTitle'] = "Đăng ký";
		$this->data['pageNote'] = CNF_APPNAME;

		$input = array(
				'username'	=>'',
				'name'	=>'',
				'sex'	=>'1',
				'phone'	=>'',
				'email'	=>'',
				'address'	=>'',
				'provinceid'	=>'79',
				'districtid'	=>'',
				'wardid'	=>'',
			);
		if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$data['input'] = $input;

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.dangky';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','dangky');
	}

	public function postDangky(){
		$rules = Customer::$rules;
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$data = $this->getDataPost('customer');
			//print_r($data);die;
			$data['created'] = time();
			$data['password'] = md5($data['password']);
			$data['code'] = md5(time());
			$mdCus = new Customer();
			$ID = $mdCus->insertRow($data , Input::get('customer_id'));
			$data_message = array('name'=>Input::get('name'),'code'=>$data['code'],'email'=>Input::get('email'),'password'=>$data['password']); 
			Mail::send('emails.dangky', $data_message, function($message)
			{
				$message->from( Input::get('email'), Input::get('name') );
			    $message->to(CNF_EMAIL, 'Admin')->subject(Input::get('subject'));
			});
			return Redirect::to('')->with('message', SiteHelpers::alert('success','Đăng ký thành công ! Email kích hoạt dã được gửi vào Email của bạn Vui lòng kích hoạt để sử dụng dịch vụ chủa chúng tôi'));
		}
		else{
			return Redirect::to('dang-ky.html')->with('message_dangky', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->with('input_rd',Input::all())->withErrors($validator)->withInput();
		}
	}

	public function getActivation(){
		if(!isset($_GET['code']) || $_GET['code'] == ''){
			return Redirect::to('');
		}
		$code = $_GET['code'];
		$customer = DB::table('customer')->where('code','=',$code)->first();
		if(count($customer) <= 0){
			return Redirect::to('');
		}
		$data['code'] = '';
		$data['status'] = '1';
		DB::table('customer')->where('customer_id','=',$customer->customer_id)->update($data);
		return Redirect::to('')->with('message', SiteHelpers::alert('success','Kích hoạt thành công ! Hãy đăng nhập ngay để tham gia với chúng tôi !'));
	}

	public function getDangnhap(){
		$this->data['pageTitle'] = "Đăng nhập";
		$this->data['pageNote'] = CNF_APPNAME;


		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.dangnhap';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page)->with('page', $this->data)->with('menu','dangnhap');
	}

	public function postDangnhap(){
		$rules = array(
			'username'=>'required',
			'password'=>'required',
		);		
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$cus = DB::table('customer')->where('username', '=',Input::get('username'))->where('password','=',md5(Input::get('password')))->first();
			if(count($cus)>0){
				$arr_cus = array('id'=>$cus->customer_id, 'name'=>$cus->name, "email"=>$cus->email);
				Session::put('customer',$arr_cus);
				Session::save();
				return Redirect::to('');
			}else{
				return Redirect::to('home/dangnhap')->with('message_dangnhap', SiteHelpers::alert('error','Sai tên đăng nhập hoặc mật khẩu'));
			}
		}
		else{
			return Redirect::to('home/dangnhap')->with('message_dangnhap', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->withErrors($validator)->withInput();
		}
	}

	public function forgotpass(){
		$this->data['pageTitle'] = "Quên mật khẩu";
		$this->data['pageNote'] = CNF_APPNAME;


		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.forgotpass';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page)->with('page', $this->data)->with('menu','forgotpass');
	}

	public function postForgotpass(){
		$rules = array(
			'email'=>'required|email',
		);
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$cus = DB::table('customer')->where('email','=',Input::get('email'))->first();
			if(count($cus) > 0){
				$pass = SiteHelpers::randomPassword();
				DB::table('customer')->where('email','=',Input::get('email'))->update(array('password'=>md5($pass)));
				$data = array('name'=>$cus->name,'username'=>$cus->username,'pass'=>$pass); 
				Mail::send('emails.forgotpass', $data, function($message)
				{
					$message->from( CNF_EMAIL, 'Admin' );
				    $message->to(Input::get('email'), '')->subject('Thông tin đăng nhập');
				});
			}
			return Redirect::to('')->with('message', SiteHelpers::alert('success','Vui lòng kiểm tra Email để nận mật khẩu mới !'));
		}	
		else{
			return Redirect::to('forgotpass.html')->with('message_forgotpass', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->withErrors($validator)->withInput();
		}
	}

	public function  changeinfo(){
		if(!Session::has('customer')){
			return Redirect::to('dang-ky.html');
		}
		$this->data['pageTitle'] = "Thay đổi thông tin";
		$this->data['pageNote'] = CNF_APPNAME;
		$ses_cus = Session::get('customer');
		$input = DB::table('customer')->where("customer_id",'=',$ses_cus['id'])->first();
		

		if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$data['input'] =(array) $input;

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.changeinfo';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','changeinfo');
	}

	public function postChangeinfo(){
		if(!Session::has('customer')){
			return Redirect::to('dang-ky.html');
		}
		$rules = $rules=array(
			"email" => "required|email",
			"username" => "required|alpha_num|between:5,15",
			"name" => "required|between:5,15",
			"phone" => "required|Numeric",
			"address" => "required",
			"provinceid" => "required",
			"districtid" => "required",
			"wardid" => "required",
		);
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$data['name'] = Input::get('name');
			$data['phone'] = Input::get('phone');
			$data['address'] = Input::get('address');
			$data['provinceid'] = Input::get('provinceid');
			$data['districtid'] = Input::get('districtid');
			$data['wardid'] = Input::get('wardid');
			DB::table('customer')->where('email','=',Input::get('email'))->where('username','=',Input::get('username'))->update($data);
			return Redirect::to('change-info.html')->with('message', SiteHelpers::alert('success','Thay đổi thông tin thành công !'));
		}else{
			return Redirect::to('change-info.html')->with('message_changeinfo', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->withErrors($validator)->withInput();
		}
	}

	public function changepass(){
		if(!Session::has('customer')){
			return Redirect::to('dang-ky.html');
		}
		$this->data['pageTitle'] = "Thay đổi mật khẩu";
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.changepass';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page)->with('page', $this->data)->with('menu','changepass');
	}

	public function postChangepass(){
		if(!Session::has('customer')){
			return Redirect::to('dang-ky.html');
		}
		$rules = $rules=array(
			"password" => "required|between:5,20",
			"newpassword" => "required|between:5,20",
			"confirmpassword" => "required|same:newpassword",
		);
		//if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$ses_cus = Session::get('customer');
			$cus = DB::table('customer')->where('customer_id','=',$ses_cus['id'])->first();
			if(md5(Input::get('password')) != $cus->password){
				return Redirect::to('change-pass.html')->with('message_changepass', SiteHelpers::alert('error','Mật khẩu cũ không chính xác !'));
			}
			$pass = md5(Input::get('newpassword'));
			DB::table('customer')->where('customer_id','=',$ses_cus['id'])->update(array('password'=>$pass));
			return Redirect::to('')->with('message', SiteHelpers::alert('success','Thay đổi mật khẩu thành công !'));
		}else{
			return Redirect::to('change-pass.html')->with('message_changepass', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->withErrors($validator)->withInput();
		}
		/*$rules = $rules=array(
			"type_customer" => "required|Numeric",
			"subject" => "required",
			"subject" => "required|alpha_num|between:5,15",
			"name" => "required|between:5,15",
			"phone" => "required|Numeric",
			"address" => "required",
			"provinceid" => "required",
			"districtid" => "required",
			"wardid" => "required",
		);
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {

		}else{

		}*/

	}

	public function getLogout(){
		Session::forget('customer');
		return Redirect::to('');
	}

	public function dangtin(){
		if(!Session::has('customer')){
			return Redirect::to('home/dangnhap');
		}
		$this->data['pageTitle'] = "Đăng tin";
		$this->data['pageNote'] = CNF_APPNAME;
		$page = 'pages.template.dangtin';

		$input = array(
				'post_typecustomer'	=>'',
				'post_subject'	=>'',
				'post_provincefrom'	=>'79',
				'post_districtfrom'	=>'',
				'post_addressfrom'	=>'',
				'post_provinceto'	=>'79',
				'post_districtto'	=>'',
				'post_addressto'	=>'',
				'post_datestar'	=>'',
				'post_price'	=>'0',
				'post_typecar'	=>'',
				'post_note'	=>'',
				'name'	=>'',
				'phone'	=>'',
				'address'	=>'',
			);
		if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$data['input'] = $input;

		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data)->with('menu','dangtin');
	}

	public function postDangtin(){
		if(!Session::has('customer')){
			return Redirect::to('home/dangnhap');
		}
		$rules = array(
				'post_typecustomer'		=>'required|Numeric',
				'post_subject'			=>'required',
				'post_provincefrom'		=>'required|Numeric',
				'post_districtfrom'		=>'required|Numeric',
				'post_addressfrom'		=>'required',
				'post_provinceto'		=>'required|Numeric',
				'post_districtto'		=>'required|Numeric',
				'post_addressto'		=>'required',
				'post_datestar'			=>'required',
				'post_price'			=>'required|Numeric',
				'post_typecar'			=>'required',
				'post_note'				=>'required',
				'name'					=>'required',
				'phone'					=>'required',
				'address'				=>'required',
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) 
		{
			$data = $this->getDataPost('post');
			$data['created'] = time();
			$data['post_datestar'] = strtotime($data['post_datestar']);
			unset($data['lang']);
			$mdPost = new Post();
			$ID = $mdPost->insertRow($data , '');
			echo "asdasd";die;
		}else{
			return Redirect::to('dang-tin.html')->with('message_dangtin', SiteHelpers::alert('error','Vui lòng xác nhận các thông tin bên dưới'))->with('input_rd',Input::all())->withErrors($validator)->withInput();
		}

	}

	/*public function page($id){
		$mdPage = new Pages();
		$item = $mdPage->find($id);

		$data['page'] = $item;
		$this->data['pageTitle'] = $item->title;
		$this->data['pageNote'] = 'Welcome To Our Site';

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.index';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data);
	}

	public function cart()
	{
		$cart = Session::get('addcart');
		if(count($cart) <= 0){
			return Redirect::to('')->with('message', SiteHelpers::alert('success','Bạn vui lòng chọn mua sản phẩm'));	
		}
		$datacart = array();
		$mdPro = new Nproducts();
		$mdCat = new Ncategories();
		//$total = 0;
		$total_real = 0;
		foreach ($cart as $key => $value) {
			$data = $mdPro->find($key);
			$category = $mdCat->find($data->CategoryID);
			$price_convert = SiteHelpers::getPricePromotion($data);

			$price_item = $price_convert * $value;
			//$total += $data->UnitPrice * $value ;
			$total_real += $price_item ;
			$datacart[$key]['image'] = $data->image == '' ? URL::to('').'/sximo/images/no_pic.png' : URL::to('').'/uploads/products/thumb/'.$data->image;
			$datacart[$key]['ProductName'] = $data->ProductName;
			$datacart[$key]['categoryname'] = $category->CategoryName != "" ?  $category->CategoryName : 'Unknow';
			$datacart[$key]['sl'] = $value;
			$datacart[$key]['price'] = number_format($price_convert,0,',','.') . 'VNĐ';
			$datacart[$key]['price_total'] = number_format($price_item,0,',','.') . 'VNĐ';
			$datacart[$key]['price_promition'] = $data->id_promotion != 0 ? '<br/><span style="color: #f00;font-weight: normal;text-decoration: line-through;">'.number_format($data->UnitPrice,0,',','.') . 'VNĐ</span><br/>' : '';
			$datacart[$key]['link'] = URL::to('')."/detail/".$data->slug . "-" . $data->ProductID . ".html";
		}
		$datas['cart'] = $datacart;
		//$datas['total'] = $total;
		$datas['total_real'] = number_format($total_real,0,',','.') . 'VNĐ';
		$datas['total'] = $total_real;
		//print_r($data);die;

		$seo['pageTitle'] = 'Cart';
		$seo['pageNote'] = 'Welcome To Our Site';
		$html = SiteHelpers::renderHtml('pages.template.cart');
		$this->layout->nest('content',$html,$datas)->with('page', $seo);
	}

	public function postOrder(){
		$cart = Session::get('addcart');
		if(count($cart) <= 0){
			return Redirect::to('')->with('message', SiteHelpers::alert('warning','Bạn vui lòng chọn mua sản phẩm'));	
		}
		$rules = array(
			'recaptcha_response_field'=>'required|recaptcha',
			);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$data = $this->getDataPost('orders');
			$data['total'] = SiteHelpers::getTotalcart();
			unset($data['lang']);
			$data['OrderDate'] = date('Y-m-d H:i:s', time());
			$mdOrderDetail = new Orderdetail();
			$mdOrder = new Order();
			$mdPro = new Nproducts();
			$ID = $mdOrder->insertRow($data,'');
			if($ID){
				foreach($cart as $key=>$val){
					$product = $mdPro->find($key);
					$price = SiteHelpers::getPricePromotion($product);
					$data_cart['UnitPrice'] = $price;
					$data_cart['OrderID'] = $ID;
					$data_cart['ProductID'] = $key;
					$data_cart['Quantity'] = $val;
					$mdOrderDetail->insertRow($data_cart,'');
				}

				Session::put('addcart',array());
				Session::save();
			}
			return Redirect::to('')->with('message', SiteHelpers::alert('success','Đặt hàng thành công'));
		}
		else{
			return Redirect::to('checkout.html')->with('message_checkout', SiteHelpers::alert('warning','Sai mã bảo mật'))->with('input_rd',Input::all());
		}
	}*/

	public function search(){
		if(Input::get('search') == ''){
			return Redirect::to('');
		}
		$s = Input::get('search');
		$sortget = ( Input::get('sort') != '') ? Input::get('sort') : 'ProductID-desc';
		list($sort,$order) = explode('-', $sortget);
		$filter = " AND status = 1 AND (ProductName LIKE '%".$s."%' OR Slug LIKE '%".$s."%' OR Content LIKE '%".$s."%' OR description LIKE '%".$s."%') AND lang = '$this->lang'";
		$page = (!is_null(Input::get('page') && Input::get('page') != '')) ? Input::get('page') : 1;
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null(Input::get('numpage')) ? filter_var(Input::get('numpage'),FILTER_VALIDATE_INT) : $this->perpage ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$model = new Nproducts();
		$results = $model->getRows( $params );
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);
		$data['search']		=$s;
		$data['data']		= $results['rows'];
		$data['page']		= $page;
		$data['sort']		= $sortget;
		$data['numpage']	= $params['limit'];
		// Build Pagination 
		$data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$data['pager'] 		= $this->injectPaginate();


		$this->data['pageTitle'] = 'Kết qua tìm kiếm từ khóa'.'"'.$s.'"';
		$this->data['pageNote'] = 'Welcome To Our Site';

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.search';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data);
	}

	/*public function checkout()
	{
		$cart = Session::get('addcart');
		if(count($cart) <= 0){
			return Redirect::to('')->with('message', SiteHelpers::alert('success','Bạn không có sản phẩm nào trong giỏ hàng !'));	
		}
		$input = array(
				'name'	=>'',
				'sex'	=>'1',
				'phone'	=>'',
				'email'	=>'',
				'address'	=>'',
				'provinceid'	=>'79',
				'content'	=>'',
				'districtid'	=>'',
				'wardid'	=>'',
			);
		if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$datas['input'] = $input;
		$datacart = array();
		$mdPro = new Nproducts();
		$mdCat = new Ncategories();
		//$total = 0;
		$total_real = 0;
		foreach ($cart as $key => $value) {
			$data = $mdPro->find($key);
			$category = $mdCat->find($data->CategoryID);
			$price_convert = SiteHelpers::getPricePromotion($data);

			$price_item = $price_convert * $value;
			//$total += $data->UnitPrice * $value ;
			$total_real += $price_item ;
			$datacart[$key]['image'] = $data->image == '' ? URL::to('').'/sximo/images/no_pic.png' : URL::to('').'/uploads/products/thumb/'.$data->image;
			$datacart[$key]['ProductName'] = $data->ProductName;
			$datacart[$key]['categoryname'] = $category->CategoryName != "" ?  $category->CategoryName : 'Unknow';
			$datacart[$key]['sl'] = $value;
			$datacart[$key]['price'] = number_format($price_convert,0,',','.') . 'VNĐ';
			$datacart[$key]['price_total'] = number_format($price_item,0,',','.') . 'VNĐ';
			$datacart[$key]['price_promition'] = $data->id_promotion != 0 ? '<br/><span style="color: #f00;font-weight: normal;text-decoration: line-through;">'.number_format($data->UnitPrice,0,',','.') . 'VNĐ</span><br/>' : '';
			$datacart[$key]['link'] = URL::to('')."/detail/".$data->slug . "-" . $data->ProductID . ".html";
		}
		$datas['cart'] = $datacart;
		//$datas['total'] = $total;
		$datas['total_real'] = number_format($total_real,0,',','.') . 'VNĐ';
		$datas['total'] = $total_real;

		$this->data['pageTitle'] = 'Check out';
		$this->data['pageNote'] = 'Welcome To Our Site';

		//$this->data['breadcrumb'] = 'inactive';
		$page = 'pages.template.checkout';


		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$datas)->with('page', $this->data);
	}

	public function getUpdatecart(){
		if($_GET['id'] != '' && $_GET['quality'] != ''){
			$id = $_GET['id'] ;
			$quality = $_GET['quality'] ;
			$cart = Session::get('addcart');
			if(isset($cart[$id])){
				$cart[$id] = $quality;
				Session::put('addcart',$cart);
				Session::save();
			}
		}
		die;
	}*/
	

	public function index()
	{
		if(CNF_FRONT =='false' && Session::get('uid') !=1) :
			if(!Auth::check())  return Redirect::to('user/login');
		endif; 
		$data['items'] = DB::table('products')->where('lang','=',$this->lang)->where('status','=','1')->orderby('created','desc')->limit('20')->get();
		$this->data['pageTitle'] = 'Home';
		$this->data['pageNote'] = 'Welcome To Our Site';
		//$this->data['breadcrumb'] = 'inactive';			
		$page = 'pages.template.home';
		
		$page = SiteHelpers::renderHtml($page);
		

		$this->layout->nest('content',$page,$data)->with('menu', 'index' );
			
	}

	/*public function getAddtocart(){
		if($_GET['id'] != '' && $_GET['quality'] != ''){
			$id = $_GET['id'] ;
			$quality = $_GET['quality'] ;
			$cart = Session::get('addcart');
			if(isset($cart[$id])){
				$cart[$id] = $cart[$id] + $quality;
			}
			else{
				$cart[$id] =  $quality;
			}
			
			Session::put('addcart',$cart);
			Session::save();
		}
		$output = SiteHelpers::getCart();

		echo $output;die;

	}

	public function getLoadcart(){
		$cart = Session::get('addcart');
		if(count($cart) > 0){
			$mdPro = new Nproducts();
			$datacart = array();
			foreach($cart as $key=>$val){
				$data = $mdPro->find($key);
				$price_convert = SiteHelpers::getPricePromotion($data);
				$price_item = $price_convert * $val;
				$datacart[$key]['ProductName'] = $data->ProductName;
				$datacart[$key]['image'] = $data->image != '' ? asset('uploads/products/thumb').'/'.$data->image : asset('sximo/images/no_pic.png');
				$datacart[$key]['sl'] = $val;
				$datacart[$key]['link'] = URL::to('detail').'/'.$data->slug.'-'.$data->ProductID.'.html';
				$datacart[$key]['price'] = number_format($price_convert,0,',','.').' VNĐ';
			}
			$view = View::make('pages.template.loadcart')->with('datacart', $datacart);
	    	echo $view;die;
		}else{
			echo '';die;
		}

	}

	public function getRemovecart(){
		if($_GET['id'] != ''){
			$id = $_GET['id'] ;
			$cart = Session::get('addcart');
			unset($cart[$id]);
			Session::put('addcart',$cart);
			Session::save();
		}
		$output = SiteHelpers::getCart();

		echo $output;die;
	}

	public function productdetail($alias = '',$id = ''){
		$mdPro = new Nproducts();
		$mdCat = new Ncategories();
		$mdImg = new Imagesproduct();
		$product = $mdPro->find($id);
		$cat = $mdCat->find($product->CategoryID);
		$images = $mdImg->getImagesOfProduct($product->ProductID);

		$pro_same = DB::table('products')->where('ProductID','!=',$product->ProductID)->where('status','=',1)->where('lang','=',$this->lang)->where('CategoryID','=',$product->CategoryID)->limit(10)->get();

		$data['pro_same'] = $pro_same;
		$data['cat'] = $cat;
		$data['cat_link'] = $cat != NULL ? "» <a href='".URL::to('')."/category/".$cat->alias."-".$cat->CategoryID.".html'>".$cat->CategoryName."</a>" : '';
		$data['images'] = $images;
		$data['product'] = $product;
		$seo['pageTitle'] = $product->ProductName;
		$seo['pageNote'] = $cat != NULL ? $cat->CategoryName :'Welcome To Our Site';
		$html = SiteHelpers::renderHtml('pages.template.productdetail');
		$this->layout->nest('content',$html,$data)->with('page', $seo);
	}

	public function categorydetail($alias = '',$id = ''){
		
		$cat = Ncategories::detail($id);
		$sortget = ( Input::get('sort') != '') ? Input::get('sort') : 'ProductID-desc';
		list($sort,$order) = explode('-', $sortget);
		$filter = " AND status = 1 AND CategoryID = $id AND lang = '$this->lang'";
		$page = (!is_null(Input::get('page') && Input::get('page') != '')) ? Input::get('page') : 1;
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null(Input::get('numpage')) ? filter_var(Input::get('numpage'),FILTER_VALIDATE_INT) : $this->perpage ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$model = new Nproducts();
		$results = $model->getRows( $params );
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);
		$data['cat']		=$cat;
		$data['data']		= $results['rows'];
		$data['page']		= $page;
		$data['sort']		= $sortget;
		$data['numpage']	= $params['limit'];
		// Build Pagination 
		$data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$data['pager'] 		= $this->injectPaginate();

		$html = SiteHelpers::renderHtml('pages.template.category');
		$this->layout->nest('content',$html,$data);
	}*/
	
	public function  postContactform()
	{
	
		$this->beforeFilter('csrf', array('on'=>'post'));
		$rules = array(
				'name'		=>'required',
				'email'	=>'required|email',
				'phone'	=>'required|Numeric',
				'content'	=>'required',
				'subject'	=>'required',
				'recaptcha_response_field'=>'required|recaptcha',
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) 
		{
			
			$data = array('name'=>Input::get('name'),'phone'=>Input::get('phone'),'email'=>Input::get('email'),'content'=>Input::get('content'),'subject'=>Input::get('subject')); 
			/*$message = View::make('emails.contact', $data); 		
			$to 		= 	CNF_EMAIL;
			$subject 	= Input::get('subject');
			$headers  	= 'MIME-Version: 1.0' . "\r\n";
			$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers 	.= 'From: '.Input::get('name').' <'.Input::get('email').'>' . "\r\n";
			mail($to, $subject, $message, $headers);*/
			Mail::send('emails.contact', $data, function($message)
			{
				$message->from( Input::get('email'), Input::get('name') );
			    $message->to(CNF_EMAIL, 'Admin')->subject(Input::get('subject'));
			});
			return Redirect::to(URL::to('')."/contact-us.html")->with('message', SiteHelpers::alert('success','Yêu cầu của bạn đã được gởi !'));	
				
		} else {
			return Redirect::to(URL::to('')."/contact-us.html")->with('message_contact', SiteHelpers::alert('error','Vui lòng khắc phục các lỗi bên dưới'))->with('input_rd',Input::all())
			->withErrors($validator)->withInput();
		}		
	}

	public function contactus(){
		$input = array(
				"name"=>'',
				"phone"=>'',
				"email"=>'',
				"content"=>'',
				"subject"=>''
			);
		if(Session::has('input_rd')){
			$input = Session::get('input_rd');
		}
		$data['input'] = $input;


		$page = 'pages.template.contactus';

		$this->data['pageTitle'] = 'Contact US';
		$this->data['pageNote'] = 'Welcome To Our Site';
		$page = SiteHelpers::renderHtml($page);
		$this->layout->nest('content',$page,$data)->with('page', $this->data);
	}

	public function  getLang($lang='en')
	{
		Session::put('lang', $lang);
		return  Redirect::back();
	}	
}