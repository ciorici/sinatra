<?php
/**
 * Title: Blog Posts Grid
 * Slug: prisma-core/blog-posts-grid
 * Categories: prisma-core
 * Keywords: blog, posts, grid, latest, articles, magazine
 * Viewport Width: 1200
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:heading {"textAlign":"center","fontSize":"max-36"} -->
<h2 class="wp-block-heading has-text-align-center has-max-36-font-size"><?php esc_html_e( 'Latest Articles', 'prisma-core' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"foreground","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}}} -->
<p class="has-text-align-center has-foreground-color has-text-color" style="margin-bottom:var(--wp--preset--spacing--medium)"><?php esc_html_e( 'Stories, tips, and guides from our blog.', 'prisma-core' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"style":{"spacing":{"blockGap":"10px"}}} -->
<div class="wp-block-group"><!-- wp:post-featured-image {"isLink":true,"style":{"border":{"radius":"4px"}}} /-->

<!-- wp:post-title {"isLink":true,"fontSize":"medium","style":{"spacing":{"margin":{"top":"10px"}}}} /-->

<!-- wp:post-excerpt {"excerptLength":20,"style":{"spacing":{"margin":{"top":"5px"}},"color":{"text":"#30373e"}}} /-->

<!-- wp:post-date {"style":{"color":{"text":"#9ca3af"},"typography":{"fontSize":"13px"}}} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--medium)"><!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button"><?php esc_html_e( 'View All Posts', 'prisma-core' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
