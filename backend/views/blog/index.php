<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?> 
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content:ntext',
//            'status',
            [
                'attribute' => 'status',
                'filter' => $searchModel->statuses,
                'value' => function($data){
                    return $data->statuses[$data->status];
                }
            ],
//            'author_id',
            [
                'attribute' => 'author_id',
                'value' => 'author.username',
            ],
            // 'create_at',
             'updated_at:datetime',
            [
                'format' => 'raw',
                'label' => '图片',
                'value' => function($data){
                    $html = '<img src="'.$data->cover.'" />';
                    return $html;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
