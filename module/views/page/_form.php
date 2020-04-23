<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model abcms\cms\models\ContentType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-item-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= \abcms\structure\widgets\Form::widget(['model' => $model, 'structure' => $structure, 'form' => $form]) ?>
    
    <?= \abcms\multilanguage\widgets\TranslationForm::widget(['model' => $structureTranslation, 'form' => $form]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('abcms.cms', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
