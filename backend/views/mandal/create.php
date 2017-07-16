<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Mandal */

$this->title = Yii::t('app', 'Create Mandal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mandals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mandal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
