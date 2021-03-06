<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple FTP Upload Script using PHP by 2netlodge</title>
</head>

<body>

<?php
	
$ftp_server = "localhost";
$ftp_user_name = "test";
$ftp_user_pass = "";
$destination_file = "/ftp". $_FILES["file"]["name"]; 
$source_file = $_FILES["file"]["tmp_name"]; 

$conn_id = ftp_connect($ftp_server) or die("Can't connect to server");


$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 

// check connection
if ((!$conn_id) || (!$login_result)) { 
    echo "FTP connection has failed!";
    echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
    exit; 
} else {
    echo "Connected to $ftp_server, for user $ftp_user_name";
}

ftp_pasv($conn_id, true);


if ($_FILES["file"]["error"] > 0)
    {
        echo "Error: " . $_FILES["file"]["error"] . "<br>";
    }
else
    {
        echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        echo "Type: " . $_FILES["file"]["type"] . "<br>";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "Stored in: " . $_FILES["file"]["tmp_name"]. "<br>";

    }



$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY); 


if (!$upload) { 
echo "FTP upload has failed!";
} else {
echo "Uploaded $source_file to $ftp_server as $destination_file";
}

ftp_close($conn_id);
?>

</body>
</html>