<?php
$customLogoId = get_theme_mod("custom_logo");
$logo = wp_get_attachment_image_src($customLogoId, "full");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="author" content="Kenny Wu">
        <meta name="date" content="July 30th, 2020">
        <meta charset="utf-8">
        <!-- IE use the latest edge version else use the Chrome rendering engine if installed-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body>
        <header class="mainHeader lightText">
            <div class="page">
                <div id="logoContainer">
                    <?php
                    if ( has_custom_logo() ) {
                        echo "<img class='headerLogo' src='".esc_url($logo[0])."' alt='".get_bloginfo("name")." logo'>";
                    } else {
                        echo "<h1 class='headerLogo upperText' style='margin: 0;'>".get_bloginfo("name")."</h1>";
                    }
                    ?>
                    <!-- <img class="headerLogo" src="./images/Lumiere logo REV.png" alt="Lumiere logo"> -->
                    <div id="navToggle">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div id="navContainer" class="">
                    <nav>
                        <?php
                            wp_nav_menu(
                                array(
                                    "menu" => "primary",
                                    "container" => "",
                                    "theme_location" => "primary",
                                )
                            );
                        ?>
                        <!-- <ul>
                            <li><a href="">OVERVIEW</a></li>
                            <li><a href="">AMENITIES</a></li>
                            <li><a href="">VIEWS</a></li>
                            <li><a href="">AVAILABILITY</a></li>
                            <li><a href="">DOWNTOWN</a></li>
                            <li><a href="">CONTACT</a></li>
                        </ul> -->
                    </nav>
                </div>
            </div>
        </header>