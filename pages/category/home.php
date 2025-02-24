



<div class="container mt-5">
    <div class="d-flex justify-content-between">
    <h1>Category List</h1>
    <div> <a href="./?page=category/create" class="btn btn-sm btn-success">Add Category</a></div>
   
    </div>

    <div class="card">
    <div class="card-body">
        
    <table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
       
       
        
    </tr>
    
    <?php
    $manage_category = getCategories();
    if($manage_category !== null){
        while ($row = $manage_category->fetch_object()){
            ?>       
        
            <tr>
                <td> <?php echo $row->id_category?></td>
                <td> <?php echo $row->name?></td>
                <td> <?php echo $row->slug?></td>
                
                
                <td> <a class="btn btn-primary" href="./?page=category/update&id=<?php echo $row->id_category ?>">Update</a>
                    <a class="btn btn-danger" href="./?page=category/delete&id=<?php echo $row->id_category ?>" >Delete</a>
            
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
