<?php

namespace app\modules\cabinet\widgets;

use yii\base\Widget;

class SidebarWidget extends Widget
{
    public function run()
    {
        switch (getUserRole()) {
            case "cadmin":
                return $this->render('_manager_sidebar');
            case "dispatcher":
                return $this->render('_dispatcher_sidebar');
            case "safety_specialist":
                return $this->render('_safety_sidebar');
        }


    }
}
