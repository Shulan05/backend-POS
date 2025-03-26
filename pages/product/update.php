<?php
if (!isset($_GET['id']) || getProductByID($_GET['id']) === null) {
    header('Location: ./?page=product/home');
   
}
/* 
$id_product = $_GET['id']; */

$manage_product = getProductByID($_GET['id']);

$product_categories = getProductCategories($_GET['id']);

$id_product_categories = [];
if($product_categories!== null){
    while($row = $product_categories -> fetch_object()){
        $id_product_categories[] = $row->id_category;
    }
}



$name_err = $slug_err = $price_err= $short_desc_err=$long_desc_err='';

// Assuming createUser() and usernameExists() are defined elsewhere
if (isset($_POST['name'], $_POST['slug']) && isset($_POST['price']) && isset($_POST['short_desc']) && isset($_POST['long_desc']  ) && (isset($_FILES['image']))) {
    $id_product = $_GET['id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $price = $_POST['price'];
    $short_desc = $_POST['short_desc'];
    $long_desc = $_POST['long_desc'];
    $id_categories = isset($_POST['id_categories']) ? $_POST['id_categories'] : [];


    $image = $_FILES['image'];
  
    
    // Validation
    if (empty($name)) {
        $name_err = "Name  is required!";
    }else{
        if($name !== $manage_product->name && productNameExists($name)){
             
            $name_err = "Name already exists!";
        }
    }

    if (empty($slug)) {
        $slug_err = "Slug is required!";
    } else{
        if($slug!== $manage_product->slug && productSlugExists($slug)){
             
            $slug_err = "Slug already exists!";
        }

    }
    if (empty($price)) {
        $price_err = "Price is required!";
    
    }else{
        if($price<0){
            $price_err = 'Price must not be lower than zero';

        }
    }
    if (empty($short_desc)) {
        $short_desc_err = "Short Description is required!";
    }
    if (empty($long_desc)) {
        $long_desc_err = "Long Descriptin is required!";
    }
   



    // If no errors, proceed with user creation
    if (empty($name_err) && empty($slug_err)&& empty($price_err)&& empty($short_desc_err)&& empty($long_desc_err)) {
        try{
            if(updateProduct($id_product,$name, $slug,$price ,$short_desc,$long_desc,$image,$id_categories)) {

        
        

                $name_err = $slug_err = $price_err= $short_desc_err=$long_desc_err='';
                unset($_POST['name']);
                unset($_POST['slug']) ;
                unset($_POST['price']);
                unset($_POST['short_desc']) ;
                unset($_POST['long_desc']);
                unset($_POST['id_categories']) ;
    
                echo '<div class="alert alert-success" role="alert">
                Product successfully created! 
                <a href="./?page=product/home" class="alert-link">Product List</a>
              </div>';
        
            } else {
               
                    echo '<div class="alert alert-danger" role="alert">Product cannot be added!</div>';
              
        }
    }catch(Exception $th){
         $image_err = $th->getMessage();
            
        }
         
        }

        
            // Reset form inputs after successful creation
         
    }
    $product_categories = getProductCategories($_GET['id']);

$id_product_categories = [];
if($product_categories!== null){
    while($row = $product_categories -> fetch_object()){
        $id_product_categories[] = $row->id_category;
    }
}


?>





<form action="./?page=product/update&id=<?php echo $_GET['id']?>" method="post" class="w-50 mx-auto" enctype="multipart/form-data">

    <h1>Update Product</h1>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" 
               name="name" 
               class="form-control <?php echo $name_err !== '' ? 'is-invalid' : ''; ?>" 
               id="name" 
               value="<?php echo isset($_POST['name']) ?($_POST['name']) :$manage_product-> name ?>">
       
        <div class="invalid-feedback">
        <?php if ($name_err): ?>
            Name not found. <?php echo $name_err ?>
        </div>
        <?php endif; ?>
    </div>
    <div  class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" 
               name="slug" 
               class="form-control <?php echo $slug_err !== '' ? 'is-invalid' : ''; ?>" 
               id="slug" 
               value="<?php echo isset($_POST['slug']) ?($_POST['slug']) : $manage_product-> slug ?>">
       
        
        <?php if ($slug_err): ?>
            <div class="invalid-feedback">
            Slug not found. <?php echo $slug_err ?>
            </div>
        
        <?php endif; ?>
    </div>
    <div  class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" 
               name="price" 
               class="form-control <?php echo $price_err !== '' ? 'is-invalid' : ''; ?>" 
               id="price" 
               value="<?php echo isset($_POST['price']) ?($_POST['price']) : $manage_product-> price ?>">
       
        
        <?php if ($price_err): ?>
            <div class="invalid-feedback">
            Price not found. <?php echo $price_err ?>
            </div>
        
        <?php endif; ?>
    </div>
    <div  class="mb-3">
        <label for="short_desc" class="form-label">Short Description</label>
        <textarea name="short_desc" class="form-control <?php echo $short_desc_err !== '' ? 'is-invalid' : ''; ?>" id=""><?php echo isset($_POST['short_desc']) ?($_POST['short_desc']) : $manage_product-> short_desc
        ?></textarea>
        
       
        
        <?php if ($short_desc_err): ?>
            <div class="invalid-feedback">
            Short Description not found. <?php echo $short_desc_err ?>
            </div>
        
        <?php endif; ?>
    </div>
    
    <div  class="mb-3">
        <label for="long_desc" class="form-label">Long Description</label>
        <textarea name="long_desc" class="form-control <?php echo $long_desc_err !== '' ? 'is-invalid' : ''; ?>" id=""><?php echo isset($_POST['long_desc']) ?($_POST['long_desc']) : $manage_product-> long_desc?></textarea>
        
       
        
        <?php if ($long_desc_err): ?>
            <div class="invalid-feedback">
            Long Description not found. <?php echo $long_desc_err ?>
            </div>
        
        <?php endif; ?>
    </div>
    <div class="mb-3">
  <label for="product-image" class="form-label">Select Product Image</label>
  <input name="image" class="form-control <?php echo $image_err !== '' ? 'is-invalid' : ''; ?>" type="file" id="product-image"><?php echo isset($_POST['image']) ?($_POST['image']) : ''; ?></div>
        <div class="invalid-feedback">
            <?php echo $image_err?>
        </div>
        
</div>

    
    </div>   
    <div class="mb-3">
    <label for="">Category</label>
    <?php
    $manage_categories = getCategories();
    if ($manage_categories !== null) {
        while ($row = $manage_categories->fetch_object()) {
            $checked = in_array($row->id_category, $id_product_categories) ? 'checked' : ''; //  Fixed property name
            ?>       
            <div class="form-check">
                <input <?php echo $checked ?> name="id_categories[]" class="form-check-input" type="checkbox" 
                    value="<?php echo $row->id_category; ?>" id="flexCheckDefault_<?php echo $row->id_category; ?>">
                <label class="form-check-label" for="flexCheckDefault_<?php echo $row->id_category; ?>">
                    <?php echo $row->name; ?>
                </label>
            </div>
        <?php
        }
    }
    ?>
</div>

            
           <?php
        
        
    
    ?>
   
    </div>

    <div class="d-flex justify-content-between">
        <a href="./?page=product/home" role="button" class="btn btn-primary mt-3">Cancel</a>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </div>
</form>
