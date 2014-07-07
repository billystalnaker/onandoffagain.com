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
	$('#search_choices > li').on('click', function(){
		$(this).siblings('li').removeClass('selected');
		$(this).addClass('selected');
	});
	$('#search_submit').on('click', function(){
		selected=false;
		$('#search_choices > li').each(function(){
			if($(this).hasClass('selected')){
				selected=$(this).data('choice');
			}
		})
		if(selected==false){
			selected='st_light';
		}
		search_params=$('#search_params').val();
		redirect('/search/'+selected+'/'+search_params);
	});
	if(typeof ($('#data_table'))!=='undefined'){
		$('#data_table').dataTable();
	}
//	var switch_options={
//		onText: 'Yes',
//		offText: 'No'
//	};
//	$(":checkbox").bootstrapSwitch(switch_options);
});
function redirect(uri){
	window.location=uri;
}