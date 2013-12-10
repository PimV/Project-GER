<h1>Resultaat</h1>          
<div class="ribbon">  
    <div class="item" onclick="javascript:location.href='index.php?p=studentsearch'">
                <div class="fontIcon"> 
                     &#xe126;
                </div>  
                <div class="text">
                    Terug
                </div>
    </div>
    <div class="item">
        <div class="fontIcon">
             &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>      
    <div class="item">
        <div class="fontIcon">
             &#xe1b2;
        </div>  
        <div class="text">
            Exporteren
        </div>
    </div>
</div>  

<div class="splitScreen">
    <div class="left">
        <table class="noAction">
            <tr>
                <td>Naam</td>  
                <td><input disabled="disabled" type="text" value="Patrick de Vries"/></td>
            </tr>  
            <tr>
                <td>Student nummer</td>  
                <td><input disabled="disabled" type="text" value="00203987"/></td>
            </tr>
            <tr>
                <td>Coach</td>  
                <td><input disabled="disabled" type="text" value="Bart Jansen"/></td>
            </tr>       
        </table>         
    </div>

    <div class="right">   
        <table class="noAction">       
            <tr>
                <td>Klas:</td>  
                <td><input disabled="disabled" type="text" value="42las54"/></td>
            </tr>       
            <tr>
                <td>Blok:</td>  
                <td><input disabled="disabled" type="text" value="4"/></td>
            </tr>
        </table>      
    </div>
</div> 

<br />
<!--Alleen huidige blok laten zien wanener de coach is ingelogd. Bij beheerder alles.-->
     <table class="noAction" style="width: 94%; border: 1px solid black;">   
        <tr>
            <td>Klas</td>  
            <td>
                <select class="selectFullSize" >
                    <option>Leerjaar 1</option>  
                    <option>Leerjaar 2</option>
                </select>
            </td>

            <td>Blok</td>         
            <td>
                <select class="selectFullSize" >
                    <option></option> 
                    <option>Blok 5 - Aarde</option>  
                    <option>Blok 6 - Energie</option>
                </select>
            </td>
        </tr> 
    </table>  

<br />

<table cellpadding="0" cellspacing="0" style="width: 94%;">
    <thead>   
        <th>Docent</th>   
        <th>Nr 1</th>
        <th>Nr 2</th>
        <th>Nr 3</th>
        <th>Nr 4</th>
        <th>Nr 5</th>
        <th>Nr 6</th>
        <th>Nr 7</th>   
        <th>Nr 8</th>
        <th>Nr 9</th>     
        <th>Nr 10</th>
        <th>Nr 11</th>   
        <th>Nr 12</th>
    </thead>      
    <tbody>
        <tr class="unEven">     
            <td>Henk de Boer</td>
            <td>2</td>      
            <td>4</td>
            <td>3</td>
            <td>1</td>
            <td>1</td>
            <td>5</td>
            <td>2</td>
            <td>3</td>
            <td>5</td>
            <td>1</td>
            <td>2</td>
            <td>1</td>
        </tr>    
        <tr>                
            <td>Jan Haas</td>
            <td>4</td>      
            <td>5</td>
            <td>2</td>
            <td>3</td>
            <td>2</td>
            <td>4</td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>1</td>
            <td>3</td>
            <td>2</td>
        </tr>     
        <tr class="unEven">     
            <td>Rik Rikken</td> 
            <td>1</td>      
            <td>4</td>
            <td>3</td>
            <td>2</td>
            <td>1</td>
            <td>4</td>
            <td>2</td>
            <td>1</td>
            <td>5</td>
            <td>3</td>
            <td>2</td>
            <td>2</td>
        </tr>   
        <tr>               
            <td>Wim Wimpie</td> 
            <td>4</td>      
            <td>5</td>
            <td>2</td>
            <td>3</td>
            <td>2</td>
            <td>4</td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>1</td>
            <td>3</td>
            <td>2</td>
        </tr>  
        <tr class="unEven">       
            <td>Dirk Dommers</td>   
            <td>2</td>      
            <td>4</td>
            <td>3</td>
            <td>1</td>
            <td>1</td>
            <td>5</td>
            <td>2</td>
            <td>3</td>
            <td>5</td>
            <td>1</td>
            <td>2</td>
            <td>1</td>
        </tr>   
    </tbody> 
</table>

<br>

<!--Check of de ingelogde docent de coach is, en er nog geen eindoordeel vast gezet is, laat dan onderstaande tabel zien.-->
<table class="noAction" style="width: 94%; border: 1px solid black;">
    <thead>
        <th>Nr 1</th>
        <th>Nr 2</th>
        <th>Nr 3</th>
        <th>Nr 4</th>
        <th>Nr 5</th>
        <th>Nr 6</th>
        <th>Nr 7</th>   
        <th>Nr 8</th>
        <th>Nr 9</th>     
        <th>Nr 10</th>
        <th>Nr 11</th>   
        <th>Nr 12</th>
    </thead>    
    <tbody>
    <tr>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>      
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
    </tr>  
</table>
