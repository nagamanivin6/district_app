<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html ng-app="districtApp">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>My Angular Yii Application</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div ng-controller="MainController" style="margin-left:10%;margin-right:10%">
	<!--<div >
	    <img   height="150px;" width=100% src="http://mckarimnagar.in/wp-content/gallery/photos/banner6.png">
	</div>-->
    <div style="margin-top: 5px;">
    <nav class="navbar navbar-inverse" role="navigation">
    
    <ul class="nav navbar-nav">
            <li data-match-route="/$">
                <a href="#/">Home</a>
            </li>
            <li data-match-route="/dashboard" ng-show="loggedIn()" class="ng-hide">
                <a href="#/dashboard">Dashboard</a>
            </li>
            <li data-match-route="/complaint" ng-show="loggedIn()" class="ng-hide">
                <a href="#/complaint">Complaint</a>
            </li>
            <li ng-class="{active:isActive('/logout')}" ng-show="loggedIn()" ng-click="logout()"  class="ng-hide">
                 <a href="">Logout({{loggedInUser.user_name}})</a>
            </li>
            <li data-match-route="/login" ng-hide="loggedIn()">
                <a href="#/login">Login</a>
            </li>
    </ul>
</nav>
    <div ng-view></div>
        
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
