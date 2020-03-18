$(document).ready(function () {
	// console.log('test');
	$('#user-list').click(function (e) {
		console.log('klik');
		// $('.container-fluid').load('account/user');
		$.ajax({
			url:'http://localhost:8004/account/user',
			method:"GET",
			success:function(response){
				// window.location = "/account/user";
				$('.container-fluid').html(response);
				console.log('ok');
			}
		});
	});
});