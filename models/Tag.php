<?php

namespace garmayev\news\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 *
 * @property PostTag[] $postTags
 * @property Post[] $posts
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

	public function behaviors()
	{
		return [
			'sluggable' => [
				'class' => SluggableBehavior::class,
				'attribute' => 'title',
				'ensureUnique' => true,
			]
		];
	}

	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('news', 'ID'),
            'title' => Yii::t('news', 'Title'),
            'slug' => Yii::t('news', 'Slug'),
        ];
    }

    /**
     * Gets query for [[PostTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['tag_id' => 'id']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->viaTable('post_tag', ['tag_id' => 'id']);
    }
}
