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
            <div class="item" onclick="javascript:location.href='index.php?p=blok&del='+getSelectedItemId();">
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
                <th>Omschrijvig</th>     
                <th>Leerjaar</th>          
                <th>Bloknummer</th>         
                <th>Open</th>  
            </thead>    
            <tbody>
				<?php 
				include_once("Model/Blokken.php");
				$blocks = new Blokken;
				$arr = $blocks->getAllBlocks();	
				
				$unEven = true;
				foreach ($arr as &$value) {
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
					
					// TODO: ophalen of blok open staat
					echo "<td>Nee</td></tr>";
				}
				?>			
            </tbody>
        </table>