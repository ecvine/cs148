
<? include ("top.php"); 

$file_name = pathinfo($_SERVER['PHP_SELF']);
$file_name = $file_name['filename'];

print '<body id="' . $file_name . '">';
 
include ("header.php");
include ("menu.php");
?>

<p id="mainContentWrapper"> To make a comment please fill out all of the information below.


<form id="formWrapper">


	<label for="txtUsername" class="required">Username</label>
	
	<input id="txtUsername" name="txtUsername" value="" tabindex="110" size="25" maxlength="45" onfocus="this.select()" type="text">	
			<br>
	<label for="txtSubject" class="required">Subject</label>
	<input id="txtSubject" name="txtSubject" value="" tabindex="100" size="25" maxlength="100" onfocus="this.select()" type="text">
	<br>
	<p>Post <br>
	<textarea rows="7" maxLength="5000" placeholder="Share your tails here." name="txtPost" onfocus="this.select()"></textarea></p>
				
	<input type="submit" id="btnSubmit" name="btnSubmit" value="Submit Post*" 
				 class="button"/>

</form>
<p id="disclaimer">*By posting you agree to be solely responsible for the content of all information you contribute. Opinions expressed here and in any corresponding comments are the personal opinions of the original authors, not of Animal Adventures. Please do not spam, use inappropriate language or pretend to be anyone else. If you do any of the listed above your account will be frozen and you will not be allowed to comment anymore.</p>



<? include ("footer.php");
include ("end.php");
?>
