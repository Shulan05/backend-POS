<?php
$name_err = $slug_err = $price_err= $short_desc_err=$long_desc_err='';

// Assuming createUser() and usernameExists() are defined elsewhere
if (isset($_POST['name'], $_POST['slug']) && isset($_POST['price']) && isset($_POST['short_desc']) && isset($_POST['long_desc']) /* && isset($_POST['id_categories']) */) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $price = $_POST['price'];
    $short_desc = $_POST['short_desc'];
    $long_desc = $_POST['long_desc'];
    $id_categories = isset($_POST['id_categories']) ?$_POST['id_categories']:[];
 

    // Validation
    if (empty($name)) {
        $name_err = "Name  is required!";
    }else{
        if
            (productNameExists($name)) {
            $name_err = "Name already exists!";
        }
    }

    if (empty($slug)) {
        $slug_err = "Slug is required!";
    } else{
        if (productSlugExists($slug)) {
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
    if (empty($slug)) {
        $slug_err = "Slug is required!";
    }
    // If no errors, proceed with user creation
    if (empty($name_err) && empty($slug_err)&& empty($price_err)&& empty($short_desc_err)&& empty($long_desc_err)) {
        if (createProduct($name, $slug,$price ,$short_desc,$long_desc,$id_categories)) {
            // Reset form inputs after successful creation
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
    }
}

?>




<form action="./?page=product/create" method="post" class="w-50 mx-auto">
    <h1>Create Product</h1>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" 
               name="name" 
               class="form-control <?php echo $name_err !== '' ? 'is-invalid' : ''; ?>" 
               id="name" 
               value="<?php echo isset($_POST['name']) ?($_POST['name']) : ''; ?>">
       
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
               value="<?php echo isset($_POST['slug']) ?($_POST['slug']) : ''; ?>">
       
        
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
               value="<?php echo isset($_POST['price']) ?($_POST['price']) : ''; ?>">
       
        
        <?php if ($price_err): ?>
            <div class="invalid-feedback">
            Price not found. <?php echo $price_err ?>
            </div>
        
        <?php endif; ?>
    </div>
    <div  class="mb-3">
        <label for="short_desc" class="form-label">Short Description</label>
        <textarea name="short_desc" class="form-control <?php echo $short_desc_err !== '' ? 'is-invalid' : ''; ?>" id=""><?php echo isset($_POST['short_desc']) ?($_POST['short_desc']) : ''; ?></textarea>
        
       
        
        <?php if ($short_desc_err): ?>
            <div class="invalid-feedback">
            Short Description not found. <?php echo $short_desc_err ?>
            </div>
        
        <?php endif; ?>
    </div>
    
    <div  class="mb-3">
        <label for="long_desc" class="form-label">Long Description</label>
        <textarea name="long_desc" class="form-control <?php echo $long_desc_err !== '' ? 'is-invalid' : ''; ?>" id=""><?php echo isset($_POST['long_desc']) ?($_POST['long_desc']) : ''; ?></textarea>
        
       
        
        <?php if ($long_desc_err): ?>
            <div class="invalid-feedback">
            Long Description not found. <?php echo $long_desc_err ?>
            </div>
        
        <?php endif; ?>
    </div>
   
    
    </div>   
    <div class="mb-3">
        <label for="">Category</label>
        <?php
    $manage_categories = getCategories();
    if($manage_categories !== null){
        while ($row = $manage_categories->fetch_object()){
            ?>       
        
        <div class="form-check">
        <input name="id_categories[]" class="form-check-input" type="checkbox" value="<?php echo $row->id_category; ?>" id="flexCheckDefault_<?php echo $row->id_category; ?>">
<label class="form-check-label" for="flexCheckDefault_<?php echo $row->id_category; ?>">
   <?php echo $row->name; ?>
</label>

</div>
            
           <?php
        }
        
    }
    ?>
   
    </div>

    <div class="d-flex justify-content-between">
        <a href="./?page=product/home" role="button" class="btn btn-primary mt-3">Cancel</a>
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </div>
</form>