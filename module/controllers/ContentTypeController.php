<?php

namespace abcms\cms\module\controllers;

use Yii;
use abcms\cms\models\ContentType;
use abcms\cms\module\models\ContentTypeSearch;
use abcms\library\base\AdminController;
use yii\web\NotFoundHttpException;
use abcms\structure\models\Structure;
use abcms\structure\module\models\FieldSearch;

/**
 * ContentTypeController implements the CRUD actions for ContentType model.
 */
class ContentTypeController extends AdminController
{

    /**
     * Lists all ContentType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContentTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContentType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchModel = new FieldSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model->structureId);
        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ContentType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContentType();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $structure = new Structure(['name' => $mode->generateStructureName()]);
            if($structure->save(false)){
                $model->structureId = $structure->id;
                if($model->save(false)){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing ContentType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->isAttributeChanged('name')){
                $structure = $model->structure;
                $structure->name = $model->generateStructureName();
                $structure->save(false);
            }
            if($model->save(false)){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ContentType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
