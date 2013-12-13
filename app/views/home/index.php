
<h4>Sapin de noël</h4>
<a href="#" id="switch-light" class="btn btn-default"></a>

<?php foreach(Yii::app()->smartthings->endpoints as $endpoint):?>
	<?php foreach($endpoint->makeCall('/switches') as $switch):?>
		<h4><?php echo CHtml::encode($switch['label']);?></h4>
		<?php echo CHtml::link("Turn ON", $endpoint->createUrl('/switches/'.$switch['id'].'/on'), array(
			'class'=>'btn btn-default smartthings-action',
		));?>
		<?php echo CHtml::link("Turn OFF", $endpoint->createUrl('/switches/'.$switch['id'].'/off'), array(
			'class'=>'btn btn-default smartthings-action',
		));?>
		<?php echo CHtml::link("Toggle", $endpoint->createUrl('/switches/'.$switch['id'].'/toggle'), array(
			'class'=>'btn btn-default smartthings-action',
		));?>
	<?php endforeach;?>
<?php endforeach;?>

<?php Yii::app()->clientScript->registerPackage('jquery');?>
<script>
jQuery(function($){
	var BASE_URL = '<?php echo HomeController::API_ENDPOINT;?>';
	var btn = $('#switch-light');
	var currentState;
	function refreshState(){
		getState(function(state){
			currentState = state;
			btn.html(state ? "Turn off" : "Turn on");
		});
	}
	setTimeout(refreshState, 0);
	setInterval(refreshState, 5000);
	btn.click(function(evt){
		evt.preventDefault();
		$.get(BASE_URL + '/lights/' + (currentState ? 'off' : 'on'), function(){
			setTimeout(refreshState, 100);
		});
	});
	function getState(callback){
		$.get(BASE_URL + '/lights', function(data){
			if(data && data.success){
				callback(data.state);
			}else{
				console.error("Failed to get state");
			}
		});
	}
	
	$('.smartthings-action').click(function(evt){
		evt.preventDefault();
		var btn = $(this);
		btn.attr('disabled', 'disabled');
		$.ajax({
			url: btn.attr('href'),
			cache: false,
			crossDomain: true,
			complete: function(){
				btn.removeAttr('disabled');
			}
		});
	});
});
</script>
