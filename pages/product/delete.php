<?php
// Check if 'id' is set and if the user exists
if (!isset($_GET['id']) || getProductByID($_GET['id']) === null) {
    header('Location: ./?page=product/home');
   
}

// Attempt to delete the user
if (deleteProduct($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">Product has been deleted successfully! <a  href
    =" ./?page=product/home"> Product List</a></div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Failed to delete Product! <a  href
    ="./?page=product/home"></a >Product List</div>';
}
?>

