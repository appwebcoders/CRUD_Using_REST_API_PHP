<?php 
if($_SERVER['REQUEST_METHOD']==='POST'){

} else {
    http_response_code(404);
    $server__response__error = array(
        "code" => http_response_code(404),
        "status" => false,
        "message" => "Invalid Request"
    );
    echo json_encode($server__response__error);                                                                                                                                                                                            
}                                                           