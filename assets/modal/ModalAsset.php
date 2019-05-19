<?php

namespace app\assets\modal;

use yii\web\AssetBundle;

/**
 *
 */
class ModalAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseurl = '@web';

  public $js = [
    'js/modal/main.js'
  ];

  public $depends = [
    'yii\web\YiiAsset',
  ];
}
