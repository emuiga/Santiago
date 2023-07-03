<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
</head>
<body>
    <!-- <form action="send.php" method="post">
        Email <input type="text" name="email" id=""> <br>
        Subject <input type="text" name="subject"><br>
        Message <input type="text" name="message"><br>
        <button type="submit" name="send">Send</button>
    </form> -->
    <?php
$con = mysqli_connect("localhost","root","","library");
$sql = "SELECT distinct EmailId from tblpatrons order by EmailId";
$result = mysqli_query($con, $sql);
?>
    <div>
        <form action="send.php" method="post" target="blank">
            Email <select name="email" type="text" id="">
                <?php
                while($rows = mysqli_fetch_array($result)){
                    echo '<option value="'.$rows['tblpatrons'].'">'.$rows["EmailId"].'</option>';
                }
                ?>
            </select><br>
            Email <input type="text" name="email"><br>
            Subject <input type="text" name="subject"><br>
            Message <input type="text" name="message"><br>
            <button type="submit" name="button">Send</button>
        </form>
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