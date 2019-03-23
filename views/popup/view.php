<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Popup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Popups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="popup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'text:ntext',
            'is_active',
            'count_show',
        ],
    ]) ?>

    <?php
    Modal::begin([
        'header' => '<h2>js script</h2>',
        'clientOptions' => ['show' => true],
        'footer' => 'Если на сайте подключен jquery, можно убрать CDN подключение',
    ]);
    ?>
    <?=
    $str = "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
        <script>
        $.ajax({
            url:  '" . \yii\helpers\Url::toRoute('site/popup', true) . "',
            type: 'POST',
            data: {id:" . $model->id . "},
            success: function(res){
                $('body').append(res);
            }
        }); 
        </script>
   ";

    ?>
    <pre>
        <?=  htmlspecialchars($str)  ?>

    </pre>


    <?php Modal::end(); ?>


</div>
