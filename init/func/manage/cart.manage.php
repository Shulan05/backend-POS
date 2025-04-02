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
?>
