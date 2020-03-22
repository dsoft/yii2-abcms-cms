<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $models abcms\cms\models\ContentType[] */

$this->title = Yii::t('acbms.cms', 'Lists');
$this->params['breadcrumbs'][] = $this->title;

$css = <<<EOT
        h1{
            margin-bottom: 30px;
        }
        .list-item{
            border: solid 1px gray;
            text-align:center;
            display:block;
            padding: 20px 8px;
            font-size: 25px;
            color: black;
            text-decoration: none;
            margin-bottom: 15px;
            word-wrap: break-word;
            line-height: 1.1;
        }
        .list-item:hover{
            text-decoration: none;
        }
        .list-item span{
            font-size: 40px;
            display:block;
            margin-bottom: 15px;
        }
EOT;
$this->registerCss($css);
?>
<div class="content-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php foreach($models as $model): ?>
        <div class="col-xs-6 col-sm-3 col-md-3">
            <a class="list-item" href="<?= Url::to(['item/index', 'contentTypeId' => $model->id]) ?>">
                <?= $model->getIconHtml() ?>
                <?= $model->getPluralName() ?>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
