<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(
        $model->getStatuses(),
        ['prompt'=>'请选择状态']
    ) ?>
    <?= $form->field($model,'author_id')
        ->dropDownList($model->authorname,
            ['prompt'=>'请选择作者']);?>
    <?= $form->field($model, 'cover', [
        'options'=>['class'=>''],
        'inputOptions' => ['class' => 'form-control'],
    ])->fileInput()->label(false); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
