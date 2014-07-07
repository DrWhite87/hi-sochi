<?php

namespace app\modules\event\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\event\models\Event;

/**
 * Search represents the model behind the search form about `app\modules\event\models\Event`.
 */
class Search extends Event {
    
    public $category;

    public function rules() {
        return [
            [['id', 'date_begin', 'date_end', 'category_id', 'image_id', 'status'], 'integer'],
            [['alias', 'title', 'descr', 'category', 'tags'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = Event::find()->orderBy('date_begin DESC');

        if (!empty($params['Search']['category'])) {
            $query->joinWith('category');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->options['pageSize'],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if (isset($params['Search']['notOverdue'])) {
            $query->andWhere('(date_end > :date_end OR date_end IS NULL)', [':date_end' => time()]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'category_id' => $this->category_id,
            'image_id' => $this->image_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'alias', $this->alias])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'descr', $this->descr])                
                ->andFilterWhere(['like', 'tags', $this->tags])
                ->andFilterWhere(['like', 'tbl_event_categories.alias', $this->category]);

        return $dataProvider;
    }

}
