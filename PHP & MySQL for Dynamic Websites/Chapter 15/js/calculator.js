//$(function(){
//	alert('Ready!'); 	
//});

$(function() { // When document ready
	$('.errorMessage').hide(); // Hide error msg
	$('#calculator').submit(function() { // Call submit function on form with id of 'calulator'
		var quantity, price, tax, total;
	 	
	 	if($('#quantity').val() > 0){
			quantity = $('#quantity').val();
			$('#quantityP').removeClass('error');
			$('#quantityError').hide();
		}else{
	 	 	//alert('Please enter a valid quantity!');
			$('#quantityP').addClass('error');
			$('#quantityError').show();
	 	}
	 	 	
	 	if ($('#price').val() > 0) {
			price = $('#price').val();
			$('#priceP').removeClass('error');
			$('#priceError').hide();
	 	}else{
			//alert('Please enter a valid price!');
			$('#priceP').addClass('error');
			$('#priceError').show();
	 	}
	
		if ($('#tax').val() > 0) {
			tax = $('#tax').val();
			$('#taxP').removeClass('error');
			$('#taxError').hide();
	 	}else{
			//alert('Please enter a valid tax!');
			$('#taxP').addClass('error');
			$('#taxError').show();
	 	}
	
	 	if (quantity && price && tax){
			total = quantity * price;
	 	 	total += total * (tax/100);
	 	 	//alert('The total is $' + total);
			$('#results').html('The total is <b>$' + total + '</b>.');
	 	}
			 
		return false; // To prevent an actual form submission (otherwise it'll execute calculator.php)
	 	});	
});