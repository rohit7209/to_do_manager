<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskList */

$this->title = 'Update: ' . $model->task_name;

?>
    
    <h1><?= Html::tag('h1',$this->title,['class'=>'text-primary']) ?></h1>

    <?php
        $time=date("h:i:s a", strtotime($model->task_time));
        $date = date("D, d-M-Y, ", strtotime($model->task_date));

        $model->task_time=$date.$time;
        $model->task_date=$date;
        $model->save();
    ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    