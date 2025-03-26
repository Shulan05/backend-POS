<?php
function getUsers(){
    global $db;
    $query = $db->query("SELECT id_user,user_label,level FROM tbl_users WHERE level = 'User'");
   
    if($query->num_rows ){
       

        return $query;
    }
    return null;
}
function createUser($user_label, $username, $password)
{
    global $db;
    $query = $db->prepare("INSERT INTO tbl_users(user_label,username,password,level) VALUES (?,?,?,'User')");
    $query->bind_param('sss', $user_label, $username, $password);
    $query->execute();
    if ($db->affected_rows) {
        return true;
    }
    return false;
}
function getUserByID($id){
    global $db;

    $query = $db->prepare(" SELECT id_user ,user_label ,level FROM  tbl_users WHERE id_user = ? AND level = 'User'");
    $query->bind_param('i', $id);
    $query->execute();
    $result = $query->get_result();
   
    if ($result->num_rows){
        return $result->fetch_object();
    } 
    return null;
}
/* function updateUser($id, $user_label , $username , $password){
    global $db;

    $username_query = empty($username) ? "":", username = '$username'"; */
   /*  if (empty($username)){
        $username_query = "";
    }else{
        $username_query = ", username = '$username'";
    }
    if (empty($password)){
        $password_query = "";
    }else{
        $password_query = ", password3 = '$password'";
    } */

  /*   $password_query = empty($password)? "" : " , password = '$password'";
  
    $db->query("UPDATE tbl_users SET user_label = '$user_label' " .$username_query. $password_query." WHERE id_user= '$id'");
    if($db-> affected_rows){
        return true;
    }
    return false;
} */
function updateUser($id, $user_label , $username , $password){
    global $db;

    
  
    $db->query("UPDATE tbl_users SET user_label = '$user_label' ,username = '$username' ,password ='$password' WHERE id_user= '$id'");
    if($db-> affected_rows){
        return true;
    }
    return false;
}
 
function deleteUser($id ){
    global $db;
    $query=$db->prepare("DELETE  FROM tbl_users WHERE id_user =?");
    $query->bind_param('i', $id);
    $query->execute();
    if($db-> affected_rows){
        return true;
    }
    return false;
}
    

