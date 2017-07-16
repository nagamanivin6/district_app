<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\rest\Controller;
use backend\models\District;
use backend\models\Mandal;
use backend\models\Village;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use frontend\models\Customer;
use frontend\models\LoginForm;
use backend\models\Issue;
use backend\models\Complaints;
use yii\web\Response;
/**
 * Site controller
 */
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['raise-complaint','user-details'],
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['raise-complaint','user-details'],
            'rules' => [
                [
                    'actions' => ['raise-complaint','user-details'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
        //return [];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            
        ];
    }

    public function actionDistricts(){
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $districts = ArrayHelper::map(District::find()->all(), 'dist_id', 'dist_name');
        $response->data = $districts;
        return $response;
    }
    public function actionMandals(){
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $mandals = ArrayHelper::map(Mandal::find()->where(['dist_id'=>7])->all(), 'mandal_id', 'mandal_name');
        $response->data = $mandals;
        return $response;
    }
    public function actionVillages($mandal){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $villages = ArrayHelper::map(Village::find()->where(['mandal_id'=>$mandal])->all(), 'village_id', 'village_name');
        $response->data = $villages;
        return $response;
    }

    public function actionIssuesList(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $issues = ArrayHelper::map(Issue::find()->where(['issue_status'=>1])->all(), 'issue_id', 'issue_desc');
        $response->data = $issues;
        return $response;
    }
    
    public function actionRaiseComplaint(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $v =file_get_contents('php://input');
        $post_data = json_decode($v);
        $complaint = new Complaints;
        $complaint->comp_desc = $post_data->description;
        $complaint->issue_id = $post_data->issue;
        $complaint->mandal_id = $post_data->mandal;
        $complaint->village_id = $post_data->village;
        $complaint->status = 1;
        $complaint->user_regid = Yii::$app->user->identity->user_id;
        $complaint->created_date =  new \yii\db\Expression('NOW()');
        if($complaint->save()){
            $response->data = ['type'=>'success'];
        }
        else {
            $complaint->validate();
            $response->data = ['type'=>'error','data'=>$complaint->errors];
        }
        return $response;
    }
    public function actionUserDetails(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = Yii::$app->user->identity;
        return $response;
    }
    public function actionRegister(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $v =file_get_contents('php://input');
        $post_data = json_decode($v);
        $customer = new Customer;
        $customer->user_name = $post_data->user_name;
        $customer->user_mother = $post_data->user_mother;
        $customer->user_father = $post_data->user_father;
        $customer->user_uid = $post_data->user_uid;
        $customer->user_gender = $post_data->user_gender;
        $customer->user_dob = $post_data->user_dob;
        $customer->user_email = $post_data->user_email;
        $customer->user_phone = $post_data->user_phone;
        $customer->user_hno = $post_data->user_hno;
        $customer->user_area = $post_data->user_area;
        $customer->user_dist = (isset($post_data->user_dist)) ? $post_data->user_dist : '';
        $customer->user_village = $post_data->user_village;
        $customer->user_mandal = $post_data->user_mandal;
        $customer->user_pin = $post_data->user_pin;
        $customer->user_password = $post_data->user_password;
        $customer->user_state = 'Telangana';
        $customer->user_status =1;
        if ($customer->validate()) {
            $customer->setPassword($customer->user_password);
            $customer->generateAuthKey();
            if($customer->save())
                $response->data =['type'=>'success'];
            else 
                $response->data =['type'=>'save-error'];
        } else {
            // validation failed: $errors is an array containing error messages
            $errors = $customer->errors;
            $response->data = ['type'=>'error','errors' => $errors];
        }
        return $response;
    }
    public function actionLogin(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        
        $v =file_get_contents('php://input');
        $post_data = json_decode($v);
        $customer = new LoginForm();
        $customer->username = $post_data->username;
        $customer->password = $post_data->password;
        if($customer->login()){
            $response->data =['type'=>'success','access_token' => Yii::$app->user->identity->getAuthKey()];
        }
        else {
            $customer->validate();
            $response->data =['type'=>'error','errors' => $customer->errors];
        }
    }
}
