<?php

namespace abcms\cms\classes;

use Yii;
use abcms\structure\classes\FieldTypesInterface;
use abcms\structure\classes\DefaultFieldTypes;
use abcms\cms\models\ContentType;

/**
 * Get field types from database in addition to default field types.
 */
class DbFieldTypes implements FieldTypesInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getTypes()
    {
        $array = DefaultFieldTypes::getTypes();
        $additionalTypes = ContentType::findOne(['name' => 'Field Type'])->activeItems;
        foreach($additionalTypes as $additionalType){
            $array[$additionalType->getField('className')] = $additionalType->getField('name');
        }
        return $array;
    }
}
