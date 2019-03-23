<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Example';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Демонстративная страница на которой установлен код попапа.
    </p>

    <code><?= __FILE__ ?></code>

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>

    <script>
        $.ajax({
            url:  'http://phptask.local/web/index.php?r=site%2Fpopup',
            type: 'POST',
            data: {id:1},
            success: function(res){
                $('body').append(res);
            }
        });
    </script>

</div>
