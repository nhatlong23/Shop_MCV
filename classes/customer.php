<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class customer
{
    private $db;
    private $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function insert_comment()
    {
        $product_id = $_POST['product_id_comment'];
        $comment_Name = $_POST['comment_Name'];
        $comment = $_POST['comment'];
        if ($comment_Name == '' || $comment == '') {
            $alert = "<span class='error'> Các trường không được để trống </span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_comment(comment_Name,title_comment,product_id) VALUES ('$comment_Name',
            '$comment','$product_id')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'> Bình luận sẽ được kiểm duyệt </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Bình luận không thành công </span>";
                return $alert;
            }
        }
    }



    public function insert_customer($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" ||  $country == "" || $phone == "" || $password == "") {
            $alert = "<span class='error'> Fields must not be empty </span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if ($result_check) {
                $alert = "<span class='error'> Email đã tồn tại </span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password) VALUES ('$name',
            '$city','$zipcode','$email','$address','$country','$phone','$password')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'> Tạo tài khoản thành công </span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'> Tạo tài khoản không thành công </span>";
                    return $alert;
                }
            }
        }
    }


    public function login_customer($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if ($email == '' || $password == '') {
            $alert = "<span class='error'> Email và mật khẩu không được để trống </span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'LIMIT 1";
            $result_check = $this->db->select($check_email);
            if ($result_check != false) {
                $values = $result_check->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $values['id']);
                Session::set('customer_name', $values['name']);
                header('Location:index.php');
            } else {
                $alert = "<span class='error'> Tài khoản hoặc Email không trùng khớp </span>";
                return $alert;
            }
        }
    }

    public function show_customers($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_customers($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        if ($name == "" || $zipcode == "" || $email == "" || $address == "" || $phone == "") {
            $alert = "<span class='error'> Fields must be empty </span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_customer SET name = '$name',zipcode = '$zipcode',email = '$email',address = '$address',phone = '$phone'
            WHERE id = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'> Cập nhật thành công </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Cập nhật không thành công </span>";
                return $alert;
            }
        }
    }
}
?>