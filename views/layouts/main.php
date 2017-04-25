<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use dosamigos\datepicker\DatePicker;


AppAsset::register($this);

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My ToDo Manager',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Manage All Tasks', 'url' => ['task-list/all']],
            ['label' => 'Create New', 'url' => ['task-list/create']],
        ],
    ]);
    NavBar::end();
    ?>
    <div class="site-index">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <div class="body-content" style="margin-top: 100px">
                <div class="row">
                    <div class="col-lg-3" style="background: white;text-align:center;min-height:500px;border-right:1px solid rgb(200,200,200);">
                        <p>
                            <?= Html::a('Today', ['task-list/today'], ['class' => 'btn btn-success full-stretch btn-cstm']) ?>
                        </p>
                        <p>
                            <?= Html::a('Tommorrow', ['task-list/tommorrow'], ['class' => 'btn btn-success full-stretch btn-cstm']) ?>
                        </p>
                        <p>
                            <?= Html::a('Next 7 Days', ['task-list/next7'], ['class' => 'btn btn-success full-stretch btn-cstm']) ?>
                        </p>
                        <p>
                            <?= Html::a('Next 30 Days', ['task-list/next30'], ['class' => 'btn btn-success full-stretch btn-cstm']) ?>
                        </p>
                        
                        
                        
                        <?php $form = ActiveForm::begin([   'action' => '?r=task-list/search',
                                                            'method' => 'get',
                                                            'options' => ['enctype' => 'multipart/form-data'],
                                                        ]); ?>

                            <?= DatePicker::widget([
                                'name' => 'selected_date',
                                'value' => date('d-M-Y'),
                                'inline'=>true,
                                'template' => '<div class="well well-sm" style="margin:auto;background-color: #fff; width:250px">{input}</div>',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-M-yyyy'
                                ]
                            ]);?>

                            <div class="form-group">
                                <?= Html::submitButton('On Selected Date', ['class' => 'btn btn-primary', 'style'=>'margin-top:10px;min-width:150px']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
                        
                    </div>
                    
                    <div class="col-lg-9" style="">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My ToDo Manager <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
