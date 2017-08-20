<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\components\GlobalFunctions;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Leaves');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Leave'), ['create'], ['class' => 'btn btn-success']) ?>
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
            [
            'attribute' => 'financial_year',
            'value' => 'financialYear.financial_year_name',
            'filter'=>GlobalFunctions::GetFinancialYear(),
            ],
            'used_leaves',
            'balanced_leaves',
            'total_leaves',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
