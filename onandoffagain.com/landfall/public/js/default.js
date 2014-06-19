$(window).on('resize', function(){
	if(window.innerwidth>767){
		//no button
	}else{
		//button
	}
});
$(function(){
	$('.sign-out').click(function(){
		$anchor=$(this);
		bootbox.confirm('<h2>Leaving so soon?</h2> Are you sure you want to sign out?', function(result){
			if(result===true){
				var uri=$anchor.data('alt');
				redirect(uri);
			}
		});
	});
	if(typeof ($('#data_table'))!=='undefined'){
		$('#data_table').dataTable();
	}
});
function redirect(uri){
	window.location=uri;
}