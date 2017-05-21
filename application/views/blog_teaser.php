<div class="blog-post" id="post-<?php echo $id; ?>">
	<h2 class="blog-post-title"><?php echo $title; ?></h2>
	<p class="blog-post-meta"><?php echo $date; ?> by <a href="#"><?php echo $author; ?></a></p>
	<?php
		echo $teaser;

		if ($readon) {
			echo '<p class="readon">' . anchor('post/' . $id, 'Read On') . '</p>';
		}
    ?>
</div><!-- /.blog-post -->