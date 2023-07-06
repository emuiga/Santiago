<?php

function fetch_data()
{
    $output = '';
    $con = mysqli_connect("localhost", "root", "", "library");
    $sql = "SELECT tblpatrons.FullName,tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid from  tblissuedbookdetails join tblpatrons on tblpatrons.PatronId=tblissuedbookdetails.PatronId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId ORDER BY tblissuedbookdetails.id desc";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result))
    
    {
        $output .= '<tr>   
                         
                          <td>' . $row["FullName"] . '</td> 
                          <td>' . $row["BookName"] . '</td>  
                          <td>' . $row["ISBNNumber"] . '</td> 
                          <td>' . $row["IssuesDate"] . '</td> 
                          <td>' . $row["ReturnDate"] . '</td>  
                     </tr>  
                          ';
    }
    return $output;
}
if (isset($_POST["generate_pdf"])) {
    require_once('tcpdf/tcpdf.php');
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("NYANDARUA COUNTY ASSEMBLY");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 11);
    $obj_pdf->AddPage();
    $content = '<h1 style="text-decoration:none;background-color:#2B7A0B;color:black;" align="center"> NYANDARUA COUNTY ASSEMBLY</h1>'
;
    $content .= '  
      <h4 align="center">N.C.A LIBRARY BOOK ISSUE</h4><br /> 
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
            
                <th width="20%">Patron Name</th>  
                <th width="20%">Book Name</th>  
                <th width="20%">ISBN</th> 
                <th width="15%">Issue Date</th>   
                <th width="10%">Return Date</th>  
           </tr>  
      ';
    $content .= fetch_data();
    $content .= '</table>';
    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('file.pdf', 'I');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>N.C.A LIBRARY BOOK ISSUE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>

<body>
    <br />
    <div class="container">
        <h4 align="center"> N.C.A LIBRARY BOOK ISSUE</h4><br />
        <div class="table-responsive">
            <div class="col-md-12" align="right">
                <form method="post">
                    <input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" />
                </form>
            </div>
            <br />
            <br />
            <table class="table table-bordered">
                <tr>
                
                <th width="20%">Patron Name</th>  
                <th width="20%">Book Name</th>  
                <th width="20%">Accession</th> 
                <th width="15%">Issue Date</th>   
                <th width="10%">Return Date</th>  
                </tr>
                <?php
                echo fetch_data();
                ?>
            </table>
        </div>
    </div>
</body>

</html>