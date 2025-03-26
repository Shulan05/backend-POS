<?php
      function getProducts(){
        global $db;
        $query = $db->query("SELECT * FROM tbl_product");
       
        if($query->num_rows ){
           
    
            return $query;
        }
        return null;
}



function productNameExists($name)
{
    global $db;
    $query = $db->query("SELECT id_product FROM tbl_product WHERE name = '$name'");
    if ($query->num_rows) {
        return true;
    }
    return false;
}
function productSlugExists($slug)
{
    global $db;
    $query = $db->query("SELECT id_product FROM tbl_product WHERE slug = '$slug'");
    if ($query->num_rows) {
        return true;
    }
    return false;
}
function createProduct($name, $slug, $price, $short_desc, $long_desc, $image, $id_categories) {
    $img_name = $image['name'];
    $img_size = $image['size'];
    $tmp_name = $image['tmp_name'];
    $error = $image['error'];

    $dir = './assets/images/';
    $allow_exs = ['jpg', 'png', 'jpeg'];

    // Check for upload errors
    if ($error !== 0) {
        throw new Exception('Unknown error occurred');
    }

    // Check file size
    if ($img_size > 5000000) {
        throw new Exception('File size is too large');
    }

    // Get the file extension and check if it's allowed
    $image_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $image_lowercase_ex = strtolower($image_ex);
    if (!in_array($image_lowercase_ex, $allow_exs)) {
        throw new Exception('File extension is not allowed');
    }

    // Generate a unique image name
    $new_image_name = uniqid("PI-") . '.' . $image_lowercase_ex;
    $image_path = $dir . $new_image_name;

    // Move the uploaded file
    if (!move_uploaded_file($tmp_name, $image_path)) {
        throw new Exception('Failed to upload image');
    }

    global $db;
    $db->begin_transaction();
    try {
        // Prepare and bind the first insert statement (product)
        $query = $db->prepare("INSERT INTO tbl_product (name, slug, price, qty, short_desc, long_desc, image) VALUES (?, ?, ?, 0, ?, ?, ?)");
        $query->bind_param("ssdsss", $name, $slug, $price, $short_desc, $long_desc, $new_image_name);

        // Execute the product insertion
        if ($query->execute()) {
            $id_product = $query->insert_id;

            // Prepare and bind insert statements for categories
            $query1 = $db->prepare("INSERT INTO tbl_product_category (id_category, id_product) VALUES (?, ?)");
            $query1->bind_param("ii", $id_category, $id_product);

            // Insert categories
            foreach ($id_categories as $id_category) {
                $query1->execute();
            }

            // Commit transaction
            $db->commit();
            return true;
        } else {
            throw new Exception('Failed to insert product');
        }
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $db->rollback();
        return false;
    }
}

      

       function getProductByID($id){
        global $db;
    
        $query = $db->query(" SELECT * FROM  tbl_product WHERE id_product = '$id'");
        if ($query->num_rows){
            return $query->fetch_object();
        } 
        return null;
    }
    function updateProduct($id, $name,$slug,$price,$short_desc,$long_desc){
        global $db;
    
        
      
        $db->query("UPDATE tbl_product SET name = '$name' ,slug = '$slug',price ='$price',short_desc='$short_desc' ,long_desc = '$long_desc'WHERE id_product= '$id'");
        if($db-> affected_rows){
            return true;
        }
        return false;
    }
  
    function deleteProduct($id) {
        global $db;
        $product = getProductByID($id);
    
        // Check if product exists
        if (!$product) {
            return false;
        }
    
        // Construct the full path to the image
        $image_path = "assets/images/" . $product->image;
    
        // Delete product category reference first
        $db->query("DELETE FROM tbl_product_category WHERE id_product = '$id'");
    
        // Delete the product from the database
        $db->query("DELETE FROM tbl_product WHERE id_product = '$id'");
    
        // Check if the product was deleted successfully
        if ($db->affected_rows) {
            // Check if file exists before deleting
            if (!empty($product->image) && file_exists($image_path)) {
                unlink($image_path);
            }
            return true;
        }
    
        return false;
    }
    
    ?>
    
