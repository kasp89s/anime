<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderStatus;

/**
 * OrderStatusSearch represents the model behind the search form about `app\models\OrderStatus`.
 */
class OrderStatusSearch extends OrderStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'isDefault', 'isChargeble', 'isPaid', 'isShipped', 'isRestock', 'isPenalty', 'isFinished'], 'integer'],
            [['statusCode', 'name'], 'safe'],
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

        $query = OrderStatus::find();

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
            'isDefault' => $this->isDefault,
            'isChargeble' => $this->isChargeble,
            'isPaid' => $this->isPaid,
            'isShipped' => $this->isShipped,
            'isRestock' => $this->isRestock,
            'isPenalty' => $this->isPenalty,
            'isFinished' => $this->isFinished,
        ]);
        $query->orderBy('id desc');
        $query->andFilterWhere(['like', 'statusCode', $this->statusCode])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
