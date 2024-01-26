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
            <h1 class="m-0 text-dark">Jobs Cancel Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jobs Cancel Detail
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
                  
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div> -->
              <!-- /.card-header -->

              <div class="card-body">
              <!-- <div class="row">
                <div class="col-9">
                </div>
                <div class="col-3">
                    <a href="create_booking" class="btn btn-primary btn-block"> + Add</a>

                </div>
                </div>
                <br> -->

                <table id="example3"  class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <!-- <th data-visible="false">Id</th> --> 
                    <th>Référence</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Type de Mission</th>
                    <!-- <th>Passager Principal</th> -->
                    <th>Tarif</th>
                    <th>Action</th>
                    <!-- <th data-visible="false">Create Date</th> -->
                  </tr>
                  </thead>
                  <tbody>
               
                  <?php  
                    $sql="SELECT distinct passenger.`p_id`,passenger.`passager_principal`,passenger.`date_de_prise_en_charge`,passenger.`Time`,passenger.`Tarif`,type_mission.`type_m`,driver.`dname`,passenger.`Create_job_action` 
                    FROM passenger ,type_mission,driver where passenger.`tm_id`=type_mission.`tm_id` and passenger.`d_id`=driver.`d_id` and  passenger.`Create_job_action`='Cancel'";         
                    $res=$con->query($sql);
                    while($row=$res->fetch_assoc()){    
                            
                    ?>
                    <tr>
                        <td><a href="create_passenger_action.php?get_id=<?= $row["p_id"]?>"><?= "PCL1000".$row['p_id']?></td>
                        <td><?= $row['date_de_prise_en_charge']?></td>
                        <td><?= $row['Time']?></td>
                        <td><?= $row['type_m']?></td>
                        <!-- <td>< $row['passager_principal']?></td> -->
                        <td><?= $row['Tarif']?></td>

                        <td>
                            <a href="create_booking.php?get_id=<?= $row["p_id"]?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                            <a href="print_invoice1.php?get_id=<?=$row["p_id"]?>" target="_blank" class="btn btn-success"><i class="fas fa-download"></i></a> 
                            <!-- <button  class="btn btn-danger" data-href="?delete_id=<$row["p_id"]?>" data-toggle="modal" data-target="#confirm-delete-passenger"><i class="fas fa-trash"></i></button> -->
                        </td>

                        <!--  -->
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                  </tfoot>
                </table>
  
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
    <!-- /.content -->
  </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.content-wrapper -->



<!--BLOCK#2 end YOUR CODE HERE -->


<!--BLOCK#3 START DON'T CHANGE THE ORDER-->
<?php include_once("footer.php"); ?>
<!--END DON'T CHANGE THE ORDER-->