<div class="container">
			<div class="box new-post">
                <h2>Đăng tin miễn phí</h2>
                <p>Vậy còn chờ gì ? Hãy tham gia ngay!</p>
                <form method="post" action="{{URL::to('')}}/home/dangtin" enctype="multipart/form-data">
                	<div class="input-group">
                      <label>Bạn là </label>
                      <label class="type left"><span><input type="radio" name="type_customer" value="1"></span> Hành khách</label>
                      <span> hay </span>
                      <label class="type right"><span><input type="radio" name="type_customer" value="0"></span> Tài xế</label>
                    </div>
                    <div class="devide clearfix"></div>
                    <div class="input-group">
                      <label>Tiêu đề</label>
                      <input type="text" name="subject" class="form-control">
                    </div>
                    <div class="devide clearfix"></div>
                    <div class="place">
                    	 <div class="input-group place">
                          	<label>Nơi xuất phát</label>
                          	<select name="province_from" class="form-control">
                              <option>Tỉnh / Thành</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                          	</select>
                          	<select name="district_from" class="form-control">
                              <option>Quận / huyện</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                          	</select>
                          	<input type="text" class="form-control" name="address_from" placeholder="Địa chỉ chi tiết">
                      	</div>
                    </div><!-- place -->
                    <div class="devide clearfix"></div>
                    <div class="place">
                    	 <div class="input-group place">
                          	<label>Nơi đến</label>
                          	<select name="province_yo" class="form-control">
                              <option>Tỉnh / Thành</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                          	</select>
                          	<select name="district_to" class="form-control">
                              <option>Quận huyện</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                          	</select>
                          	<input type="text" class="form-control" name="address_to" placeholder="Địa chỉ chi tiết">
                      	</div>
                    </div><!-- place -->
                    <div class="devide clearfix"></div>
                 	<div class="input-group date">
                    <label>Ngày xuất phát</label>
                        <input name="date_star" type="text" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY'],separator:'/'" data-beatpicker-position="['right','bottom']" data-beatpicker-disable="{from:[1970 , 2 , 2],to:[{{date("Y")}} , {{date("m")}}  , <?php echo (date("d") -1 ) ?> ]}"/>
                	</div>
                    <div class="devide clearfix"></div>
                    <div class="column left">
                   		<div class="input-group">
                          <label>Giá</label>
                          <input name="price" type="text" class="form-control" value="0">
                        </div>
                    </div><!-- column -->
                    <div class="column right">
                        <div class="input-group">
                          <label>Loại xe</label>
                          <input name="type_car" type="text" class="form-control">
                        </div>
                    </div><!-- column -->
                    <div class="devide clearfix"></div>
                    <div class="column left">
                   		<div class="input-group">
                          <label>Ghi chú thêm</label>
                          <textarea name="note"></textarea>
                        </div>
                    </div><!-- column -->
                    <div class="column right">
                   		<div class="input-group">
                          <label>Đính kèm file</label>
                          <input type="file" name="file1">
                          <input type="file" name="file2">
                        </div>
                    </div><!-- column -->
                    <div class="devide clearfix"></div>
                    <div class="box info-user">
                    	<label>Thông tin liên hệ</label>
                    	<table>
                        	<tr><td>Tên</td><td><input type="text" class="form-control" value="" name="name"></td></tr>
                            <tr><td>Số điện thoại</td><td><input type="text" class="form-control" value="" name="phone"></td></tr>
                            <tr><td>Địa chỉ</td><td><input type="text" class="form-control" value="" name="address"></td></tr>
                            <tr><td>Tỉnh/Thành</td><td><input type="text" class="form-control" value="" name="address"></td></tr>
                            <tr><td>Quận/Huyện</td><td><input type="text" class="form-control" value="" name="address"></td></tr>
                        </table>
                    </div><!-- info-user -->
                    <div class="devide clearfix"></div>
                  	<button type="submit" class="btn btn-default submit">Đăng tin</button>
                </form>
			</div>
        </div><!-- container -->
        {{ HTML::style('sximo/themes/uber/css/BeatPicker.min.css')}}
        {{ HTML::script('sximo/themes/uber/js/BeatPicker.min.js') }}
