<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Class AppAsset
 *
 * @package app\assets
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/web/css/normalize.css',
        '/web/css/bootstrap.css',
        '/web/css/slick.css',
        '/web/css/owl.carousel.css',
        '/web/css/style.css',
    ];
    public $js = [
		'/web/js/owl.carousel.min.js',
		'/web/js/slick.min.js',
		'/web/js/script.js',
   ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

