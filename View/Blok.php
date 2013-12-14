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
                <th>bloknummer</th>         
                <th>Open</th>  
            </thead>    
            <tbody>
				<?php 
				include_once("Model/Blokken.php");
				$blocks = new Blokken;
				$arr = $blocks->getAllBlocks();				
				foreach ($arr as &$value) {
					echo "<tr id=".$value['id']." class='unEven'>
						  <td>".$value['naam']."</td>
						  <td>".$value['omschrijving']."</td>
						  <td>".$value['leerjaar']."</td>
						  <td>".$value['bloknummer']."</td>
						  <td>Nee</td>
						  </tr>";
				}
				?> 
            </tbody>
        </table>