<?php
$this->pageTitle = Yii::app()->name . ' - Product'; ?>

<h1>Изменить пост</h1>

<div class="form" style="width: 250px;">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'update-form',
        'enableAjaxValidation' => false,
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php echo $form->textField($model, 'content'); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>
    <input type="text" class="d-none" name="id_post_update" value="<?php echo $model->id ?>">

    <div class="row buttons">
        <?php echo CHtml::submitButton('Изменить'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->