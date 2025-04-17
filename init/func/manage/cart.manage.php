<?php
function addProductToCart($id_product)
{
    global $db;
    $cart = null;
    $user = LoggedInUser();

    // Check if the user has an existing pending cart
    $query = $db->prepare("SELECT * FROM tbl_cart WHERE id_user = ? AND status = 'pending'");
    $query->bind_param('i', $user->id_user);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows) {
        $cart = $result->fetch_object();
    } else {
        // Create a new cart if none exists
        $query = $db->prepare("INSERT INTO tbl_cart (id_user, status) VALUES (?, 'pending')");
        $query->bind_param('i', $user->id_user);
        $query->execute();

        if ($db->affected_rows) {
            $cart_id = $query->insert_id;
            $query = $db->prepare("SELECT * FROM tbl_cart WHERE id_cart = ?");
            $query->bind_param('i', $cart_id);
            $query->execute();
            $cart = $query->get_result()->fetch_object();
        }
    }

    if ($cart) {
        // Check if the product already exists in the cart
        $query = $db->prepare("SELECT * FROM tbl_cart_item WHERE id_cart = ? AND id_product = ?");
        $query->bind_param('ii', $cart->id_cart, $id_product);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows) {
            return true;
        }

        // Insert the product into the cart
        $query = $db->prepare("INSERT INTO tbl_cart_item (id_cart, id_product, qty) VALUES (?, ?, 1)");
        $query->bind_param('ii', $cart->id_cart, $id_product);
        $query->execute();

        if ($db->affected_rows) {
            return true;
        }
    }

    return null;
}
function getPendingCartProductCount() {
    global $db;
    $query = $db->prepare("SELECT * FROM tbl_cart_item INNER JOIN tbl_cart ON tbl_cart.id_cart = tbl_cart_item.id_cart WHERE status = 'pending'");
    $query->execute(); // Run the query
    $result = $query->get_result(); // Fetch result set
    return $result->num_rows; // Now you can get the row count
}

   
function getPendingCartDetails() {
    global $db;
    $query = $db->prepare("SELECT * FROM tbl_cart_item 
        INNER JOIN tbl_cart ON tbl_cart.id_cart = tbl_cart_item.id_cart 
        WHERE status = 'pending'");

    $query->execute(); // Execute the query
    $result = $query->get_result(); // Fetch result set

    if ($result->num_rows > 0) {
        return $result;
    }
    return null;
}
function deleteCart($id)
{
    global $db;

    // Begin transaction
    $db->begin_transaction();

    try {
        // 1. Delete cart items
        $stmt1 = $db->prepare("DELETE FROM tbl_cart_item WHERE id_cart = ?");
        $stmt1->bind_param("i", $id);
        if (!$stmt1->execute()) {
            throw new Exception("Failed to delete cart items");
        }
        $stmt1->close();

        // 2. Delete the cart
        $stmt2 = $db->prepare("DELETE FROM tbl_cart WHERE id_cart = ?");
        $stmt2->bind_param("i", $id);
        if (!$stmt2->execute()) {
            throw new Exception("Failed to delete cart");
        }
        $stmt2->close();

        // Commit transaction
        $db->commit();
        return true;
    } catch (Exception $e) {
        // Rollback on error
        $db->rollback();
        error_log("Failed to delete cart: " . $e->getMessage());
        return false;
    }
}
function getCartByID($id)
{
    global $db;
    $query = $db->prepare("SELECT * FROM tbl_cart WHERE id_cart = ?");
    $query->bind_param('i', $id);
    $query->execute();
    return $query->get_result()->fetch_object();
}








?>
