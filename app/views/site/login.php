<div class="form login-form col-sm-4 col-sm-offset-4">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'htmlOptions'=>array(
			'role'=>'form',
		),
	));?>
	
	<div class="form-group <?php echo $model->hasErrors('username')?'has-error':'';?>">
		<?php echo $form->label($model,'username', array('class'=>'control-label'));?>
		<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username');?>
	</div>
	
	<div class="form-group <?php echo $model->hasErrors('password')?'has-error':'';?>">
		<?php echo $form->label($model,'password', array('class'=>'control-label'));?>
		<?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'password');?>
	</div>
	
	<button type="submit" class="btn btn-default">Se connecter</button>
	
	<?php $this->endWidget('CActiveForm');?>
</div>
