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
    .custom-field {
  font-size: 14px;
  position: relative;
  border-top: 20px solid transparent;
  --field-padding: 12px;
}
.custom-field::after {
  content: attr(aria-label);
}
.custom-field input {
  border: none;
  -webkit-appearance: none;
  -ms-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background: #f2f2f2;
  padding: 12px;
  border-radius: 3px;
  width: 250px;
  font-size: 14px;
  padding: var(--field-padding);
}
.custom-field .placeholder {
  position: absolute;
  left: 12px;
  bottom: 50%;
  top: 22px;  
  transform: translateY(-50%);
  width: calc(100% - 24px);  
  color: #aaa;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  left: var(--field-padding);
  width: calc(100% - (var(--field-padding) * 2));
  transition: 
    top 0.3s ease,
    color 0.3s ease,
    font-size 0.3s ease;
}
.custom-field input:not(:placeholder-shown) + .placeholder
.custom-field input:focus + .placeholder {
  top: -10px;
  font-size: 10px;
  color: #222;
}
textarea {
  width: 100%;
  height: 250px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
h3 {
  font-size: 50px;
  font-weight: 600;
  background: rgb(2,0,36);
background: chocolate;
  color: transparent;
  background-clip: text;
  -webkit-background-clip: text;
}
h4 {
  font-size: 30px;
  font-weight: 400;
  background: rgb(2,0,36);
background: #ffffff;
  color: transparent;
  background-clip: text;
  -webkit-background-clip: text;
}
button {
    border-radius: 5px;
    padding: 10px 32px;
  text-align: center;
}

button a {
    padding: 12px 12px;
    border: 5px solid #ED2939;
    border-radius: 5px;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 14px;
    color: #ffffff; 
    text-decoration: none;
    font-weight: bold;
    display: inline-block;  
}
</style>
<body style="background-color:#00610E;">
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <center><h3>
        N.C.A LIBRARY EMAIL
    </h3></center>
                
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
            &nbsp&nbsp&nbsp&nbsp<strong>Check Address</strong>&nbsp&nbsp&nbsp<label class="custom-field" aria-label=""><select name="checkmail" type="text" id="" style="padding: 10px; background-color:chocolate; border:none; border-radius: 0.25em;">
                    <?php
                    while ($rows = mysqli_fetch_array($result)) {
                        echo '<option value="' . $rows['tblpatrons'] . '">' . $rows["EmailId"] . '</option>';
                    }
                    ?>
                </select>
                </label><br><br>
            </form>

        </div>
         <form action="send.php" method="post">
<label class="custom-field" aria-label="">
&nbsp&nbsp&nbsp&nbsp<strong>Email</strong>&nbsp&nbsp <input type="email" name="email" required value="" size="35" placeholder="Enter patron email">
        </label> <br><br>
        <label class="custom-field" aria-label="">
        &nbsp&nbsp&nbsp&nbsp<strong>Subject</strong>&nbsp&nbsp <input type="text" name="subject" size="34" placeholder="Paste subject">
        </label><br><br>
        <div>
        <label class="custom-field" aria-label="">
        &nbsp&nbsp&nbsp&nbsp<strong>Message</strong></div> &nbsp&nbsp<textarea type="text" name="message" placeholder="Paste message" rows="10" cols="90"></textarea>
            </label><br><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" name="send">Send</button>
    </form>              

        <div class="contact-info">
            <h3>Select email template</h3>
            <p class="text" maxlength="100">
            <h4>Reminder Notice: Overdue Book</h4>
            <p>Dear [Patron's Name],</p>
            <p>We hope this email finds you well. This is a friendly reminder that you currently have an overdue book checked out from the NCA Library. The title of the book is [Book Title] and the due date for its return was 00/00/2023.</p>
            <p>We kindly ask that you return the book as soon as possible to avoid further charges. If you have any concerns or questions, please do not hesitate to contact us at <a href="https://nyandaruaassemblylibrary@gmail.com."  style="color:chocolate"> nyandaruaassemblylibrary@gmail.com.</a></p>
            <p>Thank you for your cooperation and for being a valued member of the NCA Library community.<br></p>
            <p>Sincerely,</p>
            <p>Librarian</p>
                </p>
            
            <p class="text">
            <h4>Notice of Charges: Lost Book</h4>
            <p>Dear [Patron's Name],</p>
            <p>We are writing to inform you that you are being charged for losing a book from the NCA Library. The title of the book is [Book Title] and the replacement cost of the book is [Replacement Cost].</p>
            <p>As per our policy, you will incur the replacement cost of the book.</p>

            <p>We understand that accidents can happen, and we would appreciate it if you could return or replace the book as soon as possible. If you have any questions or concerns, please do not hesitate to contact us at <a href="https://nyandaruaassemblylibrary@gmail.com."  style="color:chocolate"> nyandaruaassemblylibrary@gmail.com.</a></p> 
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
    <?php include('./footer.php'); ?>
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