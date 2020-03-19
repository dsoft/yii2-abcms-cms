<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use abcms\cms\models\ContentType;
use abcms\structure\models\Structure;

/* @var $this yii\web\View */
/* @var $model abcms\cms\models\ContentType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'namePlural')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'typeId')->dropDownList(ContentType::getTypeList()) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?php if(!$model->isNewRecord): ?>
    <?= $form->field($model, 'structureId')->dropDownList(Structure::getList()) ?>
    <?php endif; ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('abcms.cms', 'Create') : Yii::t('abcms.cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
