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
            <h1 class="m-0 text-dark">Job verification Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Job verification Detail
              <?php
                  // echo  $Sdate = new DateTime("now", new DateTimeZone('Asia/Colombo'));
                //   date_default_timezone_set('Asia/Colombo');
                //   $date = date('d-m-y h:i:s');
                //   echo $date;
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
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">verification</h3>
            </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form method="POST">
                 <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                        <div class="form-group">
                            <label>Job verification</label>
                            <select class="form-control Type_select" style="width: 100%;" name="Create_job_action" id="Create_job_actionx">
                            <option value="null" selected disabled >---- Select the Type ---- </option>
                            <?php

if(isset($_GET['get_id'])){
    $pid=$_GET['get_id'];
    $sql="SELECT p_id,Create_job_action from passenger where p_id='$pid'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)==1) {       
        $row=mysqli_fetch_assoc($result);
        
        $Create_job_action=$row['Create_job_action'];
        if($row['Create_job_action'] =='created'){
?>
                            <option value="completed">Completed</option>
                            <option value="cancel">Cancel</option>
<?php
        }elseif($row['Create_job_action'] =='completed'){
?>
                            <option value="created">Go to Passenger</option>
                            <option value="cancel">Cancel</option>
<?php

        }elseif($row['Create_job_action'] =='cancel'){
?>
                            <option value="created">Go to Passenger</option>
                            <option value="completed">Completed</option>
<?php
        }
    }
}
?>

                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-block" value="+ Submit" name="add"> 
                      </div>
                    </div>
                  </div>
                </form>
                </div>

            <!-- /.card-body -->

        </div>
      <!-- /.card -->
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.content-wrapper -->



<!--BLOCK#2 end YOUR CODE HERE -->

<?php

if(isset($_POST['add'])){
  if(!empty($_POST['Create_job_action'])){

    $Create_job_action=$_POST['Create_job_action'];

  $sql='UPDATE  `passenger` set 
  `Create_job_action` ="'.$Create_job_action.'"

  where `p_id`="'.$pid.'"';

  if(mysqli_query($con,$sql)){
   
    //$message ="<h4 class='text-success' >Update successfully</h4>";
    if($row['Create_job_action'] =='created'){
    echo '<script>';
    echo '
    Swal.fire({
       position: "top-end",
   
       icon: "success",
       title: "Your Job has been '.$Create_job_action.'",
       showConfirmButton: false,
      
       timer: 1500
     }).then(function() {
       // Redirect the user
       window.location.href = "view_passenger";
   
       });
    ';
    echo '</script>';
  }elseif($row['Create_job_action'] =='completed'){
    echo '<script>';
    echo '
    Swal.fire({
       position: "top-end",
   
       icon: "success",
       title: "Your Job has been '.$Create_job_action.'",
       showConfirmButton: false,
      
       timer: 1500
     }).then(function() {
       // Redirect the user
       window.location.href = "view_passenger_action_completed";
   
       });
    ';
    echo '</script>';
  }elseif($row['Create_job_action'] =='cancel'){
    echo '<script>';
    echo '
    Swal.fire({
       position: "top-end",
   
       icon: "success",
       title: "Your Job has been '.$Create_job_action.'",
       showConfirmButton: false,
      
       timer: 1500
     }).then(function() {
       // Redirect the user
       window.location.href = "view_passenger_action_cancel";
   
       });
    ';
    echo '</script>';
  }

}else{
    echo "Error :-".$sql.
  "<br>"  .mysqli_error($con);
}
}



}
?>
<!--BLOCK#3 START DON'T CHANGE THE ORDER-->
<?php include_once("footer.php"); ?>
<!--END DON'T CHANGE THE ORDER-->