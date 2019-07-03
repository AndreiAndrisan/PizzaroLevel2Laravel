 var container = $(".products");
 var request_in_progress = false;
 var end_of_database = false;

 function showSpinner() {
 	$("#spinner").css("display","block");
}

function hideSpinner() {
    $("#spinner").css("display","none");
}

 function scrollReaction() {
	var content_height = container.outerHeight(true);;
	var current_y = window.innerHeight + window.pageYOffset;
	if((current_y >= content_height) && end_of_database == false) {
  		loadMore();
  	}

}
function updatePage(page) {
	container.data("page", page);
}

function loadMore() {

    if(request_in_progress) { return; }
    request_in_progress = true;
    showSpinner();

    var categorie = getParameterByName('category');
    if (categorie == null) {
    	categorie = (container.attr('category') != null) ? container.attr('category') : "";}
    var token = container.attr('token');
    var page = container.data("page");
    var next_page = page + 1;
    var id = getParameterByName('id');
    if (id == null) {
    	id = (container.data('id') != null) ? container.data('id') : "";}
    url = (isNaN(next_page)) ? "../" : "";
    $.get({
	url: url+"../resources/views/includes/databaseForAjax.blade.php?category="+categorie+"&page="+next_page+"&id="+id+"&token="+token,  //the file u are sending too
    dataType: "text",   //text, JSON, XML
	success: function(data) {
		hideSpinner();
		container.append(data);
		updatePage(next_page);
		request_in_progress = false;
		if (data == 0) {
			end_of_database = true;
		}
		if (id !="") {end_of_database = true;}
	}
});
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

window.onscroll = function() {
    scrollReaction();
}

loadMore();


   // $('ul.pagination').hide();
   //  $(function() {
   //      $('.infinite-scroll').jscroll({
   //          autoTrigger: true,
   //          loadingHtml: '<img class="center-block" src="images/spinner.gif" alt="Loading..." />',
   //          padding: 0,
   //          nextSelector: '.pagination li.active + li a',
   //          contentSelector: 'div.infinite-scroll',
   //          callback: function() {
   //              $('ul.pagination').remove();
   //          }
   //      });
   //  });

// $('main').on('click', '.ajax_add_to_cart', function(){
// 	var id = $(this).data("id");
// 	var quantity = $(this).attr("quantity");
// 	$.get({
// 		url: "/laravel/AssigmentLevel2Laravel/public/includes/session.php?id="+id+"&quantity="+quantity,  //the file u are sending too
// 		dataType: "json",   //text, JSON, XML
// 		success: function(data) {	
// 			$('#count-header').html(data.count+" items");
// 			$('#amount-header').html("$"+data.price);
// 			$('.footer-cart-contents .count').html(data.count);
// 			if(data.timeout == "1")
// 			{
// 				$('#myModal').modal('show');
// 				$('#myModal').on('hidden.bs.modal', function () {
// 				  location.reload();
// 				});
// 			}
// 		},
// 	});
// })

// $(".product-quantity .quantity input").change(function(){
// 	var quantity = $(this).val();
// 	var id = $(this).data('id');
// 	$(this).attr('value',quantity);
// 	var price = $(this).closest('tr').find('.product-subtotal').children('.woocommerce-Price-amount').attr('price');
// 	var newPrice = price*quantity;
// 	$(this).closest('tr').find('.product-subtotal').children('.woocommerce-Price-amount').html('<span class="woocommerce-Price-currencySymbol">&#36;</span>'+ newPrice);
// 	$.get({
// 		url: "/laravel/AssigmentLevel2Laravel/public/includes/updateSession.php?id="+id+"&quantity="+quantity,  //the file u are sending too
// 		dataType: "text",   //text, JSON, XML
// 		success: function(data) {	
// 			$('#amount-header').html("$"+data);
// 			$('#totals .woocommerce-Price-amount.amount').html('<span class="woocommerce-Price-currencySymbol">&#36;</span>'+data);
// 			if(parseInt(data) == 0)
// 			{
// 				$('#myModal').modal('show');
// 				$('#myModal').on('hidden.bs.modal', function () {
// 				  location.reload();
// 				});
// 			}
// 			console.log(data);
// 		},
// 	});
// })
