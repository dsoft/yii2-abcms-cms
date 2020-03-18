<?php

namespace abcms\cms\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%content_item}}`.
 */
class M200318154828CreateContentItemTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%content_item}}', [
            'id' => $this->primaryKey(),
            'structureId' => $this->integer()->notNull(),
            'active' => $this->boolean()->notNull()->defaultValue(1),
            'deleted' => $this->boolean()->notNull()->defaultValue(0),
            'ordering' => $this->integer()->notNull()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%content_item}}');
    }
}
