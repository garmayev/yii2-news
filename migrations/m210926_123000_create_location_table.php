<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%location}}`.
 */
class m210926_123000_create_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%location}}', [
            'id' => $this->primaryKey(),
	        'title' => $this->string(),
	        'latitude' => $this->double(),
	        'longitude' => $this->double(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%location}}');
    }
}
