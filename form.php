<?php
/* the purpose of this page is to display a form to allow a person to register
 * the form will be sticky meaning if there is a mistake the data previously 
 * entered will be displayed again. Once a form is submitted (to this same page)
 * we first sanitize our data by replacing html codes with the html character.
 * then we check to see if the data is valid. if data is valid enter the data 
 * into the table and we send and dispplay a confirmation email message. 
 * 
 * if the data is incorrect we flag the errors.
 * 
 * Written By: Robert Erickson robert.erickson@uvm.edu
 * Last updated on: October 10, 2013
 * 
 * 
  -- --------------------------------------------------------
  --
  -- Table structure for table `tblRegister`
  --

  CREATE TABLE IF NOT EXISTS `tblRegister` (
  `pkRegisterId` int(11) NOT NULL AUTO_INCREMENT,
  `fldEmail` varchar(65) DEFAULT NULL,
  `fldDateJoined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fldConfirmed` tinyint(1) NOT NULL DEFAULT '0',
  `fldApproved` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkPersonId`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

 * I am using a surrogate key for demonstration, 
 * email would make a good primary key as well which would prevent someone
 * from entering an email address in more than one record.
 */

//-----------------------------------------------------------------------------
// 
// Initialize variables
//  

$debug = false;
if ($debug) print "<p>DEBUG MODE IS ON</p>";

$baseURL = "http://www.uvm.edu/~evine/";
$folderPath = "cs148/assignment4.1/";
// full URL of this form
$yourURL = $baseURL . $folderPath . "form.php";

require_once("connect.php");

//#############################################################################
// set all form variables to their default value on the form. for testing i set
// to my email address. you lose 10% on your grade if you forget to change it.

$email = "";
$username = "";
$gender = "";
$dog = "";
$cat = "";
$other = "";
$yearsWithPets ="";

// 
//#############################################################################
// 
// flags for errors

$emailERROR = false;
$usernameERROR = false;
$genderERROR = false;
$dogERROR = false;
$catERROR = false;
$otherERROR = false;
$yearsWithPets = false;


//#############################################################################
//  
$mailed = false;
$messageA = "";
$messageB = "";
$messageC = "";


//-----------------------------------------------------------------------------
// 
// Checking to see if the form's been submitted. if not we just skip this whole 
// section and display the form
// 
//#############################################################################
// minor security check

if (isset($_POST["btnSubmit"])) {
    $fromPage = getenv("http_referer");

//    if ($debug)
//        print "<p>From: " . $fromPage . " should match ";
//        print "<p>Your: " . $yourURL;

    if ($fromPage != $yourURL) {
        die("<p>Sorry you cannot access this page. Security breach detected and reported.</p>");
    }


//#############################################################################
// replace any html or javascript code with html entities
//

    $email = htmlentities($_POST["txtEmail"], ENT_QUOTES, "UTF-8");
    $username = htmlentities($_POST["txtUsername"], ENT_QUOTES, "UTF-8");
    $gender = htmlentities($_POST["radGender"], ENT_QUOTES, "UTF-8");
    $dog = htmlentities($_POST["chkDog"], ENT_QUOTES, "UTF-8");
    $cat = htmlentities($_POST["chkCat"], ENT_QUOTES, "UTF-8");
	$other = htmlentities($_POST["chkOther"], ENT_QUOTES, "UTF-8");
	$yearsWithPets = htmlentities($_POST["ddmyearsWithPets"], ENT_QUOTES, "UTF-8");

//#############################################################################
// 
// Check for mistakes using validation functions
//
// create array to hold mistakes
// 

    include ("validation_functions.php");

    $errorMsg = array();


//############################################################################
// 
// Check each of the fields for errors then adding any mistakes to the array.
//
    //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^       Check email address
    if (empty($email)) {
        $errorMsg[] = "Please enter your Email Address<br>";
        $emailERROR = true;
    } else {
        $valid = verifyEmail($email); /* test for non-valid  data */
        if (!$valid) {
            $errorMsg[] = "I'm sorry, the email address you entered is not valid.<br>";
            $emailERROR = true;
        }
    }

    if (empty($username)) {
        $errorMsg[] = "Please enter your username";
        $usernameERROR = true;
    } else {
        $valid = verifyUsername($username); /* test for non-valid  data */
        if (!$valid) {
            $errorMsg[] = "I'm sorry, the username you entered is not valid.";
            $usernameERROR = true;
        }
    }


//############################################################################
// 
// Processing the Data of the form
//

    if (!$errorMsg) {
        if ($debug) print "<p>Form is valid</p>";

//############################################################################
//
// the form is valid so now save the information
//    
        $primaryKey = "";
        $dataEntered = false;
        
        try {
            $db->beginTransaction();
//register - email           
            $sql = 'INSERT INTO tblRegister SET ';
            $sql .='pkEmail="' . $email . '" ';
            
            $stmt = $db->prepare($sql);
            if ($debug) print "<p>sql ". $sql;
       
            $stmt->execute();
            $primaryKey = $email;
            if ($debug) print "<p>pk= " . $primaryKey;
//blogger - email

 			$sql = 'INSERT INTO tblBlogger SET ';
            $sql .='pkEmail="' . $email . '" ';
            
            $stmt = $db->prepare($sql);
            if ($debug) print "<p>sql ". $sql;

			$stmt->execute();
			$primaryKey = $email;
			if ($debug) print "<p>pk= " . $primaryKey;
//blogger - username
 			$sql = 'INSERT INTO tblBlogger SET ';
            $sql .='fldUsername="' . $username . '" ';
            
            $stmt = $db->prepare($sql);
            if ($debug) print "<p>sql ". $sql;

			$stmt->execute();
			$primaryKey = $email;
			if ($debug) print "<p>fld= " . $primaryKey;
//blogger-gender
 			$sql = 'INSERT INTO tblBlogger SET ';
            $sql .='fldGender="' . $gender . '" ';
            
            $stmt = $db->prepare($sql);
            if ($debug) print "<p>sql ". $sql;

			$stmt->execute();
			$primaryKey = $gender;
			if ($debug) print "<p>fld= " . $primaryKey;
// animals - dog
 			$sql = 'INSERT INTO tblAnimals SET ';
            $sql .='fldTypeOfAnimal="' . $dog . '" ';
            
            $stmt = $db->prepare($sql);
            if ($debug) print "<p>sql ". $sql;

			$stmt->execute();
			$primaryKey = $dog;
			if ($debug) print "<p>pk= " . $primaryKey;
// animals - cat
 			$sql = 'INSERT INTO tblAnimals SET ';
            $sql .='fldTypeOfAnimal="' . $cat . '" ';
            
            $stmt = $db->prepare($sql);
            if ($debug) print "<p>sql ". $sql;

			$stmt->execute();
			$primaryKey = $cat;
			if ($debug) print "<p>pk= " . $primaryKey;			
//animals - other
 			$sql = 'INSERT INTO tblAnimals SET ';
            $sql .='fldTypeOfAnimal="' . $other . '" ';
            
            $stmt = $db->prepare($sql);
            if ($debug) print "<p>sql ". $sql;

			$stmt->execute();
			$primaryKey = $other;
			if ($debug) print "<p>pk= " . $primaryKey;
//blogger - years with pets
 			$sql = 'INSERT INTO tblBlogger SET ';
            $sql .='fldyearsWithPets="' . $yearsWithPets . '" ';
            
            $stmt = $db->prepare($sql);
            if ($debug) print "<p>sql ". $sql;

			$stmt->execute();
			$primaryKey = $yearsWithPets;
			if ($debug) print "<p>fld= " . $primaryKey;

			
            // all sql statements are done so lets commit to our changes
            $dataEntered = $db->commit();
            if ($debug) print "<p>transaction complete ";
        } catch (PDOExecption $e) {
            $db->rollback();
            if ($debug) print "Error!: " . $e->getMessage() . "</br>";
            $errorMsg[] = "There was a problem with accpeting your data please contact us directly.";
        }


        // If the transaction was successful, give success message
        if ($dataEntered) {
            if ($debug) print "<p>data entered now prepare keys ";
            //#################################################################
            // create a key value for confirmation

            $sql = "SELECT fldDateJoined FROM tblRegister WHERE pkRegisterId=" . $primaryKey;
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $dateSubmitted = $result["fldDateJoined"];

            $key1 = sha1($dateSubmitted);
            $key2 = $primaryKey;

            if ($debug) print "<p>key 1: " . $key1;
            if ($debug) print "<p>key 2: " . $key2;


            //#################################################################
            //
            //Put forms information into a variable to print on the screen
            //

            $messageA = '<h2>Thank you for registering.</h2>';

            $messageB = "<p>Click this link to confirm your registration: ";
            $messageB .= '<a href="' . $baseURL . $folderPath  . 'confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . '">Confirm Registration</a></p>';
            $messageB .= "<p> or copy and paste this url into a web browser: ";
            $messageB .= $baseURL . $folderPath  . 'confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . "</p>";

            $messageC .= "<p><b>Email Address:</b><i>   " . $email . "</i><br><b>Username: </b>" . $username . "<br><b>Gender: </b>" . $gender . "<br><b>Pets: </b>" . $dog . $cat . $other . "<br><b>Years With Pets: </b>" . $yearsWithPets . "</p>";


            //##############################################################
            //
            // email the form's information
            //
            
            $subject = "Animal Adventures Registration Confirmation";
            include_once('mailMessage.php');
            $mailed = sendMail($email, $subject, $messageA . $messageB . $messageC);
        } //data entered   
    } // no errors 
}// ends if form was submitted. 

    include ("top.php");

    $ext = pathinfo(basename($_SERVER['PHP_SELF']));
    $file_name = basename($_SERVER['PHP_SELF'], '.' . $ext['extension']);

    print '<body id="' . $file_name . '">';

    include ("header.php");
    include ("menu.php");
    ?>

    <section id="main">


        <?
//############################################################################
//
//  In this block  display the information that was submitted and do not 
//  display the form.
//
        if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) {
            print "<h2>Your Request has ";

            if (!$mailed) {
                echo "not ";
            }

            echo "been processed</h2>";

            print "<p>A copy of this message has ";
            if (!$mailed) {
                echo "not ";
            }
            print "been sent to: " . $email . "</p>";

            echo $messageA . $messageC;
        } else {


//#############################################################################
//
// Here we display any errors that were on the form
//

            print '<div id="errors">';

            if ($errorMsg) {
                echo "<ol>\n";
                foreach ($errorMsg as $err) {
                    echo "<li>" . $err . "</li>\n";
                }
                echo "</ol>\n";
            }

            print '</div>';
            ?>

<!-- ########################	Main Content	############################# -->

<p id="mainContentWrapper"> 
<br/>
Please fill out the information below to register for Animal Adventures. We would love for you to become part of our community and share your stories. We encourage you to sign up even if you don't have a pet. This is a great place to ask questions if you are considering getting a pet.<br><br>

Before you are able to post, we ask that you confirm the email address you provided; therefore please give us a valid email address.

            <form action="<? print $_SERVER['PHP_SELF']; ?>"

                  method="post"
                  id="formWrapper">
<fieldset>
<legend>Contact Information:</legend>					
				
	<label for="txtEmail" class="required">Email</label>
	<input id="txtEmail" name="txtEmail" tabindex="100" size="25" maxlength="45" placeholder="Enter your email adress" onfocus="this.select()" type="text" value="<?php echo $email; ?>">

	<label for="txtUsername" class="required">Username</label>
	<input id="txtUsername" name="txtUsername" tabindex="110" size="25" maxlength="45" placeholder="Enter your username" onfocus="this.select()" type="text" value="<?php echo $username; ?>">	
</fieldset>

<fieldset>
<legend>Gender:</legend>
	<label><input type="radio" id="radMale" name="radGender" value="Male" tabindex="210" checked="checked" />Male</label><br />
	<label><input type="radio" id="radFemale" name="radGender" value="Female" tabindex="220" />Female</label><br />
	<label><input type="radio" id="radOther" name="radGender" value="Other" tabindex="230" />Other</label><br />
</fieldset>

<fieldset>
<legend>What types of animals do you have:</legend>
	<label><input type="checkbox" name="chkDog" value="Dog" tabindex="310">Dog</label><br/>
	<label><input type="checkbox" name="chkCat" value="Cat" tabindex="320">Cat</label><br/>
	<label><input type="checkbox" name="chkOther" value="Other" tabindex="330">Other</label>
</fieldset>	

<fieldset>
<legend>How long have you lived with pets:</legend>
<select id="yearsWithPets" name="ddmyearsWithPets" tabindex="410">
  <option>0 - 1 year</option>
  <option>1 - 5 years</option>
  <option>5 - 15 years</option>
  <option>15 - 30 years</option>
<option>More than 30 years</option>
</select>
</fieldset>

<fieldset class="buttons">
	<legend>Submit the form:</legend>				
	<input type="submit" id="btnSubmit" name="btnSubmit" value="Register*" 
				tabindex="991" class="button"/>

	<input type="reset" id="btnReset" name="btnReset" value="Reset Form" 
				tabindex="993" class="button" onclick="reSetForm()" />
</fieldset>	

</form>

<p id="disclaimer">*By posting you agree to be solely responsible for the content of all information you contribute. Opinions expressed here and in any corresponding comments are the personal opinions of the original authors, not of Animal Adventures. Please do not spam, use inappropriate language or pretend to be anyone else. If you do any of the listed above your account will be frozen and you will not be allowed to comment anymore.</p>
            <?php
        } // end body submit
        if ($debug)
            print "<p>END OF PROCESSING REGISTER</p>";
        ?>
    </section>
<? include ("footer.php");
include ("end.php");
?>