<?php

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);
$category = $_GET['category'];

$user = $db->getHistory($category);    

if ($user != false) {
	
	if ($user->num_rows > 0) {
        // output data of each row
	    $response["data"]=array();
        while($row = $user->fetch_assoc()) {

	        $response["data"][]=array(
			    'id_category' => $row["id_category"],
			    'judul' => $row["judul"],
			    'tingkatan' => $row["tingkatan"],
			    'nilai' => $row["nilai"]
			);
        }
    } else {
	    $response["error"] = TRUE;
	    $response["error_msg"] = "Tidak ada data";
    }		    
    echo json_encode($response);
} else {
	$response["error"] = TRUE;
	$response["error_msg"] = "Tidak ada data";
    echo json_encode($response);
    }


?>