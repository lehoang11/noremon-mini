
$(document).ready(function(){
    $(document).on("click", ".js-add-to-cart", function() {
    	var product_id = $('#product_id').val();
		var quantity = $('#quantity').val();
		$.ajax({
			url :BASE_URL+'cart/add-to-cart',
			type :'POST',
			cache : false,
			dataType: 'json',
			data: {'product_id':product_id,'quantity':quantity},
			success: function(data){
                if (data.success == true) {
                    location.reload();
                }else{
                    alert('error');
                }
            } 
		});
    });
});

$(document).on('click', '.product-qty .btn-update-cart', function () {    
	var btn = $(this),
		oldValue = btn.closest('.product-qty').find('input').val().trim(),
		newVal = 1;
	var id = btn.attr('data-id'); 
	if (btn.attr('data-dir') == 'plus') {
		if(oldValue < 10) {
			newVal = parseInt(oldValue) + 1;
		}else{
			newVal = 10;
		}
		
	} else {
		if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		} else {
			newVal = 1;
		}
	}
	btn.closest('.product-qty').find('input').val(newVal);
	$.ajax({
			url :BASE_URL+'cart/update',
			type :'POST',
			cache : false,
			dataType: 'json',
			data: {'id':id,'qty':newVal},
			success: function(data){
                if (data.success == true) {
                    location.reload();
                }else{
                    alert('error');
                }
            } 
		});
});

$(document).on('click', '.cart-item .btn-del-cart', function () { 
	var id = $(this).attr('cartId');
    $.ajax({
	   	url:BASE_URL+'cart/delete',
	   	type : 'POST',
	   	cache: false,
	   	dataType: 'json',
	   	data : {'id':id},
	   	success:function(data){
	   		if (data.success == true) {
                //$('.cart-item-'+data.id).remove();
                location.reload();
            }else{
                alert('error');
            }
	   	}
   });  
});

