<?php

namespace abcms\cms\assets;

use yii\web\AssetBundle;

/**
 * CMS module asset bundle.
 */
class CmsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/abcms/yii2-cms/public';
    public $css = [
        'cms.css',
    ];
    public $js = [
    ];
}
