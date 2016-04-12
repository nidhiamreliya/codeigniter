// Validate data entered by user in registration form
function form_validation()
{
	var first_name = document.registration.first_name.value.trim();  
	var last_name = document.registration.last_name.value.trim();  
	var email_id = document.registration.email_id.value;  
	var user_name = document.registration.user_name.value;  
	var password = document.registration.password.value;
	var confirm_password = document.registration.confirm_password.value; 
	var address_line1 = document.registration.address_line1.value;  
	var city = document.registration.city.value;   
	var zip_code = document.registration.zip_code.value;  
	var state = document.registration.state.value;
	var country = document.registration.country.value;      
	if (first_name == "" || last_name == "" || email_id == "" || user_name == "" || password == "" || address_line1 == "" || city == "" || zip_code == "" || state == "" || country == "")
	{
		alert ( "There are some empty fiels. Please fill all required fields." );
		return false;
	}
	else
	{
		var letters = /^[A-Za-z]+$/;  
		if (! first_name.match(letters))  
		{  
			alert("First name must contain alphabet characters only");
			document.registration.first_name.focus();  
			return false;  
		}
		if (! last_name.match(letters))  
		{  
			alert("Last name must contain alphabet characters only");  
			document.registration.last_name.focus();  
			return false;  
		}
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if( ! email_id.match(mailformat))  
		{  
			alert("You have entered an invalid email address!");  
			document.registration.email_id.focus();  
			return false;  
		}
		if (! city.match(letters))  
		{  
			alert("Invalid city name");
			document.registration.city.focus();  
			return false;  
		}
		if (! state.match(letters))  
		{  
			alert("Invalid state name");
			document.registration.state.focus();  
			return false;  
		}
		if (! country.match(letters))  
		{  
			alert("Invalid country name");
			document.registration.country.focus();  
			return false;  
		}        
		
		if (password.length < 6) 
		{
		  	alert('Please enter at least 6 characters in password');  
			document.registration.password.focus(); 
		  	return false;
		}
 		if (confirm_password != password)
 		{
 			alert('Your password not match');  
			document.registration.confirm_password.focus(); 
  			return false;
 		}  
		var numbers = /^\d{6}$/;  
		if(! zip_code.match(numbers))  
		{
			alert('You have entered an invalid zip code!');  
			document.registration.zip_code.focus();  
			return false;     
		}
		
	}
	return true;
}

// Validate data entered by user in login form
function login_check()
{
	var user_name = document.login.user_name.value.trim();  
	var password = document.login.password.value;
	if(user_name == "" && password == "")
	{	
		alert ( "Please enter user name and password." );
		return false;
	}
	else if(user_name == "")
	{
		alert ( "Please enter user name." );
		return false;
	}
	else if(password == "")
	{
		alert ( "Please enter password." );
		return false;
	}
}

// Validate data entered by user in edit profile form
function edit_user()
{
	var first_name = document.edit_profile.first_name.value.trim();  
	var last_name = document.edit_profile.last_name.value.trim();  
	var email_id = document.edit_profile.email_id.value;  
	var user_name = document.edit_profile.user_name.value;  
	var password = document.edit_profile.password.value;
	var confirm_password = document.edit_profile.confirm_password.value; 
	var address_line1 = document.edit_profile.address_line1.value;  
	var city = document.edit_profile.city.value;   
	var zip_code = document.edit_profile.zip_code.value;  
	var state = document.edit_profile.state.value;
	var country = document.edit_profile.country.value;
	      
	if (first_name == "" || last_name == "" || email_id == "" || user_name == "" || address_line1 == "" || city == "" || zip_code == "" || state == "" || country == "")
	{
		alert ( "There are some empty fiels. Please fill all required fields." );
		return false;
	}
	else
	{
		var letters = /^[A-Za-z]+$/;  
		if (! first_name.match(letters))  
		{  
			alert("First name must contain alphabet characters only");
			document.edit_profile.first_name.focus();
			return false;  
		}
		if (! last_name.match(letters))  
		{  
			alert("Last name must contain alphabet characters only");  
			document.edit_profile.last_name.focus(); 
			return false;  
		}
		if (! state.match(letters))  
		{  
			alert("Invalid state name");
			document.edit_profile.state.focus();  
			return false;  
		}
		if (! country.match(letters))  
		{  
			alert("Invalid country name");
			document.edit_profile.country.focus();  
			return false;  
		}    
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if( ! email_id.match(mailformat))  
		{  
			alert("You have entered an invalid email address!");  
			document.edit_profile.email_id.focus();
			return false;  
		}
		if(password != "")
		{
			if (password.length < 6) 
			{
		  		alert('Please enter at least 6 characters in password');  
		  		document.edit_profile.password.focus();
		  		return false;
			}
 			if (confirm_password != password)
 			{
 				alert('Your password not match'); 
 				document.edit_profile.confirm_password.focus(); 
  				return false;
 			}
 		}  
		var numbers = /^\d{6}$/;  
		if(! zip_code.match(numbers))  
		{
			alert('You have entered an invalid zip code!'); 
			document.edit_profile.zip_code.focus(); 
			return false;     
		} 
		if (! city.match(letters))  
		{  
			alert("Invalid city name");
			document.edit_profile.city.focus();
			return false;  
		} 
	}
	return true;
}

// To validate upadated profile picture
function check_pic()
{
	var fup = document.getElementById('profile_pic');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(!fileName)
	{
		alert("You have not uploaded any image");
		fup.focus();
		return false;
	}
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
	{	
		return true;
	} 
	else
	{
		alert("Upload Gif, Jpg, jpeg or png images only");
		fup.focus();
		return false;
	}
}

