<?php

namespace backend\forms;

use portfolio\entities\Language;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class LanguageSearch extends Model
{
    public $id;
    public $content;

    public function rules(): array 
    {
        return [
            ['id', 'integer'],
            ['content', 'trim']
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Language::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'content', $this->content]);
            
        return $dataProvider;
    }
}