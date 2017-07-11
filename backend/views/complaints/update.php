<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Complaints */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Complaints',
]) . $model->comp_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->comp_id, 'url' => ['view', 'id' => $model->comp_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="complaints-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
