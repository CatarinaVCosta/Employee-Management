<?php

$first_date = $_GET['first_date'];
$second_date = $_GET['second_date'];

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
      <h3 align="center">List of employee Salary between ' . $first_date . ' and ' . $second_date . '</h3><br /><br /><br />
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="50%"><strong>Name</strong></th>  
                <th width="50%"><strong>Salary(€)</strong></th>  
           </tr>  
      ';
$content .= output($first_date, $second_date);
$content .= '</table>';
$obj_pdf->writeHTML($content);
$obj_pdf->Output('sample.pdf', 'I');

function output($first_date, $second_date) {


    $conn = mysqli_connect("127.0.0.1", "root", "12345", "mydb");

    $res = mysqli_query($conn, "select * from employee where role=1");

    while ($row1 = mysqli_fetch_assoc($res)) {
        $output .= '<tr> <td>' . $row1['name'] . '</td>';
        $result = mysqli_query($conn, "select * from register where date >= '$first_date'  and date <='$second_date' and employeeID=" . $row1['id'] . ";");
        while ($row = mysqli_fetch_assoc($result)) {
            // echo $row['out'] . "   " . $row['entrance'];
            $out = strtotime($row['out']);
            $in = strtotime($row['entrance']);
            if ($out == "") {
                $in = 0;
                $out = 0;
            }

            $diff = abs($out - $in) / 3600;


            $res1 = mysqli_query($conn, "select t.salary_hour from task t, employee_schedule_task e where e.task_id=t.id and e.day ='" . $row['date'] . "' ;");

            while ($row = mysqli_fetch_assoc($res1)) {



                $salario += round($diff * $row['salary_hour'], 3);
            }
        }
        $output .= '<td>' . $salario . '</td> </tr>';
        $salario = 0;
    }
    return $output;
}
