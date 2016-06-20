<?php
/**
 * Created by PhpStorm.
 * User: zinzinday
 * Date: 10/30/2014
 * Time: 1:20 AM
 */

namespace anmishael\jwplayer7;
use yii\web\AssetBundle;

class JWPlayerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/anmishael/yii2-jwplayer7/assets';
    public $js = ['jwplayer.js'];
	public $css = ['skins/six.css'];
    public $depends=[
        'yii\web\JqueryAsset'
    ];
} 