<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaskList */

$this->title = 'Create Task';

?>

    <h1><?= Html::tag('h1',$this->title,['class'=>'text-primary']) ?></h1>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    