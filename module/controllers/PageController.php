<?php

namespace abcms\cms\module\controllers;

use Yii;
use abcms\cms\models\ContentType;
use abcms\library\base\AdminController;
use yii\web\NotFoundHttpException;

/**
 * PageController implements listing and update actions for content with type 'page'.
 */
class PageController extends AdminController
{

    /**
     * Lists all ContentType models with type equal to 'page'.
     * @return mixed
     */
    public function actionIndex()
    {
        $models = ContentType::find()
                ->andWhere(['typeId' => ContentType::TYPE_PAGE])
                ->orderBy(['name' => SORT_ASC])
                ->all();

        return $this->render('index', [
                    'models' => $models,
        ]);
    }

    /**
     * Updates an existing ContentType model.
     * If update is successful, the browser will be refresh the page
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $structure = $model->structure;
        $structure->fillFieldsValues($model->returnModelId(), $model->id);
        $dynamicModel = $structure->getDynamicModel();
        
        $structureTranslation = $structure->getStructureTranslation($model);
        $structureTranslationModel = $structureTranslation->getTranslationModel();

        $post = Yii::$app->request->post();
        if ($dynamicModel->load($post) && $structureTranslationModel->load($post) && $dynamicModel->validate() && $structureTranslationModel->validate()) {
            $model->saveStructureData($structure->id, $dynamicModel->attributes);
            $structureTranslation->saveTranslationData($structureTranslationModel->attributes);
            Yii::$app->session->setFlash('success', 'Data saved successfully.');
            return $this->refresh();
        }
        return $this->render('update', [
                    'model' => $model,
                    'structure' => $structure,
                    'structureTranslation' => $structureTranslation,
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
        if (($model = ContentType::findOne(['id' => $id, 'typeId' => ContentType::TYPE_PAGE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('acbms.cms', 'The requested page does not exist.'));
    }

}
