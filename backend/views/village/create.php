<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Village */

$this->title = Yii::t('app', 'Create Village');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Villages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="village-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
