<?php

namespace abcms\cms\models;

use Yii;
use abcms\structure\models\Structure;
use yii\helpers\Inflector;

/**
 * This is the model class for table "content_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $namePlural
 * @property integer $typeId
 * @property string $icon
 * @property integer $structureId
 * @property integer $deleted
 */
class ContentType extends \abcms\library\base\BackendActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'typeId'], 'required'],
            [['typeId', 'structureId'], 'integer'],
            [['name', 'namePlural', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('abcms.cms', 'ID'),
            'name' => Yii::t('abcms.cms', 'Name'),
            'namePlural' => Yii::t('abcms.cms', 'Name Plural'),
            'typeId' => Yii::t('abcms.cms', 'Type'),
            'icon' => Yii::t('abcms.cms', 'Icon'),
            'structureId' => Yii::t('abcms.cms', 'Structure'),
            'deleted' => Yii::t('abcms.cms', 'Deleted'),
        ];
    }
    
    /**
     * Structure relation
     * @return mixed
     */
    public function getStructure()
    {
        return $this->hasOne(Structure::className(), ['id' => 'structureId']);
    }
    
    /**
     * Returns the structure name
     * @return string
     */
    public function getStructureName()
    {
        return $this->structure ? $this->structure->name : null;
    }
    
    /**
     * Returns an array containing the available content types
     * @return array
     */
    public static function getTypeList()
    {
        $array = [
            1 => Yii::t('abcms.cms', 'List'),
        ];
        return $array;
    }
    
    /**
     * Returns the type name
     * @return string|null
     */
    public function getType()
    {
        $array = self::getTypeList();
        return isset($array[$this->typeId]) ? $array[$this->typeId] : null;
    }
    
    /**
     * Generate a structure name from the model name
     * @return string
     */
    public function generateStructureName()
    {
        return 'ContentType'.Inflector::camelize($this->name);
    }
    
    /**
     * Returns the icon HTML code
     * @return string
     */
    public function getIconHtml()
    {
        if(!$this->icon){
            return null;
        }
        $html = '<span class="glyphicon glyphicon-'.$this->icon.'"></span>';
        return $html;
    }
}