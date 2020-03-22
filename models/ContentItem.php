<?php

namespace abcms\cms\models;

use Yii;
use abcms\cms\models\ContentType;

/**
 * This is the model class for table "content_item".
 *
 * @property int $id
 * @property int $contentTypeId
 * @property int $active
 * @property int $deleted
 * @property int $ordering
 */
class ContentItem extends \abcms\library\base\BackendActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'ordering'], 'integer'],
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
     * ContentType relation
     * @return mixed
     */
    public function getContentType()
    {
        return $this->hasOne(ContentType::className(), ['id' => 'contentTypeId']);
    }

    /**
     * Return Structure model from ContentType
     * @return Structure|null
     */
    public function getStructure()
    {
        return $this->contentType ? $this->contentType->structure : null;
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('abcms.cms', 'ID'),
            'contentTypeId' => Yii::t('abcms.cms', 'Content Type'),
            'active' => Yii::t('abcms.cms', 'Active'),
            'deleted' => Yii::t('abcms.cms', 'Deleted'),
            'ordering' => Yii::t('abcms.cms', 'Ordering'),
        ];
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
     * Check if custom field 'title' or 'name' exists and return it
     * @return string|null
     */
    public function getTitle()
    {
        if($title = $this->getField('title')){
            return $title;
        }
        if($name = $this->getField('name')){
            return $name;
        }
        return null;
    }

}
