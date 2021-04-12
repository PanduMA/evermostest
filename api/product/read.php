<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$product = new Product($db);

// query products
$stmt = $product->readAll();
// $stmt = $product->findById(1);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
  
    // products array
    $products_arr=array();
    $products_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $product_item=array(
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "price_discount" => $price_discount,
            "stok" => $stok,
            "category_id" => $category_id,
            "created_at" => $created_at,
            "updated_at" => $updated_at
        );
  
        array_push($products_arr["data"], $product_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($products_arr);
}else{
    // set response code - 200 OK
    http_response_code(200);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>