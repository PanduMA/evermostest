<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';
include_once '../objects/product.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();

// initialize object
$product = new Product($db);
$order = new Order($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));


if (!empty($data->productid) && !empty($data->userid) && !empty($data->unit_order) && !empty($data->payment_method)) {
    $dataProduct = readProduct($product,$data->productid);
    if ($dataProduct) {
        if ($dataProduct->stok != 0) {
            // set product property values
            $order->product_id = $data->productid;
            $order->user_id = $data->userid;
            $order->unit = $data->unit_order;
            $order->notes = $data->notes;
            $order->price_condition = $data->price_condition;
            $order->price = $data->price_condition == 'disc' ? $dataProduct->price_discount : $dataProduct->price;
            $order->payment_method = $data->payment_method;
            $order->created_at = date('Y-m-d H:i:s');
            
            $stokUpdated = updateStok($product,$data,$dataProduct);
            if ($stokUpdated) {
                if($order->create()){
                    http_response_code(200);
                    echo json_encode(array("message" => "Succes create new order."));
                }else{ // if unable to create the order, tell the user
                    http_response_code(500);
                    echo json_encode(array("message" => "Unable to create order."));
                }
            }else {
                http_response_code(500);
                echo json_encode(array("message" => "Unable to create order."));
            }
        }else {
            http_response_code(200);
            echo json_encode(array("message" => "Product out of stock."));
        }
    }else {
        http_response_code(200);
        echo json_encode(array("message" => "Unable to create order. Product with id : ".$data->productid." not found."));
    }
}else {
    http_response_code(200);
    echo json_encode(array("message" => "Unable to create order. Incomplete data."));
}

function readProduct($product,$id){
    $product->id = $id;
    $product->readOne();
    return $product;
}

function updateStok($product,$data,$dataProduct){
    $product->id = $data->productid;
    $product->stok = (int)$dataProduct->stok-(int)$data->unit_order;

    return $product->update();
    // if($product->update()){
    //     return true;
    // }else{
    //     return false;
    // }
}
?>