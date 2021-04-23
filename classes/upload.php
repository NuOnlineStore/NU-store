<?php
function uploadImg($_ARR_FILES, $fileName = "file")
{
	$img_url = false;
	$md5 = md5(rand());
	$up_dir = "../images/".$md5 ;

	if ((($_ARR_FILES[$fileName]["type"] == "image/gif")
	|| ($_ARR_FILES[$fileName]["type"] == "image/jpeg")
	|| ($_ARR_FILES[$fileName]["type"] == "image/pjpeg")
	|| ($_ARR_FILES[$fileName]["type"] == "image/png"))
	&& ($_ARR_FILES[$fileName]["size"] < 2097152*2))//2097152 = 2M

	  {
		if ($_ARR_FILES[$fileName]["error"] > 0)
		  {
		  	$img_url = false;
		  }

		if (file_exists($up_dir . $_ARR_FILES[$fileName]["name"]))
		  {
		  	$img_url = false;
		  }
		else
		  {
		  move_uploaded_file($_ARR_FILES[$fileName]["tmp_name"],$up_dir . $_ARR_FILES[$fileName]["name"]);
		  $img_url =  $md5 . $_ARR_FILES[$fileName]["name"];
		  }
		}
	else
	{
	  $img_url = false;
	}
	return $img_url;
}

?>
