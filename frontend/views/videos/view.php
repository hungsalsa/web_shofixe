    <?php 
    use app\models\Mydatetime;
    $this->title = 'video '.$data['vtitle'];
    $time = new Mydatetime();
    // dbg($data);
        // $dw = date( "w", $value['created_at']);
        // echo date('l', strtotime( $value['created_at']));
        // echo date('d/m/Y H:i', ( $value['created_at']));
        // dbg($aa);
        ?>
    <section id="videoList" class="top_detail clearfix">
            <div id="player_playing" class="detail_left paddingLeft0 col-md-8">
            <div id="videoContent">
                <iframe width="100%" height="430" src="<?= $data['vlink'] ?>?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <div id="scroll_pane_right" class="detail_right col-md-4">
            <div class="inner_detail_right" tabindex="2" style="overflow: hidden; outline: none;">
                <div id="info_inner">
                    <h1 class="title"><?= $data['vname'] ?></h1>
                    <div class="lead_detail">
                        <?= $data['content'] ?>
                    </div>
                    
                    <p class="cat_time_info">
                        <a href="<?= Yii::$app->homeUrl.'videos/'.$data['cate_slug'].'-'.$data['category_id'] ?>" class="category" title="Cuộc sống 4.0"><?= $data['cateName'] ?></a>
                        <span class="time"><?= $time->sw_get_current_weekday(date('l', strtotime( $data['created_at'])),$data['created_at']) ?>, (GMT+7)</span>
                    </p>
                    <!-- <div class="social width_common">
                    
                    </div> -->
                </div>

            </div>
        </div>
    </section>
    <?php if (count($data['videocate'])>1): ?>
        
    
    <section class="main_section_home">
        <div id="top_inner" class="box_cat">
            <div class="title_box">
                <h2>Video cùng chuyên mục</h2>
            </div>
            <?php foreach ($data['videocate'] as $key => $value): 
                if ($data['id'] == $value['idVideo']) {
                    continue;
                }
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
                        <span class="category"><a href="/nhip-song" title="Nhịp sống">nhipj song</a></span>
                            <!-- <span class="count_comment">
                                 <i class="ic ic-comment ic-x ic-invert">
                                     <span class="txt_num_comment widget-comment-3928946-1"><label class="total">5</label></span>
                                 </i>
                             </span> --> 
                         </p>
                     </article>
                 <?php endforeach ?>
             </div>
         </section>
<?php endif ?>
