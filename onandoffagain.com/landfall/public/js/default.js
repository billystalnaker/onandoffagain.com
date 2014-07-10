$(window).on('resize', function() {
    if (window.innerwidth > 767) {
	//no button
    } else {
	//button
    }
});
$(function() {
    //sign-out link click
    $('.sign-out').click(function() {
	$anchor = $(this);
	bootbox.confirm('<h2>Leaving so soon?</h2> Are you sure you want to sign out?', function(result) {
	    if (result === true) {
		var uri = $anchor.data('alt');
		redirect(uri);
	    }
	});
    });
    //search choice click
    $('#search_choices > li').on('click', function() {
	$(this).siblings('li').removeClass('selected');
	$(this).addClass('selected');
    });
    //search submit click
    $('#search_submit').on('click', function() {
	selected = false;
	$('#search_choices > li').each(function() {
	    if ($(this).hasClass('selected')) {
		selected = $(this).data('choice');
	    }
	})
	if (selected == false) {
	    selected = 'st_light';
	}
	search_params = $('#search_params').val();
	redirect('/landfall/search/' + selected + '/' + search_params);
    });
    //all data-tables used
    if (typeof ($('#data_table')) !== 'undefined') {
	$('#data_table').dataTable();
    }
    $('.reset-password').on('click', function(e) {
	e.preventDefault();
	$(this).attr('disabled', true);
	if (typeof $(this).data('identifier') !== 'undefined') {
	    var params = {};
	    params['identifier'] = $(this).data('identifier');
	    $.post('/landfall/api/forgot_password', params, function(data) {
		if (data === 1) {
		    bootbox.alert('<h2>Yay!!</h2> Password email has been sent.');
		} else {
		    bootbox.alert('<h2>Uh oh...</h2> Something went wrong try again...');
		}
	    });
	    $(this).attr('disabled', false);
	}
    });
//	var switch_options={
//		onText: 'Yes',
//		offText: 'No'
//	};
//	$(":checkbox").bootstrapSwitch(switch_options);
});
function redirect(uri) {
    window.location = uri;
}