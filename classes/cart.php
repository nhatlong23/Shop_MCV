<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class cart
{
    private $db;
    private $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result["image"];
        $price = $result["price"];
        $productName = $result["productName"];


        $query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName)
         VALUES ('$id','$quantity','$sId','$image','$price','$productName')";

        $insert_cart = $this->db->insert($query_insert);

        if ($result) {
            header('Location:cart.php');
        } else {
            header('Location:404.php');
        }
    }

    public function get_product_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_quantity_Cart($quantity, $cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);

        $query = "UPDATE tbl_cart SET
        quantity = '$quantity'
        WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        if ($result) {
            header("Location:cart.php");
        } else {
            $msg = "<span class='error'>Sản phẩm không được thêm</span>";
            return $msg;
        }
    }
    public function del_product_cart($cartid)
    {
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'";
        $result = $this->db->delete($query);
        if ($result) {
            header("Location:cart.php");
        } else {
            $msg = "<span class='error'>Sản phẩm không được xóa</span>";
            return $msg;
        }
    }

    public function check_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }


    public function del_all_data_cart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertOrder($customer_id)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $get_product = $this->db->select($query);
        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productid = $result['productId'];
                $productName = $result['productname'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $customer_id = $customer_id;

                $query_order = "INSERT INTO tbl_order(productId,productname,quantity,price,image,customer_id)
                VALUES ('$productid','$productName','$quantity','$price','$image','$customer_id')";

                $insert_order = $this->db->insert($query_order);
            }
        }
    }

    public function getAmountPrice($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }


    public function get_cart_ordered($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }


    public function check_order($customer_id)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_inbox_cart()
    {
        $query = "SELECT * FROM tbl_order ORDER BY date_order";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }

    public function shifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET
        status = '1'
        WHERE id = '$id' AND date_order='$time' AND price = '$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='error'>Cập nhật thành công</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Cập nhật không thành công</span>";
            return $msg;
        }
    }


    public function del_shifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "DELETE FROM tbl_order
        WHERE id = '$id' AND date_order='$time' AND price = '$price'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<span class='error'>Xóa thành công</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Xóa không thành công</span>";
            return $msg;
        }
    }


    public function shifted_confirm($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET
        status = '2'
        WHERE customer_id = '$id' AND date_order='$time' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;
    }

    public function del_compare($customer_id)
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }
}
?>