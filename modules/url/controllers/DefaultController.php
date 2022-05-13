<?php

namespace app\modules\url\controllers;

use app\modules\url\models\UrlShortener;
use app\modules\url\models\UrlShortenerLog;
use app\modules\url\models\UrlShortenerLogSearch;
use app\modules\url\models\UrlShortenerSearch;
use WhichBrowser\Parser;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * DefaultController implements the CRUD actions for UrlShortener model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all UrlShortener models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UrlShortenerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UrlShortener model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $searchModelLog = new UrlShortenerLogSearch();
        $dataProviderLog = $searchModelLog->search($this->request->queryParams);
        return $this->render('view', [
            'model' => $model,
            'searchModelLog' => $searchModelLog,
            'dataProviderLog' => $dataProviderLog,
        ]);
    }

    /**
     * Finds the UrlShortener model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UrlShortener the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UrlShortener::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new UrlShortener model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UrlShortener();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UrlShortener model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UrlShortener model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGet($short_url)
    {
        $url_short = UrlShortener::findOne(['short_url' => $short_url]);
        if (empty($url_short))
            throw new NotFoundHttpException('The requested page does not exist.');

        $user_agent = new Parser(Yii::$app->request->getUserAgent());
        $user_agent = $user_agent->toArray();

        $url_short_log = new UrlShortenerLog();
        $url_short_log->user_agent = Yii::$app->request->getUserAgent();
        $url_short_log->ip = Yii::$app->request->getUserIP();
        $url_short_log->browser = $user_agent['browser']['name'];
        $url_short_log->os = $user_agent['os']['name'];
        $url_short_log->device = $user_agent['device']['type'];
        $url_short_log->engine = $user_agent['engine']['name'];
        $url_short_log->url_shortener_id = $url_short->id;

        if (!$url_short_log->save())
            throw new NotFoundHttpException('The requested page does not exist.');


        return $this->redirect($url_short->url);
    }
}
