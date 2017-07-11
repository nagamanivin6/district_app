<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ComplaintsTrans */

$this->title = Yii::t('app', 'Create Complaints Trans');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaints Trans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaints-trans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
