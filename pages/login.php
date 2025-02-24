<?php
$username_err = $password_err = '';
if(isset($_POST['username']) && isset($_POST['password'])){
    
    $username =$_POST['username'];
    $password =$_POST['password'];

    if(usernameExists($username)){
        if (logUserIn($username,$password))   {
            
                header('Location: ./?page=dashboard');
            }else{
             $password_err = 'Password not match';
            }
        }else{
            $username_err = 'Username not found';
        }
    }
 
?>       
<form action="./?page=login" method="post" class="w-50 mx-auto">
    <h1>Login Form</h1>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" 
               name="username" 
               class="form-control <?php echo $username_err !== '' ? 'is-invalid' : ''; ?>" 
               id="username" 
               value="<?php echo isset($_POST['username']) ?($_POST['username']) : ''; ?>">
       
        <div class="invalid-feedback">
        <?php if ($username_err): ?>
            Username not found. <?php echo $username_err ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" 
               name="password" 
               class="form-control <?php echo $password_err !== '' ? 'is-invalid' : ''; ?>" 
               id="password" value ="<?php echo isset($_POST['username']) ?($_POST['username']) : ''; ?>">
        
        <div class="invalid-feedback">
        <?php if ($password_err): ?>
            Password does not match. <?php echo $password_err ?>
        </div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>


          
        

           
    

      





