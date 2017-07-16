<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Village */

$this->title = $model->village_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Villages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="village-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->village_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->village_id], [
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
            'village_id',
            'village_name',
            'mandal_id',
        ],
    ]) ?>

</div>
