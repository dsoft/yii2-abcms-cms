<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model abcms\cms\models\ContentType */

$this->title = Yii::t('abcms.cms', 'Update {modelClass}', [
            'modelClass' => $model->name,
        ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('abcms.cms', 'Pages'), 'url' => ['page/index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="content-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
    'model' => $model,
    'structure' => $structure,
    ])
    ?>

</div>
