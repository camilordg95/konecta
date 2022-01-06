<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Producto;
use app\models\Venta;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actionSaluda(){
        return $this->render("saludahola");
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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
                    'logout' => ['post'],
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
     * @return string
     */
    public function actionIndex()
    {
        $modelprod = Producto::find()->all();
        return $this->render('index',['modelprod' => $modelprod]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionListadoproducto()
    {   
        $msj="";
        $model = new Producto();
        if ($model->load(Yii::$app->request->post())) {
            $model->fecha_creación=date('Ymd');
            if($model->validate()){
                if ($model->save ()){
                    $model=new Producto();
                    $msj="<label style='color:green'>se creo producto</label>";
                }else{
                    $alert=$model->getErrors();
                    foreach($alert as $error => $value ){
                        foreach ($value as $key) {
                            $error=$key."<br>";
                        }
                    }
                    $msj="<label style='color:red'>Corrija los errores: ".$error."</label>";
                }   
            }else{
                $alert=$model->getErrors();
                foreach($alert as $error => $value ){
                    foreach ($value as $key) {
                        $error=$key."<br>";
                    }
                }
                $msj="<label style='color:red'>Corrija los errores: ".$error."</label>";
            }
        }
        $modelprod = $model->find()->all();
        return $this->render('Crearproducto',['model' => $model,'modelprod'=>$modelprod,"msj"=>$msj]);
    }
    public function actionEditarproducto()
    {
        $msj="";
        $id=$_GET['id'];
        $model = Producto::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                if ($model->update ()){
                    $model = Producto::findOne($id);
                    $msj="<label style='color:green'>se ha actualizado</label>";
                }else{
                    $msj="<label style='color:red'>Corrija los errores</label>";
                }
            }else{
                $model->getErrors();
                $msj="<label style='color:red'>Corrija los errores</label>";
            }
        }
        return $this->render('editarproducto',['model' => $model,"msj"=>$msj]);
    }
    public function actionEliminarproducto()
    {
        $msj="";
        $id=$_GET['id'];
        $model = new Producto();
        $modelprod = Producto::findOne($id);
        if($modelprod){
            if($modelprod->delete()){
                $msj="<label style='color:green'>se ha eliminado registro</label>";
            }else{
                $msj="<label style='color:red'>Corrija los errores</label>";
            }
        }   
        $modelprod = $model->find()->all();
        return $this->render('Crearproducto',['model' => $model,'modelprod'=>$modelprod,"msj"=>$msj]);
    }
    public function actionVentas(){
        $msj="";
        $model = new Venta();
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                $modelprod = Producto::findOne($model->id_producto);
                if($modelprod){
                    $restante_stock=$modelprod->stock - $model->cantidad;
                    if($modelprod->stock > 0 && $restante_stock > 0){
                        $modelprod->stock=$restante_stock;
                        if($modelprod->update()){
                            if($model->save()){
                                $model = new Venta();
                                $msj="<label style='color:green'>se genero venta</label>";
                            }else{
                                $alert=$model->getErrors();
                                foreach($alert as $error => $value ){
                                    foreach ($value as $key) {
                                        $error=$key."<br>";
                                    }
                                }
                                $msj="<label style='color:red'>Corrija los errores: ".$error."</label>";
                            }
                        }
                    }else{
                        $msj="<label style='color:red'>no hay stock suficiente del producto ".$model->id_producto.", cantidad actual: ".$modelprod->stock."</label>";   
                    }
                }
            }else{
                $alert=$model->getErrors();
                foreach($alert as $error => $value ){
                    foreach ($value as $key) {
                        $error=$key."<br>";
                    }
                }
                $msj="<label style='color:red'>Corrija los errores: ".$error."</label>";
            }
        }
        return $this->render('ventas',['model' => $model,"msj"=>$msj]);
    }
}
