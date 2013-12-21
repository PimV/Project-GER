<h1>Blokken</h1>          
        <div class="ribbon">     
            <div class="item" onclick="javascript:location.href='index.php?p=home'">
                <div class="fontIcon">
                     &#xe126;
                </div>  
                <div class="text">
                    Terug
                </div>
            </div> 
            <div class="item" onclick="javascript:location.href='index.php?p=blokedit'">
                <div class="fontIcon">
                    &#xe102;
                </div>  
                <div class="text">
                    Toevoegen
                </div>
            </div>
            <div class="item" onclick="javascript:location.href='index.php?p=blokedit&id='+getSelectedItemId();">
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
        <table cellpadding="0" cellspacing="0">
            <thead>
                <th>Naam</th>     
                <th>Omschrijving</th>     
                <th>Leerjaar</th>          
                <th>Bloknummer</th>         
                <th>Open</th>  
            </thead>    
            <tbody>
				<?php 			
				$unEven = true;
				foreach ($blockArray as &$value) {
					echo "<tr id=".$value['id']." ";
					
					if ($unEven == true) {
						echo "class='unEven'";
						$unEven = false;
					} else {
						$unEven = true;
					}
					echo ">";
					echo "<td>".$value['naam']."</td>";
					echo "<td>".$value['omschrijving']."</td>";
					echo "<td>".$value['leerjaar']."</td>";
					echo "<td>".$value['bloknummer']."</td>";
					
					// Check of blok open staat
					if(!is_null($value['beoordeling_deadline'])) {
						echo "<td>Ja</td></tr>";
					} else {
						echo "<td>Nee</td></tr>";
					}
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
            <h2>Weet u zeker dat u dit blok wilt verwijderen?</h2>
            <br><br><br><br><br><br><br><br>
            <input style="height: 40px; width: 180px;" type="button" value="Blok verwijderen" onclick="javascript:location.href='index.php?p=blok&del='+getSelectedItemId();"/>
            &nbsp;&nbsp;&nbsp;
            <input style="height: 40px; width: 100px;" type="button" value="Annuleren" onclick="closeCover('cover')"/>
        </div>
    </div>
</div>