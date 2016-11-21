<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CustomerGroup;

/**
 * CustomerGroupSearch represents the model behind the search form about `app\models\CustomerGroup`.
 */
class CustomerGroupSearch extends CustomerGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'isAutomaticGroup', 'isActive', 'isDefault'], 'integer'],
            [['name', 'description'], 'safe'],
            [['groupDiscount', 'groupAccumulatedLimit'], 'number'],
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
        $query = CustomerGroup::find();

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
                'groupDiscount' => $this->groupDiscount,
                'isAutomaticGroup' => $this->isAutomaticGroup,
                'isActive' => $this->isActive,
                'isDefault' => $this->isDefault,
                'groupAccumulatedLimit' => $this->groupAccumulatedLimit,
            ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
