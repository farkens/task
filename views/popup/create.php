<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Popup */

$this->title = 'Create Popup';
$this->params['breadcrumbs'][] = ['label' => 'Popups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
