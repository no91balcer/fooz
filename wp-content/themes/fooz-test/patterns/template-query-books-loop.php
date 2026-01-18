<?php
/**
 * Title: Books loop
 * Slug: fooz-test/template-query-books-loop
 * Inserter: no
 * postTypes: book
 */
?>

<!-- wp:query {"query":{"perPage":20,"postType":"book","inherit":true}} -->
<div class="wp-block-query">

	<!-- wp:post-template {"className":"c-book-list"} -->
	<!-- wp:group {"tagName":"div","className":"c-book"} -->
	<div class="wp-block-group c-book">

		<a href="<?php the_permalink(); ?>" class="c-book__link">
			<!-- wp:group {"tagName":"div","className":"c-book__thumb-container","layout":{"type":"constrained"}} -->
			<div class="wp-block-group c-book__thumb-container">
				<!-- wp:post-featured-image {"isLink":false,"aspectRatio":"90/125","className":"c-book__thumb"} /-->
			</div>
			<!-- /wp:group -->

			<!-- wp:post-title {"isLink":false,"level":3,"className":"c-book__title"} /-->
            <!-- wp:post-date {"className":"c-book__date"} /-->

            <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|0"}}}} -->
            <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--0);">
	            <?php
	            $genres = get_the_terms(get_the_ID(), 'genre');
	            if ($genres && !is_wp_error($genres)) : ?>
                    <div class="c-book__genres">
			            <?php foreach ($genres as $genre) : ?>
                            <span class="c-book__genre-tag">
                                <?php echo esc_html($genre->name); ?>
                            </span>
			            <?php endforeach; ?>
                    </div>
	            <?php endif; ?>
            </div>
            <!-- /wp:group -->

			<!-- wp:post-excerpt {"className":"c-book__excerpt"} /-->
		</a>
	</div>
	<!-- /wp:group -->
	<!-- /wp:post-template -->

	<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"right"},"className":"c-pagination", "style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-query-pagination c-pagination" style="padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20)">

		<!-- wp:query-pagination-previous {"className":"c-pagination__prev"} /-->
		<!-- wp:query-pagination-numbers {"className":"c-pagination__numbers"} /-->
		<!-- wp:query-pagination-next {"className":"c-pagination__next"} /-->

	</div>
	<!-- /wp:query-pagination -->

	<!-- wp:query-no-results -->
	<!-- wp:paragraph -->
	<p><?php esc_html_e( 'No books found in this genre.', 'fooz-test' ); ?></p>
	<!-- /wp:paragraph -->
	<!--/wp:query-no-results -->
</div>
<!-- /wp:query -->
