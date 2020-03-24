<?php

namespace abcms\cms\module\controllers;

use Yii;
use abcms\cms\models\ContentType;
use abcms\library\base\AdminController;

/**
 * ListController displays all content with type 'list'
 */
class ListController extends AdminController
{

    /**
     * Lists all ContentType models with type equal to 'list'.
     * @return mixed
     */
    public function actionIndex()
    {
        $models = ContentType::find()
                ->andWhere(['typeId' => ContentType::TYPE_LIST])
                ->orderBy(['name' => SORT_ASC])
                ->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }
}
