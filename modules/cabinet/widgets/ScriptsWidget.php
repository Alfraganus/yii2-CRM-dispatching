<?php
namespace app\modules\cabinet\widgets;

use yii\base\Widget;

class ScriptsWidget extends Widget
{
    public function run()
    {
        return $this->render('scripts');
    }
}
