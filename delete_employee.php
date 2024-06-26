<?php
include('dbconnection.php');

// Check if Product_Id is set
if(isset($_REQUEST['employee_code'])) {
    $pid = $_REQUEST['employee_code'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM employee WHERE employee_code=?");
    $stmt->bind_param("i", $pid);
     ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you ready to delete ");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
      echo "<script>alert('delete successfully.');</script>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "employee  id is not set.";
}

$connection->close();
?>
