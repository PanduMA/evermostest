<?php 
class Product {
    // database connection and table name
    private $conn;
    private $table_name = "products";
  
    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $price_discount;
    public $stok;
    public $category_id;
    public $created_at;
    public $updated_at;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    public function readAll(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function findById($id){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '$id' ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->name = $row['name'];
            $this->price = $row['price'];
            $this->description = $row['description'];
            $this->category_id = $row['category_id'];
            $this->price_discount = $row['price_discount'];
            $this->stok = $row['stok'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
        }
    }
    public function update()
    {
        // update query
        $query = "UPDATE " . $this->table_name . " SET name =:name, price =:price, description =:description,
                category_id =:category_id, price_discount=:price_discount, stok =:stok WHERE id =:id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->price_discount=htmlspecialchars(strip_tags($this->price_discount));
        $this->stok=htmlspecialchars(strip_tags($this->stok));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':price_discount', $this->price_discount);
        $stmt->bindParam(':stok', $this->stok);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}
?>
