<?php

use yii\helpers\Html;
use yii\helpers\Url;
use abcms\cms\assets\CmsAsset;

/* @var $this yii\web\View */
/* @var $models abcms\cms\models\ContentType[] */

CmsAsset::register($this);

$this->title = Yii::t('acbms.cms', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-type-index">

    <h1 class="list-header"><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php foreach($models as $model): ?>
        <div class="col-xs-6 col-sm-3 col-md-3">
            <a class="list-item" href="<?= Url::to(['page/update', 'id' => $model->id]) ?>">
                <?= $model->getIconHtml() ?>
                <?= $model->name ?>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
