<?php

namespace app\modules\url\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\url\models\UrlShortenerLog;

/**
 * UrlShortenerLogSearch represents the model behind the search form of `app\modules\url\models\UrlShortenerLog`.
 */
class UrlShortenerLogSearch extends UrlShortenerLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'url_shortener_id'], 'integer'],
            [['user_agent', 'ip', 'browser', 'created_at', 'updated_at', 'os', 'device', 'engine'], 'safe'],
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
        $query = UrlShortenerLog::find();

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
            'url_shortener_id' => $this->url_shortener_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'user_agent', $this->user_agent])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'browser', $this->browser])
            ->andFilterWhere(['like', 'os', $this->os])
            ->andFilterWhere(['like', 'device', $this->device])
            ->andFilterWhere(['like', 'engine', $this->engine]);

        return $dataProvider;
    }
}
