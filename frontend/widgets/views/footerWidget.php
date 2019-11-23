<?php if ($footer = Yii::$app->cache->get('settings_app_website')['footer']): ?>
  <footer>
    <div class="container" style="background-color: transparent;">
      <row>
        <?= $footer; ?>
      </row>
    </div>
  </footer>
<?php endif ?>


  <!-- <a href="javascript:;" id="back_to_top"><i class="fa fa-arrow-circle-up"></i></a> -->
  <span id="back-to-top">
  	<!-- đây là icon mình lấy từ fontawesome -->
  	<i class="fa fa-arrow-circle-up"></i>
  </span>
  
<!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55d7ec8729b23042"></script> -->