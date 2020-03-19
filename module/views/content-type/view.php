<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model abcms\cms\models\ContentType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('abcms.cms', 'Content Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$structureRoute = Yii::$app->controller->module->structureRoute;
?>
<div class="content-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('abcms.cms', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('abcms.cms', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('abcms.cms', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'namePlural',
            [
                'attribute' => 'typeId',
                'value' => $model->type,
            ],
            [
                'attribute' => 'icon',
                'value' => $model->icon . ($model->icon ? ' (' . $model->iconHtml . ')' : ''),
                'format' => 'html',
            ],
            [
                'attribute' => 'structureId',
                'value' => $model->structureName,
            ],
        ],
    ])
    ?>

    <p>
        <?=
        Html::a(Yii::t('abcms.cms', 'Add Field'), [
            $structureRoute . 'field/create',
            'structureId' => $model->structureId,
            'returnUrl' => Url::current(),
                ], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'type',
            'label',
            'isRequired:boolean',
            'ordering',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'controller' => 'field',
                'urlCreator' => function($action, $model, $key, $index, $column) use ($structureRoute) {
                    return Url::to([$structureRoute . 'field/'.$action, 'id' => $key, 'returnUrl' => Url::current()]);
                },
            ],
        ],
    ]);
    ?>
</div>
