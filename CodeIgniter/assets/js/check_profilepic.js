// To validate upadated profile picture
function checkpic()
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