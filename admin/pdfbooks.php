<?php

function fetch_data()
{
    $output = '';
$con = mysqli_connect("localhost","root","","library");
$sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblbooks.AuthorName, tblbooks.ISBNNumber, tblbooks.BookPrice, tblbooks.id as bookid FROM tblbooks JOIN tblauthors LEFT JOIN tblcategory on tblcategory.id=tblbooks.CatId LEFT JOIN tblauthor_tblbook on tblbooks.id=tblauthor_tblbook.book_id and tblauthors.id=tblauthor_tblbook.author_id";
$result = mysqli_query($con, $sql);
while($row= mysqli_fetch_array($result))

     {  
      $output .= '<tr>   
                          <td>'.$row["BookName"].'</td>  
                          <td>'.$row["CategoryName"].'</td> 
                          <td>'.$row["AuthorName"].'</td> 
                          <td>'.$row["ISBNNumber"].'</td>  
                          <td>'.$row["BookPrice"].'</td>  
                     </tr>  
                          ';  
      }  
      return $output;  
}
 if(isset($_POST["generate_pdf"]))  
 {  
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("NYANDARUA COUNTY ASSEMBLY");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .=
    '  
      <h4 align="center">N.C.A LIBRARY BOOKS</h4><br /> 
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           <th width="30%">Title</th>  
           <th width="20%">Category</th> 
           <th width="25%">Author</th>  
           <th width="10%">ISBN</th>  
           <th width="10%">Price</th> 
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      ob_clean();
      $obj_pdf->Output('file.pdf', 'I');
  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>N.C.A LIBRARY BOOKS</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
      </head>  
      <body>  
           <br />
           <div class="container">  
                <h4 align="center"> N.C.A LIBRARY BOOKS</h4><br />  
                <div class="table-responsive">  
                    <div class="col-md-12" align="right">
                     <form method="post">  
                          <input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" />  
                     </form>  
                     </div>
                     <br/>
                     <br/>
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="30%">Title</th>  
                               <th width="20%">Category</th> 
                               <th width="25%">Author</th>  
                               <th width="10%">Accession</th>  
                               <th width="10%">Price</th>  
                          </tr>  
                     <?php  
                     echo fetch_data();  
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
</html>