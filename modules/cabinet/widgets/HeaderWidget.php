<?php
namespace app\modules\cabinet\widgets;

use yii\base\Widget;

class HeaderWidget extends Widget
{
    public function run()
    {
        return $this->render('header');
    }
}
