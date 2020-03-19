<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model abcms\cms\models\ContentType */

$this->title = Yii::t('abcms.cms', 'Create Content Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('abcms.cms', 'Content Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
