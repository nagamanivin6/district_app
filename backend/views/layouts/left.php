<?php
use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!--<?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    
                    ['label' => 'Department Type', 'icon' => 'dashboard', 'url' => ['/department-type']],
                    ['label' => 'Department', 'icon' => 'dashboard', 'url' => ['/department']],
                    ['label' => 'Districts', 'icon' => 'dashboard', 'url' => ['/district']],
                    ['label' => 'Mandals', 'icon' => 'dashboard', 'url' => ['/mandal']],
                    ['label' => 'Village', 'icon' => 'dashboard', 'url' => ['/village']],
                    ['label' => 'Issue', 'icon' => 'dashboard', 'url' => ['/issue']],
                    ['label' => 'Complaints', 'icon' => 'dashboard', 'url' => ['/complaints']],
                    ['label' => 'Employees', 'icon' => 'dashboard', 'url' => ['/user-management/user/index']],
                    // ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    // ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    // ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        ) ?>-->
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
                    ['label' => 'Admin Leave Management',  'url' => ['/leave/index']],
                    ['label' => 'Employee Leave Management',  'url' => ['/leave-trans/index']],
                    ['label' => 'Employees',  'url' => ['/user-management/user/index']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]);
        ?>

    </section>

</aside>
