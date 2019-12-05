<?php

namespace backend\models;
//created by Ajie Dibyo R.
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Posting;

/**
 * PostingSearch represents the model behind the search form of `backend\models\Posting`.
 */
class PostingSearch extends Posting
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idCategory', 'idUser', 'ratingPosting', 'likePosting', 'dislikePosting'], 'integer'],
            [['title', 'mainPost', 'datePosted', 'filePosting'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Posting::find();

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
            'idCategory' => $this->idCategory,
            'idUser' => $this->idUser,
            'ratingPosting' => $this->ratingPosting,
            'likePosting' => $this->likePosting,
            'dislikePosting' => $this->dislikePosting,
            'datePosted' => $this->datePosted,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'mainPost', $this->mainPost])
            ->andFilterWhere(['like', 'filePosting', $this->filePosting]);

        return $dataProvider;
    }
}