<?php
// Maak connectie met de database
include('connection.php');

// Haal id uit de get
$id = $_GET['id'];

// Delete alle inschrijvingen van deze reis
$delete_entry = $mysqli->prepare("DELETE FROM `pastors` WHERE id = ?");

$delete_entry->bind_param('i', $id);

// Kijk of de query gelukt is
if ($delete_entry->execute()) {
    header("Location:../index.php");
} else {
    echo "Verwijderen is niet goed gegaan.";
}
?>