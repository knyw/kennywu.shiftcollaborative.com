<?php
function equalSplit($str) {
    $result = array(); 
    $currentIdx = ceil(strlen($str)/2);
    $checkNum = 1;
    while ($currentIdx != (strlen($str)-1)) {
        if ($str[(int)$currentIdx] == " ") {
            $first = substr($str, 0, $currentIdx);
            $second = substr($str, $currentIdx, strlen($str));
            array_push($result, $first);
            array_push($result, $second);
            return $result;
        }
        if ($str[(int)$currentIdx+$checkNum] == " ") {
            $first = substr($str, 0, $currentIdx+$checkNum);
            $second = substr($str, $currentIdx+$checkNum, strlen($str));
            array_push($result, $first);
            array_push($result, $second);
            return $result;
        } elseif ($str[(int)$currentIdx-$checkNum] == " ") {
            $first = substr($str, 0, $currentIdx-$checkNum);
            $second = substr($str, $currentIdx-$checkNum, strlen($str));
            array_push($result, $first);
            array_push($result, $second);
            return $result;
        } else {
            $checkNum++;
        }
    }
}
$customLogoId = get_theme_mod("custom_logo");
$logo = wp_get_attachment_image_src($customLogoId, "full");
$taglines = explode('|', get_bloginfo("description"));
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
        <?php
            if ( ! has_post_thumbnail() ) {
                echo "<script>alert('Please add Featured Image (thumbnail) to the page to enable top banner.')</script>";
            } else {
        ?>
        <article class="mainBanner lightText">
            <div class="mainBannerHeadsBox">
                <div class="page">
                    <div class="mainBannerHeads">
                        <h2 class="mainBannerHead upperText">
                            <?php
                                $result = equalSplit($taglines[0]);
                                echo $result[0]."<br>".$result[1];
                            ?>
                        </h2>
                        <hr class="blueLine long">
                        <h1 class="mainBannerSubHead upperText"><?php echo $taglines[1] ?></h1>
                        <button type="button" class="primary red">Explore Availablility</button>
                    </div>
                </div>
            </div>
            <img class="mainBannerImage" src="<?php the_post_thumbnail_url(); ?>" alt="homepage header">
        </article>
        <?php } ?>