<?php

namespace abcms\cms\module\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use abcms\cms\models\ContentItem;

/**
 * ContentItemSearch represents the model behind the search form about `abcms\cms\models\ContentItem`.
 */
class ContentItemSearch extends ContentItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contentTypeId', 'active', 'deleted', 'ordering'], 'integer'],
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
     * @param integer $contentTypeId
     *
     * @return ActiveDataProvider
     */
    public function search($params, $contentTypeId)
    {
        $query = ContentItem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'ordering' => SORT_ASC,
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'contentTypeId' => $contentTypeId,
            'active' => $this->active,
            'deleted' => $this->deleted,
            'ordering' => $this->ordering,
        ]);

        return $dataProvider;
    }
}
