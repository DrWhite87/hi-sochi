<?php

namespace app\modules\event\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\event\models\EventCategory;

/**
 * CategorySearch represents the model behind the search form about `app\modules\event\models\EventCategory`.
 */
class CategorySearch extends EventCategory
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'alias', 'descr'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = EventCategory::find();
        
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        if (!($this->load($params) && $this->validate())) {            
            return $dataProvider;
        }
        var_dump($params);
        
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'descr', $this->descr]);

         
        return $dataProvider;
    }
}
