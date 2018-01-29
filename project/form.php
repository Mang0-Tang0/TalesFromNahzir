<?php 
include("top.php");          // Currently don't know if we need both of these for this page
include("header.php");
include("nav.php"); 

//SECTION 1 INITIALIZE VARIABLES********************

// SECTION 1a. 
// we print out the post array so that we can see our form is working.
 if ($debug) { //later you can uncomment the if statement
    print '<p>Post Array:</p><pre>';
    print_r($_POST);
    print '</pre>';
    
 }  

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in section 2a

$thisURL = $domain . $phpSelf;


//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables 
//
// Initialize variables one for each form element
// in order they appear on the form 

$email = "";
$advenName = "";
$homeLand = "";
$charType = "";
$chkCheese = true;
$chkCelery = false;
$chkIceCream = false;
$equip = "Magic";

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize error flags, one for each form element we validate
// in order they appear in section 1c 

$emailERROR = false;
$advenNameERROR = false;
$homeLandERROR = false;
$charTypeError = false;
$equipERROR = false;
$foodERROR = false;
$numFavFoodChked = 0;

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// Create  array to hold  error messages filled (if any) in 2d displayed in 3c
    $errorMsg = array();
    
// array used to hold form values that will be written to CSV file
   $dataRecord = array(); 
   
// array containing player's character choice 
// First indices: 0 = human, 1 = elf, 3 = troll    
// Second indices: 0 = magic, 1 = weapon, 3 = potion
// Value in array = image url
   $characterPic = array(
       array("images/humanmagic.png","images/humanweapon.png","images/humanpotion.png"),
       array("images/elfmagic.png","images/elfweapon.png","images/elfpotion.png"),
       array("images/trollmagic.png","images/trollweapon.png","images/trollpotion.png")
       );
   
// have we emailed information to the user?
   $mailed = false; 

// Variable to toggle showing the form. If we submited the form, dont show the form
   $showForm = true;
  
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION 2: Process for when the form is submitted 
// 
    if (isset($_POST["btnSubmit"])){
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION 2a: Security
    //
        if(!securityCheck($thisURL)){
            $msg = '<p>Sorry you cannot access this page. ';
            $msg .= 'Security breach detected and reported. </p>';
            die($msg);
        }


    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION 2b: Sanitize (clean) data
    // remove any potential Javascript or html code from user input on the
    // form. Note it is best to follow the same order as declared in section 1c
        $advenName = htmlentities($_POST["txtAdvenName"],ENT_QUOTES,"UTF-8");
        $dataRecord[] = $advenName;
        
        $email = filter_var($_POST["txtEmail"],FILTER_SANITIZE_EMAIL);
        $dataRecord[] = $email; 
           
        $homeLand = htmlentities($_POST["txtHomeLand"],ENT_QUOTES,"UTF-8");
        $dataRecord[] = $homeLand;
        
        $charType = htmlentities($_POST["lstCharType"],ENT_QUOTES,"UTF-8");
        $dataRecord[] = $charType;
        
        $equip = htmlentities($_POST["radEquip"] , ENT_QUOTES , "UTF-8");
        $dataRecord[] = $equip;
        
        if (isset($_POST["chkCheese"])) {
            $chkCheese = true;
            $dataRecord[] = htmlentities($_POST["chkCheese"] , ENT_QUOTES , "UTF-8");
            $numFavFoodChked= $numFavFoodChked + 1;
        } else {
            $chkCheese = false;
            $dataRecord[] = "";
        }

        if (isset($_POST["chkCelery"])) {
            $chkCelery = true;
            $dataRecord[] = htmlentities($_POST["chkCelery"] , ENT_QUOTES , "UTF-8");
            $numFavFoodChked= $numFavFoodChked + 1;
        } else {
            $chkCelery = false;
            $dataRecord[] = "";
        }

        if (isset($_POST["chkIceCream"])) {
            $chkIceCream = true;
            $dataRecord[] = htmlentities($_POST["chkIceCream"] , ENT_QUOTES , "UTF-8");
            $numFavFoodChked= $numFavFoodChked + 1;
        } else {
            $chkIceCream = false;
            $dataRecord[] = "";
        }        
    
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION 2c: Validation
    //
    // Validation section. Check each value for possible errors, empty or
    // not what we expect. You will need an IF block for each element you wil 
    // check (see above section 1c and 1d). The if blocks should also be in the 
    // order that the elements appear on your form so that the error messages 
    // will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.
    
    //CHECK IF COOKIES ARE ENABLED************************************************
        
    
        
    if($advenName == ""){
        $errorMsg[] = "Please enter your character's name.";
        $advenNameERROR = true; 
    } elseif (!verifyAlphaNum($advenName)){
        $errorMsg[] = "Your character name appears to have an extra character.";
        $firstNameERROR = true;
    }

    if($homeLand == ""){
        $errorMsg[] = "Please enter your character's home land .";
        $homeLandERROR = true; 
    } elseif (!verifyAlphaNum($homeLand)){
        $errorMsg[] = "Your character's home land name appears to have an extra character.";
        $homeLandERROR = true;
    }    
    
    if($charType == ""){
        $errorMsg[] = "Please choose a character type";
        $charTypeError = true;
    }
    
    if ($numFavFoodChked < 1) {
    $errorMsg[] = "Please choose at least one favorite food.";
    $foodERROR = true;
    }
    
    if ($equip != "Magic" and $equip != "Weapon" and $equip != "Potion"){
        $errorMsg[] = "Please choose an option for equipment.";
        $equip = true;        
    }
    
    if ($email == ""){
        $errorMsg[] = 'Please enter your email address';
        $emailERROR = true;
    } elseif (!verifyEmail($email)){
        $errorMsg[] = 'Your email address appears to be incorrect.';
        $emailERROR = true;
    }
    

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION 2d: Process Form - Passed Validation 
    // 
    // Proccess for when the form passes validation (the errorMsg array is empty)
    //
    
    if(!$errorMsg){
        if ($debug) {
            print PHP_EOL . '<p> Form is Valid</p>';
        }    
        
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION 2e: Save Date
    // 
    // This block saves the data to a CSV file.
    
    $myFolder = '';
    
    $myFileName = 'characterDetails';
   
    $fileExt = '.csv';
    
    $filename = $myFolder . $myFileName . $fileExt;
    if ($debug) {
        print PHP_EOL . '<p> filename is ' . $filename;
    }
    // now we just open the file for append.
    $file = fopen($filename, 'r');
    
    // write the forms information
    fputcsv($file,$dataRecord);
    
    // close the file
    fclose($file);
    
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION 2f: Create Message 
    //
    // build message to display on the screen in section 3a and to mail 
    // to the person filling out the form (section 2g).
    
    $message = '<h2>Your Character Information:</h2>';
    
    foreach ($_POST as $htmlName => $value){
        $message .= '<p>';
        // breaks up the form names into words. for example
        // txtFirstName becomes First Name
        $camelCase = preg_split('/(?=[A-Z])/',substr($htmlName,3));
        
        foreach ($camelCase as $oneWord){
            $message .= $oneWord . ' ';
        }
        
        $message .= ' = ' . htmlentities($value,ENT_QUOTES, "UFT-8") . '</p>';
    }
    
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION 2g: Mail to User
    // 
    // Process for mailing a message which contains the forms data 
    // the message was built in section 2f
    $to = $email; //the person who filled out the form 
    $cc = '';
    $bcc = '';
    
    $from = 'Shivani Sharma <customer.service@adventure.com>';
    
    //subject of mail should make sense to your form 
    $subject = 'Character Created';
    
    $mailed = sendmail($to,$cc,$bcc,$from,$subject,$message);
        
        
    // SET COOKIES**************************************************************
        if ($charType == "Human"){
            $firstIndex = 0;
        } elseif ($charType == "Elf"){
            $firstIndex = 1;
        } elseif ($charType == "Troll") { 
            $firstIndex = 2;
        }
        
        if ($equip == "Magic"){
            $secondIndex = 0;
        } elseif ($equip == "Weapon"){
            $secondIndex = 1;
        } elseif ($equip == "Potion") { 
            $secondIndex = 2;
        }
            
        $cookie_val = $characterPic[$firstIndex][$secondIndex];
        setcookie("character",$cookie_val);
        setcookie("equipment",$equip);
        setcookie("advenName",$advenName);
        setcookie("homeLand",$homeLand);
        $cookie_val = "";
        If ($numFavFoodChked = 0){
            $cookie_val = "Nothing";
        }
        if ($chkCheese == true ){
            $cookie_val = "Cheese";
            if (($chkCelery == true) or ($chkIceCream == true)){
                $cookie_val .= " and ";
            }     
        }
        if ($chkCelery == true){
            $cookie_val .= "Celery"; 
            if ($chkIceCream == true){
                $cookie_val .= " and ";
            }            
        }
        if ($chkIceCream == true){
            $cookie_val .= "Ice Cream";             
        }        
        setcookie("foods",$cookie_val);
    
        // Dont show the form again
        $showForm = false;
        
        
    }// ends form is valid
    
        
}// ends if form was submitted
    
       
//SECTION 3: Display form *************************************  
        
//SECTION 3B: Error Messages
    
//display any error messages before we print out the form.
    
    if ($errorMsg) {
        print '<div id="errors">' . PHP_EOL;
        print '<h2>Your form has the following mistakes that need to be fixed.</h2>' . PHP_EOL;
        print '<ol>' . PHP_EOL;
        
        foreach ($errorMsg as $err) {
            print '<li>' . $err . '</li>' . PHP_EOL;
        }
        
        print '</ol>' . PHP_EOL;
        print '</div>' . PHP_EOL;
    }  
  
  if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) {
      include("formSubmitted.php");  
      
    }else {
        include("formControls.php");
    }
include("footer.php");
?>

    </body>
</html>