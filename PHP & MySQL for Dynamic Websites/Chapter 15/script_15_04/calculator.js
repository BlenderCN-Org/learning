//$(function(){
//	alert('Ready!'); 	
//});

$(function() { // When document ready
	$('#calculator').submit(function() { // Call submit function on form with id of 'calulator'
		var quantity, price, tax, total;
	 	
	 	if($('#quantity').val() > 0){
			quantity = $('#quantity').val();
		}else{
	 	 	 	 alert('Please enter a valid quantity!');
	 	}
	 	 	
	 	if ($('#price').val() > 0) {
			price = $('#price').val();
	 	}else{
			alert('Please enter a valid price!');
	 	}
	
		if ($('#tax').val() > 0) {
			tax = $('#tax').val();
	 	}else{
			alert('Please enter a valid tax!');
	 	}
	
	 	if (quantity && price && tax){
			total = quantity * price;
	 	 	total += total * (tax/100);
	 	 	alert('The total is $' + total);
	 	}
			 
		return false; // To prevent an actual form submission:
	 	});	
});