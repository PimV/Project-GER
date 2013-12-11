<?php

	if ($_POST['submit'])  {
		header('Location:rubriek.php');
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
					<td><input type="text" name="name"/></td>
				</tr>     
			</table>            
		</div>
		
		<div class="right">   
			<table class="noAction">
				<tr>
					<td>Omschrijving</td>  
					<td><input type="text" name="description"/></td>
				</tr>     
			</table>     
		</div>
	</div>
</form>