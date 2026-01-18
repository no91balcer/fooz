<?php
if ( ! is_singular( 'book' ) ) {
	return;
}

$post_id = get_the_ID();
?>

<div class="wp-block-fooz-test-book-related b-book-related" data-current-id="<?php echo esc_attr( $post_id ); ?>">
    <h2 class="b-book-related__title">
        <?php esc_html_e( 'Other books', 'fooz-test' ); ?>
    </h2>
    <div class="b-book-related__list c-book-list"></div>
</div>