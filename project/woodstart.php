<?php 
include("top.php");        
include("header.php");     
include("characterDeets.php");
?>

<p>You steel yourself for the coming battle. It is inevitable. You reflect. You grab your 
    
      <?php if(isset($_COOKIE["equipment"])) {
        Echo strtoupper($_COOKIE["equipment"]);
        }?>  
    
    that was collecting dust over the years. You finally get to do battle!</p>
<p>After your preparations are complete, you set off on a new journey. First off, you must gather the other two heroes told in the myth passed down for generations. They most likely saw the same dream you just had. They are at the dungeon where the Calamity resides to build up mass. After walking on the common path used by travellers, you come across a fork in the road. One path short, but dangerous monsters lurk in the shadows of the woods. The other path is long, but it is safer than the other path. It is relatively easier in term of travel but it will take more time.</p>
<p>What will you choose?</p>

<p class="center">
    <a href="bandits.php">Choose long but easy path.</a>
</p>
<p class="center">
    <a href="death2.php">Choose short but hard path.</a>
</p>

<?php 
include("footer.php");
?>
</body>
</html>