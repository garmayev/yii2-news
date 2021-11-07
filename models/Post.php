<?php

namespace garmayev\news\models;

use common\models\User;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $content
 * @property string|null $slug
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $author_id
 * @property int|null $location_id
 *
 * @property User $author
 * @property Location $location
 * @property PostTag[] $postTags
 * @property Tag[] $tags
 */
class Post extends \yii\db\ActiveRecord
{
	/**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

	/**
	 * {@inheritdoc}
	 * @return array
	 */
	public function behaviors()
	{
		return array_merge(parent::behaviors(), [
			'timestamp' => [
				'class' => TimestampBehavior::class,
				'createdAtAttribute' => 'created_at',
				'updatedAtAttribute' => 'updated_at'
			],
			'sluggable' => [
				'class' => SluggableBehavior::class,
				'attribute' => 'title',
				'ensureUnique' => true,
			],
			'relations' => [
				'class' => SaveRelationsBehavior::class,
				'relations' => [
					'tags'
				],
			]
		]);
	}

	/**
     * {@inheritdoc}
     */
    public function rules()
    {
		$module = Yii::$app->getModule('news');
        return [
            [['content'], 'string'],
            [['created_at', 'updated_at', 'author_id', 'location_id'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => $module->user_class, 'targetAttribute' => ['author_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location_id' => 'id']],
	        [['author_id'], 'default', 'value' => Yii::$app->user->id],
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
            'content' => Yii::t('news', 'Content'),
            'slug' => Yii::t('news', 'Slug'),
            'created_at' => Yii::t('news', 'Created At'),
            'updated_at' => Yii::t('news', 'Updated At'),
            'author_id' => Yii::t('news', 'Author ID'),
            'location_id' => Yii::t('news', 'Location ID'),
        ];
    }

	public function transactions()
	{
		return [
			self::SCENARIO_DEFAULT => self::OP_ALL,
		];
	}

	public function load($data, $formName = null)
	{
		$ids = [];
		if ( isset($data["Post"]["tags"]) ) {
			foreach ($data["Post"]["tags"] as $tag) {
				$id = intval($tag);
				if ( $id === 0 ) {
					$newTag = new Tag([
						'title' => $tag
					]);
					$newTag->save();
					$ids[] = $newTag->id;
				} else {
					$ids[] = $id;
				}
			}
			$this->tags = $ids;
		}
		return parent::load($data, $formName);
	}

	/**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    /**
     * Gets query for [[PostTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
    }

	/**
	 * Gets query for [[Tags]].
	 *
	 * @return \yii\db\ActiveQuery
	 * @throws \yii\base\InvalidConfigException
	 */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('post_tag', ['post_id' => 'id']);
    }
}