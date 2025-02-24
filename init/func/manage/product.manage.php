<?php
      function getProducts(){
        global $db;
        $query = $db->query("SELECT * FROM tbl_product");
       
        if($query->num_rows ){
           
    
            return $query;
        }
        return null;
    }

    function  productNameExists($name){
        global $db;
        $query = $db->query("SELECT id_product FROM tbl_product WHERE name = '$name'");
        //$db->close();
        if($query->num_rows ){
            return true;
        }
    
        return false;
    }
    function  productSlugExists($slug){
            global $db;
            $query = $db->query("SELECT id_product FROM tbl_product WHERE slug = '$slug'");
            //$db->close();
            if($query->num_rows ){
                return true;
            }
    
            return false;
        }

        function createProduct($name, $slug,$price,$short_desc,$long_desc,$id_categories)
        {
            //tbl_product->id_product-> tbl_product_category
           global $db;
            $db->begin_transaction();

            try{
                $query = $db->prepare("INSERT INTO tbl_product (name, slug,price,qty,short_desc,long_desc) VALUES ('$name', '$slug','$price',0,'$short_desc','$long_desc')");
       
                if ($query->execute()) {
                     $id_product = $query-> insert_id;
                     foreach ($id_categories as $id_category){
                         $query1 = $db->prepare("INSERT INTO tbl_product_category (id_category,id_product) VALUES ('$id_category', '$id_product')");
                         $query1->execute();
                         
                     }
                     $db->commit();
                    return true;
                } 
                return false;
               
               
            
            } 
            catch(Exception $e){
                $db->rollback();

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
       function deleteProduct($id ){
        global $db;
        $db->query("DELETE  FROM tbl_product WHERE id_product ='$id'");
        if($db-> affected_rows){
            return true;
        }
        return false;
    }
?>