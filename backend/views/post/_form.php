<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>
    <?php
    /*第一种
        $psObjs = \common\models\Poststatus::find()->all();
        $allStatus = \yii\helpers\ArrayHelper::map($psObjs,'id','name');
    */
    /*二
     * $psObjs = Yii::$app->db->createCommand('select id,name from poststatus')->queryAll();
    $allStatus = \yii\helpers\ArrayHelper::map($psObjs,'id','name');
    */
    $allStatus =(new \yii\db\Query())
        ->select(['name','id'])
        ->from('poststatus')
        ->indexBy('id')
        ->column();
//    echo "<pre>";
//    print_r($allStatus);
//    echo "</pre>";
//    $allStatus = \yii\helpers\ArrayHelper::map($psObjs,'id','name');

    ?>
    <?= $form->field($model,'status')
    ->dropDownList($allStatus,
        ['prompt'=>'请选择状态']);?>

<!--    --><?//= $form->field($model, 'create_time')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'update_time')->textInput() ?>

    <?php
        $author = (new \yii\db\Query())
            ->select('nickname')
            ->from('adminuser')
            ->indexBy('id')
            ->column();
    ?>
    <?= $form->field($model, 'author_id')
        ->dropDownList($author,
            ['prompt'=>'请选择作者']);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
