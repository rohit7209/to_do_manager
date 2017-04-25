<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaskList */

$this->title = $model->task_name;

?>


<h1><?= Html::tag('h1',$this->title,['class'=>'text-primary']) ?></h1>

    <p>
        <?php 
            if($model->status=='notdone'){
                echo Html::a('Update', ['update', 'id' => $model->task_id], ['class' => 'btn btn-primary']);
            }
        ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->task_id], [
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
            'task_id',
            'task_name',
            'task_description:ntext',
            'task_time',
            'task_location',
            'created_on',
            'status',
        ],
    ]) ?>
