<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['emailID'])) {
        $name = $_POST['name'];
        $email = $_POST['emailID'];
        try {
            // Performing data insertion using MySQLi.
            include 'MySQLiDBConnect.php';
            $SQL__INSERT__QUERY  =  "INSERT INTO `crud_operations`(
                                            `name`,
                                            `email_id`
                                        )
                                        VALUES(
                                            '$name',
                                            '$email'
                                        );";
            if (mysqli_query($con, $SQL__INSERT__QUERY)) {
                http_response_code(200);
                $server__response__success = array(
                    "code" => http_response_code(),
                    "status" => true,
                    "message" => "The entry has been successfully added to the database Using MYSQLi."
                );
                echo json_encode($server__response__success);
            } else {
                http_response_code(404);
                $server__response__error = array(
                    "code" => http_response_code(),
                    "status" => false,
                    "message" => "Failed to add the record to the database." . mysqli_error($con)
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
            "message" => "Invalid Parameters!!! Please try with valid parameters!"
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
