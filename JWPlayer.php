<?php
namespace anmishael\jwplayer7;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\helpers\ArrayHelper;
use Yii;

class JWPlayer extends Widget
{
    public $key = '';
    public $options = [];
    public $clientOptions = [];

    public function init()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        $this->defaultOptions();
        $this->registerAssetBundle();
        $this->registerJs();
    }

    public function defaultOptions()
    {
        $this->clientOptions['width'] = ArrayHelper::getValue($this->clientOptions, 'width', '100%');
        if(!isset($this->clientOptions['height'])){
            $this->clientOptions['aspectratio']='16:9';
        }
        if (!isset($this->clientOptions['sharing']['link'])) {
            $this->clientOptions['sharing']['link'] = Yii::$app->request->absoluteUrl;
        }
        $this->clientOptions['abouttext'] = ArrayHelper::getValue($this->clientOptions, 'abouttext', Yii::$app->name);
        $this->clientOptions['aboutlink'] = ArrayHelper::getValue($this->clientOptions, 'aboutlink', Yii::$app->request->hostInfo);
	    if(!isset($this->clientOptions['flashplayer'])) {
		    $this->clientOptions['flashplayer'] = Yii::$app->assetManager->getPublishedUrl('@vendor/anmishael/yii2-jwplayer7/assets') . '/jwplayer.flash.swf';
	    }
//	    if(!array_key_exists('skin', $this->clientOptions)) {
//		    $this->clientOptions['skin'] = Yii::$app->assetManager->getPublishedUrl('@vendor/anmishael/yii2-jwplayer7/assets/skins/') . '/six.css';
//	    }
    }

    public function run()
    {
        echo Html::tag('div', '', $this->options);
    }

    public function registerAssetBundle()
    {
        JWPlayerAsset::register($this->getView());
    }

    public function registerJs()
    {
//        $this->getView()->registerJs("jwplayer.key='{$this->key}';", View::POS_READY, 'jwplayer.key');
        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '';
        $this->getView()->registerJs("".($this->key?'jwplayer.key=\''.$this->key.'\';':'').";jwplayer('{$this->options['id']}').setup({$options});");
    }
} 