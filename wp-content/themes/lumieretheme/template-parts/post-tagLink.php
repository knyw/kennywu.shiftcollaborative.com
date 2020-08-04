<?php
/**
 * Template Name: Tag Link
 * Template Post Type: post
 *
 * @package Lumiere
 * @subpackage Lumiere Theme
 * @since Lumiere Theme 1.0
 */
?>
        <article class="tagLink lightText">
            <div class="tagBody burgundy">
                <div class="page">
                    <div class="tagBanner">
                        <h1 class="tagHead upperText"><?php the_title() ?></h1>
                        <hr class="blueLine center">
                        <h4 class="tagSubhead lighterFontWeight"><?php the_content(); ?></h4>
                        <button type="button" class="primary blue" onclick="window.location.href='<?php echo get_permalink(get_page_by_title('Availability')->ID) ?>';">Explore Availablility</button>
                    </div>
                </div>
            </div>
        </article>