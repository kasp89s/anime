<?php
namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/web/admin/css/bootstrap.min.css',
        '/web/admin/font-awesome/css/font-awesome.css',
        '/web/admin/css/plugins/iCheck/custom.css',
        '/web/admin/css/animate.css',
        '/web/admin/css/style.css',
        '/web/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        '/web/admin/css/plugins/datapicker/datepicker3.css',
        '/web/admin/css/plugins/summernote/summernote.css',
        '/web/admin/css/plugins/summernote/summernote-bs3.css',
        '/web/admin/css/plugins/chosen/bootstrap-chosen.css',
    ];
    public $js = [
        '/web/admin/js/bootstrap.min.js',
        '/web/admin/js/plugins/metisMenu/jquery.metisMenu.js',
        '/web/admin/js/plugins/slimscroll/jquery.slimscroll.min.js',
        '/web/admin/js/inspinia.js',
        '/web/admin/js/plugins/pace/pace.min.js',
        '/web/admin/js/plugins/iCheck/icheck.min.js',
        '/web/admin/js/plugins/datapicker/bootstrap-datepicker.js',
        '/web/admin/js/plugins/nestable/jquery.nestable.js',
        '/web/admin/js/plugins/summernote/summernote.min.js',
        '/web/admin/js/plugins/chosen/chosen.jquery.js',
        '/web/admin/js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

