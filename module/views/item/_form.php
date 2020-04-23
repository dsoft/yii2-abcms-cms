<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model abcms\cms\models\ContentItem */
/* @var $structure abcms\structure\models\Structure */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-item-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= \abcms\structure\widgets\Form::widget(['model' => $model, 'structure' => $structure, 'form' => $form]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'ordering')->textInput() ?>
    
    <?= \abcms\multilanguage\widgets\TranslationForm::widget(['model' => $structureTranslation, 'form' => $form]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('abcms.cms', 'Create') : Yii::t('abcms.cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
