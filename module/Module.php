<?php

namespace abcms\cms\module;

/**
 * structure module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'abcms\cms\module\controllers';
    
    /**
     * {@inheritdoc}
     */
    public $defaultRoute = 'content-type';
    
    /**
     * @var string Structure module route
     */
    public $structureRoute = '/structure/';
    

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
