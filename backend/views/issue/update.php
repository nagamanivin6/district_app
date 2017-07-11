<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Issue */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Issue',
]) . $model->issue_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Issues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->issue_id, 'url' => ['view', 'id' => $model->issue_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="issue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
