<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m210926_123016_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
	        'title' => $this->string(),
	        'content' => $this->text(),
			'slug' => $this->string()->unique(),
	        'created_at' => $this->integer(),
	        'updated_at' => $this->integer(),
	        'author_id' => $this->integer(),
	        'location_id' => $this->integer(),
        ]);
		$this->createIndex(
			'idx-post-author_id',
			'{{%post}}',
			'author_id'
		);
		$this->addForeignKey(
			'fk-post-author_id',
			'{{%post}}',
			'author_id',
			'{{%user}}',
			'id',
			'CASCADE',
			'CASCADE'
		);

		$this->createIndex(
			"idx-post-location_id",
			"{{%post}}",
			"location_id"
		);
		$this->addForeignKey(
			"fk-post-location_id",
			"{{%post}}",
			"location_id",
			"location",
			"id",
			"CASCADE",
			"CASCADE"
		);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropForeignKey('fk-post-author_id', '{{%post}}');
		$this->dropIndex('idx-post-author_id', '{{%post}}');

		$this->dropForeignKey('fk-post-location_id', '{{%post}}');
		$this->dropIndex('idx-post-location_id', '{{%post}}');

        $this->dropTable('{{%post}}');
    }
}
