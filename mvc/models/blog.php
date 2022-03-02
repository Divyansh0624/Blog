<?php
require_once('DBcontroller.php');
class blog
{
    public $db_handle;
    function __construct()
    {
        $this->db_handle = new datacontroller();
    }
    function addblog($user_id, $blog_name, $blog)
    {
        $sql = "insert into `blog` (`user_id`, `blog_name`, `blog`) VALUES (?,?,?)";
        $param_type = "iss";
        $param_array = array(
            $user_id,
            $blog_name,
            $blog
        );
        $result = $this->db_handle->insert($sql, $param_type, $param_array);
        return $result;
    }
    function deleteblog($id)
    {
        $sql = "Delete from `blog` where id = ?";
        $param_type = "i";
        $param_array = array(
            $id
        );
        $this->db_handle->insert($sql, $param_type, $param_array);
    }
    function updateblog($blog_name, $blog, $id)
    {
        $sql = "Update `blog` set blog_name = ?, blog = ? where id = ?";
        $param_type = "ssi";
        $param_array = array(
            $blog_name,
            $blog,
            $id
        );
        $this->db_handle->update($sql, $param_type, $param_array);
    }
    function getuserblogs($id)
    {
        $sql = "select * from `blog` where user_id = ?";
        $param_type = "i";
        $param_array = array(
            $id
        );
        $result = $this->db_handle->runquery($sql, $param_type, $param_array);
        return $result;
    }
    function getblogbyid($id)
    {
        $sql = "select * from `blog` where id = ?";
        $param_type = "i";
        $param_array = array(
            $id
        );
        $result = $this->db_handle->runquery($sql, $param_type, $param_array);
        return $result;
    }
    function getallblog()
    {
        $sql = "select * from `blog`";
        $result = $this->db_handle->RunBaseQuery($sql);
        return $result;
    }
}