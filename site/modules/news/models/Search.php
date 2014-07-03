<?php

namespace app\modules\news\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\news\models\News;

/**
 * Search represents the model behind the search form about `app\modules\news\models\News`.
 */
class Search extends News {

    public function rules() {
        return [
            [['id', 'created', 'updated', 'user_id', 'image_id', 'head', 'status'], 'integer'],
            [['title', 'alias', 'anons', 'content', 'tags', 'source', 'category'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {       
        
        $query = News::find()->orderBy('id DESC');        
        
        if(!empty($params['Search']['category'])){
            $query->joinWith('categories');
        }
        
        //print_r($query->all());

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->options['pageSize'],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        if(isset($params['Search']['notOverdue'])){
            $query->andWhere('(end_active > :end_active OR end_active IS NULL)', [':end_active' => time()]);
        }
        

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'image_id' => $this->image_id,
            'head' => $this->head,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                //->andFilterWhere(['LIKE', 'alias', $this->alias])
                ->andFilterWhere(['like', 'anons', $this->anons])
                ->andFilterWhere(['like', 'content', $this->content])
                ->andFilterWhere(['like', 'tags', $this->tags])
                ->andFilterWhere(['like', 'source', $this->source])
                ->andFilterWhere(['like', 'tbl_news_category.alias', $this->category]);

        return $dataProvider;
    }

}
