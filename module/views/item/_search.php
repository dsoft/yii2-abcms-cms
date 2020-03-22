<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model abcms\cms\module\models\ContentItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contentTypeId') ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'ordering') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('abcms.cms', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('abcms.cms', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
