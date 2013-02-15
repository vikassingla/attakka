function submitPaymentRangeForm()
{
	var price_range = $(".price_range_checkbox");
	
	if($(price_range).is(':checked'))
	{
		$("#price_range_form").submit();
	}
	else
		showPopup("Kindly select atleast one payment/price range");
}

function resetOfferCount(obj,value)
{
	if (obj.checked)
	{
		$("#offer_count_input").val(parseInt($("#offer_count_input").val())+parseInt(value));
	}
	else
		$("#offer_count_input").val(parseInt($("#offer_count_input").val())-parseInt(value));
}

function submitVehicleBrandForm()
{
	var price_range = $(".price_range_checkbox");
	
	if($(price_range).is(':checked'))
	{
		$("#vehicle_brand_range_form").submit();
	}
	else
		showPopup("Kindly select atleast one vehicle brand");
}

function submitVehicleTypeForm()
{
	var price_range = $(".price_range_checkbox");
	
	if($(price_range).is(':checked'))
	{
		$("#vehicle_type_range_form").submit();
	}
	else
		showPopup("Kindly select atleast one vehicle type");
}

function submitLeadForm()
{
	var first_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var email = $("#email").val();
	var phone = $("#phone").val();
	var zip_code = $("#zip_code").val();
	var contact_preference = $("#contact_preference").val();
	var purchase_time_frame = $("#purchase_time_frame").val();
	var notes = $("#notes").val();
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

	if (first_name=="" || first_name=="First Name")
	{

		showPopup("Kindly enter first name!");
		 

		//alert("Kindly enter first name!");
		return false;
	}
	if (last_name=="" || last_name=="Last Name")
	{
		showPopup("Kindly enter last name!");
		 
		//alert("Kindly enter last name!");
		return false;
	}
	if (!reg.test(email))
	{
		showPopup("Kindly enter a valid email address!");
		 
	//	alert("Kindly enter a valid email address!");
		return false;
	}
	if (phone=="" || phone=="Phone Number")
	{
		showPopup("Kindly enter phone number!");
		
	//	alert("Kindly enter phone number!");
		return false;
	}
	if (zip_code=="" || zip_code=="Zip Code")
	{
		showPopup("Kindly enter Zip Code!");
		
		//alert("Kindly enter Zip Code!");
		return false;
	}
	if (contact_preference=="0")
	{
		showPopup("Kindly select Contact Preference");
		
		//alert("Kindly select Contact Preference!");
		return false;
	}
	if (purchase_time_frame=="0")
	{
		showPopup("Kindly select Purchase Time Frame!");
		
	//	alert("Kindly select Purchase Time Frame!");
		return false;
	}
	if (notes=="" || notes=="Notes")
	{
		showPopup("Kindly enter notes!");
		
		//alert("Kindly enter notes!");
		return false;
	}

	$("#lead_form").submit();
}

function blankValue(obj,title)
{
	if (obj.value==title)
	{
		obj.value='';
	}
}

function resetValue(obj,title)
{
	if (obj.value=='')
	{
		obj.value=title;
	}
}

function submitContactForm()
{
	var first_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var email = $("#email").val();
	var phone = $("#phone").val();
	var notes = $("#notes").val();
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

	if (first_name=="" || first_name=="First Name")
	{
		showPopup("Kindly enter first name!");
		return false;
	}
	if (last_name=="" || last_name=="Last Name")
	{
		showPopup("Kindly enter last name!");
		return false;
	}
	if (!reg.test(email))
	{
		showPopup("Kindly enter a valid email address!");
		return false;
	}
	if (phone=="" || phone=="Phone Number")
	{
		showPopup("Kindly enter phone number!");
		return false;
	}
	
	if (notes=="" || notes=="Notes")
	{
		showPopup("Kindly enter notes!");
		return false;
	}

	$("#contact_form").submit();
}

function resetOfferCountAjax()
{
	var price_range = $(".price_range_checkbox");
	
	if(!$(price_range).is(':checked'))
	{
		$("#offer_count_input").val(0);
		return;
	}

	var form_data=$("#vehicle_advanced_form").serialize();

	$.ajax({
	  url: site_url+"deals/ajax_vehicle_count",
	  type: 'POST',
	  data: form_data,
	  success: function(data){
		$("#offer_count_input").val(data);
	  }
	});
}

function submitAdvancedForm()
{
	var price_range=$("input[name='price_range[]']").is(':checked');
	var vehicle_type=$("input[name='vehicle_type[]']").is(':checked');
	var vehicle_brand=$("input[name='vehicle_brand[]']").is(':checked');
	
	if (!price_range)
	{
		$(".payment_range").attr("checked","checked");
	}
	
	if (!vehicle_type)
	{
		$(".vehicle_type").attr("checked","checked");
	}
	
	if (!vehicle_brand)
	{
		$(".vehicle_make").attr("checked","checked");
	}

	$("#vehicle_advanced_form").submit();
	
}

function showPopup(content)
{
	$('.jqmAlertContent').html(content);
	$('#ex3b').jqmShow();
}

function checkUncheckAdvancedOptions(css,obj)
{
	if (obj.checked)
	{
		$("."+css).attr("checked","checked");
	}
	else
	{
		$("."+css).attr("checked","");
	}

	resetOfferCountAjax();
}
