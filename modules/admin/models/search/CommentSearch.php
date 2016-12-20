<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comment;

/**
 * CommentSearch represents the model behind the search form about `app\models\Comment`.
 */
class CommentSearch extends Comment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'productId', 'rating', 'isActive'], 'integer'],
            [['userName', 'userEmail', 'message', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        if (!empty($params[get_class($this)]))
            $params[get_class($this)] = array_map("trim", $params[get_class($this)]);

        $query = Comment::find();

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
            'productId' => $this->productId,
            'rating' => $this->rating,
            'isActive' => $this->isActive,
        ]);
        $query->orderBy('id desc');
        $query->andFilterWhere(['like', 'userName', $this->userName])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'userEmail', $this->userEmail])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
