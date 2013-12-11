
<h1>Beoordelingen</h1>  

<div class="ribbon">       
    <div class="item">
        <div class="fontIcon">
            &#xe126;
        </div>  
        <div class="text">
            Terug
        </div>
    </div> 
    <div class="item" onclick="javascript:location.href = 'index.php?p=beoordelingedit&id='">

        <div class="fontIcon">
            &#xe0b3;
        </div>  
        <div class="text" >
            Beoordelen
        </div>
    </div>
</div>  

<table cellpadding="0" cellspacing="0">
    <thead>
    <th>Klas</th>     
    <th>Aantal studenten</th>   
    <th>Beoordeeld</th>
</thead>    
<tbody>
    <?php
    //Loop through all classes and populate table

    /*
     *  foreach($klassen as $klas) {
     *      <tr class="unEven">
      <td>$klas->getCode()</td>
      <td>$klas->getStudentAmount()</td>
      <td>$klas->getToDo()</td>
      </tr>
     *  }
     */
    ?>
    <tr class="unEven">
        <td>45sad12</td>       
        <td>22</td>
        <td>Nee</td>
    </tr>    
    <tr>                       
        <td>45sad14</td>       
        <td>19</td>
        <td>Ja</td>
    </tr>
    <tr class="unEven">     
        <td>25sad12</td>       
        <td>25</td>
        <td>Ja</td>
    </tr>
    <tr>                   
        <td>45sad02</td>       
        <td>21</td>
        <td>Nee</td>
    </tr>
    <tr class="unEven">       
        <td>15sad12</td>       
        <td>29</td>
        <td>Nee</td>
    </tr>
</tbody>
</table>

