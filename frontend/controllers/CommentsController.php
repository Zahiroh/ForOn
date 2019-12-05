<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Comments;
use frontend\models\CommentsSearch;
use frontend\models\Posting;
use frontend\models\PostingSearch;
use frontend\models\SetLikeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;

/**
 * CommentsController implements the CRUD actions for Comments model.
 */
class CommentsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comments models.
     * @return mixed
     */
    public function actionIndex($idPost)
    {
        $query = (new yii\db\Query);
        $dataProvider = new ActiveDataProvider([
            'models' => $query->select(['user.id as idUser','user.fullname as fullname','user.fotoUser as fotoUser','comments.id as id','mainComment as mainComment','commentPosted as commentPosted'])
            ->from(['comments'])
            ->leftjoin('posting', 'posting.id = comments.idPosting')
            ->leftjoin('user', 'user.id = comments.idUser')
            ->where(['comments.idPosting'=>$idPost])
            ->orderBy('commentPosted DESC')
            ->all(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $query3 = (new yii\db\Query);

        $query1 = (new yii\db\Query)->select(['count(love) as love','idPosting'])->from('setlike')->groupBy('idPosting')->where('love <> 0');

        $query2 = (new yii\db\Query)->select(['count(dislike) as dislike','idPosting'])->from('setlike')->groupBy('idPosting')->where('dislike <> 0');

        $dataProvider2 = new ActiveDataProvider([
            'models' => $query3->select(['user.id as idUser','user.fullname as fullname','user.fotoUser as fotoUser','posting.id as id','u.love as love','q.dislike as dislike','posting.title as title','posting.mainPost as mainPost','posting.datePosted as datePosted','posting.filePosting as filePosting'])
            ->from(['posting'])
            ->leftjoin('user', 'user.id = posting.idUser')
            ->leftjoin(['u' => $query1], 'u.idPosting = posting.id')
            ->leftjoin(['q' => $query2], 'q.idPosting = posting.id')
            ->where(['posting.id'=>$idPost])
            ->orderBy('datePosted DESC')
            ->all(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $model = new Comments();

        $model->commentPosted = date('Y-m-d h:m:s');
        $model->idUser = Yii::$app->user->getID();
        $model->idPosting = $idPost;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'idPost' => $idPost]);
        }

        $dataProvider3 = SetLikeSearch::find()->all();
        //$dataProvider3 = $searchModel->search(Yii::$app->request->queryParams);

        //notif
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'dataProvider3' => $dataProvider3,
            'notif' => $this->getModelNotif(),
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Comments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $query2 = new yii\db\Query;
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query2->from('user')->all(),
            'sort' => [
                'attributes' => ['idUser','datePosted','title','mainPost']
            ],
        ]);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id),
            'notif' => $this->getModelNotif(),
        ]);
    }

    /**
     * Creates a new Comments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idPost)
    {
        $model = new Comments();

        $postId = $idPost;

        $model->commentPosted = date('Y-m-d h:m:s');
        $model->idUser = Yii::$app->user->getID();
        $model->idPosting = $idPost;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'idPost' => $idPost]);
        }

        return $this->render('create', [
            'model' => $model,
            'notif' => $this->getModelNotif(),
        ]);
    }

    /**
     * Updates an existing Comments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $idPosting = $this->findModel($id)->idPosting;

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'idPost' => $idPosting]);
        }

        return $this->render('update', [
            'model' => $model,
            'notif' => $this->getModelNotif(),
        ]);
    }

    /**
     * Deletes an existing Comments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $idPosting = $this->findModel($id)->idPosting;

        $this->findModel($id)->delete();

        return $this->redirect(['index', 'idPost' => $idPosting, 'notif' => $this->getModelNotif(),]);
    }

    /**
     * Finds the Comments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getModelNotif(){
        $query2 = (new yii\db\Query);
        
        $subQuery = (new yii\db\Query)->select(['id as idPost'])->from('posting')->where(['idUser'=>Yii::$app->user->getId()])->column();
        
        $dataProvider3 = new ActiveDataProvider([
            'models' => $query2
                ->select(['u.fullname as fullname','s.love as love','s.dislike as dislike','u.fotoUser as fotoUser','s.id idPosting'])
                ->from(['setlike s'])
                
                ->leftjoin(['user u'], 'u.id=s.idUser')
                ->where(['s.idPosting'=>$subQuery])
                ->orderBy(['s.id'=>SORT_DESC])
                ->limit(5)
                ->all(),
        ]);
        return $dataProvider3;
    }

    public function actionDownload($id)
    {
        $data = Posting::findOne($id);
        header('Content-Type:'.pathinfo(Yii::getAlias('@web').'/'.$data->filePosting, PATHINFO_EXTENSION));
        header('Content-Disposition: attachment; filePosting="'.$data->filePosting.'"');
        return readfile(Yii::getAlias('@web').'/'.$data->filePosting);
    }
}
