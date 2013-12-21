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
		<div class="item" onclick="javascript:location.href='index.php?p=rubriekedit'">
			<div class="fontIcon">
				&#xe102;
			</div>  
			<div class="text">
				Toevoegen
			</div>
		</div>
		<div class="item" onclick="javascript:location.href='index.php?p=rubriekedit&id='+getSelectedItemId();">
			<div class="fontIcon">
				&#xe006;
			</div>  
			<div class="text">
				Bewerken
			</div>
		</div> 
		<div class="item" onclick="deleteClicked(getSelectedItemId());">
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
			$unEven = true;
			foreach ($rubricArray as &$value) {
				echo "<tr id=".$value['id']." ";
				
				if ($unEven == true) {
					echo "class='unEven'";
					$unEven = false;
				} else {
					$unEven = true;
				}
				echo ">";
				echo "<td>".$value['naam']."</td></tr>";

			}
			?>
		</tbody>
	</table> 
	
<div class="coverBg" id="cover">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('cover')"></div>
        </div>
        <div class="contentMessage">
            <h2>Weet u zeker dat u deze rubriek wilt verwijderen?</h2>
            <br><br><br><br><br><br><br><br>
            <input style="height: 40px; width: 180px;" type="button" value="Rubriek verwijderen" onclick="javascript:location.href='index.php?p=rubriek&del='+getSelectedItemId();"/>
            &nbsp;&nbsp;&nbsp;
            <input style="height: 40px; width: 100px;" type="button" value="Annuleren" onclick="closeCover('cover')"/>
        </div>
    </div>
</div>