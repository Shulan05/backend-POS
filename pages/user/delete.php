<?php
// Check if 'id' is set and if the user exists
if (!isset($_GET['id']) || getUserByID($_GET['id']) === null) {
    header('Location: ./?page=user/home');
   
}

// Attempt to delete the user
if (deleteUser($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">User has been deleted successfully! <a  href
    =" ./?page=user/home"> User List</a></div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Failed to delete user! <a  href
    ="./?page=user/home"></a >User List</div>';
}
?>

