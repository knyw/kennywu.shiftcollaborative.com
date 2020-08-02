<?php
/**
 * Template Name: Call To Action
 * Template Post Type: post
 *
 * @package Lumiere
 * @subpackage Lumiere Theme
 * @since Lumiere Theme 1.0
 */
?>
        <article class="callToAction darkText">
            <div class="call">
                <div class="page">
                    <div>
                        <h5 class="lighterFontWeight"><?php the_content(); ?></h5>
                    </div>
                </div>
            </div>
            <div class="action" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
                <div class="page">
                    <div class="actionBanner light">
                        <div>
                            <div class="darkText">
                                <h2 class="lighterFontWeight">Explore</h2>
                                <h1 class="upperText"><?php the_title() ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>