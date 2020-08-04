<?php get_header(); ?>
        <?php
            $args = array(
                "numberposts" => -1,
                // "offset" => $paged*4,
                // "orderby" => "post_date",
                // "order" => "DESC",
                "post_type" => "post",
                "post_status" => "publish",
                "category_name" => "Home Page - Lumiere",
                "suppress_filters" => true,
            );
            $posts = get_posts($args);
            foreach ($posts as $post) { 
                setup_postdata($post);
                $templatePath = get_post_meta(get_the_ID(), "_wp_page_template", true);
                $templateName = basename($templatePath, ".php");
                if ($templateName == "post-callToAction") {
                    get_template_part("template-parts/post", "callToAction");
                } elseif ($templateName == "post-statement") {
                    get_template_part("template-parts/post", "statement");
                } elseif ($templateName == "post-tagLink") {
                    get_template_part("template-parts/post", "tagLink");
                }
            }
        ?>
        <article class="partners darkText">
            <div class="page">
                <div class="partnersBox">
                    <h2 class="upperText">Partners</h2>
                    <hr class="blueLine center">
                    <div class="logoBox">
                        <span>
                            <img class="partnerLogo" src="<?php echo get_template_directory_uri()."/assets/images/MC Main 300.png" ?>" alt="Millcraft">
                            <img class="partnerLogo" src="<?php echo get_template_directory_uri()."/assets/images/Piatt_HorzBW.png" ?>" alt="Piatt">
                        </span>
                        <span>
                            <img class="partnerLogo" src="<?php echo get_template_directory_uri()."/assets/images/mcknight_logo.jpg" ?>" alt="McKnight">
                            <img class="partnerLogo" src="<?php echo get_template_directory_uri()."/assets/images/Indovina_logo.png" ?>" alt="Indovina">
                        </span>
                    </div>
                </div>
            </div>
        </article>
        <article class="map darkText">
            <img src="<?php echo get_template_directory_uri()."/assets/images/map-bw.jpg" ?>" alt="map" style="width: 100%;">
        </article>
<?php get_footer(); ?>