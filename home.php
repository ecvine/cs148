<? include ("top.php"); 

$file_name = pathinfo($_SERVER['PHP_SELF']);
$file_name = $file_name['filename'];

print '<body id="' . $file_name . '">';
 
include ("header.php");
include ("menu.php");
?>

<p id="mainContentWrapper">
<img id="rubyImg" src="ruby.png" alt="A little pug, Ruby sitting on a carpet" />
Have you ever heard an adorable tails ;) involving a new puppy? Any stories you want to share about a kitten you just rescued? Now is your chance to blog these stories. Share them with a tight knit community who wants to hear your animal adventures.
<br><br>
The little pug puppy to the right is Ruby Bridges. She is my friend's dog who I dog sit for all the time. She is part of the reason I created this site. Ruby is just a little bundle of joy. I have one story for you. As I mentioned she is a happy little puppy...most of the time. At night time she has a tendency to get comfortable and warm sitting in my lap. This only becomes a problem when I have to get up. Ruby warns me that she is upset with a nasty little growl. I usually have to throw the blanket over her head when I move so she doesn't nip. I love her little quirks.
<br><br>
Please join the community and share your stories. Sign up and give us a try.
</p>

<? include ("footer.php");
include ("end.php");
?>
