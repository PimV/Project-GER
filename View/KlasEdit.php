<h1>Klas bewerken</h1>          
<div class="ribbon">     
    <div class="item" onclick=""> <!-- submit form -->
        <div class="fontIcon">
             &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>
    <div class="item" onclick="javascript:location.href='index.php?p=klas'">
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
                <td>Code</td>  
                <td><input type="text"/></td>
            </tr>        
            <tr>
                <td>Schooljaar</td>  
                <td>
                    <select class="selectFullSize">
                        <option><?php echo($year1) ?></option>   
                        <option><?php echo($year2) ?></option>  
                    </select>    
                </td>
            </tr> 
        </table>                  
    </div>

    <div class="right">   
        <table class="noAction">    
            <tr>
                <td>Coach</td>  
                <td>
                    <select class="selectFullSize"> 
                    </select>    
                </td>
            </tr>          
            <tr>
                <td>Blok</td>  
                <td>
                    <select class="selectFullSize">
                    </select>    
                </td>
            </tr>
        </table>     
    </div>
</div>      


<div style="clear: both">          
    <h2>Studenten</h2>

    <div alt="listItem">
        <ul class="listView" alt="left">
            <?php
            foreach ($students as $row) {
                echo("<li class='listItem'>".$row["studentid"]. " | " .$row["studentnaam"]."</li>");
            }
            ?>
        </ul>     

        <div class="listViewControl">
            <div name="Left" class="fontIcon">&#xe111;</div>    
            <div name="Right" class="fontIcon">&#xe112;</div>      
        </div>    

        <ul class="listView" alt="right"> 
        </ul> 
    </div>
</div>  