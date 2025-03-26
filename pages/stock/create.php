<?php
$qty_err = $date_err = '';

// Assuming createUser() and userqtyExists() are defined elsewhere
if (isset($_POST['id_product'])&&isset($_POST['qty'])&&isset($_POST['date'])) {
    $id_product= $_POST['id_product'];
    $qty = $_POST['qty'];
    $date = $_POST['date'];


    // Validation
    if (empty($qty)) {
        $qty_err = "qty  is required!";
    } else {
        if ($qty <0) {
            $qty_err = "Qty already exists!";
        }
    }

    if (empty($date)) {
        $date_err = "Date is required!";
    }   

    
    // If no errors, proceed with user creation
    if (empty($qty_err) && empty($date_err)) {
        
        if (createStock(   $id_product,$qty, $date)) {
            // Reset form inputs after successful creation
            $qty_err = $date_err  = '';
            unset($_POST['id_product'],$_POST['qty'], $_POST['date']);
            echo '<div class="alert alert-success" role="alert">
          Stock successfully created!  
            <a href="./?page=stock/home" class="alert-link">stock List</a>
          </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Stock cannot be added!</div>';
        }
    }
}
?>




<form action="./?page=stock/create" method="post" class="w-50 mx-auto">
    <h1>Create Stock</h1>

    <div class="mb-3">
    <label for="qty" class="form-label">Product</label>
    <select name="id_product" id="" class="form-select">
        <?php
        $products = getProducts();
        if ($products !== null) {
            while ($row = $products->fetch_object()) {
        ?>
                <option value="<?php echo $row->id_product; ?>"><?php echo $row->name; ?></option>
                    
                
        <?php
            }
        }
        ?>
    </select>
</div>

    <div class="mb-3">
        <label for="qty" class="form-label">Qty</label>
        <input type="number"
            name="qty"
            class="form-control <?php echo $qty_err !== '' ? 'is-invalid' : ''; ?>"
            id="qty"
            value="<?php echo isset($_POST['qty']) ? ($_POST['qty']) : ''; ?>">

        <div class="invalid-feedback">
            <?php if ($qty_err): ?>
                Qty not found. <?php echo $qty_err ?>
        </div>
    <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date"
            name="date"
            class="form-control <?php echo $date_err !== '' ? 'is-invalid' : ''; ?>"
            id="date"
            value="<?php echo isset($_POST['date']) ? ($_POST['date']) : ''; ?>">


        <?php if ($date_err): ?>
            <div class="invalid-feedback">
                Date not found. <?php echo $date_err ?>
            </div>

        <?php endif; ?>
    </div>


    </div>
    <div class="d-flex justify-content-between">
        <a href="./?page=stock/home" role="button" class="btn btn-primary mt-3">Cancel</a>
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </div>
</form>