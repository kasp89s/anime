<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InfoPage;

/**
 * InfoPageSearch represents the model behind the search form about `app\models\InfoPage`.
 *
 * @package app\modules\admin\models\search
 */
class InfoPageSearch extends InfoPage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'createUserId', 'updateUserId'], 'integer'],
            [['code', 'title', 'content', 'createTime', 'updateTime'], 'safe'],
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

        $query = InfoPage::find();

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
                'createTime' => $this->createTime,
                'updateTime' => $this->updateTime,
                'createUserId' => $this->createUserId,
                'updateUserId' => $this->updateUserId,
            ]);
        $query->orderBy('id desc');
        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
