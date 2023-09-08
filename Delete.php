<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        if (is_numeric($id)) {
            try {
                require 'DBConnect.php';
                $DELETE__SQL__QUERY  = "DELETE FROM `crud_operations` WHERE id =:id";
                $delete__statement = $con->prepare($DELETE__SQL__QUERY);
                $delete__statement->bindParam(':id', $id);
                $delete__statement->execute();
                $count = $delete__statement->rowCount();
                if ($count > 0) {
                    http_response_code(200);
                    $server__response__success = array(
                        "code" => http_response_code(),
                        "status" => true,
                        "message" => "Record has been deleted"
                    );
                    echo json_encode($server__response__success);
                } else {
                    http_response_code(404);
                    $server__response__error = array(
                        "code" => http_response_code(),
                        "status" => false,
                        "message" => "Unable to delete the record"
                    );
                    echo json_encode($server__response__error);
                }
            } catch (Exception $ex) {
                http_response_code(404);
                $server__response__error = array(
                    "code" => http_response_code(),
                    "status" => false,
                    "message" => "Exception! " . $ex->getMessage()
                );
                echo json_encode($server__response__error);
            }
        } else {
            http_response_code(404);
            $server__response__error = array(
                "code" => http_response_code(),
                "status" => false,
                "message" => "Invalid ID"
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
