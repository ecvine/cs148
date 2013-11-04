<? include ("top.php"); 

$file_name = pathinfo($_SERVER['PHP_SELF']);
$file_name = $file_name['filename'];

print '<body id="' . $file_name . '">';
 
include ("header.php");
include ("menu.php");
?>

<section id="mainContentWrapper"> 
<br>
<p class="userComment">No one has posted any stories yet. Please share your stories. I am currently living in an apartment where we are not allowed to have any pets. I made this site because I want to reconnect with animals. I miss my little basset hound back home. She is six years old, going on seven this December. I sometimes find that I need to go home just to visit her. Every memory that gets shared helps me miss my puppy less.

<br><br>
So please please share your stories. 
</p>
<br>

  </section>

<? include ("footer.php");
include ("end.php");
?>