function validate_email(emailAddress)
{
	var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
 var valid = emailRegex.test(emailAddress);
  if (!valid) {
    return false;
  } else
    return true;
}

function isEmpty(text_box)
{
	if(text_box=='')
	return false;
	else
	return true;
}

/*function check_isAirport(pick_place,drop_place)
{
			$.ajax({
			  type: 'POST',
			  url: "<?php echo base_url();?>index.php/welcome/check_airport",
			  data: 'pick_place='+pick_place+' &drop_place='+drop_place,
			  cache: false,
			  success: function(data) {
					return data;
		}});
	
}*/