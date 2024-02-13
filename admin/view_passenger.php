<!-- BLOCK#1 START DON'T CHANGE THE ORDER-->
<?php
$title = "Home | SLGTI";

include_once("head.php");
include_once("menu.php");

$u_n = $_SESSION['user']['username'];
$u_t = $_SESSION['user']['user_type'];
$u_p = $_SESSION['user']['profile'];

?>
<!--END DON'T CHANGE THE ORDER-->




<!--BLOCK#2 START YOUR CODE HERE -->
  <!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Jobs Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jobs Detail
              <?php
                  // echo  $Sdate = new DateTime("now", new DateTimeZone('Asia/Colombo'));
                 // date_default_timezone_set('Asia/Colombo');
                  // $date = date('d-m-y h:i:s');
                  // echo $date;
              ?>
              </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <!-- Main content -->
                  
    <section class="content mb-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-9">
          </div>
                <!-- /.col -->
          <div class="col-3">
              <a href="create_booking" class="btn btn-primary btn-block"> + Add</a>
          </div>
        </div>
      </div>
    </section>


                <?php
// Assuming you've already established a mysqli connection

// Execute the SELECT query
$query = "SELECT passenger.`p_id`,passenger.`passager_principal`,DATE_FORMAT(passenger.`date_de_prise_en_charge`, '%d-%b,%Y') AS formatted_date ,passenger.`Time`,type_mission.`type_m`,driver.`dname` 
FROM passenger ,type_mission,driver where passenger.`tm_id`=type_mission.`tm_id` and passenger.`d_id`=driver.`d_id` and  passenger.`Create_job_action`='created'  ORDER BY passenger.`date_de_prise_en_charge`";
$result = mysqli_query($con, $query);

if ($result) {
    $previous_date = null;
    while ($row = mysqli_fetch_assoc($result)) {
        $current_date = $row['formatted_date'];
        
        // If the date changes, start a new table
        if ($current_date !== $previous_date) {
            if ($previous_date !== null) {
                echo "</table>"; // Close previous table
                ?>
                </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->

       
         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->
     </div>
     <!-- /.container-fluid -->
   </section>
   <?php
            }
            
            // echo "$current_date";
        ?>
          <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color:#f4f6f9">
                <h2 class="card-title"><?php echo "$current_date"; ?></h2>
              </div>

              <div class="card-body">
                <table   class="example3 table table-bordered table-striped">
                  <thead>
                  <tr>
                    <!-- <th data-visible="false">Id</th> --> 
                    <th>Référence</th>
                    <!-- <th>Date</th> -->
                    <th>Time</th>
                    <th>Type de Mission</th>
                    <th>Passager Principal</th>
                    <th>Driver</th>
                    <th>Action</th>
                    <!-- <th data-visible="false">Create Date</th> -->
                  </tr>
                  </thead>
                  <?php
                    if(isset($_GET['delete_id']))
                    {                
                        $p_id = $_GET['delete_id'];
                        // Start a transaction
                        $con->begin_transaction();

                        // Define an array of table names
                        $tables = ["passenger", "option_desc", "passenger_description", "type_de_mission_desc"];

                        $success = true;

                        // Delete records from each table
                        foreach ($tables as $table) {
                            $sql = "DELETE FROM $table WHERE p_id = $p_id";
                            if ($con->query($sql) !== TRUE) {
                                $success = false;
                                break;
                            }
                        }

                        if ($success) {
                            // All deletes were successful
                            $con->commit(); // Commit the transaction
                            echo '<script>';
                            echo '
                            Swal.fire({
                               position: "top-end",
                           
                               icon: "success",
                               title: "Your Data Deleted!",
                               showConfirmButton: false,
                              
                               timer: 1500
                             }).then(function() {
                               // Redirect the user
                               window.location.href = "view_passenger";
                           
                               });
                            ';
                            echo '</script>';
                        } else {
                            // At least one delete operation failed, so we need to roll back the transaction
                            $con->rollback();
                            echo "Error deleting records from one or more tables: " . $con->error;
                        }

                      
                      }

                    ?>
                  <tbody>
        <?php
        }
        ?>
        
                    <tr>
                        <td><a href="create_passenger_action.php?get_id=<?= $row["p_id"]?>"><?= "PCL1000".$row['p_id']?></a></td>
                      
                        <td><?= $row['Time']?></td>
                        <td><?= $row['type_m']?></td>
                        <td><?= $row['passager_principal']?></td>
                        <td><?= $row['dname']?></td>
                        <!--  -->
                        <td>
                            <a href="create_booking.php?get_id=<?= $row["p_id"]?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                            <a href="print_invoice1.php?get_id=<?=$row["p_id"]?>" target="_blank" class="btn btn-success"><i class="fas fa-download"></i></a> 
                            <button  class="btn btn-danger" data-href="?delete_id=<?=$row["p_id"]?>" data-toggle="modal" data-target="#confirm-delete-passenger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    
                  
        <?php
        $previous_date = $current_date;
    }
    
    // Close the last table
    echo "</tbody>";
    echo "</tfoot>";
    echo "</table>";
    
    mysqli_free_result($result);
    ?>
                 </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <?php
} else {
    echo "Error: " . mysqli_error($con);
}

// Close the mysqli connection
mysqli_close($con);
?>


                
                
  
 
    <!-- /.content -->
  </div>

 
  <!-- /.content-wrapper -->

  <!-- /.content-wrapper -->



<!--BLOCK#2 end YOUR CODE HERE -->


<!--BLOCK#3 START DON'T CHANGE THE ORDER-->
<?php include_once("footer.php"); ?>
<!--END DON'T CHANGE THE ORDER-->