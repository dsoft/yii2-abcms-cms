<?php

use yii\helpers\Html;
use yii\grid\GridView;
use abcms\cms\models\ContentType;

/* @var $this yii\web\View */
/* @var $searchModel abcms\cms\module\models\ContentTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('abcms.cms', 'Content Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('abcms.cms', 'Create Content Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'namePlural',
            [
                'attribute' => 'typeId',
                'value' => function($data){
                    return $data->type;
                },
                'filter' => ContentType::getTypeList(),
            ],
            'icon',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
