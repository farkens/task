<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%popup}}`.
 */
class m190323_180002_create_popup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{popup}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'text' => $this->text(),
            'is_active' => 'ENUM("on", "off")',
            'count_show' => $this->integer()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('{{popup}}');
    }
}
