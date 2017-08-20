<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LeaveCategories */

$this->title = Yii::t('app', 'Create Leave Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leave Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
