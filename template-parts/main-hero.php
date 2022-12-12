<div class="innerBlock1 container">
    <?php  $logo = get_option('_site_logo'); if( !empty( $logo ) ) { ?>
    <div class="brandImageRow row">
        <img src="<?php echo $logo ?>" class="brandImage">
    </div>
    <?php } else { ?>
    <div class="brandImageRow row">
        <img src="<?php echo ELT_URI . 'assets/image/قرطاسيه-0١.png'; ?>" class="brandImage">
    </div>
    <?php } ?>
    <div class="brandNameText row"><?php echo get_option('_hero_title', true); ?></div>
    <div class="socialMediaButtons">
        <div class="columnDiv col">
            <a href="<?php echo get_option('_instagram', true); ?>" target="_blank" rel="noopener noreferrer" id="instagramLink">
                <img src="<?php echo ELT_URI . 'assets/image/instagram.svg'; ?>" class="socialButtonImages">
            </a>
        </div>
        <div class="columnDiv col">
            <a href="tel:+<?php echo get_option( '_phone', true ); ?>" id="telephoneNumber">
                <img src="<?php echo ELT_URI . 'assets/image/mobile-outline.svg'; ?>" class="socialButtonImages">
            </a>
        </div>
        <div class="columnDiv col">
            <a href="<?php echo get_option('_snapchat', true); ?>" target="_blank"
                rel="noopener noreferrer" id="snapchatLink">
                <img src="<?php echo ELT_URI . 'assets/image/snap-ghost.png'; ?>"
                    class="socialButtonImages socialButtonLogo">
                </a>
            </div>
        <div class="columnDiv col">
            <a href="https://api.whatsapp.com/send?phone=<?php echo get_option('_watsapp_number', true); ?>" target="_blank" rel="noopener noreferrer" id="whatsappLink">
                <img
                    src="<?php echo ELT_URI . 'assets/image/whatsapp.svg'; ?>" class="socialButtonImages">
                </a>
            </div>
    </div>
</div>