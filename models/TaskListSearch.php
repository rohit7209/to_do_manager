<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TaskList;

/**
 * TaskListSearch represents the model behind the search form about `app\models\TaskList`.
 */
class TaskListSearch extends TaskList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id'], 'integer'],
            [['task_name', 'task_description', 'task_time', 'task_date', 'task_location', 'created_on', 'status'], 'safe'],
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
        $query = TaskList::find();

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
            'task_id' => $this->task_id,
            'task_time' => $this->task_time,
            'task_date' => $this->task_date,
            'created_on' => $this->created_on,
        ]);

        $query->andFilterWhere(['like', 'task_name', $this->task_name])
            ->andFilterWhere(['like', 'task_description', $this->task_description])
            ->andFilterWhere(['like', 'task_location', $this->task_location])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
