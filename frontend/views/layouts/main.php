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
<nav class="navbar navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">

        <button type="button" class="navbar-toggle" ng-init="navCollapsed = true" ng-click="navCollapsed = !navCollapsed">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Brand</a>
      </div>
    
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" ng-class="!navCollapsed && 'in'">
      
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Link</a></li>
          <li><a href="#">Link</a></li>
          
          <li dropdown>
            <a href="#" dropdown-toggle>Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
          
        </ul>
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Link</a></li>
      <li dropdown>
            <a href="#" dropdown-toggle>Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>
    
<div ng-view></div>
        <!--<ul class=" nav">
            <li data-match-route="/$">
                <a href="#/">Home</a>
            </li>
            <li data-match-route="/about">
                <a href="#/about">About</a>
            </li>
            <li data-match-route="/contact">
                <a href="#/contact">Contact</a>
            </li>
            <li data-match-route="/dashboard" ng-show="loggedIn()" class="ng-hide">
                <a href="#/dashboard">Dashboard</a>
            </li>
            <li ng-class="{active:isActive('/logout')}" ng-show="loggedIn()" ng-click="logout()"  class="ng-hide">
                <a href="">Logout</a>
            </li>
            <li data-match-route="/login" ng-hide="loggedIn()">
                <a href="#/login">Login</a>
            </li>
        </ul>-->
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
