<?php
namespace app\modules\cabinet\widgets;
use yii\base\Widget;

class FooterWidget extends Widget
{
    public function run()
    {
        return $this->render('footer');
    }
}
