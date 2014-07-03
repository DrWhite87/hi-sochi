<?php

namespace app\modules\user\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\user\models\User;

/**
 * Search represents the model behind the search form about `app\modules\user\models\User`.
 */
class Search extends User {

    public function rules() {
        return [
            [['id'], 'integer'],
            [['username', 'email', 'first_name', 'last_name', 'password', 'ip', 'role', 'authKey', 'accessToken'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'first_name', $this->first_name])
                ->andFilterWhere(['like', 'last_name', $this->last_name])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'ip', $this->ip])
                ->andFilterWhere(['like', 'role', $this->role])
                ->andFilterWhere(['like', 'authKey', $this->authKey])
                ->andFilterWhere(['like', 'accessToken', $this->accessToken]);

        return $dataProvider;
    }

}
