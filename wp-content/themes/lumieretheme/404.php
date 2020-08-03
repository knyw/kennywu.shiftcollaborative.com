<?php if (have_posts()) {
    while (have_posts()) {
        the_post();
    }
} ?>
<?php get_header("404"); ?>

        <article class="emptyPage">
            <div id="lumiere_404_redirect_box">
                <h2 id="lumiere_404_redirect">This page does not exist, redirecting in 5 seconds.</h2>
            </div>
        </article>

<?php get_footer(); ?>