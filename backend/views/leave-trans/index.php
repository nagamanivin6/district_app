<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\components\GlobalFunctions;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LeaveTransSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Leave Data');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-trans-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Apply Leave'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
            'attribute' => 'emp_id',
            'value' => 'employee.username',
            'filter'=>GlobalFunctions::GetAllEmployeeDetails(),
            ],
            [
            'attribute' => 'leave_category',
            'value' => 'leaveCategory.leave_category_name',
            'filter'=>GlobalFunctions::GetLeaveCategories(),
            ],
            'leave_description:ntext',
            'leave_from',
            'leave_to',
            'leave_days',
            [
            'attribute' => 'leave_status',
            'value' => 'leaveStatus.leave_status_name',
            'filter'=>GlobalFunctions::GetLeaveStatus(),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'delete' => function ($model, $key, $index) {
                        return ($model->leave_status !== 1 || $model->emp_id !== Yii::$app->user->id )? false : true;
                    },
                    'update' => function ($model, $key, $index) {
                        return $model->leave_status !== 1 ? false : true;
                    }
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
