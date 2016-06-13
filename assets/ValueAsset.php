<?php
namespace pistol88\field\assets;

use yii\web\AssetBundle;

class ValueAsset extends AssetBundle
{
    public $depends = [
        'pistol88\field\assets\Asset'
    ];

    public $js = [
        'js/value.js',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();
    }

}
