<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>N.C.A Library Management System | Admin Dash Board</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
                <a href="https://drive.google.com/drive/folders/16UXx42261WcyAP_c5Ci34Luzshk-9-OC" class="btn btn-danger pull-right" target="blank">E-RESOURCES <i class="fa fa-book"></i></a>
            <div class="col-md-12">
                <h4 class="header-line" style="color:darkgreen ;">ADMIN DASHBOARD</h4>
                
                            </div>

        </div>
             
             <div class="row">

 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-success back-widget-set text-center">
                            <i class="fa fa-book fa-5x"></i>
<?php 
$sql ="SELECT id from tblbooks ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$listdbooks=$query->rowCount();
?>


                            <h3><?php echo htmlentities($listdbooks);?></h3>
                            <a href="manage-books.php" style="color:darkgreen ;">Books Listed</a>
                        </div>
                    </div>

            
                 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-info back-widget-set text-center">
                            <i class="fa fa-bars fa-5x"></i>
<?php
// // fetch file to download from database
// $sql = "SELECT * FROM  upload_files WHERE ID=$id";
// $result = mysqli_query($conn, $sql);

// $file = mysqli_fetch_assoc($result);
// $filepath = '../uploads/' . $file['NAME'];

// if (file_exists($filepath)) {
//     header('Content-Description: File Transfer');
//     header('Content-Type: application/octet-stream');
//     header('Content-Disposition: attachment; filename=' . basename($filepath));
//     header('Expires: 0');
//     header('Cache-Control: must-revalidate');
//     header('Pragma: public');
//     header('Content-Length: ' . filesize('../uploads/' . $file['NAME']));
//     readfile('../uploads/' . $file['NAME']);

//     // Now update downloads count
//     $newCount = $file['DOWNLOAD'] + 1;
//     $updateQuery = "UPDATE upload_files SET DOWNLOAD=$newCount WHERE ID=$id";
//     mysqli_query($conn, $updateQuery);
//     exit;
// } 
$status=0;
$sql1 ="SELECT id from tblissuedbookdetails where ReturnStatus=:status";
$query1 = $dbh -> prepare($sql1);
$query1->bindParam(':status',$status,PDO::PARAM_STR);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$issuedbooks=$query1->rowCount();
?>

                            <h3><?php echo htmlentities($issuedbooks);?> </h3>
                            <a href="manage-issued-books.php">Books Issued</a>
                        </div>
                    </div>
             
                   <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-warning back-widget-set text-center">
                            <i class="fa fa-recycle fa-5x"></i>
<?php 
$status=1;
$sql2 ="SELECT id from tblissuedbookdetails where ReturnStatus=:status";
$query2 = $dbh -> prepare($sql2);
$query2->bindParam(':status',$status,PDO::PARAM_STR);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$returnedbooks=$query2->rowCount();
?>

                            <h3><?php echo htmlentities($returnedbooks);?></h3>
                            <a href="manage-issued-books.php" style="color:saddlebrown;">Books Returned</a>
                        </div>
                    </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center">
                            <i class="fa fa-users fa-5x"></i>
                            <?php 
$sql3 ="SELECT id from tblpatrons ";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$regptrs=$query3->rowCount();
?>
                            <h3><?php echo htmlentities($regptrs);?></h3>
                            <a href="reg-patrons.php" style="color:brown ;">Registered Patrons</a>
                        </div>
                    </div>

        </div>



 <div class="row">

 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-success back-widget-set text-center">
                            <i class="fa fa-user fa-5x"></i>
<?php 
$sql4 ="SELECT id from tblauthors ";
$query4 = $dbh -> prepare($sql4);
$query4->execute();
$results4=$query4->fetchAll(PDO::FETCH_OBJ);
$listdathrs=$query4->rowCount();
?>


                            <h3><?php echo htmlentities($listdathrs);?></h3>
                            <a href="manage-authors.php" style="color:darkgreen ;">Publishers Listed</a>
                        </div>
                    </div>

            
                 <div class="col-md-3 col-sm-3 rscol-xs-6">
                      <div class="alert alert-info back-widget-set text-center">
                            <i class="fa fa-file-archive-o fa-5x"></i>
<?php 
$sql5 ="SELECT id from tblcategory ";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$listdcats=$query5->rowCount();
?>

                            <h3><?php echo htmlentities($listdcats);?> </h3>
                            <a href="manage-categories.php" style="color:cornflowerblue;">Listed Categories</a>
                        </div>
                    </div>
             

        </div>             





















             <div class="row">

              <div class="col-md-10 col-sm-8 col-xs-12 col-md-offset-1">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" >
                   
                    <div class="carousel-inner">
                        <div class="item active">

                            <img src="assets/img/1.jpg" alt="" />
                           
                        </div>
                        <div class="item">
                            <img src="assets/img/2.jpg" alt="" />
                          
                        </div>
                        <div class="item">
                            <img src="assets/img/3.jpg" alt="" />
                           
                        </div>
                    </div>
                    <!--INDICATORS-->
                     <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                    </ol>
                    <!--PREVIUS-NEXT BUTTONS-->
                     <a class="left carousel-control" href="#carousel-example" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
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
