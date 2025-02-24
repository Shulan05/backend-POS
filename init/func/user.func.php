<?php
 function  usernameExists($username){
        global $db;
        $query = $db->query("SELECT id_user FROM tbl_users WHERE username = '$username'");
        //$db->close();
        if($query->num_rows ){
            return true;
        }

        return false;
    }
 

function logUserIn    ($username, $password){
        global $db;
        $query = $db->query("SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'");
        $db->close();
        if($query->num_rows ){
            $_SESSION['id_user'] = $query->fetch_object()->id_user;

            return true;
        }
        return false;
            
        
           
}

function LoggedInUser()
{
    global $db;
    if (isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
        $query = $db -> query("SELECT id_user , user_label FROM tbl_users WHERE id_user = '$id_user'");
        if($query->num_rows){
            return $query->fetch_object();
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function isAdmin(){
    global $db;
   
   if (isset($_SESSION['id_user'])){
    $id_user = $_SESSION['id_user'];
    $query = $db -> query(query: "SELECT level FROM tbl_users WHERE id_user = '$id_user' AND level ='Admin'");
    if($query->num_rows){
    
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
   }


?>

