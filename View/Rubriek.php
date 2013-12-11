
<h1>Rubrieken</h1>          
	<div class="ribbon">     
		<div class="item" onclick="javascript:location.href='index.php?p=home'">
			<div class="fontIcon">
				 &#xe126;
			</div>  
			<div class="text">
				Terug
			</div>
		</div> 
		<div class="item" onclick="javascript:location.href='index.php?p=rubriekEdit'">
			<div class="fontIcon">
				&#xe102;
			</div>  
			<div class="text">
				Toevoegen
			</div>
		</div>
		<div class="item" onclick="javascript:location.href='index.php?p=rubriekEdit'&id='+getSelectedItemId()'">
			<div class="fontIcon">
				&#xe006;
			</div>  
			<div class="text">
				Bewerken
			</div>
		</div> 
		<div class="item" onclick="javascript:location.href='index.php?p=klas&del='+getSelectedItemId();">
			<div class="fontIcon">
				&#xe0a8;
			</div>  
			<div class="text">
				Verwijderen
			</div>
		</div>
	</div>
	<!-- Table containing all rubrics -->
	<table cellpadding="0" cellspacing="0">
		<thead>
			<th>Naam</th>   
		</thead>    
		<tbody>
			<?php 
			include_once($_SERVER['DOCUMENT_ROOT']."/Model/Rubrieken.php");
			$rubrics = new Rubrieken;
			$arr = $rubrics->getAllRubrics();				
			foreach ($arr as &$value) {
				echo "<tr id=".$value['id']." class='unEven'><td>".$value['naam']."</td></tr>";
			}
			?>
		</tbody>
	</table> 