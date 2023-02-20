<?php
$this->pageTitle = Yii::app()->name . ' - Register';
$this->breadcrumbs = array(
    'User',
);
?>

<h1>Зарегистрироваться</h1>

<div class="form" style="width: 250px;">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'register-form',
        'enableAjaxValidation' => false,
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username'); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Регистрация'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->