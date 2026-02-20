<?php
/**
 * Title: Split Content
 * Slug: prisma-core/split-content
 * Categories: prisma-core
 * Keywords: split, alternating, image, text, content, magazine
 * Viewport Width: 1200
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/patterns/placeholder-about.jpg" alt="<?php esc_attr_e( 'Featured content', 'prisma-core' ); ?>" style="border-radius:4px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"textColor":"primary","style":{"typography":{"fontWeight":"600","textTransform":"uppercase","letterSpacing":"2px","fontSize":"13px"}}} -->
<p class="has-primary-color has-text-color" style="font-size:13px;font-weight:600;letter-spacing:2px;text-transform:uppercase"><?php esc_html_e( 'Our Story', 'prisma-core' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"max-30","style":{"spacing":{"margin":{"top":"5px"}}}} -->
<h2 class="wp-block-heading has-max-30-font-size" style="margin-top:5px"><?php esc_html_e( 'Crafted with Passion and Purpose', 'prisma-core' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"foreground","style":{"spacing":{"margin":{"top":"var:preset|spacing|x-small"}}}} -->
<p class="has-foreground-color has-text-color" style="margin-top:var(--wp--preset--spacing--x-small)"><?php esc_html_e( 'Every great project starts with a simple idea. Ours was to create something that makes web design accessible to everyone, without sacrificing quality or creativity.', 'prisma-core' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"textColor":"primary","style":{"typography":{"fontWeight":"600","textTransform":"uppercase","letterSpacing":"2px","fontSize":"13px"}}} -->
<p class="has-primary-color has-text-color" style="font-size:13px;font-weight:600;letter-spacing:2px;text-transform:uppercase"><?php esc_html_e( 'Our Mission', 'prisma-core' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"max-30","style":{"spacing":{"margin":{"top":"5px"}}}} -->
<h2 class="wp-block-heading has-max-30-font-size" style="margin-top:5px"><?php esc_html_e( 'Building for the Future of the Web', 'prisma-core' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"foreground","style":{"spacing":{"margin":{"top":"var:preset|spacing|x-small"}}}} -->
<p class="has-foreground-color has-text-color" style="margin-top:var(--wp--preset--spacing--x-small)"><?php esc_html_e( 'We believe the web should be beautiful, fast, and open. Our tools empower creators and businesses to build their online presence with confidence.', 'prisma-core' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/patterns/placeholder-about.jpg" alt="<?php esc_attr_e( 'Featured content', 'prisma-core' ); ?>" style="border-radius:4px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
