<?php
include_once("../../config.php");
if(isset($_POST['driver'])){
    $id = $_POST['driver'];

    $sql = "SELECT * FROM `driver`  WHERE `d_id` = '$id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        echo '<option  value="'.$row["d_id"].'" required>'.$row["dtp_num"].'</option>';
        }
    }else{
        echo '<option value="null"   selected disabled>-- No tp number --</option>';
    }
}





?>