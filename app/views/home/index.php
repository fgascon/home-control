
<h2>Sapin de noël</h2>
<a href="#" id="switch-light"></a>

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
});
</script>
