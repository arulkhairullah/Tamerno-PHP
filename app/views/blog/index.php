This index page of blog<br/>

	
<ul>
	<?php while ($post = $posts->fetch_object()){  ?>
	<li><?php echo $post->title; ?></li>
	<?php } ?>
</ul>

<a href="/">home</a>
<?php
?>