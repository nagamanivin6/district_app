<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplaintsTrans */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Complaints Trans',
]) . $model->comp_transid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaints Trans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->comp_transid, 'url' => ['view', 'id' => $model->comp_transid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="complaints-trans-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
