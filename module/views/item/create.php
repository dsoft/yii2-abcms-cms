<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model abcms\cms\models\ContentItem */
/* @var $contentType abcms\cms\models\ContentType */

$this->title = Yii::t('abcms.cms', 'Create {modelClass} ', ['modelClass' => $contentType->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('abcms.cms', 'Lists'), 'url' => ['list/index']];
$this->params['breadcrumbs'][] = ['label' => $contentType->getPluralName(), 'url' => ['index', 'contentTypeId' => $contentType->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'structure' => $structure,
    ]) ?>

</div>
