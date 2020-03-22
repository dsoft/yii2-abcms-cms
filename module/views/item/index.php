<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel abcms\cms\module\models\ContentItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model abcms\cms\models\ContentType */

$this->title = $model->getPluralName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('abcms.cms', 'Lists'), 'url' => ['list/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('abcms.cms', 'Create {modelClass} ', ['modelClass' => $model->name]), ['create', 'contentTypeId' => $model->id], ['class' => 'btn btn-success'])
        ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'title',
                'value' => function($data) {
                    return $data->getTitle();
                }
            ],
            'ordering',
            ['class' => 'abcms\library\grid\ActivateColumn'],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
