<!-- BLOCK#1 START DON'T CHANGE THE ORDER-->
<?php
$title = "Home | SLGTI";

include_once("head.php");
include_once("menu.php");

$u_n = $_SESSION['user']['username'];
$u_t = $_SESSION['user']['user_type'];
$u_p = $_SESSION['user']['profile'];



// Only admin allowed
if ($_SESSION['user']['user_type'] !== 'admin') {
    die("Access denied");
}

if (!isset($_GET['id'])) {
    die("No user ID provided");
}

$user_id = intval($_GET['id']);
$result = mysqli_query($con, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found");
}

?>
<!--END DON'T CHANGE THE ORDER-->
<?php


?>




  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Drivers Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item ">Drivers Detail
              <?php
                  // echo  $Sdate = new DateTime("now", new DateTimeZone('Asia/Colombo'));
                  // date_default_timezone_set('UTC');

                  // // Get the current date and time
                  // $currentDateTime = date('Y-m-d H:i:s');
                  
                  // // Display the current date and time
                  // echo "Current Date and Time: " . $currentDateTime;
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


      <h2>Edit User Profile</h2>
<form method="post" action="update_user">
  <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

  <label>Username:</label>
  <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>

  <label>Email:</label>
  <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>

  <label>Phone:</label>
  <input type="tel" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required><br>

  <label>User Type:</label>
  <select name="user_type" required>
    <option value="admin" <?php if ($user['user_type'] == 'admin') echo 'selected'; ?>>Admin</option>
    <option value="ADM" <?php if ($user['user_type'] == 'ADM') echo 'selected'; ?>>ADM</option>
    <option value="user" <?php if ($user['user_type'] == 'user') echo 'selected'; ?>>User</option>
    <option value="driver" <?php if ($user['user_type'] == 'driver') echo 'selected'; ?>>Driver</option>
  </select><br>

  <label>Current Password (hashed):</label>
  <input type="text" value="<?php echo $user['password']; ?>" readonly><br>

  <input type="checkbox" id="change_pass" onchange="togglePassword()"> Change Password<br>

  <div id="new_pass_div" style="display:none;">
    <label>New Password:</label>
    <input type="password" name="new_password"><br>
  </div>

  <button type="submit" name="update_user">Update User</button>
</form>

<!-- Intl Tel Input -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

<script>
  const phoneInput = document.querySelector("#phone");
  const iti = window.intlTelInput(phoneInput, {
    initialCountry: "us",
    nationalMode: false,
    formatOnDisplay: true
  });

  document.querySelector("form").addEventListener("submit", function () {
    phoneInput.value = iti.getNumber();
  });

  function togglePassword() {
    const check = document.getElementById("change_pass");
    const div = document.getElementById("new_pass_div");
    div.style.display = check.checked ? "block" : "none";
  }
</script>



</div>
</div>
</div>
</div>
</section>


<!--BLOCK#3 START DON'T CHANGE THE ORDER-->
<?php include_once("footer.php"); ?>
<!--END DON'T CHANGE THE ORDER-->