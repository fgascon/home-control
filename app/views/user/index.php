
<?php echo CHtml::link("Ajouter un utilisateur", array('create'), array('class'=>'btn btn-default'));?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>new CActiveDataProvider('User'),
	'itemsCssClass'=>'table table-striped',
	'columns'=>array(
		'name',
		'username',
		'is_admin',
		array(
			'class'=>'zii.widgets.grid.CButtonColumn',
			'template'=>'{update} {delete}',
		),
	),
));?>