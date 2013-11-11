<div class="form col-lg-8">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'htmlOptions'=>array(
			'role'=>'form',
		),
	));?>
	
	<div class="form-group <?php echo $model->hasErrors('name')?'has-error':'';?>">
		<?php echo $form->label($model,'name', array('class'=>'control-label'));?>
		<?php echo $form->textField($model,'name', array('class'=>'form-control'));?>
		<?php echo $form->error($model,'name');?>
	</div>
	
	<div class="form-group <?php echo $model->hasErrors('username')?'has-error':'';?>">
		<?php echo $form->label($model,'username', array('class'=>'control-label'));?>
		<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username');?>
	</div>
	
	<div class="form-group <?php echo $model->hasErrors('password')?'has-error':'';?>">
		<?php echo $form->label($model,'password', array('class'=>'control-label'));?>
		<?php echo $form->passwordField($model,'password', array('class'=>'form-control'));?>
		<?php echo $form->error($model,'password');?>
	</div>
	
	<div class="checkbox">
		<label>
			<?php echo $form->checkBox($model, 'is_admin');?>
			<?php echo CHtml::encode($model->getAttributeLabel('is_admin'));?>
		</label>
	</div>
	
	<button type="submit" class="btn btn-default">Enregistrer</button>
	
	<?php $this->endWidget('CActiveForm');?>
</div>
