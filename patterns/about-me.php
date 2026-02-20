<?php
/**
 * Title: About Me
 * Slug: prisma-core/about-me
 * Categories: prisma-core
 * Keywords: about, personal, bio, profile, blogger
 * Viewport Width: 1200
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"35%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:35%"><!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/patterns/placeholder-about.jpg" alt="<?php esc_attr_e( 'Profile photo', 'prisma-core' ); ?>" style="border-radius:50%"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"65%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:65%"><!-- wp:paragraph {"textColor":"primary","style":{"typography":{"fontWeight":"600","textTransform":"uppercase","letterSpacing":"2px","fontSize":"13px"}}} -->
<p class="has-primary-color has-text-color" style="font-size:13px;font-weight:600;letter-spacing:2px;text-transform:uppercase"><?php esc_html_e( 'Hello, I\'m', 'prisma-core' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"max-36","style":{"spacing":{"margin":{"top":"5px"}}}} -->
<h2 class="wp-block-heading has-max-36-font-size" style="margin-top:5px"><?php esc_html_e( 'Jane Doe', 'prisma-core' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"foreground","style":{"spacing":{"margin":{"top":"var:preset|spacing|x-small"}}}} -->
<p class="has-foreground-color has-text-color" style="margin-top:var(--wp--preset--spacing--x-small)"><?php esc_html_e( 'Writer, traveler, and coffee enthusiast. I have been sharing stories from around the world for over a decade. This blog is my space to document adventures, share travel tips, and connect with fellow wanderers.', 'prisma-core' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"foreground"} -->
<p class="has-foreground-color has-text-color"><?php esc_html_e( 'When I am not on the road, you will find me in my home studio, editing photos, or experimenting with new recipes from the places I have visited.', 'prisma-core' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:social-links {"iconColor":"white","iconBackgroundColor":"primary","style":{"spacing":{"margin":{"top":"var:preset|spacing|small"},"blockGap":{"left":"10px"}}}} -->
<ul class="wp-block-social-links has-icon-color has-icon-background-color"><!-- wp:social-link {"url":"#","service":"instagram"} /-->

<!-- wp:social-link {"url":"#","service":"x"} /-->

<!-- wp:social-link {"url":"#","service":"facebook"} /-->

<!-- wp:social-link {"url":"#","service":"youtube"} /-->

<!-- wp:social-link {"url":"#","service":"pinterest"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
