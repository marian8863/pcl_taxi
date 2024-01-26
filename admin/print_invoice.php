<?php

require_once 'plugins/dompdf/autoload.inc.php';

use Dompdf\Dompdf;


$dompdf =new Dompdf();


include '../config.php';

if(isset($_GET['get_id'])){
    $pid=$_GET['get_id'];
    $sql="SELECT passenger.passager_principal,passenger.contact_number,passenger.date_de_prise_en_charge,passenger.Time,passenger.adresse_du_pick_up,
    passenger.adresse_de_depose,passenger.nb_de_passager,passenger.d_id,passenger.Tarif,passenger.tm_id,passenger.whogiven,option_desc.op_desc,option_desc.op_question,passenger_description.passenger_select_quesntion,
    passenger_description.passenger_select_desc,type_de_mission_desc.type_desc,type_de_mission_desc.select_quesntion,driver.dname,driver.dtp_num,type_mission.type_m,vehicule.Vehicule_num
    
    
    from passenger ,option_desc,passenger_description ,type_de_mission_desc,driver,type_mission,vehicule
    
    WHERE passenger.p_id=option_desc.p_id and passenger.p_id=passenger_description.p_id and passenger.p_id=type_de_mission_desc.p_id and passenger.tm_id=type_mission.tm_id and passenger.d_id=driver.d_id and  passenger.Vehicule_num=vehicule.v_id and
    passenger.p_id=$pid";
      $result = mysqli_query($con,$sql);
      if(mysqli_num_rows($result)==1) {       
          $row=mysqli_fetch_assoc($result);
          $pp=$row['passager_principal'];
          $cn=$row['contact_number'];
          $dd=$row['date_de_prise_en_charge'];
          $tm=$row['Time'];
          $pu=$row['adresse_du_pick_up'];
          $dp=$row['adresse_de_depose'];
          $np=$row['nb_de_passager'];
          $dn=$row['d_id'];
          $dtn=$row['dtp_num'];
          $vn=$row['Vehicule_num'];
          $ta=$row['Tarif'];
          $op_d=$row['op_desc'];
          $tdm=$row['tm_id'];
          $op_q=$row['op_question'];
          $psq=$row['passenger_select_quesntion'];
          $psd=$row['passenger_select_desc'];
          $td=$row['type_desc'];
          $sq=$row['select_quesntion'];
          $wg=$row['whogiven'];
          $dnn=$row['dname'];
  
          
  
      }
  
  }
  

// $html_file_content=file_get_contents('passenger_pdf.php');
// $dompdf->loadHtml($html_file_content);

// $url = 'http://booking.pariscablimousine.fr/admin/passenger_pdf?get_id=' . urlencode($pid);
// //$url = 'http://localhost/my_admin/admin/passenger_pdf.php?get_id=' . urlencode($pid);

// $html_file_content = file_get_contents($url);
// $dompdf->loadHtml($html_file_content);

// $html_file_content="
// <h1>Jayanth</h1> .$pp.
// ";
// $dompdf->loadHtml($html_file_content);
// $dompdf->set_option('isPhpEnabled', true);

$dompdf->setPaper("A4", "portrait");

/**
 * Load the HTML and replace placeholders with values from the form
 */
$html = file_get_contents("passenger_pdf.php");

$html = str_replace(["{{ passager_principal }}", "{{ contact_number }}",
"{{ date_de_prise_en_charge }}", "{{ Time }}",
"{{ adresse_du_pick_up }}", "{{ adresse_de_depose }}",
"{{ nb_de_passager }}", "{{ op_desc }}",
"{{ dname }}", "{{ dtp_num }}",
"{{ Vehicule_num }}","{{ get_id }}","{{ Tarif }}"
], [$pp, $cn,$dd, $tm,$pu, $dp,$np, $op_d,$dnn, $dtn,$vn,$pid,$ta], $html);

$dompdf->loadHtml($html);



$dompdf->render();

$dompdf->stream('PCI-document-'.$pp.'.pdf',array('Attachment' =>0));
?>