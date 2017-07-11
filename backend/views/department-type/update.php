<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DepartmentType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Department Type',
]) . $model->depttype_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Department Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->depttype_id, 'url' => ['view', 'id' => $model->depttype_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="department-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
