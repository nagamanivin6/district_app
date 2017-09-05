<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LeaveTrans */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leave Trans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-trans-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                "label" => Yii::t('app', 'Employee Name'),
                "value" => ($model->employee) ? $model->employee->username : ''
            ],
            'leaveCategory.leave_category_name',
            'leave_description:ntext',
            'leave_days',
            'leave_from',
            'leave_to',
            'leaveStatus.leave_status_name',
            [
                "label" =>  Yii::t('app', 'Leave Updated By'),
                "value" => ($model->headOfDept) ? $model->headOfDept->username : ''
            ],
           // 'headOfDept.username',
            'leave_updated_time',
        ],
    ]) ?>

</div>
