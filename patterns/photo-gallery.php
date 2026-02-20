<?php
/**
 * Title: Photo Gallery
 * Slug: prisma-core/photo-gallery
 * Categories: prisma-core
 * Keywords: gallery, photos, images, travel, portfolio, grid
 * Viewport Width: 1200
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:heading {"textAlign":"center","fontSize":"max-36"} -->
<h2 class="wp-block-heading has-text-align-center has-max-36-font-size"><?php esc_html_e( 'Photo Gallery', 'prisma-core' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"foreground","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}}} -->
<p class="has-text-align-center has-foreground-color has-text-color" style="margin-bottom:var(--wp--preset--spacing--medium)"><?php esc_html_e( 'A collection of moments from our journey.', 'prisma-core' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:gallery {"columns":3,"linkTo":"none","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|x-small","top":"var:preset|spacing|x-small"}}}} -->
<figure class="wp-block-gallery has-nested-images columns-3"><!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/patterns/placeholder-about.jpg" alt="<?php esc_attr_e( 'Gallery image', 'prisma-core' ); ?>" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/patterns/placeholder-about.jpg" alt="<?php esc_attr_e( 'Gallery image', 'prisma-core' ); ?>" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/patterns/placeholder-about.jpg" alt="<?php esc_attr_e( 'Gallery image', 'prisma-core' ); ?>" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/patterns/placeholder-about.jpg" alt="<?php esc_attr_e( 'Gallery image', 'prisma-core' ); ?>" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/patterns/placeholder-about.jpg" alt="<?php esc_attr_e( 'Gallery image', 'prisma-core' ); ?>" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/patterns/placeholder-about.jpg" alt="<?php esc_attr_e( 'Gallery image', 'prisma-core' ); ?>" style="border-radius:4px"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></div>
<!-- /wp:group -->
