<?php

namespace app\modules\event\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\event\models\EventAttribute;

/**
 * AttributeSearch represents the model behind the search form about `app\modules\event\models\EventAttribute`.
 */
class AttributeSearch extends EventAttribute {

    public function rules() {
        return [
            [['id', 'type_id', 'category_id', 'required'], 'integer'],
            [['name', 'alias'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = EventAttribute::find();
        
        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'category_id' => $this->category_id,
            'required' => $this->required,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }

}
