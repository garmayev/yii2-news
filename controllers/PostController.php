<?php

namespace garmayev\news\controllers;

use garmayev\news\models\Post;
use garmayev\news\models\search\PostSearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends DefaultController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [];
    }

	public function beforeAction($action)
	{
//		var_dump($action); die;
		if ( $action->id == "create" ) {
			$this->enableCsrfValidation = false;
		}
		return parent::beforeAction($action);
	}

	/**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        return $this->render('view', [
            'model' => $this->findModel(["slug" => $slug]),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        if (Yii::$app->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
				return $this->redirect(["post/index"]);
            } else {
				Yii::error($model->getErrorSummary(true));
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $model = $this->findModel(["slug" => $slug]);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['post/index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param mixed $mixed
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($mixed)
    {
        if (($model = Post::findOne($mixed)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('news', 'The requested page does not exist.'));
    }
}
