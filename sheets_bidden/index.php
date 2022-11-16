<?php
// Maak connectie met de database
include('PHP_ZOOI/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bidden voor pastors</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
	<?php

	// Query de database op alle reizen
	$query = "SELECT * FROM `pastors`";

	$result = mysqli_query($mysqli, $query);

	// Laat alle reizen zien
	if (mysqli_num_rows($result) == 0) {
		echo "<p class='text-center w-full pt-2'>Er zijn nog geen Pastorechtparen in de database.<p>";
	} else {
		// var_dump($result);
		while ($row = mysqli_fetch_array($result)) {
			echo "<div class='w-5/6 h-32 bg-slate-900 rounded-lg p-2 my-4 m-auto flex flex-row'>";
			echo "<img src='image/" . $row['image'] . "' alt='' srcset='' class='w-1/5 rounded-l object-cover'>";
			echo "<div class='flex flex-col pl-2'>";
			echo "<div class='font-bold text-white'>" . $row['plaats'] . "</div>";
			echo "<div class='text-white whitespace-nowrap'>" . $row['achternaam'] . ", " . $row['voornaam_pastor'] . ", " .  $row['voornaam_vrouw'] . "</div>";
			echo "</div>";
			echo "<div class='flex flex-col items-end justify-around text-white w-full'>
					<button class='px-2 text-rose-700' id='deletebtn'>
						<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
							<path stroke-linecap='round' stroke-linejoin='round' d='M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0' />
		  				</svg>
					</button>
					<div class='px-2 text-lime-700' id='editbtn'>
						<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
		  					<path stroke-linecap='round' stroke-linejoin='round' d='M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125' />
						</svg>
					</div>
				</div>";
			echo "</div>";
		}
	}
	?>
	<div class='flex justify-center items-center cursor-pointer rounded-lg bg-green-400 text-white w-12 h-12 absolute bottom-20 right-4' onclick='window.location.href=`add.php`'>add</div>
	<div class='flex justify-center items-center cursor-pointer rounded-lg bg-green-400 text-white w-20 h-12 absolute bottom-4 right-4' onclick='window.location.href=`generate.php`'>Generate</div>

	<div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
		<!--
			Background backdrop, show/hide based on modal state.

			Entering: "ease-out duration-300"
			From: "opacity-0"
			To: "opacity-100"
			Leaving: "ease-in duration-200"
			From: "opacity-100"
			To: "opacity-0"
 		 -->
		<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

		<div class="fixed inset-0 z-10 overflow-y-auto">
			<div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
				<!--
					Modal panel, show/hide based on modal state.

					Entering: "ease-out duration-300"
					From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
					To: "opacity-100 translate-y-0 sm:scale-100"
					Leaving: "ease-in duration-200"
					From: "opacity-100 translate-y-0 sm:scale-100"
					To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    			  -->
				<div class="relative transform overflow-hidden rounded-lg bg-slate-900 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
					<div class="bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
						<div class="sm:flex sm:items-start">
							<div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-rose-700 sm:mx-0 sm:h-10 sm:w-10">
								<!-- Heroicon name: outline/exclamation-triangle -->
								<svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v3.75m-9.303 3.376C1.83 19.126 2.914 21 4.645 21h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 4.88c-.866-1.501-3.032-1.501-3.898 0L2.697 17.626zM12 17.25h.007v.008H12v-.008z" />
								</svg>
							</div>
							<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
								<h3 class="text-lg font-medium leading-6 text-white" id="modal-title">Deactivate account</h3>
								<div class="mt-2">
									<p class="text-sm text-gray-500">Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="bg-slate-900 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
						<button type="button" id="" class="inline-flex w-full justify-center rounded-md border border-transparent bg-rose-700 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Deactivate</button>
						<button type="button" id="closing" class="mt-3 inline-flex w-full justify-center rounded-md bg-slate-800 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>

  <script>
    var closingbtn = document.getElementById('closing');
    var deletebtn = document.getElementById('deletebtn');

    closingbtn.onclick = function() {
      modal.style.display = "none";
    }

    deletebtn.onclick = function() {
      modal.style.display = "block";
    }
  </script>

</body>

</html>