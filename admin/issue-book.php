<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['issue']))
{

    //check here
$date = "$IssuesDate";
$IssuesDate=$_POST['IssuesDate'];
$ExpectedReturn = strtotime ( '30 day' , strtotime ( $date ) ) ;
$ExpectedReturn = date ( 'Y-m-j' , $ExpectedReturn );
$patronid=strtoupper($_POST['patronid']);
$bookid=$_POST['bookdetails'];
    $sql="INSERT INTO  tblissuedbookdetails(PatronID,BookId,ReturnStatus,ExpectedReturn) VALUES(:patronid,:bookid,0,ExpectedReturn)";
$query = $dbh->prepare($sql);
$query->bindParam(':patronid',$patronid,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Book issued successfully";
header('location:manage-issued-books.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:issue-book.php');
}

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>N.C.A Library Management System | Issue a new Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get patron name
function getpatron() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_patron.php",
data:'patronid='+$("#patronid").val(),
type: "POST",
success:function(data){
$("#get_patron_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

// function getbook() {
// $("#loaderIcon").show();
// jQuery.ajax({
// url: "get_book.php",
// data:'bookname='+$("#bookname").val(),
// type: "POST",
// success:function(data){
// $("#get_book_name").html(data);
// $("#loaderIcon").hide();
// },
// error:function (){}
// });
// }

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <center><h4 class="header-line">Issue a New Book</h4></center>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Issue a New Book
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Patron Id<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="patronid" id="patronid" onBlur="getpatron()" autocomplete="on"  required />
</div>

<div class="form-group">
<span id="get_patron_name" style="font-size:16px;"></span> 
</div>





<div class="form-group">
<label>Accession Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookid" id="bookid" onBlur="getbook()"  required="required" />
</div>

 <div class="form-group">

  <select  class="form-control" name="bookdetails" id="get_book_name" readonly>
   
 </select>
 </div>
<button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
