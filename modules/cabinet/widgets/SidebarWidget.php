<?php
namespace app\modules\cabinet\widgets;

use yii\base\Widget;

class SidebarWidget extends Widget
{
    public function run()
    {
        return $this->render('sidebar');
    }
}
