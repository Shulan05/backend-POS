<?php
$name_err = $slug_err = '';

// Assuming createUser() and usernameExists() are defined elsewhere
if (isset($_POST['name'], $_POST['slug'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
   

    // Validation
    if (empty($name)) {
        $name_err = "Name  is required!";
    }else{
        if
        (categoryNameExists($name)) {
            $name_err = "Slug already exists!";
        }
    }

    if (empty($slug)) {
        $slug_err = "Slug is required!";
    } elseif (categorySlugExists($slug)) {
        $slug_err = "Slug already exists!";
    }

    // If no errors, proceed with user creation
    if (empty($name_err) && empty($slug_err)) {
        if (createCategory($name, $slug )) {
            // Reset form inputs after successful creation
            $name_err = $slug_err  = '';
            unset($_POST['name'], $_POST['slug']);
            echo '<div class="alert alert-success" role="alert">
            Category successfully created! 
            <a href="./?page=category/home" class="alert-link">Category List</a>
          </div>';
    
        } else {
            echo '<div class="alert alert-danger" role="alert">Category cannot be added!</div>';
        }
    }
}

?>




<form action="./?page=category/create" method="post" class="w-50 mx-auto">
    <h1>Create Category</h1>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" 
               name="name" 
               class="form-control <?php echo $name_err !== '' ? 'is-invalid' : ''; ?>" 
               id="name_label" 
               value="<?php echo isset($_POST['name_label']) ?($_POST['name_label']) : ''; ?>">
       
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
   
    
    </div>   
    <div class="d-flex justify-content-between">
        <a href="./?page=category/home" role="button" class="btn btn-primary mt-3">Cancel</a>
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </div>
</form>