<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Comment;

/**
 * CommentSearch represents the model behind the search form about `common\models\Comment`.
 */
class CommentSearch extends Comment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'status', 'user_id', 'remind_flag'], 'integer'],
            [['content', 'blog_id','create_at','username'], 'safe'],
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
        $query = Comment::find();

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
//            'blog_id' => $this->blog_id,
            'comment.status' => $this->status,
            'user_id' => $this->user_id,
            'create_at' => $this->create_at,
            'remind_flag' => $this->remind_flag,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);
        $query->joinWith('blog');
        $query->andFilterWhere(['like', 'title', $this->blog_id]);
        $query->joinWith('user');
        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
