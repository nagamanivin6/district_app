<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LeaveTrans */

$this->title = Yii::t('app', 'Apply Leave');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leave Trans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-trans-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model' => $model,'leaveUserDetails'=>$leaveUserDetails
    ]) ?>

</div>
