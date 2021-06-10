<?php

namespace abcms\cms\classes;

use Yii;
use yii\helpers\ArrayHelper;
use abcms\cms\models\ContentItem;
use abcms\library\fields\Field;

/**
 * Field type - a dropdown list field that displays list items of a certain ContentType
 */
class ListReference extends Field
{

    /**
     * {@inheritdoc}
     */
    public function renderInput()
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function renderActiveField($activeField)
    {
        $additionalData = $this->additionalData;
        if(isset($additionalData['contentTypeId']) && $additionalData['contentTypeId']){
            $activeField = parent::renderActiveField($activeField);
            $items = ContentItem::find()->andWhere(['contentTypeId' => $additionalData['contentTypeId']])->orderBy(['ordering' => SORT_ASC])->all();
            $list = ArrayHelper::map($items, 'id', 'title');
            $field = $activeField->dropDownList($list, ['prompt' => Yii::t('app', '--Select--')]);
            return $field;
        }
        
    }

    /**
     * {@inheritdoc}
     */
    public function renderValue()
    {
        $model = ContentItem::findOne(['id' => (int)$this->value]);
        return $model ? $model->title : $this->value;
    }

}
