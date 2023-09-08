<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get all update parameters
    if (!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['id'])) {
        $name = $_POST['name'];
        $emailID = $_POST['email'];
        $recordID = $_POST['id'];
        try {
            include 'DBConnect.php';
            $UPDATE__SQL__QUERRY = "UPDATE
                                        `crud_operations`
                                    SET
                                        `name` = :name,
                                        `email_id` = :emailID,
                                        `updated_at` = NOW()
                                    WHERE
                                        id = :recordID;";
            $update__record__statement = $con->prepare($UPDATE__SQL__QUERRY);
            $update__record__statement->bindParam(':name', $name, PDO::PARAM_STR);
            $update__record__statement->bindParam(':emailID', $emailID, PDO::PARAM_STR);
            $update__record__statement->bindParam(':recordID', $recordID);
            $update__record__statement->execute();
            $record__count = $update__record__statement->rowCount();
            if ($record__count > 0) {
                http_response_code(200);
                $server__response__success = array(
                    "code" => http_response_code(),
                    "status" => true,
                    "message" => "Record has been updated!!!"
                );
                echo json_encode($server__response__success);
            } else {
                http_response_code(404);
                $server__response__error = array(
                    "code" => http_response_code(),
                    "status" => false,
                    "message" => "Opps!!! Unable to update the record!!!"
                );
                echo json_encode($server__response__error);
            }
        } catch (Exception $ex) {
            http_response_code(404);
            $server__response__error = array(
                "code" => http_response_code(),
                "status" => false,
                "message" => "Somehting Went Wrong. Exception! " . $ex->getMessage()
            );
            echo json_encode($server__response__error);
        }
    } else {
        http_response_code(404);
        $server__response__error = array(
            "code" => http_response_code(),
            "status" => false,
            "message" => "Please check your parameters. You can try again or refer to the API documentation for additional information."
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
