<?php
// Check if 'id' is set and if the cart exists
if (!isset($_GET['id']) || getCartByID($_GET['id']) === null) {
    header('Location: ./?page=cart/home');
    exit(); // stop execution after redirect
}

// Attempt to delete the cart
if (deleteCart($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">
        Cart has been deleted successfully! <a href="./?page=cart/home">Back to Cart List</a>
    </div>';
} else {
    echo '<div class="alert alert-danger" role="alert">
        Failed to delete cart! <a href="./?page=cart/home"> Cart List</a>
    </div>';
}
?>
