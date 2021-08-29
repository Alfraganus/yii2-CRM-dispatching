<?php
use Carbon\Carbon;
/* @var $this yii\web\View */

use Carbon\CarbonTimeZone;
use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
echo $weeks = (new Carbon())::now()->subDays(30);
$now = (new Carbon())::now();

if($now<$weeks) {
    echo 'hali vaqt bor';
} else {
    echo 'vaqt tugagan';
}

echo Carbon::now()->diffInDays($weeks, false)
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
