<footer class="footer text-center"> 2019 &copy; Product of Hungld </footer>

 <?php $action = Yii::$app->controller->action->id; if (Yii::$app->controller->id == 'user' && $action == 'update'): ?>
<!-- sample modal content -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Quản lý File</h4> </div>
            <div class="modal-body">
                <?php 
                    $user =  Yii::$app->user->identity->username;
                    $auth_key =  Yii::$app->user->identity->auth_key;
                    ?>
                <iframe  width="100%" height="450" frameborder="0"
                    src="../../../filemanager/dialog.php?type=1&field_id=imageFile&akey=<?= md5($user.$auth_key) ?>">
                </iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> 
<?php endif ?>