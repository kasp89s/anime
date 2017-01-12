<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 *
 * @package app\modules\admin\models\search
 */
class OrderSearch extends Order
{
    public $fullName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customerId', 'shippingId', 'paymentId', 'isFinished'], 'integer'],
            [['currencyCode', 'orderStatus', 'couponCode', 'createTime', 'updateTime', 'fullName'], 'safe'],
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

        $query = Order::find();

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
        $query->joinWith(['customerInfo']);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'customerId' => $this->customerId,
            'shippingId' => $this->shippingId,
            'paymentId' => $this->paymentId,
            'createTime' => $this->createTime,
            'updateTime' => $this->updateTime,
            'isFinished' => $this->isFinished,
        ]);
        $query->orderBy('id desc');
        $query->andFilterWhere(['like', 'currencyCode', $this->currencyCode])
            ->andFilterWhere(['like', 'orderStatus', $this->orderStatus])
            ->andFilterWhere(['like', 'ordercustomerinfo.fullName', $this->fullName])
            ->andFilterWhere(['like', 'couponCode', $this->couponCode]);

        return $dataProvider;
    }
}
