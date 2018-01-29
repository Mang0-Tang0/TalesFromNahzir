<form action ='<?php print $phpSelf; ?>'
              id ='frmCreateChar'
              method ='post'>
            <p>**COOKIES MUST BE ENABLED</p>
            
            <fieldset class="createChar">
                <legend>Character Creator</legend>   
                <p>
                <label class= "required text-field" for = "txtAdvenName"> Adventurer Name: </label>
                <input 
                       <?php if ($advenNameERROR) print 'class="mistake"'; ?>
                       type ="text"
                       id = "txtAdvenName"
                       name = "txtAdvenName"
                       value = "<?php print $advenName; ?>"
                       size ="30" 
                       maxlength="100">
                </p>                 
                <p>
                <label class= "required text-field" for = "txtHomeLand"> Home Land: </label>
                <input 
                       <?php if ($homeLandERROR) print 'class="mistake"'; ?>
                       type ="text"
                       id = "txtHomeLand"
                       name = "txtHomeLand"
                       value = "<?php print $homeLand; ?>"
                       size ="30" 
                       maxlength="100">
                </p> 
                <p>
                <label for = "lstCharType"> Character Type: </label>
                <select id="lstCharType"
                        name="lstCharType"
                        >
                    <option value = "Human">Human</option>
                    <option value ="Elf">Elf</option>
                    <option value ="Troll">Troll</option>
                </select>  
                </p>           
                <p> Select Equipment: <br/>
                <label class="radioBut">
                    <input type="radio"
                           id="radEquipMagic"
                           name="radEquip"
                           value="Magic"
                           <?php if ($equip == "Magic") echo 'checked="checked"'; ?>>
                Magic</label>
                </p>                
                <p>
                <label class="radioBut">
                    <input type="radio"
                           id="radEquipWeapon"
                           name="radEquip"
                           value="Weapon"
                           <?php if ($equip == "Weapon") echo 'checked="checked"'; ?>>
                Weapon</label>
                </p>
                <p>
                <label class="radioBut">
                    <input type="radio"
                           id="radEquipPotion"
                           name="radEquip"
                           value="Potion"
                           <?php if ($equip == "Potion") echo 'checked="checked"'; ?>>
                Potion</label>
                </p>  
            <br/>    
            
            <p> Favorite Foods: <br/>
                <label class="check-field">
                    <input <?php if ($foodERROR) print 'checked'; ?>
                        id="chkCheese"
                        name="chkCheese"
                        tabindex="420"
                        type="checkbox"
                        value="Cheese">
                Just Cheese</label>
            </p>
            <p>
                <label class="check-field">
                    <input <?php if ($chkCelery) print 'checked'; ?>
                        id="chkCelery"
                        name="chkCelery"
                        tabindex="430"
                        type="checkbox"
                        value="Celery">
                Celery</label>
            </p>                
            <p>
                <label class="check-field">
                    <input <?php if ($chkIceCream) print 'checked'; ?>
                        id="chkIceCream"
                        name="chkIceCream"
                        tabindex="430"
                        type="checkbox"
                        value="IceCream">
                Ice Cream</label>
            </p>                 

        </fieldset> <!-- ends contact -->
        
        <fieldset class="buttons">
            <legend></legend>
                <p>
                <label class= "required text-field" for = "txtEmail"> Email: </label>
                <input autofocus 
                       <?php if ($emailERROR) print 'class="mistake"'; ?>
                       type ="text"
                       id = "txtEmail"
                       name = "txtEmail"
                       value = "<?php print $email; ?>"
                       size ="30" 
                       maxlength="100">
                </p>             
            <input class ="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="CREATE CHARACTER">
        </fieldset> <!-- ends buttons-->            
            
            
        </form>