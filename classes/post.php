<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class post
{
    private $db;
    private $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category_post($catName, $catDesc, $catStatus)
    {
        $catName = $this->fm->validation($catName);
        $catDesc = $this->fm->validation($catDesc);
        $catStatus = $this->fm->validation($catStatus);

        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catDesc = mysqli_real_escape_string($this->db->link, $catDesc);
        $catStatus = mysqli_real_escape_string($this->db->link, $catStatus);

        if (empty($catName) || empty($catDesc)) {
            $alert = "<span class='error'> Category must be empty </span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category_post(title,description,status) VALUES ('$catName','$catDesc','$catStatus')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'> Insert News Successfully </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Insert News Not Success </span>";
                return $alert;
            }
        }
    }


    public function show_category_post()
    {
        $query = "SELECT * FROM tbl_category_post ORDER BY id_cate_post desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category_post($catName, $catDesc, $catStatus, $id)
    {
        $catName = $this->fm->validation($catName);
        $catDesc = $this->fm->validation($catDesc);
        $catStatus = $this->fm->validation($catStatus);

        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catDesc = mysqli_real_escape_string($this->db->link, $catDesc);
        $catStatus = mysqli_real_escape_string($this->db->link, $catStatus);

        $id = mysqli_real_escape_string($this->db->link, $id);


        if (empty($catName) || empty($catDesc)) {
            $alert = "<span class='error'> Category must be empty </span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_category_post SET title = '$catName', description = '$catDesc', status = '$catStatus' WHERE id_cate_post = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'> Category Updates Successfully </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Category Updates Not Success </span>";
                return $alert;
            }
        }
    }


    public function del_category_post($id)
    {
        $query = "DELETE FROM tbl_category_post WHERE id_cate_post = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'> Category Post Delete Successfully </span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Category Post Delete Not Success </span>";
            return $alert;
        }
        return $result;
    }

    public function getcatbyId($id)
    {
        $query = "SELECT * FROM tbl_category_post WHERE id_cate_post = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_post_by_cat_id($id)
    {
        $query = "SELECT tbl_category_post.* FROM tbl_category_post
        WHERE tbl_category_post.id_cate_post = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }


    public function show_category_fondend()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId desc";
        $result = $this->db->select($query);
        return $result;
    }


    public function get_post_by_cat($id)
    {
        $query = "SELECT tbl_blog.*,tbl_category_post FROM tbl_blog,tbl_category_post
        WHERE tbl_blog.category_post = tbl_category_post.id_cate_post
        AND tbl_blog.category_post = '$id'";
        $result = $this->db->select($query);
        return $result;
    }


    public function get_name_by_cat($id)
    {
        $query = "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId FROM tbl_product,tbl_category
        WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}

?>