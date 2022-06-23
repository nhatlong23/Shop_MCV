<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class product
{
    private $db;
    public $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        //kiem tra hinh anh va cho vao forder upload
        $permited = array('jpg', 'png', 'gif', 'jpeg');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" ||  $type == "" || $file_name == "" || $title == "") {
            $alert = "<span class='error'> Fields must be empty </span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,type,image,title) VALUES ('$productName',
            '$brand','$category','$product_desc','$price','$type','$unique_image','$title')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'> Insert Category Successfully </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Insert Category Not Success </span>";
                return $alert;
            }
        }
    }

    public function show_product()
    {
        $query = "SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName 
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        ORDER BY tbl_product.productId DESC";


        $result = $this->db->select($query);
        return $result;
    }

    public function getproductbyid($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $id)
    {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        //kiem tra hinh anh va cho vao forder upload
        $permited = array('jpg', 'png', 'gif', 'jpeg');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;


        if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" ||  $type == "" || $title == "") {
            $alert = "<span class='error'> Fields must be empty </span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                //neu nguoi dung chon anh
                if ($file_size > 1048567) {
                    $alert = "<span class='error'> Image size should be less then 1Mb! </span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) == false) {
                    // echo"<span class='error'> You can upload only:-".implode(" ", $permited)."<\span>";
                    $alert = " <span class='error'> You can upload only:-" . implode(", ", $permited) . "</span>";
                    return $alert;
                }
                unlink("/uploads/$unique_image");
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    brandId = '$brand',
                    catId = '$category',
                    type = '$type',
                    price = '$price',
                    image = '$unique_image',
                    title = '$title',
                    product_desc = '$product_desc'
                    WHERE productId = '$id'";
            } else {
                //neu nguoi dung khong chon anh
                $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    brandId = '$brand',
                    catId = '$category',
                    type = '$type',
                    price = '$price',
                    title = '$title',
                    product_desc = '$product_desc'
                    WHERE productId = '$id'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'> Product Updates Successfully </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Product Updates Not Success </span>";
                return $alert;
            }
        }
    }
    public function del_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'> Product Delete Successfully </span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Product Delete Not Success </span>";
            return $alert;
        }
        return $result;
    }

    public function getcatbyId($id)
    {
        $query = "SELECT * FROM tbl_product WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    //END BACKEND
    public function get_product_feathered()
    {
        $query = "SELECT * FROM tbl_product WHERE type = '0'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_new()
    {
        $sp_tungtrang = 4;
        if (!isset($_GET['trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['trang'];
        }
        $tung_trang = ($trang - 1) * $sp_tungtrang;
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang,$sp_tungtrang ";
        $result = $this->db->select($query);
        return $result;
    }


    public function get_all_product()
    {
        $query = "SELECT * FROM tbl_product";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_details($id)
    {
        $query = "SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName 
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        WHERE tbl_product.productID = '$id'";

        // $query = "SELECT * FROM tbl_product ORDER BY productId desc";
        $result = $this->db->select($query);
        return $result;
    }


    public function getLastestDell()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastestOppo()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastestApple()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastestSamsung()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }


    public function getTopBrandSamSung()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId desc LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }


    public function getTopBrandApple()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId desc LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }


    public function getTopBrandDell()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId desc LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }


    public function get_Latest_Huawei()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '5' ORDER BY productId desc LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }


    public function get_Latest_Oppo()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId desc LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_slides()
    {
        $query = "SELECT * FROM tbl_slider WHERE type='0' ORDER BY sliderId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_slides_list()
    {
        $query = "SELECT * FROM tbl_slider ORDER BY sliderId desc";
        $result = $this->db->select($query);
        return $result;
    }


    public function update_type_slider($id, $type)
    {

        $type = mysqli_real_escape_string($this->db->link, $type);
        $query = "UPDATE tbl_slider SET type='$type' WHERE sliderId = '$id' ";
        $result = $this->db->update($query);
        return $result;
    }



    public function search_product($tukhoa)
    {
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%' ";
        $result = $this->db->select($query);
        return $result;
    }


    public function del_slider($id)
    {
        $query = "DELETE FROM tbl_slider WHERE sliderId = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'> Slider Delete Successfully </span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Slider Delete Not Success </span>";
            return $alert;
        }
        return $result;
    }

    public function insertCompare($productid, $customer_id)
    {
        $productid = mysqli_real_escape_string($this->db->link, $productid);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id = '$customer_id'";
        $result_check_compare = $this->db->select($check_compare);

        if ($result_check_compare) {
            $msg = "<span class='error'> Đã có trong danh sách so sánh </span>";
            return $msg;
        } else {
            $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
            $result = $this->db->select($query)->fetch_assoc();
            $productName = $result["productName"];
            $price = $result["price"];
            $image = $result["image"];
            $query_insert = "INSERT INTO tbl_compare(productId,price,image,customer_id,productName)
         VALUES ('$productid','$price','$image','$customer_id','$productName')";
            $insert_compare = $this->db->insert($query_insert);
            if ($insert_compare) {
                $alert = "<span class='success'> Đã thêm vào danh sách so sánh </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Chưa Thêm vào danh sách so sánh </span>";
                return $alert;
            }
        }
    }

    public function get_compare($customer_id)
    {
        $query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' ORDER BY id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_wishlist($customer_id)
    {
        $query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' ORDER BY id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertWishlist($productid, $customer_id)
    {
        $productid = mysqli_real_escape_string($this->db->link, $productid);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id = '$customer_id'";
        $result_check_wlist = $this->db->select($check_wlist);

        if ($result_check_wlist) {
            $msg = "<span class='error'> Đã có trong danh sách yêu thích </span>";
            return $msg;
        } else {

            $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result["productName"];
            $price = $result["price"];
            $image = $result["image"];


            $query_insert = "INSERT INTO tbl_wishlist(productId,price,image,customer_id,productName)
         VALUES ('$productid','$price','$image','$customer_id','$productName')";
            $insert_wlist = $this->db->insert($query_insert);

            if ($insert_wlist) {
                $alert = "<span class='success'> Đã thêm vào danh sách yêu thích </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Chưa Thêm vào danh sách yêu thích </span>";
                return $alert;
            }
        }
    }


    public function insert_slider($data, $files)
    {

        $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);


        //kiem tra hinh anh va cho vao forder upload
        $permited = array('jpg', 'png', 'gif', 'jpeg');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;


        if ($sliderName == "" || $type == "") {
            $alert = "<span class='error'> Fields must be empty </span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                //neu nguoi dung chon anh
                if ($file_size > 1048567) {
                    $alert = "<span class='error'> Image size should be less then 1Mb! </span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) == false) {
                    // echo"<span class='error'> You can upload only:-".implode(" ", $permited)."<\span>";
                    $alert = " <span class='error'> You can upload only:-" . implode(", ", $permited) . "</span>";
                    return $alert;
                }
                unlink("../admin/uploads/$unique_image");
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_slider(sliderName,type,slider_image) VALUES ('$sliderName',
                '$type','$unique_image')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'> Thêm thành công </span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'> Thêm không thành công </span>";
                    return $alert;
                }

                $result = $this->db->update($query);
                if ($result) {
                    $alert = "<span class='success'> Product Updates Successfully </span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'> Product Updates Not Success </span>";
                    return $alert;
                }
            }
        }
    }
}
?>




