<figure>
<?php if(isset($_COOKIE["character"])) {
   print "<img src = \"" . $_COOKIE["character"] . "\" alt = \"\">";
}?>  
    <figcaption>
        <?php if(isset($_COOKIE["advenName"]) and isset($_COOKIE["homeLand"])) {
           Echo  $_COOKIE["advenName"] . "  " . "from  " . $_COOKIE["homeLand"];
        }?>         
    </figcaption>
</figure>