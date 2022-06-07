
<?php 
  
  
	$full_Name = $_POST['Name'];
	$Address = $_POST['Address'];
	$Email = $_POST['Email'];
	$Enquiry = $_POST['Enquiry'];

	  //Database connection
	$conn = new mysqli('localhost','root','','assiment');
	if($conn->connect_error){
		die('Connection Failed :' .$conn->connect_error);

	}
	else
	{
		$stmt = $conn->prepare("insert into Data(Name, Address, Email, Enquiry) Values(?,?,?,?)");
		$stmt->bind_param("ssss",$full_Name, $Address, $Email, $Enquiry);
		$stmt->execute();
		echo "Done";
		$stmt->close();
		$conn->close();
	}

?>

<?php
// define variables and set to empty values
$full_NameErr = $EmailErr = "";
$full_Name = $Address =  $Email = $Enquiry = "";

if ($_SERVER["assiment"] == "POST") {
  if (empty($_POST["Name"])) {
    $full_NameErr = "Name is required";
  } else {
    $full_Name = test_input($_POST["Name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$full_Name)) {
     $full_NameErr = "Only letters and white space allowed";
    }
  }
    if (empty($_POST["Address"])) {
    $Address = "";
  } else {
    $Address = test_input($_POST["Address"]);
  }
  
  if (empty($_POST["Email"])) {
    $EmailErr = "Email is required";
  } else {
    $Email = test_input($_POST["Email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $EmailErr = "Invalid email format";
    }
  }
    


  if (empty($_POST["Enquiry"])) {
    $Enquiry = "";
  } else {
    $Enquiry = test_input($_POST["Enquiry"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
