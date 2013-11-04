<nav id="navMenu">
	<ol>
	<?php if(basename($_SERVER['PHP_SELF'])=="home.php"){
    print '<li class="activePage">Home</li>' . "\n";
} else {
    print '<li><a href="home.php">Home</a></li>' . "\n";
} 
if(basename($_SERVER['PHP_SELF'])=="blog.php"){
    print '<li class="activePage">Blog</li>' . "\n";
} else {
    print '<li><a href="blog.php">Blog</a></li>' . "\n";
}
if(basename($_SERVER['PHP_SELF'])=="post.php"){
    print '<li class="activePage">Post</li>' . "\n";
} else {
    print '<li><a href="post.php">Post</a></li>' . "\n";
}
if(basename($_SERVER['PHP_SELF'])=="form.php"){
    print '<li class="activePage">Register</li>' . "\n";
} else {
    print '<li><a href="form.php">Register</a></li>' . "\n";
}
?>
	</ol>
</nav>