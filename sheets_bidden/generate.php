<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bidden voor pastors</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<?php
// Maak connectie met de database
include('PHP_ZOOI/connection.php');

// $query = "SELECT * FROM `pastors`";

// 	$result = mysqli_query($mysqli, $query);

// 	// Laat alle reizen zien
// 	if (mysqli_num_rows($result) == 0) {
// 		echo "<p class='text-center w-full pt-2'>Er zijn nog geen Pastorechtparen in de database.<p>";
// 	} else {
// 		// var_dump($result);
// 		while ($row = mysqli_fetch_array($result)) {
// 			echo "<div class='w-5/6 h-32 bg-slate-900 rounded-lg p-2 my-4 m-auto flex flex-row'>";
// 			echo "<img src='image/" . $row['image'] . "' alt='' srcset='' class='w-1/5 rounded-l object-cover'>";
// 			echo "<div class='flex flex-col pl-2'>";
// 			echo "<div class='font-bold text-white'>" . $row['plaats'] . "</div>";
// 			echo "<div class='text-white whitespace-nowrap'>" . $row['achternaam'] . ", " . $row['voornaam_pastor'] . ", " .  $row['voornaam_vrouw'] . "</div>";
// 			echo "</div>";
// 			echo "<div class='flex flex-col items-end justify-around text-white w-full'>
// 					<button class='px-2 text-rose-700' id='deletebtn'>
// 						<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
// 							<path stroke-linecap='round' stroke-linejoin='round' d='M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0' />
// 		  				</svg>
// 					</button>
// 					<div class='px-2 text-lime-700' id='editbtn'>
// 						<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
// 		  					<path stroke-linecap='round' stroke-linejoin='round' d='M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125' />
// 						</svg>
// 					</div>
// 				</div>";
// 			echo "</div>";
// 		}
// 	}

// 
?>
<div id="row">
<?php

$i = 1;

$y = 3;

$idlocal = '';
$idinter = '';

while ($i < $y) {

  $query = "SELECT * FROM `pastors` WHERE national = 0 AND id NOT IN ('" . $idlocal . "') LIMIT 1 ";

  $result = mysqli_query($mysqli, $query);

  // Laat alle reizen zien
  if (mysqli_num_rows($result) == 0) {
    echo "<p class='text-center w-full pt-2'>Er zijn nog geen Pastorechtparen in de database.<p>";
  } else {
    // var_dump($result);
    while ($row = mysqli_fetch_array($result)) {
      echo "<div class='w-[1920px] h-[1080px] bg-slate-900 p-2 my-4 m-auto flex flex-row sheets'>";
      echo "<div class='w-1/2 flex flex-col justify-center'>";
      echo "<img src='image/" . $row['image'] . "' alt='' srcset='' class='w-10/12 rounded-lg object-cover mx-auto'>";
      echo "<div class='font-bold text-white text-8xl mx-auto text-center pt-2'>" . $row['plaats'] . " - " . $row['achternaam'] . "</div>";
      echo "<div class='text-white whitespace-nowrap text-5xl mx-auto text-center pt-4'>" . $row['voornaam_pastor'] . " en " .  $row['voornaam_vrouw'] . "</div>";
      echo "</div>";
      $idlocal = $idlocal . $row['id'];
      echo $row['id'];
    }
  }
  $query = "SELECT * FROM `pastors` WHERE national = 1 AND id NOT IN ('" . $idinter . "') LIMIT 1";

  $result = mysqli_query($mysqli, $query);

  // Laat alle reizen zien
  if (mysqli_num_rows($result) == 0) {
    echo "<p class='text-center w-full pt-2'>Er zijn nog geen Pastorechtparen in de database.<p>";
  } else {
    // var_dump($result);
    while ($row = mysqli_fetch_array($result)) {
      echo "<div class='w-1/2 flex flex-col justify-center'>";
      echo "<img src='image/" . $row['image'] . "' alt='' srcset='' class='w-10/12 rounded-lg object-cover mx-auto'>";
      echo "<div class='font-bold text-white text-8xl mx-auto text-center pt-2'>" . $row['plaats'] . " - " . $row['achternaam'] . "</div>";
      echo "<div class='text-white whitespace-nowrap text-5xl mx-auto text-center pt-4'>" . $row['voornaam_pastor'] . " en " .  $row['voornaam_vrouw'] . "</div>";
      echo "</div>";
      echo "</div>";
      $idinter = $idinter . $row['id'];
    }
  }
  $i++;
}

?>
</div>
<div id="dl-png" class='sticky flex justify-center items-center cursor-pointer rounded-lg bg-green-400 text-white w-12 h-12 absolute bottom-4 right-4 ml-auto'>print</div>



<script defer>

  document.getElementById("dl-png").onclick = function() {

    sheets = document.getElementsByClassName("sheets").length
    i = 0
    while (i < sheets){
      const screenschotTarget = document.getElementById('row')[i];

      html2canvas(screenschotTarget).then((canvas) => {
        const base64image = canvas.toDataURL("image/png");
        var anchor = document.createElement('a');
        anchor.setAttribute("href", base64image);
        anchor.setAttribute("download", "my-image.png");
        anchor.click();
        anchor.remove();
      })
      i++
    }
    
  }
</script>