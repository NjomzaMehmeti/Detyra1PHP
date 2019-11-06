<?php 
REQUIRE_ONCE(__DIR__.'/connect_database.php');


$connect->select_db("MyDatabase");

//check conn
if($connect === false){
    die("ERROR: Could not connect. " . $connect->connect_error);
}

$nm_error ="";
$mb_error = "";
$email_error="";
$tel="";
$message="";
$name="";
$surname="";
$email="";

if(!empty($_POST['sub'])){
   if(empty($_POST['em'])){
    $nm_error="Name is required";
   }
   if(empty($_POST['mb'])){
    $mb_error="Surname is required";
   }
 if(empty($_POST['email'])){

    $email_error="Email is required";
}

}


?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="designform.css">
    </head>
<h2>Informatat per perdoruesin</h2>

<form method="POST" action="forma.php">
Name:<br>
<input type="text" placeholder="Enter your name" name="em" value="<?php if(isset($_POST['em'])) echo $_POST['em'];?>"/>
<span><?php if(isset($nm_error)) {echo $nm_error;}  ?></span>
<br><br>
Surname:<br>
<input type="text" placeholder="Enter your surname" name="mb" value="<?php if(isset($_POST['mb'])) echo $_POST['mb'];?>"/> 
<span><?php if(isset($mb_error)) {echo $mb_error;}  ?></span>
<br><br>
Email:<br>
 <input type="email"  placeholder="Enter your email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"/>
 <span><?php if(isset($email_error)) {echo $email_error;}  ?></span>
<br><br>
Phone number:<br>
 <input type="text" placeholder="Your number" name="phonenr"value="<?php if(isset($_POST['phonenr'])) echo $_POST['phonenr'];?>"/>
<br><br>
Message:<br>
 <textarea name="txtarea"  placeholder="Write your message here" rows="5" cols="40"><?php if(isset($_POST['txtarea'])) echo $_POST['txtarea'];?></textarea>
<br><br>
<br>
 <input type="submit" name="sub"/>

</form>

</html>

<?php 

if(isset($_POST['em']))
$name = "Name: {$_POST['em']}.\n";
if(isset($_POST['mb']))
$surname = "Surname: {$_POST['mb']}.\n";
if(isset($_POST['email']))
$email = "Email: {$_POST['email']}.\n";
if(isset($_POST['phonenr']))
$tel = "Phone Number: {$_POST['phonenr']}.\n";
if(isset($_POST['txtarea']))
$message = "Message: {$_POST['txtarea']}.\n";
$rezultati = $name.$surname.$email.$tel.$message;
echo nl2br($rezultati, false);




//SQL STATEMENTS
if(isset($_POST['sub'])){
$sql = "INSERT INTO UserInfo (id,firstname,surname,email,telnumber,mesazhi) VALUES ('','$_POST[em]','$_POST[mb]','$_POST[email]',
'$_POST[phonenr]','$_POST[txtarea]')";
if($connect->query($sql) === true){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $connect->error;
}
}


$sql = "SELECT id,firstname,surname,email,telnumber,mesazhi from UserInfo";
$res = $connect->query($sql);
if ($res->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></th><th>Email</th></th><th>Tel Number</th></th><th>Message</th></tr>";
    // output data of each row
    while($row = $res->fetch_assoc()) {
     echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["surname"]."</td><td>".$row["email"]."</td><td>".$row["telnumber"]."</td><td>".$row["mesazhi"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$connect->close();



//Email Address
if(isset($_POST['sub']) && isset($_POST['em']) && isset($_POST['mb']) && isset($_POST['email']) && isset($_POST['phonenr']) && isset($_POST['txtarea'])){
 
    $name = $_POST['em'];
    $surname = $_POST['mb'];
    $email = $_POST['email'];   // this is the sender's Email address
    $tel = $_POST['phonenr'];
    $message = $_POST['txtarea'];
    $to = 'njmehmeti@hotmail.com'; // this is your Email address
    $subject = $email. " has sent you a message";
    $body = $message . "\n\n " . $name . "dhe" . $surname ."\n\n" . $tel;
    $headers = "From: ".$email."\n";
   
    $send = mail($to,$subject,$body,$headers);


    echo "Mail Sent. Thank you " . $name . ", your email has been received.";

    }
  

?>





