


<nav class="navbar navbar-expand-lg navbar-light ">
  <div class="container ">
    <a class="navbar-brand " href="./?page=home">Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <?php
  if(isAdmin()){

    ?>
      <li class="nav-item  dropdown">

  
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manage
  
 
    </a>
    <ul class="dropdown-menu">
    
        
    
      <li><a class="dropdown-item" href="./?page=user/home">User Account</a></li>
      <li><a class="dropdown-item" href="./?page=category/home">Category Page</a></li>
      <li><a class="dropdown-item" href="./?page=product/home">Product Page</a></li>
      <li><a class="dropdown-item" href="./?page=stock/home">Stock Page</a></li>
      <!--<li><hr class="dropdown-divider"></li>-->
    
      
    </ul>
    </li>
  <?php
  }
  ?>      

        <li class="nav-item  dropdown">

        
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo (!LoggedInUser() ? 'Account' : LoggedInUser()->user_label) ?>
           
          </a>
          <ul class="dropdown-menu">
            <?php if (!LoggedInUser()){?>
              
          
            <li><a class="dropdown-item" href="./?page=login">Login</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./?page=register">Register</a></li>
            <li><hr class="dropdown-divider"></li>
            <?php } else?>
          
            <li><a class="dropdown-item" href="./?page=logout">Logout</a></li>
            
          </ul>
        </li>
       
      </ul>
      
    </div>
  </div>
</nav>
 