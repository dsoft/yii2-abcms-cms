<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model abcms\cms\models\ContentType */

$this->title = Yii::t('abcms.cms', 'Update {modelClass}: ', [
    'modelClass' => 'Content Type',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('abcms.cms', 'Content Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('abcms.cms', 'Update');
?>
<div class="content-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
