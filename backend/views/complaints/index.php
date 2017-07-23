<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use backend\models\Status;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComplaintsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Complaints');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaints-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?= Html::a(Yii::t('app', 'Create Complaints'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'comp_desc',
            [
            'attribute' => 'issue_id',
            'value' => 'issueInfo.issue_desc'
            ],
            [
            'attribute' => 'user_regid',
            'value' => 'customer.user_name'
            ],
             [
            'attribute' => 'status',
            'value' => 'statusInfo.status_name',
            'filter'=>ArrayHelper::map(Status::find()->asArray()->all(), 'status_id', 'status_name'),
            ],
            'created_date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
