<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['email'])) {
        $email = $_GET['email'];
        try {
            // Performing data selection using MYSQLi Driver with a specific condition.
            include 'MySQLiDBConnect.php';
            $SQL__SELECT__QUERY = "SELECT * FROM `crud_operations` Where email_id='$email';";
            $select_result = mysqli_query($con, $SQL__SELECT__QUERY);
            $user__data = mysqli_fetch_all($select_result);
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
            mysqli_close($con); // code database connection
        } catch (Exception $ex) {
            http_response_code(404);
            $server__response__error = array(
                "code" => http_response_code(),
                "status" => false,
                "message" => "Opps!!! Something went wrong " . $ex->getMessage()
            );
            echo json_encode($server__response__error);
        }
    } else {
        http_response_code(404);
        $server__response__error = array(
            "code" => http_response_code(),
            "status" => false,
            "message" => "Invalid Parameter! Please contact the API Administrator or refer to the documentation for clarification."
        );
        echo json_encode($server__response__error);
    }
} else {
    http_response_code(404);
    $server__response__error = array(
        "code" => http_response_code(),
        "status" => false,
        "message" => "Invalid Request"
    );
    echo json_encode($server__response__error);
}
