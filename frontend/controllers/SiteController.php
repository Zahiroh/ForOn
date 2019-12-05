<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Item;
use frontend\models\Category;
use frontend\models\CategorySearch;
use frontend\models\Customer;
use frontend\models\Order;
use frontend\models\OrderItem;
use frontend\models\Posting;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {   
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = (new yii\db\Query);

        $query1 = (new yii\db\Query)->select(['count(love) as love','idPosting'])->from('setlike')->groupBy('idPosting')->where('love <> 0');

        $query2 = (new yii\db\Query)->select(['count(dislike) as dislike','idPosting'])->from('setlike')->groupBy('idPosting')->where('dislike <> 0');

        $dataProvider2 = new ActiveDataProvider([
            'models' => $query->select(['user.id as idUser','user.fullname as fullname','user.fotoUser as fotoUser','posting.id as id','posting.title','mainPost','datePosted','filePosting','u.love as love','q.dislike as dislike'])
            ->from(['posting'])
            ->leftjoin('user', 'user.id = posting.idUser')
            ->leftjoin(['u' => $query1], 'u.idPosting = posting.id')
            ->leftjoin(['q' => $query2], 'q.idPosting = posting.id')
            ->orderBy('love DESC')
            ->all(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'notif' => $this->getModelNotif(),
        ]);
    }

    public function actionCategory($id)
    {
        $models = ItemCategory::find()->all();
        $items = Item::find()->where(['category_id'=>$id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $items,
            'pagination' => [
                'pagesize'=>6,
            ],
        ]);
        $this->layout = 'IndexLayout';
        return $this->render('index',[
            'dataProvider'=>$dataProvider,
            'models'=>$models,
            'notif' => $this->getModelNotif(),
        ]);
    }

    public function actionInput($id)
    {
        if(!isset($_SESSION['keranjang'])){
            $_SESSION['keranjang']= array();
            $_SESSION['keranjang'][]=$id;
        }else{
            if(!in_array($id,$_SESSION['keranjang'])){
                $_SESSION['keranjang'][]=$id;
            }
        }
        $dataProvider = $this->coba();
        $this->layout =  'IndexLayout';
        return $this->render('keranjang',[
            'dataProvider'=>$dataProvider
        ]);
    }
    public function coba()
    {
        $items = Item::find()->where(['id'=>$_SESSION['keranjang']]);
        $dataProvider = new ActiveDataProvider([
                'query' => $items,
                'pagination' => [
                    'pagesize'=>3,
                ],
            ]);
        return $dataProvider;
        
    }
    public function actionOrder()
    {
        $model = new Order();
        
        $model->date=date('Y-m-d H:i:s');
        $customer = Customer::findOne(['user_id'=>Yii::$app->user->getId()]);
        $model->customer_id= $customer->id;
        $model->save();
        
        foreach($_SESSION['keranjang'] as $itemId){
            $model1 = new OrderItem();
            $model1->order_id = $model->id;
            $model1->item_id = $itemId;
            $model1->save();
        }
        unset($_SESSION['keranjang']);
        $_SESSION['msg'] = "Order anda berhasil dilakukan.";
        $this->layout =  'IndexLayout';
        return $this->goHome();
    }
    public function actionKeranjang()
    {
        $this->layout =  'IndexLayout';
        if(isset($_SESSION['keranjang'])){
            $dataProvider = $this->coba();
            $this->layout =  'IndexLayout';
            return $this->render('keranjang',[
                'dataProvider'=>$dataProvider
            ]);
        }else{
            return $this->render('keranjang');
        }
        
        
    }   
    public function actionRemove($id)
    {
        unset($_SESSION['keranjang'][$id]);
        
        $dataProvider = $this->coba();
        $this->layout =  'IndexLayout';
        return $this->render('keranjang',[
            'dataProvider'=>$dataProvider,
            'notif' => $this->getModelNotif(),
        ]);
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
                
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
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
        $download = Posting::findOne($id);
        $path = Yii::getAlias('../web/download/') . $download->filePosting;

        if(file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }
    }
}
