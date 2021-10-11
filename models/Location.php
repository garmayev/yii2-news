<?php

namespace garmayev\news\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string|null $title
 * @property float|null $latitude
 * @property float|null $longitude
 *
 * @property Post[] $posts
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'number'],
            [['title'], 'string', 'max' => 255],
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
            'latitude' => Yii::t('news', 'Latitude'),
            'longitude' => Yii::t('news', 'Longitude'),
        ];
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['location_id' => 'id']);
    }
}
