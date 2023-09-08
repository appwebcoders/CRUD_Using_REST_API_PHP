<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['id'])) {
        $name = $_POST['name'];
        $emailID = $_POST['email'];
        $recordID = $_POST['id'];
        try {
            // Performing data selection using MYSQLi Driver.
            include 'MySQLiDBConnect.php';
            $UPDATE__SQL__QUERRY = "UPDATE
                                        `crud_operations`
                                    SET
                                        `name` = '$name',
                                        `email_id` = '$emailID',
                                        `updated_at` = NOW()
                                    WHERE
                                        id = '$recordID';";
            if (mysqli_query($con, $UPDATE__SQL__QUERRY)) {
                http_response_code(200);
                $server__response__success = array(
                    "code" => http_response_code(),
                    "status" => true,
                    "message" => "The entry has been successfully Updated to the database Using MYSQLi."
                );
                echo json_encode($server__response__success);
            } else {
                http_response_code(404);
                $server__response__error = array(
                    "code" => http_response_code(),
                    "status" => false,
                    "message" => "Failed to update the record to the database." . mysqli_error($con)
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
