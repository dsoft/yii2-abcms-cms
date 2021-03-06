<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model abcms\cms\models\ContentItem */
/* @var $contentType abcms\cms\models\ContentType */

$itemTitle = $model->getTitle();
$this->title = Yii::t('abcms.cms', 'Update {modelClass}: ', [
            'modelClass' => $contentType->name,
        ]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('abcms.cms', 'Lists'), 'url' => ['list/index']];
$this->params['breadcrumbs'][] = ['label' => $contentType->name, 'url' => ['index', 'contentTypeId' => $contentType->id]];
$this->params['breadcrumbs'][] = ['label' => $itemTitle ? $itemTitle : $contentType->name . ': ' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('abcms.cms', 'Update');
?>
<div class="content-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
    'model' => $model,
    'structure' => $structure,
    'structureTranslation' => $structureTranslation,
    ])
    ?>

</div>
