<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Posting;
use frontend\models\PostingSearch;
use frontend\models\User;
use frontend\models\UserSearch;
use frontend\models\Setlike;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Category;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

/**
 * PostingController implements the CRUD actions for Posting model.
 */
class PostingController extends Controller
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
     * Lists all Posting models.
     * @return mixed
     */
    public function actionIndex($idCategory)
    {
        $query = (new yii\db\Query);

        $query1 = (new yii\db\Query)->select(['count(love) as love','idPosting'])->from('setlike')->groupBy('idPosting')->where('love <> 0');

        $query2 = (new yii\db\Query)->select(['count(dislike) as dislike','idPosting'])->from('setlike')->groupBy('idPosting')->where('dislike <> 0');

        $dataProvider = new ActiveDataProvider([
            'models' => $query->select(['user.id as idUser','user.fullname as fullname','user.fotoUser as fotoUser','posting.id as id','posting.title','mainPost','datePosted','filePosting','u.love as love','q.dislike as dislike'])
            ->from(['posting'])
            ->leftjoin('user', 'user.id = posting.idUser')
            ->leftjoin(['u' => $query1], 'u.idPosting = posting.id')
            ->leftjoin(['q' => $query2], 'q.idPosting = posting.id')
            ->where(['posting.idCategory'=>$idCategory])
            ->orderBy('datePosted DESC')
            ->all(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $model = new Posting();

        $category = Category::find()->all();
        $category = ArrayHelper::map($category, 'id', 'categoryName');

        $model->ratingPosting = 0;
        $model->likePosting = 0;
        $model->dislikePosting = 0;
        $model->datePosted = date('Y-m-d h:m:s');
        $model->idUser = Yii::$app->user->getID();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->filePosting = UploadedFile::getInstance($model, 'filePosting');
            $filePosting = 'file_'.$model->filePosting; //.'.'.$model->filePosting->getExtension();
            $model->filePosting ->saveAs(Yii::getAlias('@filePath').'/'.$filePosting);
            $model->filePosting  = $filePosting;
            $model->save();
            return $this->redirect(['comments/index', 'idPost' => $model->id]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'category' => $category,
            'notif' => $this->getModelNotif(),
        ]);
    }

    /** menampilkan data user yang berelasi */
    public function getUser() 
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }

    /**
     * Displays a single Posting model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView($id)
    {
        $query = (new yii\db\Query);
        
        $dataProvider = new ActiveDataProvider([
            'models' => $query->from(['comments'])
            ->leftjoin('posting', 'posting.id = comments.idPosting')
            ->leftjoin('user', 'user.id = comments.idUser')
            ->where(['comments.idPosting'=>$id])
            ->all(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'notif' => $this->getModelNotif(),
        ]);
    }

    /**
     * Creates a new Posting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Posting();

        $category = Category::find()->all();
        $category = ArrayHelper::map($category, 'id', 'categoryName');

        $model->ratingPosting = 0;
        $model->likePosting = 0;
        $model->dislikePosting = 0;
        $model->datePosted = date('Y-m-d h:m:s');
        $model->idUser = Yii::$app->user->getID();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->filePosting = UploadedFile::getInstance($model, 'filePosting');
            $filePosting = 'file_'.$model->filePosting;
            $model->filePosting ->saveAs(Yii::getAlias('@filePath').'/'.$filePosting);
            $model->filePosting  = $filePosting;
            $model->save();
            return $this->redirect(['comments/index', 'idPost' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'category' => $category,
            'notif' => $this->getModelNotif(),
        ]);
    }

    /**
     * Updates an existing Posting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $category = Category::find()->all();
        $category = ArrayHelper::map($category, 'id', 'categoryName');

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->filePosting = UploadedFile::getInstance($model, 'filePosting');
            $filePosting = 'file_'.$model->filePosting;
            $model->filePosting ->saveAs(Yii::getAlias('@filePath').'/'.$filePosting);
            $model->filePosting  = $filePosting;
            $model->save();
            return $this->redirect(['comments/index', 'idPost' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'category' => $category,
            'notif' => $this->getModelNotif(),
        ]);
    }

    /**
     * Deletes an existing Posting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $idCategory = $this->findModel($id)->idCategory;

        $this->findModel($id)->delete();

        return $this->redirect(['index', 'idCategory' => $idCategory,'notif' => $this->getModelNotif(),]);
    }

    /**
     * Finds the Posting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel1($idUser)
    {
        $query = (new yii\db\Query);

        $dataProvider = new ActiveDataProvider([
            'models' => $query->select(['setlike.id as id'])
            ->from(['setlike'])
            ->leftjoin('user', 'user.id = setlike.idUser')
            
            ->where(['setlike.idUser'=>$idUser])
            ->all(),
        ]);

        $model = ($dataProvider->getModels());
        
        if (($model != null)) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLike($id) 
    {
        $modelPosting = Posting::find()->all();
        //$modelSetlike = Setlike::find()->all();
        
        if(!Yii::$app->user->isGuest) {
            //$model2 = $this->findModel1(Yii::$app->user->getID());
            //$model = Setlike::findOne($model2['id']);

            $model = Setlike::find()->where([
                'idUser' => Yii::$app->user->getID(),
            ])->one();

            //$model = $model2->getModels();

            if($model == null){
                $model = new Setlike();
            }
            $idPosting = $this->findModel($id)->id;
            
            $model->rating = 0;
            $model->love = 1;
            $model->dislike = 0;
            $model->idPosting = $id;
            $model->idUser = Yii::$app->user->getID();
            
            $model->save();

            return $this->redirect(['comments/index', 'idPost' => $model->idPosting,
            'model' => $model,
            'notif' => $this->getModelNotif(),
            ]);
        } else {
            return $this->redirect(['site/login','notif' => $this->getModelNotif(),]);
        }
    }

    public function actionDislike($id) 
    {
        
        
        if(!Yii::$app->user->isGuest) {
            $model = Setlike::find()->where([
            'idUser' => Yii::$app->user->getID(),
            ])->one();

            //$model = $model2->getModels();

            if($model == null){
                $model = new Setlike();
            }

            $model['rating'] = 0;
            $model['love'] = 0;
            $model['dislike'] = 1;
            $model['idPosting'] = $id;
            $model['idUser'] = Yii::$app->user->getID();
            /*
            if ($model->load(Yii::$app->request->post())) {
                $model->save();
                return $this->redirect(['comments/index', 'idPost' => $model->id]);
            }
            */
            $model->save();
            return $this->redirect(['comments/index', 'idPost' => $model->idPosting, 'model' => $model,
            'notif' => $this->getModelNotif(),
            ]);
        } else {
            return $this->redirect(['site/login']);
        }
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
        $data = $this->findModel($id);
        header('Content-Type:'.pathinfo(Yii::getAlias('@filePath').'/'.$data->filePosting, PATHINFO_EXTENSION));
        header('Content-Disposition: attachment; filePosting='.$data->filePosting);
        return readfile(Yii::getAlias('@filePath').'/'.$data->filePosting);
    }
}   
