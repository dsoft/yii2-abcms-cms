<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model abcms\cms\models\ContentItem */
/* @var $contentType abcms\cms\models\ContentType */

$title = $model->getTitle();
$this->title = $title ? $title : $contentType->name.': '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('abcms.cms', 'Lists'), 'url' => ['list/index']];
$this->params['breadcrumbs'][] = ['label' => $contentType->getPluralName(), 'url' => ['index', 'contentTypeId' => $contentType->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('abcms.cms', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('abcms.cms', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('abcms.cms', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'active:boolean',
            'ordering',
        ],
    ]) ?>
    
    <?= \abcms\structure\widgets\View::widget(['model' => $model, 'structure' => $structure]) ?>
    
    <?=
    \abcms\multilanguage\widgets\TranslationView::widget([
        'model' => $structure->getStructureTranslation($model),
    ])
    ?>
</div>
