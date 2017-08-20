<?php
namespace backend\components;
use yii\web\Controller;
class BaseGlobalController extends Controller {
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }
}
?>