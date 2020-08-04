<?php
$customLogoId = get_theme_mod("custom_logo");
$logo = wp_get_attachment_image_src($customLogoId, "full");
?>
        <footer class="lightText">
            <div class="footerWidgets">
                <div class="page">
                    <div class="row">
                        <div class="column">
                            <div class="row innerRow">
                                <?php
                                    if ( has_custom_logo() ) {
                                        echo "<img class='footerLogo' src='".esc_url($logo[0])."' alt='".get_bloginfo("name")." logo'>";
                                    } else {
                                        echo "<h1 class='footerLogo upperText' style='margin: 0;'>".get_bloginfo("name")."</h1>";
                                    }
                                ?>
                                <!-- <img class="footerLogo" src="./images/Lumiere logo REV.png" alt="Lumiere logo"> -->
                            </div>
                            <div class="row innerRow">
                                <p>Welcome to the Neighborhood</p>
                                <p>Now home to close to 15,000 full-time residents, Downtown Pittsburgh’s vibrant and celebrated urbanity features the finest in dining, live entertainment, culture, and sporting events. Be it the European charm of bustling Market Square, the thriving International art scene of the Cultural District, or the tranquility of the city’s many parks and plazas, Lumière puts you just steps away.</p>
                            </div>
                        </div>
                        <div class="column">
                            <div class="row innerRow">
                                <h5 class="upperText">Contact Us</h5>
                                <p>412-471-4900</p>
                                <p>pittsburgh@sothebysrealty.com</p>
                            </div>
                            <div class="row innerRow">
                                <h5 class="upperText">Get Updates</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pelle ntesque at urna nec odio imperdiet ornare. Nulla auctor.</p>
                            </div>
                            <div class="row innerRow">
                                <form action="/action_page.php">
                                    <input type="text" id="name" class="secondary contactInput" name="name" placeholder="Full Name*">
                                    <input type="text" id="email" class="secondary contactInput" name="email" placeholder="Email Address*">
                                    <button type="submit" id="contactFormSubmit" class="secondary red">SUBMIT</button>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footerRights">
                <div class="page">
                    <p>Lumiere C 2017. All Rights Reserved.</p>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>