<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Mandal */

$this->title = $model->mandal_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mandals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mandal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->mandal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->mandal_id], [
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
            'mandal_id',
            'mandal_name',
            'dist_id',
        ],
    ]) ?>

</div>
