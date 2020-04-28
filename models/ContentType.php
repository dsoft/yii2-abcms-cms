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
 * 
 * @property Structure $structure
 * @property ContentItem[] $items
 * @property ContentItem[] $activeItems
 */
class ContentType extends \abcms\library\base\BackendActiveRecord
{
    const TYPE_LIST = 1;
    const TYPE_PAGE = 2;
    
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
            ['name' , 'unique'],
            [['name', 'typeId'], 'required'],
            [['typeId', 'structureId'], 'integer'],
            [['name', 'namePlural', 'icon'], 'string', 'max' => 255],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            [
                'class' => \abcms\structure\behaviors\CustomFieldsBehavior::className(),
            ],
        ]);
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
     * @return \yii\db\ActiveQuery
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
     * Items relation
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(ContentItem::className(), ['contentTypeId' => 'id'])->orderBy(['ordering' => SORT_ASC, 'id' => SORT_DESC])->inverseOf('contentType');
    }
    
    /**
     * Active items relation
     * @return \yii\db\ActiveQuery
     */
    public function getActiveItems()
    {
        return $this->getItems()->andWhere(['active'=>1]);
    }
    
    /**
     * Returns an array containing the available content types
     * @return array
     */
    public static function getTypeList()
    {
        $array = [
            self::TYPE_LIST => Yii::t('abcms.cms', 'List'),
            self::TYPE_PAGE => Yii::t('abcms.cms', 'Page'),
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
    
    /**
     * Returns namePlural if it's set, otherwise converts the name to its plural form.
     * @return string
     */
    public function getPluralName()
    {
        return $this->namePlural ? $this->namePlural : Inflector::pluralize($this->name);
    }
    
    /**
     * Return a specific custom field from the main structure
     * @param string $field
     * @return string|null
     */
    public function getField($field)
    {
        $structure = $this->structure;
        return $this->getCustomField($field, $structure->name);
    }
    
    /**
     * Return the translated custom field from the main structure
     * @param string $field
     * @return string|null
     */
    public function getTranslatedField($field, $language = null)
    {
        if(!$language && Yii::$app->language !== Yii::$app->sourceLanguage){
            $language = Yii::$app->language;
        }
        $structure = $this->structure;
        return $this->getCustomField($field, $structure->name, $language);
    }
    
    /**
     * Overwrites delete function to delete structure also
     * @return boolean
     */
    public function delete()
    {
        if(!$this->beforeDelete()) {
                return false;
        }
        $structure = $this->structure;
        if($structure){
            $structure->delete();
        }
        return parent::delete();
    }
}
