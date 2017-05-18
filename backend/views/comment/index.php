<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'content:ntext',
//            'blog_id',
            [
                'attribute' => 'blog_id',
                'value' => 'blog.title',
            ],
//            'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return $data->commentstatus[$data->status];
                },
                'filter' =>$searchModel->commentstatus,
            ],
            [
                'label' => '评论用户',
                'attribute' => 'username',
                'value' => 'user.username',
            ],
//            'user_id',
            // 'create_at',
            // 'remind_flag',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
