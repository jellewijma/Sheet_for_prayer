<?php
// Maak connectie met de database
include('connection.php');

// var_dump($_POST);

// // Haal alle data uit de post en get
$achternaam = $_POST['achternaam'];
$voornaam_pastor = $_POST['voornaam_pastor'];
$voornaam_vrouw = $_POST['voornaam_vrouw'];
$nationaal = $_POST['nationaal'];
$positie = $_POST['position'];
$plaats = $_POST['plaats'];
$image = $_FILES["image"]["name"];

if ($nationaal == NULL){
  $nationaal = 0;
}
// var_dump($image);

$afbeelding_folder = "../image/";
$target_file = $afbeelding_folder . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Kijk of de upload een echte image is
if(isset($_POST["submit"])) {
    echo "been";
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check of het bestand al bestaat
if (file_exists($target_file)) {
    echo "Het bestand bestaat al.";
    $uploadOk = 0;
  }
  
  // Check bestand grote
  if ($_FILES["image"]["size"] > 5000000) {
    echo "Sorry bestand is te groot.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"&& $imageFileType != "jpeg" ) {
    echo "Sorry, alleen JPG, JPEG, PNG & GIF files zijn toegestaan.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, de image is niet geupload.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "De image ". htmlspecialchars( basename( $_FILES["image"]["name"])). " is geupload.";
        $geupload = true;
        echo $geupload;
    } else {
        echo "Sorry, er was een error met het uploaden van de image.";
        $geupload = false;
    }
  }

// Kijk of er een id is meegegeven. Zoja update de reis. Zo niet maak een nieuwe reis aan
if (!$_GET['id'] == NULL && !$image == "") {
    $prepared = $mysqli->prepare("UPDATE `pastors` SET `achternaam`=?,`voornaam_pastor`=?,`voornaam_vrouw`=?,`national`=?,`image`=?,`plaats`=?, `positie`=? WHERE id=?");
    $prepared->bind_param('ssssssss', $achternaam, $voornaam_pastor, $voornaam_vrouw, $nationaal, $image, $plaats, $positie);
    echo "ervoor";
  } else if ($image == "") {
    $prepared = $mysqli->prepare("UPDATE `pastors` SET `achternaam`=?,`voornaam_pastor`=?,`voornaam_vrouw`=?,`national`=?,`plaats`=?, `positie`=? WHERE id=?");
    $prepared->bind_param('sssssss', $achternaam, $voornaam_pastor, $voornaam_vrouw, $nationaal, $plaats, $positie);
  echo "hier";
  }else {
  $prepared = $mysqli->prepare("INSERT INTO `pastors`(`achternaam`, `voornaam_pastor`, `voornaam_vrouw`, `national`, `image`, `plaats`, `positie`) VALUES (?,?,?,?,?,?,?)");
  $prepared->bind_param('sssssss',  $achternaam, $voornaam_pastor, $voornaam_vrouw, $nationaal, $image, $plaats, $positie);
    echo "niet hier";
    // var_dump($positie);
}

// Kijk of de query gelukt is
if ($prepared->execute() && $geupload == true) {
    header("Location:../index.php");
} else {
    // header("Location:../index.php");
    echo "Uploaden is niet goed gegaan.";
}