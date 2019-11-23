<?php
$this->title = $data->seo_title;
use frontend\widgets\cateNewsRightWidget;
    Yii::$app->params['og_title']['content'] = 'custom title';
    Yii::$app->params['og_description']['content'] = 'custom desc';
    Yii::$app->params['og_url']['content'] = '/new/url';
    Yii::$app->params['og_image']['content'] = 'image.jpg';
?>
<!-- Single Post -->
<div class="container-fluid no-left-padding no-right-padding">
	<!-- Container -->
	<div class="container">
		<div class="row">
			<!-- Content Area -->
			<div class="col-md-8 col-sm-12 col-xs-12 content-area">
				<article class="type-post color-3">
					<header class="clearfix">
						
						<span class="time left"><?= $datetime ?> (GMT+7)</span>
						<div class="block_share right">
							<a class="item_fb btn_facebook" rel="nofollow" href="javascript:;" title="Chia sẻ bài viết lên facebook"><i class="ic ic-facebook"></i></a>
							<a class="item_twit btn_twitter" rel="nofollow" href="javascript:;" id="twitter" data-url="http://bit.ly/2QgMaZK" title="Chia sẻ bài viết lên twitter"><i class="ic ic-twitter"></i></a>
							<a class="btn_print" href="javascript:;" onclick="common.printPopup();" title="Print" rel="nofollow"><i class="ic ic-print"></i></a>
							<a class="btn_email login_5 open-popup-link" rel="nofollow" href="#email-popup" id="email_content" title="Email" data-component-runtime="js" data-component-function="initMail" data-component-input="{}"><i class="ic ic-email"></i></a>
						</div>
					</header>
						<h1 class="entry-title"><?= $data->name ?></h1>
					<!-- <div class="entry-cover">
						<h1 class="entry-title"><?= $data->name ?></h1>
						<img src="<?= Yii::$app->homeUrl.$data->images ?>" alt="Post" />
						<div class="entry-header">
							<div class="post-category"><a href="#" title="Business">Business</a></div>
							<h3 class="entry-title"><?= $data->name ?></h3>
							<div class="entry-footer">
								<span class="post-date"><a href="#">08 July, 2016</a></span>
								<span class="post-like"><i class="fa fa-heart-o"></i><a href="#">356</a></span>
								<span class="post-view"><i class="fa fa-eye"></i><a href="#">589</a></span>
							</div>
						</div>
					</div> -->
					<div class="entry-content">
						<?= $data->content ?>
						<p><?= date('d/m/Y',$data->created_at) ?></p>
						<p><?= date('d/m/Y',$data->updated_at) ?></p>
					</div>
					<?php if (!empty($dataLienquan)): ?>
					
					<div id="box_morelink_detail" class="wrap_xemthem">
						<span class="txt_xemthem">Tin liên quan:</span>
						<ul class="list_title">
							<?php foreach ($dataLienquan as $Lienquan): ?>
								<li>
									<h4>
										<a href="<?= Yii::$app->homeUrl.$Lienquan->slug ?>.html" title="Dân số Việt Nam đạt gần 95 triệu người"><?= $Lienquan->name ?></a>
										<!-- <a class="icon_commend" href="https://vnexpress.net/suc-khoe/dan-so-viet-nam-dat-gan-95-trieu-nguoi-3870940.html#box_comment" style="white-space: nowrap;">&nbsp;<span class="txt_num_comment font_icon widget-comment-3870940-1">
															<i class="ic ic-comment ic-x ic-invert"><span>52</span></i>
														</span>
														</a> -->				
									</h4>
								</li>
								<?php endforeach ?>
							</ul>
						</div>
					<?php endif ?>
					<div class="col-md-12 about-author-box">
					<div class="fb-like pull-right"data-share="true"data-width="450"data-show-faces="true"></div>
					</div>
					<!-- About Author -->
					<!-- <div class="about-author-box">
						<h3>Thông tin tác giả</h3>
						<div class="author">
							<i><img src="<?= Yii::$app->homeUrl ?>vender/images/author.jpg" alt="Author" /></i>
							<h4>Tommy Walker</h4>
							<ul>
								<li><a href="#" class="fb" title="Facebook"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" class="tw" title="Twitter"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" class="go" title="Google"><i class="fa fa-google"></i></a></li>
								<li><a href="#" class="ln" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
							</ul>
							<p>reporter is one of the excellent magazine in the world.Newshub magazine reach many readers are very soon by his unique stories in the magazine.</p>
						</div>
					</div> --><!-- About Author /- -->
				</article>
				
				<!-- BÀI VIẾT LIÊN QUAN -->
				<div class="box_category box_cothebanquantam" style="margin-top:10px">
					<div class="title_box_category"><h4>Bạn có thể quan tâm</h4></div>
					<div class="width_common list_news_quantam">
						<article class="list_news col-md-3 col-sm-6">
							<div class="thumb_art">
								<a class="thumb thumb_5x3" href="https://vnexpress.net/the-gioi/trump-len-ke-hoach-han-che-xuat-khau-hang-cong-nghe-cao-sang-trung-quoc-3928502.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump lên kế hoạch hạn chế xuất khẩu hàng công nghệ cao sang Trung Quốc">
									<img src="https://i-vnexpress.vnecdn.net/2019/05/24/trump1-1558674093-4638-1558674435_r_180x108.jpg" alt="Trump lên kế hoạch hạn chế xuất khẩu hàng công nghệ cao sang Trung Quốc">
								</a>
							</div>
							<h3 class="title_news">
								<a href="https://vnexpress.net/the-gioi/trump-len-ke-hoach-han-che-xuat-khau-hang-cong-nghe-cao-sang-trung-quoc-3928502.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump lên kế hoạch hạn chế xuất khẩu hàng công nghệ cao sang Trung Quốc">Trump lên kế hoạch hạn chế xuất khẩu hàng công nghệ cao sang Trung Quốc</a>
							</h3>
						</article>

						<article class="list_news col-md-3 col-sm-6">
							<div class="thumb_art">
								<a class="thumb thumb_5x3" href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
									<img src="https://i-vnexpress.vnecdn.net/2019/05/24/5ce5fb7ca3104842e4af03c7-jpeg-6603-1558668135_r_180x108.jpg" alt="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
								</a>
							</div>
							<h3 class="title_news">
								<a href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'</a>
							</h3>
						</article>
						<article class="list_news col-md-3 col-sm-6">
							<div class="thumb_art">
								<a class="thumb thumb_5x3" href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
									<img src="https://i-vnexpress.vnecdn.net/2019/05/24/5ce5fb7ca3104842e4af03c7-jpeg-6603-1558668135_r_180x108.jpg" alt="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
								</a>
							</div>
							<h3 class="title_news">
								<a href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'</a>
							</h3>
						</article>
						<article class="list_news col-md-3 col-sm-6">
							<div class="thumb_art">
								<a class="thumb thumb_5x3" href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
									<img src="https://i-vnexpress.vnecdn.net/2019/05/24/5ce5fb7ca3104842e4af03c7-jpeg-6603-1558668135_r_180x108.jpg" alt="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
								</a>
							</div>
							<h3 class="title_news">
								<a href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'</a>
							</h3>
						</article>
						<article class="list_news col-md-3 col-sm-6">
							<div class="thumb_art">
								<a class="thumb thumb_5x3" href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
									<img src="https://i-vnexpress.vnecdn.net/2019/05/24/5ce5fb7ca3104842e4af03c7-jpeg-6603-1558668135_r_180x108.jpg" alt="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
								</a>
							</div>
							<h3 class="title_news">
								<a href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'</a>
							</h3>
						</article>
						<article class="list_news col-md-3 col-sm-6">
							<div class="thumb_art">
								<a class="thumb thumb_5x3" href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
									<img src="https://i-vnexpress.vnecdn.net/2019/05/24/5ce5fb7ca3104842e4af03c7-jpeg-6603-1558668135_r_180x108.jpg" alt="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
								</a>
							</div>
							<h3 class="title_news">
								<a href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'</a>
							</h3>
						</article>
						<article class="list_news col-md-3 col-sm-6">
							<div class="thumb_art">
								<a class="thumb thumb_5x3" href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
									<img src="https://i-vnexpress.vnecdn.net/2019/05/24/5ce5fb7ca3104842e4af03c7-jpeg-6603-1558668135_r_180x108.jpg" alt="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">
								</a>
							</div>
							<h3 class="title_news">
								<a href="https://vnexpress.net/the-gioi/trump-noi-chu-tich-ha-vien-my-dien-khung-3928291.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'">Trump nói Chủ tịch Hạ viện Mỹ 'điên khùng'</a>
							</h3>
						</article>
						<article class="list_news col-md-3 col-sm-6">
							<div class="thumb_art">
								<a class="thumb thumb_5x3" href="https://vnexpress.net/the-gioi/nguoi-dan-ong-phap-bi-bat-vi-trom-dien-thoai-huawei-o-thai-lan-3928327.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Người đàn ông Pháp bị bắt vì trộm điện thoại Huawei ở Thái Lan">
									<img src="https://i-vnexpress.vnecdn.net/2019/05/24/laurent-1558662744-3495-1558662747_r_180x108.jpg" alt="Người đàn ông Pháp bị bắt vì trộm điện thoại Huawei ở Thái Lan">
								</a>
							</div>
							<h3 class="title_news">
								<a href="https://vnexpress.net/the-gioi/nguoi-dan-ong-phap-bi-bat-vi-trom-dien-thoai-huawei-o-thai-lan-3928327.html?vn_source=rcm_detail&amp;vn_medium=thegioi&amp;vn_campaign=rcm&amp;ctr=rcm_detail_env_4_click_thegioi" title="Người đàn ông Pháp bị bắt vì trộm điện thoại Huawei ở Thái Lan">Người đàn ông Pháp bị bắt vì trộm điện thoại Huawei ở Thái Lan</a>
							</h3>
						</article>
					</div>
				</div>
				<!-- END : BÀI VIẾT LIÊN QUAN -->

				<!-- Comment Area -->
				<div id="comments" class="comments-area">
					
					<div class="fb-comment-embed" data-numposts="5" data-href="<?= Yii::$app->request->absoluteUrl ?>" data-width="560" data-include-parent="false"></div>
					
				</div><!-- Comment Area /- -->


				<!-- START : BÀI VIẾT CÙNG CHUYÊN MỤC -->
				<div class="POSTS_SAME_CATEGORY" id="samecategory">
				    <hgroup class="title_box_category">
				        <h4><a class="first">Cùng chuyên mục</a></h4>
				    </hgroup>
				    <div class="box_category box_infographics clearfix">
				        <article class="list_news col-md-4 col-xs-12">
				            <div class="thumb_art">
				                <a class="thumb thumb_5x3" href="https://vnexpress.net/thoi-su/tai-xe-tra-2-000-dong-cho-tram-thu-phi-gan-cau-vam-cong-3928207.html" title="Tài xế trả 2.000 đồng cho trạm thu phí gần cầu Vàm Cống">
				                    <img src="https://i-vnexpress.vnecdn.net/2019/05/23/TIENLE-1558611638-9723-1558611810_r_220x132.jpg" class="vne_lazy_image lazyloaded" data-original="https://i-vnexpress.vnecdn.net/2019/05/23/TIENLE-1558611638-9723-1558611810_220x132.jpg" alt="Tài xế trả 2.000 đồng cho trạm thu phí gần cầu Vàm Cống">
				                </a>
				            </div>
				            <h3 class="title_news"><a href="https://vnexpress.net/thoi-su/tai-xe-tra-2-000-dong-cho-tram-thu-phi-gan-cau-vam-cong-3928207.html"> Tài xế trả 2.000 đồng cho trạm thu phí gần cầu Vàm Cống </a>            <a class="icon_commend" href="https://vnexpress.net/thoi-su/tai-xe-tra-2-000-dong-cho-tram-thu-phi-gan-cau-vam-cong-3928207.html#box_comment" style="white-space: nowrap; display: none;">                <span class="txt_num_comment font_icon widget-comment-3928207-1"><i class="ic ic-comment ic-x ic-invert"><span>0</span></i></span>            </a>        </h3>
				        </article>
				        <article class="list_news col-md-4 col-xs-12">
				            <div class="thumb_art">
				                <a class="thumb thumb_5x3" href="https://vnexpress.net/thoi-su/chu-re-bi-dien-giat-tu-vong-trong-ngay-cuoi-3928100.html" title="Chú rể bị điện giật tử vong trong ngày cưới"><img src="https://i-vnexpress.vnecdn.net/2019/05/23/rapcuoi-1558606989-8976-1558607174_r_220x132.jpg" class="vne_lazy_image lazyloaded" data-original="https://i-vnexpress.vnecdn.net/2019/05/23/rapcuoi-1558606989-8976-1558607174_220x132.jpg" alt="Chú rể bị điện giật tử vong trong ngày cưới"></a>
				            </div>
				            <h3 class="title_news"><a href="https://vnexpress.net/thoi-su/chu-re-bi-dien-giat-tu-vong-trong-ngay-cuoi-3928100.html"> Chú rể bị điện giật tử vong trong ngày cưới </a>            <a class="icon_commend" href="https://vnexpress.net/thoi-su/chu-re-bi-dien-giat-tu-vong-trong-ngay-cuoi-3928100.html#box_comment" style="white-space: nowrap; display: none;">                <span class="txt_num_comment font_icon widget-comment-3928100-1"><i class="ic ic-comment ic-x ic-invert"><span>14</span></i></span>            </a>        </h3>
				        </article>
				        <article class="list_news col-md-4 col-xs-12">
				            <div class="thumb_art">
				                <a class="thumb thumb_5x3" href="https://vnexpress.net/giao-duc/hoa-binh-xem-xet-ky-luat-dang-vien-lien-quan-gian-lan-diem-thi-3928173.html" title="Hòa Bình xem xét kỷ luật đảng viên liên quan gian lận điểm thi"><img src="https://i-vnexpress.vnecdn.net/2019/05/23/So-Giaoc-duc-hoa-binh-1177-155-2814-7847-1558610388_r_220x132.jpg" class="vne_lazy_image lazyloaded" data-original="https://i-vnexpress.vnecdn.net/2019/05/23/So-Giaoc-duc-hoa-binh-1177-155-2814-7847-1558610388_220x132.jpg" alt="Hòa Bình xem xét kỷ luật đảng viên liên quan gian lận điểm thi"></a>
				            </div>
				            <h3 class="title_news"><a href="https://vnexpress.net/giao-duc/hoa-binh-xem-xet-ky-luat-dang-vien-lien-quan-gian-lan-diem-thi-3928173.html"> Hòa Bình xem xét kỷ luật đảng viên liên quan gian lận điểm thi </a>            <a class="icon_commend" href="https://vnexpress.net/giao-duc/hoa-binh-xem-xet-ky-luat-dang-vien-lien-quan-gian-lan-diem-thi-3928173.html#box_comment" style="white-space: nowrap; display: none;">                <span class="txt_num_comment font_icon widget-comment-3928173-1"><i class="ic ic-comment ic-x ic-invert"><span>0</span></i></span>            </a>        </h3>
				        </article>
				    </div>
				    <div class="wrap_10_items clearfix">
				        <ul class="list_title col-md-6">
				            <li><a href="https://vnexpress.net/thoi-su/xe-container-lat-quoc-lo-1a-ach-tac-nhieu-gio-3928169.html">Xe container lật, quốc lộ 1A ách tắc nhiều giờ </a>
				                <a class="icon_commend" href="https://vnexpress.net/thoi-su/xe-container-lat-quoc-lo-1a-ach-tac-nhieu-gio-3928169.html#box_comment" style="white-space: nowrap; display: none;"> <span class="txt_num_comment font_icon widget-comment-3928169-1"><i class="ic ic-comment ic-x ic-invert"><span>0</span></i>
				                    </span>
				                </a>
				            </li>
				            <li><a href="https://vnexpress.net/giao-duc/bo-giao-duc-va-dao-tao-khong-bien-soan-mot-bo-sach-giao-khoa-3928075.html">Bộ Giáo dục và Đào tạo không biên soạn một bộ sách giáo khoa </a>
				                <a class="icon_commend" href="https://vnexpress.net/giao-duc/bo-giao-duc-va-dao-tao-khong-bien-soan-mot-bo-sach-giao-khoa-3928075.html#box_comment" style="white-space: nowrap; display: none;"> <span class="txt_num_comment font_icon widget-comment-3928075-1"><i class="ic ic-comment ic-x ic-invert"><span>0</span></i>
				                    </span>
				                </a>
				            </li>
				            <li><a href="https://vnexpress.net/thoi-su/tp-hcm-quy-hoach-mot-loat-nut-giao-thong-trong-diem-3927415.html">TP HCM quy hoạch một loạt nút giao thông trọng điểm </a>
				                <a class="icon_commend" href="https://vnexpress.net/thoi-su/tp-hcm-quy-hoach-mot-loat-nut-giao-thong-trong-diem-3927415.html#box_comment" style="white-space: nowrap;"> <span class="txt_num_comment font_icon widget-comment-3927415-1"><i class="ic ic-comment ic-x ic-invert"><span>36</span></i>
				                    </span>
				                </a>
				            </li>
				        </ul>
				        <ul class="list_title col-md-6">
				            <li><a href="https://vnexpress.net/thoi-su/chi-lao-cong-benh-vien-tra-lai-38-trieu-dong-nhat-duoc-3927975.html">Chị lao công bệnh viện trả lại 38 triệu đồng nhặt được </a>
				                <a class="icon_commend" href="https://vnexpress.net/thoi-su/chi-lao-cong-benh-vien-tra-lai-38-trieu-dong-nhat-duoc-3927975.html#box_comment" style="white-space: nowrap; display: none;"> <span class="txt_num_comment font_icon widget-comment-3927975-1"><i class="ic ic-comment ic-x ic-invert"><span>12</span></i>
				                    </span>
				                </a>
				            </li>
				            <li><a href="https://vnexpress.net/thoi-su/nhieu-lanh-dao-xa-o-ha-tinh-su-dung-bang-gia-3927936.html">Nhiều lãnh đạo xã ở Hà Tĩnh sử dụng bằng giả </a>
				                <a class="icon_commend" href="https://vnexpress.net/thoi-su/nhieu-lanh-dao-xa-o-ha-tinh-su-dung-bang-gia-3927936.html#box_comment" style="white-space: nowrap; display: none;"> <span class="txt_num_comment font_icon widget-comment-3927936-1"><i class="ic ic-comment ic-x ic-invert"><span>19</span></i>
				                    </span>
				                </a>
				            </li>
				            <li><a href="https://vnexpress.net/thoi-su/de-xuat-muc-phat-30-trieu-dong-voi-tai-xe-vi-pham-nong-do-con-3927939.html">Đề xuất mức phạt 30 triệu đồng với tài xế vi phạm nồng độ cồn </a>
				                <a class="icon_commend" href="https://vnexpress.net/thoi-su/de-xuat-muc-phat-30-trieu-dong-voi-tai-xe-vi-pham-nong-do-con-3927939.html#box_comment" style="white-space: nowrap;"> <span class="txt_num_comment font_icon widget-comment-3927939-1"><i class="ic ic-comment ic-x ic-invert"><span>33</span></i>
				                    </span>
				                </a>
				            </li>
				        </ul>
				    </div>
				</div>
				<!--END: BÀI VIẾT CÙNG CHUYÊN MỤC -->

			</div><!-- Content Area /- -->

			<!-- Widget Area -->
			<div class="col-md-4 col-sm-12 col-xs-12 widget-area">
				<?= cateNewsRightWidget::widget() ?>
				<!-- Popular Video -->
				<!-- <aside class="widget widget_video">
					<h3 class="widget-title">POPULAR VIDEOS</h3>
					<div class="video-block">
						<div class="video-post">
							<a href="#"><img src="<?= Yii::$app->homeUrl ?>vender/images/popular-video1.jpg" alt="Popular Video" /></a>
							<h5><a href="#"><i class="fa fa-play"></i>Qaim says prominent people arrested </a></h5>
						</div>
						<div class="video-post">
							<a href="#"><img src="<?= Yii::$app->homeUrl ?>vender/images/popular-video2.jpg" alt="Popular Video" /></a>
							<h5><a href="#"><i class="fa fa-play"></i>Way now cleared for Australian </a></h5>
						</div>
						<div class="video-post">
							<a href="#"><img src="<?= Yii::$app->homeUrl ?>vender/images/popular-video3.jpg" alt="Popular Video" /></a>
							<h5><a href="#"><i class="fa fa-play"></i>Way now cleared for Australian </a></h5>
						</div>
					</div>
					<div class="see-more"><a href="#" title="SEE MORE Video">SEE MORE Video</a></div>
				</aside> -->
				<!-- Popular Video /- -->

				<!-- Facebook fanpage -->
				<!-- <aside class="widget widget_video">
					<h3 class="widget-title">FANPAGE </h3>
					<div class="video-block">
						<div class="fb-page" data-href="https://www.facebook.com/suachuaxemaymototech/" data-tabs="timeline" data-height="280" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/suachuaxemaymototech/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/suachuaxemaymototech/">Sửa chữa bảo dưỡng xe máy MotoTech</a></blockquote></div>
					</div>
				</aside> -->
				<!-- Facebook fanpage /- -->
			</div><!-- Widget Area /- -->
		</div>
	</div><!-- Container /- -->
			</div><!-- Single Post /- -->