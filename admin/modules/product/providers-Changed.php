<?php

    require_once __DIR__. "/../../autoload/autoload.php";
    
    // This use to testing
    // if(isset($_POST['category_id'])) {
	// 	echo "<script>alert('Co Roi');</script>";
	// } else {
    //     echo "<script>alert('Chua co');</script>";
    // }

    $sql = "SELECT * FROM providers WHERE category_id = '". $_POST['category_id'] ."'";
    // $query ="SELECT * FROM demo_cities WHERE state_id = '" . $_POST["state_id"] . "'";

    $result = $db->fetchsql($sql);
    // $result = $mysqli->query($sql);
?>

    <option value=""> - Chọn nhà cung cấp - </option>
<?php  foreach($result as $item): ?>
    <option value="<?php echo $item['id'] ?>"><?php echo $item['name']; ?></option>
<?php endforeach; ?>