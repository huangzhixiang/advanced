<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'title',
            'content:ntext',
//            'status',
            [
                'attribute' => 'status',
                'value' => $model->statuses[$model->status],
            ],
//            'author_id',
            [
                'attribute' => 'author_id',
                'value' => $model->author->username,
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'format' => 'raw',
                'label' => '图片',
//                'attribute' => 'cover',
                'value' =>function($data){
                    $html = '<img src="'.$data->cover.'" />';
                    return $html;
                }
            ]
        ],
    ]) ?>

</div>
