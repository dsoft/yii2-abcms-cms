<?php

namespace abcms\cms\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%content_type}}`.
 */
class M200318154630CreateContentTypeTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%content_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'namePlural' => $this->string()->null(),
            'typeId' => $this->smallInteger()->notNull(),
            'icon' => $this->string()->null(),
            'structureId' => $this->integer()->notNull(),
            'visible' => $this->boolean()->notNull()->defaultValue(1),
            'deleted' => $this->boolean()->notNull()->defaultValue(0),
        ]);
        
        // creates index for column `name`
        $this->createIndex(
            'idx-content_type-name',
            'content_type',
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `name`
        $this->dropIndex(
            'idx-content_type-name',
            'content_type'
        );
        
        $this->dropTable('{{%content_type}}');
    }
}
