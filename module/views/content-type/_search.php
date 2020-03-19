<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model abcms\cms\module\models\ContentTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'namePlural') ?>

    <?= $form->field($model, 'typeId') ?>

    <?= $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'structureId') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('abcms.cms', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('abcms.cms', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
