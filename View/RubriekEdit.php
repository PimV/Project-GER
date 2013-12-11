<?php

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
	}

?>
<h1>Rubriek bewerken</h1>   
   
<form name="save-form" id="save-form" method="POST">   
	<div class="ribbon">   
			<div class="item" onclick=document.forms['save-form'].submit();>
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