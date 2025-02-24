

<h1>About</h1>
<?php
    global $db;
    $query = $db->query("SELECT * FROM tbl_sell");

    var_dump($query->fetch_object());
?>


