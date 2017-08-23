<?php

namespace backend\controllers;

use Yii;
use backend\models\LeaveTrans;
use backend\models\LeaveTransSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\GlobalFunctions;
use backend\components\LeaveStatus;
use backend\models\Leave;
use yii\filters\AccessControl;
use backend\components\BaseGlobalController;

/**
 * LeaveTransController implements the CRUD actions for LeaveTrans model.
 */
class LeaveTransController extends BaseGlobalController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create','update','delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create','update','delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all LeaveTrans models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeaveTransSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LeaveTrans model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LeaveTrans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LeaveTrans();
        $leaveUserDetails = GlobalFunctions::GetEmployeeDetails(Yii::$app->user->id);
        $model->emp_id = $leaveUserDetails->id;
        if ($model->load(Yii::$app->request->post()) ) {
            $model->leave_status = 1;//Applied Database Value
            $model->leave_updated_by = Yii::$app->user->id;
            $model->leave_updated_time = new \yii\db\Expression('NOW()');
            if($model->save()){
                $this->updateLeaves(Yii::$app->user->id,$model);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else 
                return $this->render('create', [
                    'model' => $model,'leaveUserDetails'=>$leaveUserDetails
                ]);
        } else {
            return $this->render('create', [
                'model' => $model,'leaveUserDetails'=>$leaveUserDetails
            ]);
        }
    }

    /**
     * Updates an existing LeaveTrans model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $leaveUserDetails = GlobalFunctions::GetEmployeeDetails($model->emp_id);
        if ($model->load(Yii::$app->request->post())) {
            $model->leave_updated_by = Yii::$app->user->id;
            $model->leave_updated_time = new \yii\db\Expression('NOW()');
            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
            else 
                return $this->render('update', [
                    'model' => $model,'leaveUserDetails'=>$leaveUserDetails
                ]);
        } else {
            return $this->render('update', [
                'model' => $model,'leaveUserDetails'=>$leaveUserDetails
            ]);
        }
    }
    public function updateLeaves($emp_id,$model){
        $updateLeaveTable = Leave::find()->where(['emp_id'=>$emp_id,'leave_category'=>$model->leave_category])->one();
        $updateLeaveTable->used_leaves = $updateLeaveTable->used_leaves + $model->leave_days;
        $updateLeaveTable->balanced_leaves = $updateLeaveTable->total_leaves - $updateLeaveTable->used_leaves;
        $updateLeaveTable->save(false);
    }
    /**
     * Deletes an existing LeaveTrans model.
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
     * Finds the LeaveTrans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LeaveTrans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LeaveTrans::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}