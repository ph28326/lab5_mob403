<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// include db config file
require_once __DIR__ . '/db_config.php';

// connecting to db
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

// check for post data
if (isset($_GET["pid"])) {
    $pid = $_GET['pid'];

    // get a product from products table
    $result = mysqli_query($con, "SELECT * FROM products WHERE pid = $pid");

    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {

            $result = mysqli_fetch_array($result);

            $product = array();
            $product["pid"] = $result["pid"];
            $product["name"] = $result["name"];
            $product["price"] = $result["price"];
            $product["description"] = $result["description"];
            $product["created_at"] = $result["created_at"];
            $product["updated_at"] = $result["updated_at"];
            // success
            $response["success"] = 1;

            // product node
            $response["product"] = array();

            array_push($response["product"], $product);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}

// close database connection
mysqli_close($con);
?>