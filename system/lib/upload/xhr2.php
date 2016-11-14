<?php
	//var_dump($_FILES);
	//var_dump($_POST);
	$resultData = array();
	//$destination_path = getcwd().DIRECTORY_SEPARATOR;
	$result = 1;
	if (!isset($_POST['userId'])) $result = 0;
	if (!isset($_POST['name'])) $result = 0; else $myfile = $_POST['name'];
    if (!isset($_POST['path'])) $result = 0; else {$path = $_POST['path']; if(substr($path,-1) != "/")$path .= "/";}
	if (!isset($_FILES[$myfile]['tmp_name'])) $result = 0;
	if (!isset($_FILES[$myfile]['name'])) $result = 0;
	if (!isset($_FILES[$myfile]['error'])) {
	$error = $_FILES[$myfile]['error'];
	switch($error){
		case 0 :
		$error = '';
		break;    
		case 1 : case 2 :
		$error = 'занадто великий файл!'; $result = 0;
		break;
		case 3 :
		$error = 'файл завантажено частково'; $result = 0;
		break;
		case 4 :
		$error = 'файл не завантажено!'; $result = 0;
	}
	}
   
	if (result){
		$filename = time().'__'.$_POST['userId']. '__'. basename( $_FILES[$myfile]['name']);
		//$target_path = $destination_path .$path. $filename;
		$target_path = 'files/'. $filename;
		if(@move_uploaded_file($_FILES[$myfile]['tmp_name'], $target_path)) $result = 1;//!!!
		sleep(1);
		$resultData['data'] = $path.$filename;
		$resultData['error'] = false;
	} else {
		$resultData['data'] = $error;
		$resultData['error'] = true;
	}
	
echo json_encode($resultData);

?>