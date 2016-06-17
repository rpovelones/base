<h1 class="page-title"><?php echo get_the_title($id); ?></h1>

<?php // basically run the content filter on our posts
// the_content() won't work since we are outside of the WP loop
$content_post = get_post($id);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
echo $content;
?>