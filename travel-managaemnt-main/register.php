<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_info";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if($conn){
    echo "string";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    echo "Succesful";

    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
     $govt_document = $_FILES['govt_document'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

   // File upload handling
     $target_dir = "uploads/";
     $target_file = $target_dir.basename($_FILES["govt_document"]["name"]);
     $uploadOk = 1;
     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
     if (file_exists($target_file)) {
         echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
     } else {
         if (move_uploaded_file($_FILES["govt_document"]["tmp_name"], $target_file)) {
             echo "The file " .basename($_FILES["govt_document"])." has been uploaded.";
         } else {
             echo "Sorry, there was an error uploading your file.";
         }
     } 
    //  Insert data into the database
    $sql = "INSERT INTO user (name,password, email, govt_document, phone_number, address) VALUES ('$name','$password','$email','$govt_document','$phone_number', '$address')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " .$sql . "<br>" .mysqli_error($conn);
    }
}
// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}
}
?>
