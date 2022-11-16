<?php
// Maak connectie met de database
include('PHP_ZOOI/connection.php');
// Sla de id van get op in een variable
$id = $_GET['id'];            
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastor toevoegen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="w-screen h-14 bg-slate-900 flex ">
        <a href="index.php" class="w-1/6 flex justify-center">
            <div class="flex justify-center flex-col text-white">terug</div>
        </a>
        <div class="w-4/6 flex justify-center">
            <div class="flex justify-center flex-col text-white font-bold">Pastor Toevoegen</div>
        </div>
        <div class="w-1/6 flex justify-center flex-col">
        </div>
    </div>
    <div class='w-screen h-[calc(100vh-3.5rem)] flex justify-center flex-col'>
        <?php
        // Query de database op een specifieke reis
        $query = "SELECT * FROM `pastors` WHERE id = '$id'";

        $result = mysqli_query($mysqli, $query);

        // Kijk of de reis bestaat zo niet geef een form voor een nieuwe reis. En ander vul de form met de data van de database met een link naar de update pagina.
        if (mysqli_num_rows($result) == 0) {
            echo "<form action='/sheets_bidden/PHP_ZOOI/toevoegen.php' enctype='multipart/form-data' method='post' class='w-4/5 h-4/5 bg-slate-900 flex flex-col justify-around m-auto rounded-lg'>";
            echo "<div class='flex m-auto w-4/5 justify-between'>";
            echo "<input type='text' name='plaats' id='plaats' placeholder='Plaats' class='w-5/12 rounded p-2' required>";
            echo "<input type='text' name='achternaam' id='achternaam' placeholder='achternaam' class='w-5/12 rounded p-2' required>";
            echo "</div>";
            echo "<div class='flex m-auto w-4/5 justify-between'>";
            echo "<input type='text' name='voornaam_pastor' id='voornaam_pastor' placeholder='Voornaam van de pastor' class='w-5/12 rounded p-2' required>";
            echo "<input type='text' name='voornaam_vrouw' id='voornaam_vrouw' placeholder='Voornaam van de pastors vrouw' class='w-5/12 rounded p-2' required>";
            echo "</div>";
            echo "<input type='checkbox' name='nationaal' id='nationaal' class='w-4/5 h-10 m-auto rounded p-2'>";
            echo "<select name='position' class='w-4/5 m-auto rounded p-2'>";
            echo "<option value='Pastor'>Pastor</option>";
            echo "<option value='Evangelist'>Evangelist</option>";
            echo "<option value='Assistent pastor'>Assistent pastor</option>";
            echo "</select>";
            echo "<input type='file' name='image' id='image' class='w-4/5 m-auto rounded p-2'>";
            echo "<input type='submit' value='Opslaan' name='submit' class=' m-auto bg-slate-800 rounded p-2 text-white cursor-pointer'>";
            echo "</form>";
        } else {
            while ($row = mysqli_fetch_array($result)) {
                echo "<form action='/sheets_bidden/PHP_ZOOI/toevoegen.php?id=".$row['ID']."' enctype='multipart/form-data' method='post' class='w-4/5 h-4/5 bg-slate-900 flex flex-col justify-around m-auto rounded-lg'>";
                echo "<input type='text' name='titel' id='titel' value='" . $row['Titel'] . "' class='w-4/5 m-auto rounded p-2' required>";
                echo "<input type='text' name='bestemming' id='bestemming' value='" . $row['Bestemming'] . "' class='w-4/5 m-auto rounded p-2' required>";
                echo "<input type='text' name='omschrijving' id='omschrijving' value='" . $row['Omschrijving'] . "' class='w-4/5 m-auto rounded p-2' required>";
                echo "<div class='w-4/5 m-auto rounded p-2'>";
                echo "Startdatum";
                echo "<input type='date' name='begin' id='begin' value='" . $row['Begindatum'] . "' class='p-2 rounded ml-2' required>";
                echo "<br>";
                echo "Einddatum";
                echo "<input type='date' name='einde' id='einde' value='" . $row['Einddatum'] . "' class='p-2 rounded ml-2' required>";
                echo "</div>";
                echo "<input type='text' name='max_aantal' id='max_aantal' value='" . $row['Aantal_inschrijvingen'] . "' class='w-4/5 m-auto rounded p-2' required>";
                echo "<input type='file' name='foto' id='foto' class='w-4/5 m-auto rounded p-2' value='" . $row['Foto'] . "'>";
                echo "<input type='submit' value='Aanpassen' name='submit' class=' m-auto bg-lime-600 rounded p-2 text-white cursor-pointer'>";
                echo "</form>";
            }
        }
        ?>
    </div>
</body>

</html>