<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application Angular asset bundle.
 */
class AngularAsset  extends AssetBundle
{
    public $sourcePath  = '@bower';
    
    public $js = [
		'angular/angular.js',
        'angular-route/angular-route.js',
        'angular-strap/dist/angular-strap.js',
        'angular-bootstrap/ui-bootstrap.js',
    ];
     public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}
