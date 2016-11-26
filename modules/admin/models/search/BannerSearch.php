<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Banner;

/**
 * BannerSearch represents the model behind the search form about `app\models\Banner`.
 */
class BannerSearch extends Banner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'isActive', 'createUserId', 'updateUserId'], 'integer'],
            [['name', 'content', 'imageFileName', 'startTime', 'endTime', 'createTime', 'updateTime'], 'safe'],
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
        $query = Banner::find();

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
                'startTime' => $this->startTime,
                'endTime' => $this->endTime,
                'isActive' => $this->isActive,
                'createTime' => $this->createTime,
                'updateTime' => $this->updateTime,
                'createUserId' => $this->createUserId,
                'updateUserId' => $this->updateUserId,
            ]);
        $query->orderBy('id desc');
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'imageFileName', $this->imageFileName]);

        return $dataProvider;
    }
}
