<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class blog
{
    private $db;
    public $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_blog($data, $files)
    {

        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $category = mysqli_real_escape_string($this->db->link, $data['category_post']);
        $desc = mysqli_real_escape_string($this->db->link, $data['desc']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);

        //kiem tra hinh anh va cho vao forder upload
        $permited = array('jpg', 'png', 'gif', 'jpeg');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($title == "" || $category == "" || $desc == "" || $content == "" ||  $status == "" || $file_name == "") {
            $alert = "<span class='error'> Fields not must be empty </span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_blog(title_blog,description,content,category_post,image,status) VALUES ('$title',
            '$desc','$content','$category','$unique_image','$status')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'> Insert Blog Successfully </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Insert Blog Not Success </span>";
                return $alert;
            }
        }
    }

    public function show_blog()
    {
        $query = "SELECT tbl_blog.*, tbl_category_post.title
        FROM tbl_blog INNER JOIN tbl_category_post ON tbl_category_post.id_cate_post = tbl_blog.category_post
        ORDER BY tbl_blog.id DESC";


        $result = $this->db->select($query);
        return $result;
    }

    public function get_blog_id($id)
    {
        $query = "SELECT * FROM tbl_blog WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_blog($data, $files, $id)
    {

        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $category = mysqli_real_escape_string($this->db->link, $data['category_post']);
        $desc = mysqli_real_escape_string($this->db->link, $data['desc']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);
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


        if ($title == "" || $category == "" || $desc == "" || $content == "" ||  $type == "") {
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
                $query = "UPDATE tbl_blog SET
                    title_blog = '$title',
                    category_post = '$category',
                    status = '$type',
                    content = '$content',
                    image = '$unique_image',
                    description = '$desc'
                    WHERE id = '$id'";
            } else {
                //neu nguoi dung khong chon anh
                $query = "UPDATE tbl_blog SET
                title_blog = '$title',
                category_post = '$category',
                status = '$type',
                content = '$content',
                description = '$desc'
                WHERE id = '$id'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'> Blog Updates Successfully </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Blog Updates Not Success </span>";
                return $alert;
            }
        }
    }
    public function del_blog($id)
    {
        $query = "DELETE FROM tbl_blog WHERE id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'> Blog Delete Successfully </span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Blog Delete Not Success </span>";
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
}
?>




