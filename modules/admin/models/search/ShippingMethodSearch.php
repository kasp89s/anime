<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ShippingMethod;

/**
 * ShippingMethodSearch represents the model behind the search form about `app\models\ShippingMethod`.
 */
class ShippingMethodSearch extends ShippingMethod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'countryCode', 'description', 'imageFileName'], 'safe'],
            [['price', 'insurancePercent'], 'number'],
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
        $query = ShippingMethod::find();

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
                'price' => $this->price,
                'insurancePercent' => $this->insurancePercent,
            ]);
        $query->orderBy('id desc');
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'countryCode', $this->countryCode])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'imageFileName', $this->imageFileName]);

        return $dataProvider;
    }
}
