    <?php 
    use app\models\Mydatetime;
    $this->title = 'Danh sách video';
    $time = new Mydatetime();
    foreach ($data as $key => $value):
        // $dw = date( "w", $value['created_at']);
        // echo date('l', strtotime( $value['created_at']));
        // echo date('d/m/Y H:i', ( $value['created_at']));
        // dbg($aa);
        ?>
        <?php if ($key==0): ?>
    <section id="videoList" class="top_detail clearfix">
            <div id="player_playing" class="detail_left paddingLeft0 col-md-8">
            <div id="videoContent">
                <iframe width="100%" height="430" src="<?= $value['link'] ?>?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <div id="scroll_pane_right" class="detail_right col-md-4">
            <div class="inner_detail_right" tabindex="2">
                <div id="info_inner">
                    <h1 class="title"><?= $value['name'] ?></h1>
                    <div class="lead_detail">
                        <?= $value['content'] ?>
                    </div>
                    
                    <p class="cat_time_info">
                        <a href="<?= Yii::$app->homeUrl.'videos/'.$value['cate_slug'].'-'.$value['category_id'] ?>" class="category" title="Cuộc sống 4.0"><?= $value['cateName'] ?></a>
                        <span class="time"><?= $time->sw_get_current_weekday(date('l', strtotime( $value['created_at'])),$value['created_at']) ?>, (GMT+7)</span>
                    </p>
                    <!-- <div class="social width_common">
                    
                    </div> -->
                </div>

            </div>
        </div>
    </section>
        <section class="main_section_home">
            <div id="top_inner" class="box_cat">
                <div class="title_box">
                    <h2>Danh sách Video</h2>
                </div>
        <?php else: 
          $image = $value['link'];
          $vitri = strpos($image, 'embed/');
          $image = substr($image,$vitri+strlen('embed/'),strlen($image));
        ?>
            <article class="col-md-3"  data-lead="Vào ban đêm, nhiều nông dân huyện Ngọc Lặc soi đèn, lội suối để bắt tôm, cá cải thiện bữa ăn và kiếm thêm thu nhập." style="">
                        <div class="thumb_art thumb_full">
                            <a href="<?= Yii::$app->homeUrl.'videos/'.$value['slug'] ?>.html" class="play_video" title="<?= $value['seo_title'] ?>">
                                <img class="lazy_image" data-src="https://img.youtube.com/vi/<?= $image ?>/mqdefault.jpg" alt="<?= $value['seo_title'] ?>">
                                <span class="duration_video"><span class="fas fa-play-circle fa-2x"></span></span> 
                            </a>
                        </div>
                        <h3 class="title_news">
                            <a href="<?= Yii::$app->homeUrl.'videos/'.$value['slug'] ?>.html" class="play_video" title="<?= $value['seo_title'] ?>"><?= $value['name'] ?></a>
                        </h3>
                        <p class="">
                            <span class="duration_time"><i class="ic ic-m-24h"></i>&nbsp;<?= $time->sw_get_current_weekday(date('l', strtotime( $value['created_at'])),$value['created_at'],false) ?></span>
                            <span class="category"><a href="<?= Yii::$app->homeUrl.'videos/'.$value['cate_slug'].'-'.$value['category_id'] ?>" title="Nhịp sống"><?= $value['cateName'] ?></a></span>
                            <!-- <span class="count_comment">
                                 <i class="ic ic-comment ic-x ic-invert">
                                     <span class="txt_num_comment widget-comment-3928946-1"><label class="total">5</label></span>
                                 </i>
                             </span> --> 
                        </p>
                    </article>
        <?php endif ?>
        
    <?php endforeach ?>
            </div>

            <section class="pull-right mr-5">
    <?php 
    if ($pages->pageCount  > 1) {
      
      echo LinkPager::widget([
        'pagination' => $pages,
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last',
        'prevPageLabel' => '<i class="fas fa-chevron-left"></i>',
        'nextPageLabel' => '<i class="fas fa-chevron-right"></i>',
        'maxButtonCount' => 4,
        // 'linkContainerOptions'=>['slug']
      ]);
    }
    ?>
     </section>
        </section>


