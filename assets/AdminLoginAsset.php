<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Class AdminLoginAsset
 *
 * @package app\assets
 */
class AdminLoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/web/admin/css/bootstrap.min.css',
        '/web/admin/font-awesome/css/font-awesome.css',
        '/web/admin/css/animate.css',
        '/web/admin/css/style.css',
    ];
    public $js = [
		'/web/admin/js/bootstrap.min.js',
   ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

