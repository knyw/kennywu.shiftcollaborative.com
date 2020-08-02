<?php
/**
 * Template Name: Statement
 * Template Post Type: post
 *
 * @package Lumiere
 * @subpackage Lumiere Theme
 * @since Lumiere Theme 1.0
 */
?>
        <article class="statement darkText">
            <div class="statementBody">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="Downtown Living">
            </div>
            <div class="statementBody">
                <div>
                    <div>
                        <h3 class="upperText"><?php the_title() ?></h3>
                        <hr class="redLine">
                        <p><?php the_content(); ?></p>
                    </div>
                </div>
            </div>
        </article>