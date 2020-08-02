<?php

// remove comment functionality
function lumiereDisableComment() {
    global $pagenow;
    if ($pagenow === "edit-comments.php") {
        wp_redirect(admin_url());
        exit;
    }
    remove_meta_box("dashboard_recent_comments", "dashboard", "normal");
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, "comments")) {
            remove_post_type_support($post_type, "comments");
            remove_post_type_support($post_type, "trackbacks");
        }
    }
}
add_action("admin_init", "lumiereDisableComment");

add_filter("comments_open", "__return_false", 20, 2);
add_filter("pings_open", "__return_false", 20, 2);
add_filter("comments_array", "__return_empty_array", 10, 2);

function lumiereRemoveCommentMenu() {
    remove_menu_page("edit-comments.php");
}
add_action("admin_menu", "lumiereRemoveCommentMenu");

function lumiereRemoveCommentMenuBar() {
    if (is_admin_bar_showing()) {
        remove_action("admin_bar_menu", "wp_admin_bar_comments_menu", 60);
    }
}
add_action("init", "lumiereRemoveCommentMenuBar");

//
function lumiereThemeSupport() {
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
}
add_action("after_setup_theme", "lumiereThemeSupport");

function lumiereCustomLogo() {
    $defaults = array(
    "height" => 100,
    "width" => 400,
    "flex-height" => true,
    "flex-width" => true,
    "header-text" => array("site-title", "site-description"),
    );
    add_theme_support("custom-logo", $defaults);
}
add_action("after_setup_theme", "lumiereCustomLogo");

function lumiereMenus() {
    $locations = array(
        "primary" => "Desktop Primary Top",
        "footer" => "Footer Menu"
    );
    register_nav_menus($locations);
}
add_action("init", "lumiereMenus");

function lumiereRegisterStyles() {
    $version = wp_get_theme()->get("Version");
    wp_enqueue_style("lumiere-main-style", get_template_directory_uri()."/style.css", array(), $version, "all");
}
add_action("wp_enqueue_scripts", "lumiereRegisterStyles");

 


?>