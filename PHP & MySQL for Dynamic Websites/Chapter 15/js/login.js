$(function(){
	$('.errorMessage').hide();
	$('.errorMessage').hide();
	console.log("login.js executed");
	$('#login').submit(function(){
		var email, password;
		console.log("JQuery Submit() function called");
		
		if ($('#email').val().length >= 6){
			email = $('#email').val();
			$('#emailP').removeClass('error');
	 	 	$('#emailError').hide();
		}else{
	 	 	$('#emailP').addClass('error');
	 	 	$('#emailError').show();	
		}
		if ($('#password').val().length > 0) {
			password = $('#password').val();
	 	 	$('#passwordP').removeClass('error');
	 	 	$('#passwordError').hide();
	 	}else{
			$('#passwordP').addClass('error');
	 	 	$('#passwordError').show();
	 	}
	 	 	 	 	
	 	if (email && password){
			console.log("Email & Password OK");
			var data = new Object(); // Create object for form data
			data.email = email;
			data.password = password;
			var options = new Object(); // Create object for ajax options
			options.data = data;
			options.dataType = 'text';
			options.type = 'get';
			options.success = function(response){
			console.log("Success Function called");
			console.log("Response is: " + response);
				if(response == 'CORRECT'){
					console.log("Response correct!");
					$('#login').hide();
					$('#results').removeClass('error');
					$('#results').text('You are now logged in!'); 	 	 	 	 		
				}else if(response == 'INCORRECT'){
					console.log("Response incorrect!");
					$('#results').text('The submitted credentials do not match those on file!');
					$('#results').addClass('error');
				}else if(response == 'INCOMPLETE'){
					console.log("Response incomplete!");
					$('#results').text('Please provide an email address and a password!');
					$('#results').addClass('error');
				}else if(response == 'INVALID_EMAIL'){
					console.log("Invalid Email!");
					$('#results').text('Please provide your email address!');
					$('#results').addClass('error');
				}
			};

		options.url = 'login_ajax.php';
		console.log("Making ajax request...");
		$.ajax(options);
		}
	return false;
	});
});