<?php
if (!isset($_GET['id']) || getCategoryByID($_GET['id']) === null) {
    header('Location: ./?page=category/home');
   
}
$manage_category = getCategoryByID($_GET['id']);

$name_err = $slug_err = '';

// Assuming createUser() and usernameExists() are defined elsewhere
if (isset($_POST['name'], $_POST['slug'])) {
    $id_category = $_GET['id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
   

    // Validation
    if (empty($name)) {
        $name_err = "Name  is required!";
    }else {
        if ($name !== $manage_category-> name && categorySlugExists($name)) {
        $name_err = "Slug is already exists!";
         }
    }

    if (empty($slug)) {
        $slug_err = "Slug is required!";
    } else {
        if ($slug !== $manage_category-> slug && categorySlugExists($slug)) {
        $slug_err = "Slug is already exists!";
         }
    }

    // If no errors, proceed with user creation
    if (empty($name_err) && empty($slug_err)) {
        if (updateCategory($id_category,$name, $slug )) {
            echo '<div class="alert alert-success" role="alert">
            Category updated successfully ! 
            <a href="./?page=category/home" class="alert-link">Category List</a>
          </div>';
            // Reset form inputs after successful creation
            $name_err = $slug_err  = '';
            unset($_POST['name'], $_POST['slug']);
           
    
        } else {
            echo '<div class="alert alert-danger" role="alert">Category cannot be updated!</div>';
        }
    }
}


?>




<form action="./?page=category/update&id=<?php echo $manage_category->id_category ?>" method="post" class="w-50 mx-auto">
    <h1>Update Category ID: <?php echo ($manage_category->id_category); ?></h1>

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" 
               name="name" 
               class="form-control <?php echo $name_err !== '' ? 'is-invalid' : '' ?>" 
               id="name" 
               value="<?php echo isset ($_POST['name']) ? $_POST['name'] : $manage_category->name ?>">
       
            <div class="invalid-feedback">
                <?php echo $name_err ?>
            </div>
      
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" 
               name="slug" 
               placeholder="(optional) input slug to update"
               class="form-control <?php echo $slug_err !== ''? 'is-invalid' : '' ?>" 
               
               value="<?php echo isset($_POST['slug']) ?isset($_POST['slug']) : $manage_category->slug ?>">
       
            <div class="invalid-feedback">
                <?php echo $slug_err ?>
            </div>
        
    </div>

 

    <div class="d-flex justify-content-between">
        <a href="./?page=category/home" role="button" class="btn btn-secondary mt-3">Cancel</a>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </div>
</form>
