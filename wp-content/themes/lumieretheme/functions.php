<?php
function console_log($output, $with_script_tags = true) {
    $js_code = "console.log(".json_encode($output, JSON_HEX_TAG).");";
    if ($with_script_tags) {
        $js_code = "<script>".$js_code."</script>";
    }
    echo $js_code;
}

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

// disable single and archive post
function lumiereRedirects() {
    if (is_post_type_archive("post") || is_singular("post")) {
        status_header(404);
        get_template_part(404);
        exit();
    }
}
add_action("template_redirect", "lumiereRedirects", 99);

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

// register styles
function lumiereRegisterStyles() {
    $version = wp_get_theme()->get("Version");
    wp_enqueue_style("lumiere-main-style", get_template_directory_uri()."/style.css", array(), $version, "all");
}
add_action("wp_enqueue_scripts", "lumiereRegisterStyles");

// register scripts
function lumiereRegisterScripts() {
    $version = wp_get_theme()->get("Version");
    wp_enqueue_script("lumiere-main-script", get_template_directory_uri()."/assets/js/scripts.js", array(), $version, true);
}
add_action("wp_enqueue_scripts", "lumiereRegisterScripts");

// Add default editor content and style
function addDefaultEditorContent ($content, $post) {
    $postContent = "<div id='postInfoBox' class='postInfoBox'><p class='postInfoText'><strong>Info!</strong> Please select category, template and featured image in Settings.</p><p class='postInfoText'>And add post text in the box below.</p><p class='postInfoText'>(this block will not be displayed in the final post)</p></div><p id='hiddenAnchor_Point_Aster'>#</p><div id='postBodyBox' class='postBodyBox'><p class='postBoxyText'></p></div>";
    $pageContent = "";
    $defaultContent = "This content has not been set up, please contact site admin.";
    switch($post->post_type) {
        case "post":
            $content = $postContent;
        break;
        case "page":
            $content = $pageContent;
        break;
        default:
            $content = $defaultContent;
        break;
    }
    return $content;
}
add_filter("default_content", "addDefaultEditorContent", 10, 2);
add_editor_style(get_template_directory_uri()."/assets/css/editor-style.css");

// Remove default editor information box at save
function filterPostData($data, $postarr) {
    if (($data["post_status"] == "inherit") || $data["post_status"] == "draft") {
        return $data;
    }
    // replace all single quote
    if ($data["post_type"] == "post") {
        $cleanedContent = str_replace("\'", "\"", $data["post_content"]);
        // remove info box with anchor
        $achorIdx = strpos($cleanedContent, "#");
        $afterAchor = substr($cleanedContent, $achorIdx + 5);
        $data["post_content"] = $afterAchor;
    }
    return $data;
}
add_filter("wp_insert_post_data" , "filterPostData" , "11", 2);

// Remove default editor information box
function removeInfoBoxTheContent($content) {
    if (is_front_page() && is_main_query()) {
        // replace all single quote
        $cleanedContent = str_replace("\'", "\"", $content);
        // remove info box
        $removedContent = preg_replace('/<div[^>]*id="postInfoBox" class="postInfoBox"[^>]*>.*?<\/div>/is', "", $cleanedContent);
        // strip away aditional div
        preg_match('/<div[^>]*id="postBodyBox" class="postBodyBox">.*?<p class="postBoxyText">(.*?)<\/p>.*?<\/div>/is', $content, $outputArray);
        return $outputArray[1];
    } elseif (is_page() && is_main_query()){
        return $content;
    } elseif (is_singular("post") && is_main_query()){

    } else {
        return $content;
    }
}
add_filter("the_content", "removeInfoBoxTheContent");


/* Theme initialization steps */
// add new categories
function lumiereThemeCreateDefaultCategory(){
    $categorySettings = array(
        "cat_name" => "Home Page - Lumiere", 
        "category_description" => "Lumiere theme category for posts in homepage",
        "category_nicename" => "lumiere-home-page",
        "category_parent" => ""
    );
    wp_insert_category($categorySettings);
}
add_action("admin_init", "lumiereThemeCreateDefaultCategory");
// add new pages and add them to menu
function lumiereThemeInitialize(){
    // check if menu exist, if not -> create, else -> get Id
    $menuName = "Lumiere Main Menu";
    $menuExists = wp_get_nav_menu_object($menuName);
    if (!$menuExists) {
        $menuId = wp_create_nav_menu($menuName);
    } else {
        $menuId = $menuExists->term_id;
    }
    $defaultPages = array("Home", "Overview", "Amenities", "Views", "Availability", "Downtown", "Contact");
    foreach ($defaultPages as $singlePage) {
        if ((get_page_by_title($singlePage) == null) || (get_page_by_title($singlePage, "ARRAY_A")["post_status"] == "trash")) {
            $pages = array(
                "post_type" => "page",
                "post_title" => $singlePage,
                "post_content" => "",
                "post_status" => "publish",
                "post_author" => 1
            ); 
            $pageId = wp_insert_post($pages);
            // update_post_meta($homepage_id, "_wp_page_template", "template-filename.php");
            
            // add page besides Home to Lumiere Main Men
            if ($singlePage != "Home") {
                wp_update_nav_menu_item($menuId, 0, array(
                    "menu-item-object-id" => $pageId,
                    "menu-item-object" => "page",
                    "menu-item-status" => "publish",
                    "menu-item-type" => "post_type",
                ));
            }
        }
    }
    $homepage = get_page_by_title("Home");
    if ($homepage) {
        update_option("page_on_front", $homepage->ID);
        update_option("show_on_front", "page");
    }
}
add_action("after_setup_theme", "lumiereThemeInitialize");

?>