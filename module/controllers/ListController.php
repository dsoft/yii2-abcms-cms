<?php

namespace abcms\cms\module\controllers;

use Yii;
use abcms\cms\models\ContentType;
use abcms\library\base\AdminController;
use yii\web\NotFoundHttpException;

/**
 * ListController implements the CRUD actions for ContentType model.
 */
class ListController extends AdminController
{

    /**
     * Lists all ContentType models.
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

    /**
     * Finds the ContentType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('acbms.cms', 'The requested page does not exist.'));
    }
}
