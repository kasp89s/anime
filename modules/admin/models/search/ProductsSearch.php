<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductsSearch represents the model behind the search form about `app\models\Product`.
 *
 * @package app\modules\admin\models\search
 */
class ProductsSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quantityInStock', 'quantityOfSold', 'productDisountId', 'productManufactureId'], 'integer'],
            [['sku', 'name', 'description', 'barcode1', 'barcode2', 'barcode3', 'availableTime', 'createTime', 'updateTime', 'currencyCode', 'imageFileName'], 'safe'],
            [['price'], 'number'],
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

        $query = Product::find();

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
                'quantityInStock' => $this->quantityInStock,
                'quantityOfSold' => $this->quantityOfSold,
                'availableTime' => $this->availableTime,
                'createTime' => $this->createTime,
                'updateTime' => $this->updateTime,
                'price' => $this->price,
                'productDisountId' => $this->productDisountId,
                'productManufactureId' => $this->productManufactureId,
            ]);
        $query->orderBy('id desc');
        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'barcode1', $this->barcode1])
            ->andFilterWhere(['like', 'barcode2', $this->barcode2])
            ->andFilterWhere(['like', 'barcode3', $this->barcode3])
            ->andFilterWhere(['like', 'currencyCode', $this->currencyCode])
            ->andFilterWhere(['like', 'imageFileName', $this->imageFileName]);

        return $dataProvider;
    }
}
