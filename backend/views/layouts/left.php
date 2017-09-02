<?php
use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;
?>
<aside class="main-sidebar">

    <section class="sidebar">
        <?php
            echo GhostMenu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'encodeLabels'=>false,
            'items' => [
                    ['label' => 'Department Type',  'url' => ['/department-type/index']],
                    ['label' => 'Department', 'url' => ['/department/index']],
                    ['label' => 'Districts',  'url' => ['/district/index']],
                    ['label' => 'Mandals', 'url' => ['/mandal/index']],
                    ['label' => 'Village',  'url' => ['/village/index']],
                    ['label' => 'Issue','url' => ['/issue/index']],
                    ['label' => 'Complaints',  'url' => ['/complaints/index']],
                    ['label' => 'Leave Management',  'url' => ['/leave/index']],
                    ['label' => 'Leave Updation',  'url' => ['/leave-trans/index']],
                    ['label' => 'Employees',  'url' => ['/user-management/user/index']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]);
        ?>

    </section>

</aside>
