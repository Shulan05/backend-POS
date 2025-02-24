<?php
$user_label_err = $username_err = $password_err = $confirm_password_err = '';

// Assuming createUser() and usernameExists() are defined elsewhere
if (isset($_POST['user_label'], $_POST['username'], $_POST['password'], $_POST['confirm_password'])) {
    $user_label = $_POST['user_label'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($user_label)) {
        $user_label_err = "User label is required!";
    }

    if (empty($username)) {
        $username_err = "Username is required!";
    } elseif (usernameExists($username)) {
        $username_err = "Username already exists!";
    }

    if (empty($password)) {
        $password_err = "Password is required!";
    }

    if (empty($confirm_password)) {
        $confirm_password_err = "Confirm Password is required!";
    } else if ($password !== $confirm_password) {
        $confirm_password_err = "Confirm Password does not match!";
    }

    // If no errors, proceed with user creation
    if (empty($user_label_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        if (createUser($user_label, $username, $password)) {
            // Reset form inputs after successful creation
            $user_label_err = $username_err = $password_err = $confirm_password_err = '';
            unset($_POST['user_label'], $_POST['username'], $_POST['password'], $_POST['confirm_password']);
            echo '<div class="alert alert-success" role="alert">
            User successfully created! 
            <a href="./?page=user/home" class="alert-link">User List</a>
          </div>';
    
        } else {
            echo '<div class="alert alert-danger" role="alert">User cannot be added!</div>';
        }
    }
}

?>




<form action="./?page=user/create" method="post" class="w-50 mx-auto">
    <h1>Create User</h1>
    <div class="mb-3">
        <label for="user_label" class="form-label">User Label</label>
        <input type="text" 
               name="user_label" 
               class="form-control <?php echo $username_err !== '' ? 'is-invalid' : ''; ?>" 
               id="user_label" 
               value="<?php echo isset($_POST['user_label']) ?($_POST['user_label']) : ''; ?>">
       
        <div class="invalid-feedback">
        <?php if ($user_label_err): ?>
            UserLabel not found. <?php echo $user_label_err ?>
        </div>
        <?php endif; ?>
    </div>
    <div  class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" 
               name="username" 
               class="form-control <?php echo $username_err !== '' ? 'is-invalid' : ''; ?>" 
               id="username" 
               value="<?php echo isset($_POST['username']) ?($_POST['username']) : ''; ?>">
       
        
        <?php if ($username_err): ?>
            <div class="invalid-feedback">
            Username not found. <?php echo $username_err ?>
            </div>
        
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" 
               name="password" 
               class="form-control <?php echo $password_err !== '' ? 'is-invalid' : ''; ?>" 
               id="password" value ="<?php echo isset($_POST['password']) ?($_POST['password']) : ''; ?>">
        
        
        <?php if ($password_err): ?>
            <div class="invalid-feedback">
            Password does not match. <?php echo $password_err ?>
            </div>
       
        <?php endif; ?>
        </div>
    <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input type="password" 
               name="confirm_password" 
               class="form-control <?php echo $confirm_password_err !== '' ? 'is-invalid' : ''; ?>" 
               id="confirm_password" value ="<?php echo isset($_POST['confirm_password']) ?($_POST['confirm_password']) : ''; ?>">
        
        
        <?php if ($confirm_password_err): ?>
            <div class="invalid-feedback">
            Cofirm Password does not match. <?php echo $confirm_password_err ?>
            </div>
            <?php endif; ?>
        
    </div>   
    <div class="d-flex justify-content-between">
        <a href="./?page=user/home" role="button" class="btn btn-primary mt-3">Cancel</a>
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </div>
</form>