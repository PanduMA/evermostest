<?php 
class Order{
    // database connection and table name
    private $conn;
    private $table_name = "orders";
  
    // object properties
    public $id;
    public $user_id;
    public $product_id;
    public $unit;
    public $price_condition;
    public $payment_method;
    public $price;
    public $notes;
    public $created_at;
    public $updated_at;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET
            user_id=:user_id, product_id=:product_id, unit_order=:unit, price_condition=:price_condition,payment_method=:payment_method,
            notes=:notes, price=:price, created_at=:created_at";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
        $this->unit=htmlspecialchars(strip_tags($this->unit));
        $this->price_condition=htmlspecialchars(strip_tags($this->price_condition));
        $this->payment_method=htmlspecialchars(strip_tags($this->payment_method));
        $this->notes=htmlspecialchars(strip_tags($this->notes));
        $this->created_at=htmlspecialchars(strip_tags($this->created_at));

        // bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":unit", $this->unit);
        $stmt->bindParam(":price_condition", $this->price_condition);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":payment_method", $this->payment_method);
        $stmt->bindParam(":notes", $this->notes);
        $stmt->bindParam(":created_at", $this->created_at);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}
?>