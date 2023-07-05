<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {


?>
    <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>N.C.A Library Management System | Send Email</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<style>
body {
  background-image: url('/admin/assets/img/library-bg1.jpg');
}
</style>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <center><h2>
        N.C.A LIBRARY EMAIL
    </h2></center>
                
                            </div>
 
        <!-- <form action="send.php" method="post">
        Email <input type="text" name="email" id=""> <br>
        Subject <input type="text" name="subject"><br>
        Message <input type="text" name="message"><br>
        <button type="submit" name="send">Send</button>
    </form> -->
     
    <div class="contact-section">
        <div class="contact-section">

        <?php
    $con = mysqli_connect("localhost", "root", "", "library");
    $sql = "SELECT distinct EmailId from tblpatrons order by EmailId";
    $result = mysqli_query($con, $sql);
    ?>
    <div>
        <div>
            <form action="send.php" method="post">
                <strong>Check Address</strong>&nbsp&nbsp&nbsp<select name="checkmail" type="text" id="">
                    <?php
                    while ($rows = mysqli_fetch_array($result)) {
                        echo '<option value="' . $rows['tblpatrons'] . '">' . $rows["EmailId"] . '</option>';
                    }
                    ?>
                </select><br><br>
            </form>

        </div>
         <form action="send.php" method="post">
        <strong>Email</strong>&nbsp&nbsp <input type="text" name="email" value="" size="35" placeholder="Enter patron email"> <br><br>
        <strong>Subject</strong>&nbsp&nbsp <input type="text" name="subject" size="34" placeholder="Paste subject"><br><br>
        <div><strong>Message</strong></div> <br>&nbsp&nbsp<textarea type="text" name="message" placeholder="Paste message" rows="10" cols="90"></textarea><br><br>
        <button type="submit" name="send">Send</button>
    </form>              

        <div class="contact-info">
            <h3>Select email template</h3>
            <p class="text" maxlength="100">
            <h3>Reminder Notice: Overdue Book</h3>
            <p>Dear [Patron's Name],</p>
            <p>We hope this email finds you well. This is a friendly reminder that you currently have an overdue book checked out from the NCA Library. The title of the book is [Book Title] and the due date for its return was 00/00/2023.</p>
            <p>As the book is now overdue, you have been accumulating late fines. Please be advised that if the book is not returned within the next three working days, we will have to charge you the full replacement cost of the book in addition to the current late fees.</p>
            <p>We kindly ask that you return the book as soon as possible to avoid further charges. If you have any concerns or questions, please do not hesitate to contact us at <a href="https://nyandaruaassemblylibrary@gmail.com."  > nyandaruaassemblylibrary@gmail.com.</a></p>
            <p>Thank you for your cooperation and for being a valued member of the NCA Library community.<br></p>
            <p>Sincerely,</p>
            <p>Librarian</p>
                </p>
            
            <p class="text">
            <h3>Notice of Charges: Lost Book</h3>
            <p>Dear [Patron's Name],</p>
            <p>We are writing to inform you that you are being charged for losing a book from the NCA Library. The title of the book is [Book Title] and the replacement cost of the book is [Replacement Cost].</p>
            <p>As per our policy, you will incur the replacement cost of the book.</p>
            <p>Please note that if the book is not returned within 30 days,</p>
            <p>the book overdue fines will immediately start accumulating.</p>
            <p>We understand that accidents can happen, and we would appreciate it if you could return or replace the book as soon as possible. If you have any questions or concerns, please do not hesitate to contact us at <a href="https://nyandaruaassemblylibrary@gmail.com."  > nyandaruaassemblylibrary@gmail.com.</a></p> 
            <p>Thank you for your attention to this matter and for your continued support of the NCA Library.<br></p>
            <p>Sincerely,</p>
            <p>Librarian</p>
            </p>
            <img src="fox.png" alt="">
        </div>

    
        <!-- <form action="send.php" method="post">
             Email <input type="text" name="email" id="" placeholder="Enter patron email"> <br> -->
             <!-- <div class="block">
            <i class="fas fa-user"></i>
                <input type="text" name="email" placeholder="Enter patron email">
            </div>
             <div class="block">
                <i class="fas fa-envelope"></i>
                <input type="text" name="subject" placeholder="Paste subject">
            </div>
             <div class="block">
                <i class="fas fa-comment-alt"></i>
                <input type="text" name="message" placeholder="Paste message">
            </div>
            <button type="submit">Send message <i class="fas fa-paper-plane"></i></button>

            <p class="please-wait"></p>
            <p class="error"></p>
            <p class="success"></p>
        </form> -->
    <!-- </div>  -->
    <?php include('includes/footer.php'); ?>
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