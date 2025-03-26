<?php
// Check if 'id' is set and if the user exists
if (!isset($_GET['id']) || getStockByID($_GET['id']) === null) {
    header('Location: ./?page=stock/home');
   
}

// Attempt to delete the user
if (deleteStock($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">stock has been deleted successfully! <a  href
    =" ./?page=stock/home"> stock List</a></div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Failed to delete stock! <a  href
    ="./?page=stock/home"></a >stock List</div>';
}
?>

