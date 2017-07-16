
<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
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
        ) ?>

    </section>

</aside>
