<?php
// Check if 'id' is set and if the user exists
if (!isset($_GET['id']) || getCategoryByID($_GET['id']) === null) {
    header('Location: ./?page=category/home');
   
}

// Attempt to delete the user
if (deleteCategory($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">Category has been deleted successfully! <a  href
    =" ./?page=category/home"> Category List</a></div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Failed to delete category! <a  href
    ="./?page=category/home"></a >Category List</div>';
}
?>

