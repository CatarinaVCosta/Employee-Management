<?php

require_once('tcpdf/tcpdf.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");
$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetAutoPageBreak(TRUE, 10);
$obj_pdf->SetFont('helvetica', '', 10);
$obj_pdf->AddPage();
$content .= '  
      <h3 align="center">List all students</h3><br /><br /><br />
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="12%"><strong>Name</strong></th>  
                <th width="12%"><strong>Ssn</strong></th>  
                <th width="12%"><strong>Birthdate</strong></th>  
                <th width="12%"><strong>Email</strong></th>  
                <th width="13%"><strong>Phone_Number</strong></th>  
                <th width="13%"><strong>Experience</strong></th>  
                <th width="12%"><strong>Address</strong></th>  
                <th width="12%"><strong>Role</strong></th>  
           </tr>  
      ';  
      $content .= output();  
      $content .= '</table>'; 
$obj_pdf->writeHTML($content);
$obj_pdf->Output('sample.pdf', 'I');

function output() {
    $conn = mysqli_connect("127.0.0.1", "root", "12345", "mydb");  
    $result = mysqli_query($conn, "select * from employee");

   //$output= '<table><tr><th class="col-md-2">Name</th><th class="col-md-1">SSN</th><th class="col-md-1">Birthdate</th><th class="col-md-2">Email</th><th class="col-md-1">Phone</th><th class="col-md-1">Experience</th><th class="col-md-1">Address</th><th class="col-md-1">Role</th><th class="col-md-1"></th><th class="col-md-1"></th></tr>';


    while ($row = mysqli_fetch_assoc($result)) {
             $output .= '<tr>  
                          <td>'.$row["name"].'</td>  
                          <td>'.$row["ssn"].'</td>  
                          <td>'.$row["birthdate"].'</td>  
                          <td>'.$row["email"].'</td>  
                          <td>'.$row["phone_number"].'</td> 
                          <td>'.$row["experience"].'</td> 
                         <td>'.$row["address"].'</td>
                         <td>'.$row["role"].'</td>    
                     </tr>  
                          ';  
    }
         
    
    return $output;
}
?>  
