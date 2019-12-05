<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\User2;
use frontend\models\UserSearch;
use frontend\models\Posting;
use frontend\models\Comments;
use frontend\models\Roleuser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $query = new Query();
        $user = Yii::$app->user->getID();

        $subQuery1 = (new Query())->select(['count(*) as jumlah','idUser'])->from('posting')->groupBy('idUser');
        $subQuery2 = (new Query())->select(['count(*) as jumlah','idUser'])->from('comments')->groupBy('idUser');

        $row = $query->select(['u.id as idUser','u.fullname as fullname','u.fotoUser as fotoUser','r.roleName as roleName','p.jumlah as posting','k.jumlah as komentar'])
        ->from([ 'user u'])
        ->leftjoin(['p'=>$subQuery1], 'u.id=p.idUser')
        ->leftjoin(['k'=>$subQuery2], 'k.idUser=u.id')
        ->leftjoin(['roleuser r'], 'u.rolesId=r.id')
        ->all();
        
        
        //notif
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
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProvider3' => $dataProvider3,
            'row' => $row,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $query = (new yii\db\Query);

        $query1 = (new yii\db\Query)->select(['count(love) as love','idPosting'])->from('setlike')->groupBy('idPosting')->where('love <> 0');

        $query2 = (new yii\db\Query)->select(['count(dislike) as dislike','idPosting'])->from('setlike')->groupBy('idPosting')->where('dislike <> 0');

        $row = new ActiveDataProvider([
            'models' => $query->select(['user.id as idUser','user.fullname as fullname','user.fotoUser as fotoUser','posting.id as id','posting.title','mainPost','datePosted','filePosting','u.love as love','q.dislike as dislike'])
            ->from(['posting'])
            ->leftjoin('user', 'user.id = posting.idUser')
            ->leftjoin(['u' => $query1], 'u.idPosting = posting.id')
            ->leftjoin(['q' => $query2], 'q.idPosting = posting.id')
            ->where(['posting.idUser'=>$id])
            ->orderBy('datePosted DESC')
            ->all(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        
        //notif
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
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider3' => $dataProvider3,
            'row' => $row,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        //notif
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
        
        return $this->render('create', [
            'model' => $model,
            'dataProvider3' => $dataProvider3,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->fotoUser = UploadedFile::getInstance($model, 'fotoUser');
            $fotoUser = 'foto_'.$model->id.'.'.$model->fotoUser->getExtension();
            $model->fotoUser ->saveAs(Yii::getAlias('@filePath').'/avatar/'.$fotoUser);
            $model->fotoUser  = $fotoUser;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        //notif
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
        
        return $this->render('update', [
            'model' => $model,
            'dataProvider3' => $dataProvider3,
        ]);
    }

    public function actionUpdatepassword($id){
        
        /*$model = array([
            'password' => 0,
            'newpassword' => 0,
            'konfirmasipassword' => 0
        ]);*/
        //$model = new User2();
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post() ) ) {
            /*if (Yii::$app->getSecurity()->validatePassword($model->password, $model2->password_hash)) {
                if($model->newpassword==$model->konfirmasipassword){
                    $hash = Yii::$app->getSecurity()->generatePasswordHash($model->newpassword);
                    $model2->password_hash = $hash;
                    $model2->save();
                }
            } */
            $hash = Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);
            $model->password_hash = $hash;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        //notif
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
        
        return $this->render('updatePassword', [
            'model' => $model,
            'dataProvider3' => $dataProvider3,
        ]);
    }
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
