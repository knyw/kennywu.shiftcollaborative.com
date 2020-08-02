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
    add_theme_support("editor-styles");
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

// Add default editor content and style
function addDefaultEditorContent ($content, $post) {
    $postContent = "<div id='postInfoBox' class='postInfoBox'><p class='postInfoText'><strong>Info!</strong> Please select a category and a template in Settings.</p><p class='postInfoText'>And add post text in the box below.</p><p class='postInfoText'>(this block will not be displayed in the final post)</p></div><div id='postBodyBox' class='postBodyBox'><p class='postBoxyText'></p></div>";
    $pageContent = "";
    $defaultContent = "This content has not been set up, please contact site admin.";
    switch($post->post_type) {
        case "post":
            $content = $postContent;
            add_editor_style(get_template_directory_uri()."/assets/css/editor-style-post.css");
        break;
        case "page":
            $content = $pageContent;
            add_editor_style(get_template_directory_uri()."/assets/css/editor-style-page.css");
        break;
        default:
            $content = $defaultContent;
        break;
    }
    return $content;
}
add_filter("default_content", "addDefaultEditorContent", 10, 2);

// Remove default editor information box
function removeInfoBoxTheContent($content) {
    if (is_singular() && is_main_query()) {
        // replace all single quote
        $cleanedContent = str_replace("\'", "\"", $content);
        // remove info box
        $removedContent = preg_replace('/<div[^>]*id="postInfoBox" class="postInfoBox"[^>]*>.*?<\/div>/is', "", $cleanedContent);
        // strip away aditional div
        preg_match('/<div[^>]*id="postBodyBox" class="postBodyBox">.*?<p class="postBoxyText">(.*?)<\/p>.*?<\/div>/is', $removedContent, $outputArray);
        return $outputArray[1];
    }
    return $content;
}
add_filter("the_content", "removeInfoBoxTheContent");


?>