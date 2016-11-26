<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NewsLetterSubscriber;

/**
 * NewsLetterSubscriberSearch represents the model behind the search form about `app\models\NewsLetterSubscriber`.
 */
class NewsLetterSubscriberSearch extends NewsLetterSubscriber
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customerId', 'isActive'], 'integer'],
            [['email', 'code', 'createTime'], 'safe'],
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
        $query = NewsLetterSubscriber::find();

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
                'customerId' => $this->customerId,
                'isActive' => $this->isActive,
                'createTime' => $this->createTime,
            ]);
        $query->orderBy('id desc');
        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
