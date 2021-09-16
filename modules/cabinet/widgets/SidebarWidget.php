<?php

namespace app\modules\cabinet\widgets;

use yii\base\Widget;

class SidebarWidget extends Widget
{
    public function run()
    {
        if (getUserRole() == 'cadmin') {
            return $this->render('_manager_sidebar');
        } elseif(getUserRole() == 'dispatcher') {
            return $this->render('_dispatcher_sidebar');
        }

    }
}
