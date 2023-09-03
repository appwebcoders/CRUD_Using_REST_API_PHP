<?php
$user_email = $_GET['email'];
// Performing data selection using PDO.
include 'DBConnect.php';
$SQL__SELECT__QUERY = "SELECT * FROM `crud_operations` WHERE email_id=:user_email;";
$select__record__statement = $con->prepare($SQL__SELECT__QUERY);
$select__record__statement->bindParam('user_email', $user_email, PDO::PARAM_STR);
$select__record__statement->execute();
$user__data = $select__record__statement->fetchAll(PDO::FETCH_ASSOC);
if ($user__data) {
    http_response_code(200);
    $server__response__success = array(
        "code" => http_response_code(),
        "status" => true,
        "message" => sizeof($user__data) . " Records Found",
        "data" => $user__data
    );
    echo json_encode($server__response__success);
} else {
    http_response_code(404);
    $server__response__error = array(
        "code" => http_response_code(),
        "status" => false,
        "message" => "No Records Found"
    );
    echo json_encode($server__response__error);
}
$con = null; // code database connection