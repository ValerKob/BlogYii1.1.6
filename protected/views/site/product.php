<?php
$this->pageTitle = Yii::app()->name . ' - Product';
$this->breadcrumbs = array(
	'MyPost',
);
?>

<h1>Добавить пост</h1>

<div class="form" style="width: 250px;">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'product-form',
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Добавить'); ?>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->

<br><br><br>
<h1>Мой посты</h1>

<div class="row">
	<?php
	foreach ($rows as $row) {
		if ($row->id_user === Yii::app()->user->id) {
			echo '
                <div class="col-12 col-sm-6 col-md-4 d-flex justify-content-center">
                <div class="card mb-4" style="width: 18rem; display: block; border: 0px;">
                    <div class="card-body d-flex flex-column justify-content-between" style="
                    border: var(--bs-card-border-width) solid var(--bs-card-border-color);
                    border-radius: 15px;">
                        <div>
                            <h5 class="card-title">' . $row['name'] . '</h5>
                            <p class="card-text">' . $row['content'] . '</p>
                        </div>
                        <div>
                        <div class="d-flex justify-content-between mt-3" style="color: #8e8e8e;">
                            <div class="card-title text-start"> Дата: <b style="color: #000;">' . $row['date_post'] . '</b></div>
                            <div class="card-title text-end"> Автор:  <b style="color: #000;">' . $row['username_user'] . '</b></div>
                        </div>
                            <div class="d-flex">
								<form class="me-2" action="/Work/TestTasks/FinalYii.1.1/index.php/site/deletepost" method="post">
									<input type="text" class="d-none" name="id_post" value="' . $row['id'] . '" />
									<button type="submit" class="btn btn-danger">Удалить</button>
								</form>
								<form action="/Work/TestTasks/FinalYii.1.1/index.php/site/updatepost" method="post">
									<input type="text" class="d-none" name="id_post" value="' . $row['id'] . '" />
									<button type="submit" class="btn btn-primary">Изменить</button>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
		}
	}
	?>
</div>