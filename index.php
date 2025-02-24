<?php


require_once('init/init.php');


include('includes/header.inc.php');
include('includes/navbar.inc.php');
if(  isset($_GET['page'])   ){
    $page = $_GET['page']; //about

    //if($page === 'logout'){
        //include('pages/' . $page. '.php');
    //}
   
    /* var_dump($after_login_pages); */
    $admin_pages = ['user/home','user/create','user/update','user/delete',
    'category/home','category/create','category/update','category/delete','product/home',
    'product/create',
    'product/update'
    ,'product/delete'];
    $user_pages =[];
    $before_login_pages =['login' ,'register'];
    $after_login_pages =['dashboard',
    ...$admin_pages //flat copy
  ];
    if(
        $page === 'logout' ||
         (in_array($page, $before_login_pages) && !LoggedInUser()) ||
     (in_array($page, $after_login_pages) && LoggedInUser())
     ){
        if(in_array($page, $admin_pages) && !isAdmin()){
            header('Location: ./');
        }

            include('pages/' . $page . '.php');

         }else{
            header ( 'Location: ./');
        }
   
     

    //if ((in_array($page, $before_login_pages) && LoggedInUser() === false)){
        //include('pages/' .$page. '.php');
    //}else if (in_array($page, $after_login_pages) && LoggedInUser()){
   


}else {


//if (isset($_GET['page']) && in_array($_GET['page'], $page_arr)) {
   // $page = $_GET['page']; // login
 //   include('./pages/' . $page . '.php');
 
    include('./pages/home.php');
}


include('includes/footer.inc.php');

$db->close();