<?php

namespace abcms\cms\migrations;

use yii\db\Migration;
use abcms\structure\models\Structure;
use abcms\cms\models\ContentType;
use abcms\cms\models\ContentItem;
use abcms\structure\models\Field;

/**
 * Class M210403153235AddFieldTypes
 */
class M210403153235AddFieldTypes extends Migration
{

    public $structureName = "FieldType";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add structure
        $this->insert('structure', [
            'name' => $this->structureName,
        ]);
        $structure = Structure::findOne(['name' => $this->structureName]);
        if ($structure) {
            // Add fields
            $this->batchInsert('structure_field', ['structureId', 'name', 'type', 'ordering', 'isRequired', 'hint'], [
                [$structure->id, 'className', 'text', 1, true, 'Example: \abcms\cms\classes\ListReference'],
                [$structure->id, 'name', 'text', 2, true, ''],
            ]);
            // Add ContentType
            $contentType = new ContentType([
                'name' => 'Field Type',
                'typeId' => ContentType::TYPE_LIST,
                'icon' => 'list-alt',
                'structureId' => $structure->id,
            ]);
            $contentType->save(false);
            // Add ContentItem
            $contentItem = new ContentItem([
                'contentTypeId' => $contentType->id,
                'active' => 1,
            ]);
            $contentItem->save(false);
            // Save Structure Meta, add ListReference field type
            $contentItem->saveStructureData($structure->id, [
                'className' => '\abcms\cms\classes\ListReference',
                'name' => 'List Reference',
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $structure = Structure::findOne(['name' => $this->structureName]);
        if ($structure) {
            $structureId = $structure->id;
            $this->delete('structure', ['id' => $structureId]);
            $fieldsIds = Field::find()->select('id')->andWhere(['structureId' => $structureId])->column();
            $this->delete('structure_field_meta', ['fieldId' => $fieldsIds]);
            $this->delete('structure_field', ['structureId' => $structureId]);
            $this->delete('content_type', ['structureId' => $structureId]);
        }
    }
}
