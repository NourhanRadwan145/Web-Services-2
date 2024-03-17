<?php

require_once 'vendor/autoload.php';

use App\MySQLHandler;

// Instantiate MySQLHandler
$mysqlHandler = new MySQLHandler();

// Handle requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET request handling
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $item = $mysqlHandler->select($id);
        if($item) {
            echo json_encode($item);
        } else {
            http_response_code(404);
            echo json_encode(array("error" => "Resource doesn't exist"));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing item ID"));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST request handling
    $data = json_decode(file_get_contents("php://input"), true);
    if(!empty($data['name']) && !empty($data['price']) && !empty($data['units_in_stock'])) {
        // Assuming MySQLHandler has an insert method
        $result = $mysqlHandler->insert($data);
        if($result) {
            http_response_code(201);
            echo json_encode($result);
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Internal server error"));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Incomplete data"));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // PUT request handling
    parse_str(file_get_contents("php://input"), $data);
    if(isset($_GET['id']) && !empty($data['name']) && !empty($data['price']) && !empty($data['units_in_stock'])) {
        $id = $_GET['id'];
        // Assuming MySQLHandler has an update method
        $result = $mysqlHandler->update($id, $data);
        if($result) {
            echo json_encode(array("message" => "Item updated successfully"));
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Internal server error"));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Incomplete data or missing item ID"));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // DELETE request handling
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // Assuming MySQLHandler has a delete method
        $result = $mysqlHandler->delete($id);
        if($result) {
            echo json_encode(array("message" => "Item deleted successfully"));
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Internal server error"));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing item ID"));
    }
} else {
    http_response_code(405);
    echo json_encode(array("error" => "Method not allowed!"));
}

?>