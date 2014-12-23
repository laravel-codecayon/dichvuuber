<div class="container">
            <div id="wrap-content">
                <div class="box thread-box guest">
                    <div class="box-heading"><span>Tin mới</span></div>
                    <ul>
                    @foreach($data as $item)
                        {{ SiteHelpers::templatePost($item) }}
                    @endforeach
                    </ul>
                </div><!-- guest-list -->
                <div class="pages">
                    {{ $pagination->appends(array("page"=>$page))->links('pagination_site') }}
                </div><!-- pages -->
            </div><!-- wrap-content -->
            <div id="wrap-right">
                <div class="box filter">
                    <div class="box-heading">Bộ lọc tin</div>
                    <div class="box-content">
                        <div class="input-group place">
                            <label>Nơi xuất phát</label>
                            <select class="form-control">
                                <option>Tỉnh / Thành</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <select class="form-control">
                                <option>Quận / huyện</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="input-group place">
                            <label>Nơi đến</label>
                            <select class="form-control">
                                <option>Tỉnh / Thành</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <select class="form-control">
                                <option>Quận / huyện</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="input-group date">
                            <label>Ngày xuất phát</label>
                            <div class="date-row clearfix">
                            <select class="form-control">
                                <option>Ngày</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <select class="form-control">
                                <option>Tháng</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <select class="form-control">
                                <option>Năm</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            </div><!-- date-row -->
                        </div>
                        <button type="submit" class="btn btn-default submit">Lọc tin</button>
                    </div><!-- box-content -->
                </div><!-- filter -->
                <div class="box ads">
                    <img src="images/quangcao2.jpg">
                </div><!-- ads -->
            </div><!-- wrap-right -->

        </div><!-- container -->