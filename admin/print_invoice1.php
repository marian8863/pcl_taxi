<?php

use Dompdf\Dompdf;
use Dompdf\Options;

// Include DOM Pdf autoload file
require_once 'dompdf/autoload.inc.php';
include '../config.php';
if(isset($_GET['get_id'])){
    $pid=$_GET['get_id'];

    $sql="SELECT 

    passenger.date_de_prise_en_charge,
    type_mission.type_m

    FROM passenger,type_mission
    WHERE  type_mission.tm_id=passenger.tm_id and
    
     passenger.p_id=$pid";
      $result = mysqli_query($con,$sql);
      if(mysqli_num_rows($result)==1) {       
          $row=mysqli_fetch_assoc($result);

          $date_de_prise_en_charge=$row['date_de_prise_en_charge'];
          $type_m=$row['type_m'];    
      }

}
// Include database connection file
//require_once "config.php";

 
    // $emp_id = $_POST['emp_id'];
    // $full_name = $_POST['full_name'];
    // $job_title = $_POST['job_title'];
    // $department = $_POST['department'];
    // $age = $_POST['age'];
    // $hire_date = $_POST['hire_date'];
    // $annual_salary = $_POST['annual_salary'];
    // $city = $_POST['city'];
    // $bonus = $_POST['bonus'];
    // $gender = $_POST['gender'];
    
    // // If New record than insert into database
    // $query ="INSERT INTO employees (emp_id, full_name, job_title, department, gender, age, hire_date, annual_salary, bonus, city) 
    // VALUES('$emp_id', '$full_name', '$job_title', '$department', '$gender', '$age', '$hire_date', '$annual_salary', '$bonus', '$city')";
    
    // $con->query($query);
    // $last_id = $con->insert_id; // Get last insert id 
    
    // // Get last insert data 
    // $sql = "SELECT * FROM employees WHERE id = '$last_id'";
    // $execute = $con->query($sql);
    // $row = $execute->fetch_array(MYSQLI_ASSOC); 
    // fetch last insert record from employee table

    //instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->set_Option('isRemoteEnabled', TRUE);

    $options = $dompdf->getOptions();
    $options->setDefaultFont('Courier');


    $dompdf->setOptions($options);

// $url = 'http://localhost/my_admin/admin/pdf_print.php?get_id=' . urlencode($pid);
$url = 'http://booking.pariscablimousine.fr/admin/pdf_print.php?get_id=' . urlencode($pid);


// Fetch the contents of the URL
$html = file_get_contents($url);


// $html .='';



// $html .= '<script>
// '.file_get_contents("").'
// </script>';

    
    // Load content from html file 
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF (1 = download and 0 = preview) 
    $dompdf->stream('('.$date_de_prise_en_charge.') -'.$type_m ,  array("Attachment" => 0));exit;


?>