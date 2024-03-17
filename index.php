<?php

require_once 'vendor/autoload.php';

use App\MySQLHandler;

// Handle requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET request handling
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST request handling
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // PUT request handling
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // DELETE request handling
} else {
    http_response_code(405);
    echo json_encode(array("error" => "Method not allowed!"));
}
