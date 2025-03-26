



<div class="container mt-5">
    <div class="d-flex justify-content-between">
    <h1>Stock List</h1>
    <div> <a href="./?page=stock/create" class="btn btn-sm btn-success">Add Stock</a></div>
   
    </div>

    <div class="card">
    <div class="card-body">
        
    <table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Qty</th>
        <th>Date</th>
        <th>Action</th>
       
       
        
    </tr>
    
    <?php
    $manage_stocks = getStocks();
    if($manage_stocks !== null){
        while ($row = $manage_stocks->fetch_object()){
            ?>       
        
            <tr>
                <td> <?php echo $row->id_stock?></td>
                <td> <?php echo getProductByID($row->id_product)->name ?></td>
                <td> <?php echo $row->qty?></td>
                <td><?php echo $row-> date?></td>
                
                
                <td> <a class="btn btn-primary" href="./?page=stock/update&id=<?php echo $row->id_stock ?>">Update</a>
                    <a class="btn btn-danger" href="./?page=stock/delete&id=<?php echo $row->id_stock ?>" >Delete</a>
            
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
