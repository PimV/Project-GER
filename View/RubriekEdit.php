<?php

	if(!empty($_POST['name']) && !empty($_POST['description'])) {
		// Include Rubrieken.php en maak Rubrieken klasse aan
		include_once($_SERVER['DOCUMENT_ROOT']."/Model/Rubrieken.php");
		$rubrics = new Rubrieken;
		// Initialiseer variabelen
		$name = $_POST['name'];
		$description = $_POST['description'];
		// Check of sessie 'rubric' bestaat, als dit het geval is update de huidige rubriek
		// d.m.v het id en unset de sessie 'rubric'
		if(isset($_SESSION['rubric'])) {
			$id = $_SESSION['rubric'];
			$rubrics->updateRubric($name, $description, $id);
			unset($_SESSION['rubric']);
		} else { 
			// Sessie 'rubric' bestaat niet, voeg nieuwe rubriek toe
			$rubrics->addRubric($name, $description);
		}
		// Redirect naar rubriek.php
		header("Location:index.php?p=rubriek");
	}
	if(isset($_GET['id'])) {
		// Assign id
		$id = $_GET['id'];
		// Include Rubrieken.php en maak Rubrieken klasse aan
		include_once($_SERVER['DOCUMENT_ROOT']."/Model/Rubrieken.php");
		$rubrics = new Rubrieken;
		// Get rubriek met id
		$result = $rubrics->getRubric($id);	
		// Set naam & omschrijving variabelen
		$name = $result[0]['naam'];
		$description = $result[0]['omschrijving'];
		// Maak sessie met rubriek id
		$_SESSION['rubric'] = $id;
	} 

?>
<h1>Rubriek bewerken</h1>   
   
<form id="save-form" action="index.php?p=rubriekedit" method="POST">
	<div class="ribbon">   
			<div class="item" onclick="document.forms['save-form'].submit();">
				<div class="fontIcon" >
					 &#xe060;
				</div>  
				<div class="text">
					Opslaan
				</div>
			</div>

			<div class="item" onclick="javascript:location.href='index.php?p=rubriek'">
				<div class="fontIcon">
					&#xe0f9;
				</div>  
				<div class="text">
					Annuleren
				</div>
			</div>
	</div>  
	
	<div class="splitScreen">
		<div class="left">
			<table class="noAction">
				<tr>
					<td>Naam</td>
					<td>
					<?php if(isset($name)) {
						echo "<input type='text' name='name' value='".$name."'/>";
					} else {
						echo "<input type='text' name='name' />";
					}
					?>
					</td>
				</tr>     
			</table>            
		</div>
		
		<div class="right">   
			<table class="noAction">
				<tr>
					<td>Omschrijving</td> 
					<td>
					<?php if(isset($description)) {
						echo "<input type='text' name='description' value='".$description."'/>";
					} else {
						echo "<input type='text' name='description' />";
					}
					?>
					</td>					
				</tr>     
			</table>     
		</div>
	</div>
</form>