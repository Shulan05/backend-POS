



<div class="container mt-5">
    <div class="d-flex justify-content-between">
    <h1>User List</h1>
    <div> <a href="./?page=user/create" class="btn btn-sm btn-success">Add User</a></div>
   
    </div>

    <div class="card">
    <div class="card-body">
        
    <table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>USER_LABEL</th>
        <th>USERNAME</th>
        <th>PASSWORD</th>
        <th>LEVEL</th>
        <th>ACTION</th>
       
        
    </tr>
    
    <?php
    $manage_users = getUsers();
    if($manage_users !== null){
        while ($row = $manage_users->fetch_object()){
            ?>       
        
            <tr>
                <td> <?php echo $row->id_user?></td>
                <td> <?php echo $row->user_label?></td>
                <td> <?php echo $row->username?></td>
                <td> <?php echo $row->password?></td>
                <td> <?php echo $row->level?></td>
                
                <td> <a class="btn btn-primary" href="./?page=user/update&id=<?php echo $row->id_user ?>">Update</a>
                    <a class="btn btn-danger" href="./?page=user/delete&id=<?php echo $row->id_user ?>" >Delete</a>
            
            </td>
                
                
            </tr>
           <?php
        }
        
    }
    ?>
        
    


   
        </table>
    </div>
</div>
</div>
