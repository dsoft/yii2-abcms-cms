<?php

namespace abcms\cms\module\controllers;

use Yii;
use abcms\cms\models\ContentItem;
use abcms\cms\module\models\ContentItemSearch;
use abcms\library\base\AdminController;
use yii\web\NotFoundHttpException;
use abcms\cms\models\ContentType;

/**
 * ItemController implements the CRUD actions for ContentItem model.
 */
class ItemController extends AdminController
{

    /**
     * Activate/Deactivate an existing model.
     * If action is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionActivate($id)
    {
        $model = $this->findModel($id);
        $model->activate()->save(false);

        return $this->redirect(['index', 'contentTypeId' => $model->contentTypeId]);
    }

    /**
     * Lists all ContentItem models.
     * @param integer $contentTypeId
     * @return mixed
     */
    public function actionIndex($contentTypeId)
    {
        $model = $this->findContentTypeModel($contentTypeId);
        $searchModel = new ContentItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model->id);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single ContentItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $contentType = $this->findContentTypeModel($model->contentTypeId);
        $structure = $contentType->structure;
        return $this->render('view', [
                    'model' => $model,
                    'contentType' => $contentType,
                    'structure' => $structure,
        ]);
    }

    /**
     * Creates a new ContentItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($contentTypeId)
    {
        $contentType = $this->findContentTypeModel($contentTypeId);
        $model = new ContentItem();
        $model->loadDefaultValues();
        
        $structure = $contentType->structure;
        $structureTranslation = $structure->getStructureTranslation($model);
        $model->enableAutoStructuresSaving($structure, $structureTranslation);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->contentTypeId = $contentType->id;
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
                    'model' => $model,
                    'contentType' => $contentType,
                    'structure' => $structure,
                    'structureTranslation' => $structureTranslation,
        ]);
    }

    /**
     * Updates an existing ContentItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $contentType = $this->findContentTypeModel($model->contentTypeId);
        
        $structure = $contentType->structure;
        $structure->fillFieldsValues($model->returnModelId(), $model->id);
        $structureTranslation = $structure->getStructureTranslation($model);
        $model->enableAutoStructuresSaving($structure, $structureTranslation);
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'contentType' => $contentType,
                    'structure' => $structure,
                    'structureTranslation' => $structureTranslation,
        ]);
    }

    /**
     * Deletes an existing ContentItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $contentTypeId = $model->contentTypeId;
        $model->delete();

        return $this->redirect(['index', 'contentTypeId' => $contentTypeId]);
    }

    /**
     * Finds the ContentType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findContentTypeModel($id)
    {
        if (($model = ContentType::findOne(['id' => $id, 'typeId' => ContentType::TYPE_LIST])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('acbms.cms', 'The requested page does not exist.'));
    }

    /**
     * Finds the ContentItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
