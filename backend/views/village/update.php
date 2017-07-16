<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Village */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Village',
]) . $model->village_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Villages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->village_id, 'url' => ['view', 'id' => $model->village_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="village-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
