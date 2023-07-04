<?php 
require_once("includes/config.php");
if(!empty($_POST["patronid"])) {
  $patronid= strtoupper($_POST["patronid"]);
 
    $sql ="SELECT FullName,Status FROM tblpatrons WHERE PatronId=:patronid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':patronid', $patronid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
if($result->Status==0)
{
echo "<span style='color:red'> Patron ID Blocked </span>"."<br />";
echo "<b>Patron Name-</b>" .$result->FullName;
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else {
?>


<?php  
echo htmlentities($result->FullName);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
  
  echo "<span style='color:red'> Invalid Patron Id. Please Enter Valid Id.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
