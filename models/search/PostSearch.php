<?php

namespace garmayev\news\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use garmayev\news\models\Post;

/**
 * PostSearch represents the model behind the search form of `garmayev\news\models\Post`.
 */
class PostSearch extends Post
{
	public $search;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['search'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

	public function attributeLabels()
	{
		return [
			"Search" => \Yii::t("news", "Search")
		];
	}

	/**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'author_id' => $this->author_id,
            'location_id' => $this->location_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->search])
            ->orFilterWhere(['like', 'content', $this->search])
            ->orFilterWhere(['like', 'slug', $this->search]);

		$query->orderBy(["created_at" => SORT_DESC]);
        return $dataProvider;
    }
}
