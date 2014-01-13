 
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<link href="Styles/datepicker.css" rel="stylesheet" type="text/css"/>


<?php
if(empty($_GET["id"])) {
    echo("<h1>Blok toevoegen</h1>");
} else {
    echo("<h1>Blok bewerken</h1>");
}
?> 
<form id="save-form" action="index.php?p=blokedit" method="POST"> 
	<div class="ribbon">     
		<div class="item" onclick="showError('De gegevens worden verwerkt..', 'Een ogenblik geduld'); document.forms['save-form'].submit();">
			<div class="fontIcon">
				 &#xe060;
			</div>  
			<div class="text">
				Opslaan
			</div>
		</div>
		<div class="item" onclick="javascript:location.href='index.php?p=blok'">
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
					<?php 
					if(isset($name)) {
						echo "<input type='text' name='name' value='".$name."'/>";
					} else {
						echo "<input type='text' name='name' />";
					}
					?>
					</td>
				</tr>         
				<tr>
					<td>Omschrijving</td>  
					<td>
					<?php 
					if(isset($description)) {
						echo "<input type='text' name='description' value='".$description."'/>";
					} else {
						echo "<input type='text' name='description' />";
					}
					?>
				</tr>        
				<tr>
					<td>Leerjaar</td>       
					<td>
						<select class="selectFullSize" name="schoolYear">
							<option <?php echo ($schoolYear == 1) ? 'selected="selected"' : ''; ?> value=1>1   
							<option <?php echo ($schoolYear == 2) ? 'selected="selected"' : ''; ?> value=2>2 
							<option <?php echo ($schoolYear == 3) ? 'selected="selected"' : ''; ?> value=3>3  
						</select>
					</td>
				</tr>   
				<tr>     
					<td>Blok</td>  
					<td>
						<select class="selectFullSize" name="blockNumber">
							<option <?php echo ($blockNumber == 1) ? 'selected="selected"' : ''; ?> value=1>1</option>     
							<option <?php echo ($blockNumber == 2) ? 'selected="selected"' : ''; ?> value=2>2</option>     
							<option <?php echo ($blockNumber == 3) ? 'selected="selected"' : ''; ?> value=3>3</option>     
							<option <?php echo ($blockNumber == 4) ? 'selected="selected"' : ''; ?> value=4>4</option>        
							<option <?php echo ($blockNumber == 5) ? 'selected="selected"' : ''; ?> value=5>5</option>        
							<option <?php echo ($blockNumber == 6) ? 'selected="selected"' : ''; ?> value=6>6</option>     
							<option <?php echo ($blockNumber == 7) ? 'selected="selected"' : ''; ?> value=7>7</option>      
							<option <?php echo ($blockNumber == 8) ? 'selected="selected"' : ''; ?> value=8>8</option>     
							<option <?php echo ($blockNumber == 9) ? 'selected="selected"' : ''; ?> value=9>9</option>         
							<option <?php echo ($blockNumber == 10) ? 'selected="selected"' : ''; ?> value=10>10</option>     
							<option <?php echo ($blockNumber == 11) ? 'selected="selected"' : ''; ?> value=11>11</option>     
							<option <?php echo ($blockNumber == 12) ? 'selected="selected"' : ''; ?> value=12>12</option>     
						</select>
					</td>  
				</tr> 
			</table>            
		</div>
		
		<div class="right">   
			<table class="noAction">  
				<tr><!-- 
					<td>Open</td>  
					<td>
						<select class="selectFullSize" name="open" <?php echo (!isset($_SESSION['blok'])) ? 'disabled="disabled"' : ''; ?>>  
							<option <?php echo (!isset($deadline)) ? 'selected="selected"' : ''; ?> value=false>Nee</option>
							<option <?php echo (isset($deadline)) ? 'selected="selected"' : ''; ?> value=true>Ja</option>				  
						</select>
					</td> 
					-->
					<td>Open</td>  
					<td>
						<?php
						if(isset($deadline)) {
							echo "<input type='text' name='open' value='Ja' disabled/>";
						} else {
							echo "<input type='text' name='open' value='Nee' disabled/>";
						}
						?>
					</td> 
				</tr>          
				<tr>
					<td>Einddatum</td>  
					<td>
					<?php
					if(!isset($_SESSION['blok'])) {
						echo "<input type='text' id='deadline' name='deadline' disabled/> (yyyy-MM-dd)";
					} else {
						if(isset($deadline)) {
							echo "<input type='text' id='deadline' name='deadline' value='".$deadline."'/> (yyyy-MM-dd)";
						} else {
							echo "<input type='text' id='deadline' name='deadline' /> (yyyy-MM-dd)";
						}
					}
					?>
				</tr>
			</table>     
		</div>
	</div>
	
<?php	
if(isset($error) && $error == "date") {
	echo "<script> showError('Geen geldige datum ingevoerd', 'Geen datum'); </script>"; 
}
if(isset($error) && $error == "noclass") {
	echo "<script> showError('Er is nog geen klas aan dit blok gekoppeld', 'Geen klas gevonden'); </script>"; 
}
?>

</form>

