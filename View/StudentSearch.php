<!-- Op deze pagina moet rekening wordne gehouden wie er ingelogd is. Indien in COACH is ingelogd moeten bepaalde ribbon knoppen niet worden getoond.
     Ook moet dan het zoek gedeelte worden aangepast naar alleen een dropdown met de klassen en een student naam zoek balk. 
     
     Als het om een administrator gaat moet alles worden getoond.

     Een heleboel menu knoppen moeten ook disabled zijn als er nog geen student geselecteerd is.-->

<h1>Studenten zoeken</h1>          
<div class="ribbon">     
    <div class="item">
        <div class="fontIcon"> 
             &#xe126;
        </div>  
        <div class="text">
            Terug
        </div>
    </div>
    <div class="item">
        <div class="fontIcon">
            &#xe07f;
        </div>  
        <div class="text">
            Zoeken
        </div>
    </div>   
    <div class="item" onclick="javascript:location.href='index.php?p=resultaat'">
        <div class="fontIcon">
            &#xe095;
        </div>  
        <div class="text">
            Resultaten
        </div>
    </div>   
    
    <!-- Laat onderstaande knoppen alleen zien als een administrator is ingelogd -->
    <?php if($_SESSION['admin']) { ?>
    <div class="item">
        <div class="fontIcon">
            &#xe102;
        </div>  
        <div class="text">
            Toevoegen
        </div>
    </div>
    <div class="item">
        <div class="fontIcon">
            &#xe006;
        </div>  
        <div class="text">
            Bewerken
        </div>
    </div> 
    <div class="item">
        <div class="fontIcon">
            &#xe0a8;
        </div>  
        <div class="text">
            Verwijderen
        </div>
    </div>   
    <div class="item">
        <div class="fontIcon">
            &#xe0bd;
        </div>  
        <div class="text">
            Importeren
        </div>
    </div>
    <div class="item">
        <div class="fontIcon">
            &#xe0be;
        </div>  
        <div class="text">
            Exporteren
        </div>
    </div>
    <?php } ?>
</div>  

<!-- Laat onderstaande view elementen alleen zien als een administrator is ingelogd -->
<?php if($_SESSION['admin']) { ?>
<div class="splitScreen">
    <div class="left">
        <table class="noAction">   
            <tr>
                <td>Studentnummer</td>  
                <td><input type="text"/></td>
            </tr>  
            <tr>
                <td>Voornaam</td>  
                <td><input type="text"/></td>
            </tr>         
            <tr>
                <td>Achternaam</td>  
                <td><input type="text"/></td>
            </tr>  
        </table>            
    </div>

    <div class="right">   
        <table class="noAction">  
            <tr>     
                <td>Startdatum</td>         
                <td><input type="text"/></td>
            </tr>           
            <tr>     
                <td>Einddatum</td>         
                <td><input type="text"/></td>
            </tr> 
            <tr>
                <td>Klas</td>
                <td>
                    <select class="selectFullSize" >
                        <option>Leerjaar 1</option>  
                        <option>Leerjaar 2</option>
                    </select>
                </td>
            </tr>
        </table>     
    </div>
</div>
<?php } ?>

<!-- Laat onderstaande view elementen alleen zien als een docent is ingelogd -->
<?php if(!$_SESSION['admin']) { ?>
<div class="splitScreen">
    <div class="left">
        <table class="noAction">  
            <tr>
                <td>Klas</td>
                <td>
                    <select class="selectFullSize" >
                        <option>Leerjaar 1</option>  
                        <option>Leerjaar 2</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Studentnummer</td>  
                <td><input type="text"/></td>
            </tr>  
        </table>            
    </div>

    <div class="right">   
        <table class="noAction">  
            <tr>
                <td>Voornaam</td>  
                <td><input type="text"/></td>
            </tr>         
            <tr>
                <td>Achternaam</td>  
                <td><input type="text"/></td>
            </tr> 
        </table>     
    </div>
</div>
<?php } ?>

<table cellpadding="0" cellspacing="0">
    <thead>      
        <th>Nummer</th>
        <th>Voornaam</th>     
        <th>Tussenvoegsel</th>   
        <th>Achternaam</th>
        <th>Email</th>      
        <th>Klas</th>
    </thead>    
    <tbody>
        <tr class="unEven">
            <td>12452</td>    
            <td>Henk</td>       
            <td>de</td>
            <td>Boer</td>
            <td>hBoer@hyves.nl</td>   
            <td>12asd51x</td>
        </tr>    
        <tr>      
            <td>23133</td>    
            <td>Joep</td>       
            <td></td>
            <td>Huizen</td>
            <td>jHuizen@me.com</td>      
            <td>12asd51x</td>
        </tr>
        <tr class="unEven">  
            <td>15452</td>    
            <td>Barry</td>       
            <td>van de</td>
            <td>Hoofdt</td>
            <td>bHoofdt@hotmail.nl</td>    
            <td>12asd51x</td>
        </tr>
        <tr>         
            <td>45124</td>   
            <td>Dennis</td>       
            <td></td>
            <td>Meeuwes</td>
            <td>dMeeuwes@live.nl</td>    
            <td>12asd52x</td>
        </tr>
        <tr class="unEven">  
            <td>36154</td>   
            <td>Frans</td>       
            <td></td>
            <td>Uijlen</td>
            <td>fUilen@msn.com</td>  
            <td>12asd52x</td>
        </tr>
    </tbody>
</table>