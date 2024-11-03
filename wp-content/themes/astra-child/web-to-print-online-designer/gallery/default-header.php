<?php 
if (!defined('ABSPATH')) exit; 
extract($args);
?>
<style>
    .tc-banner-container {
        background: #003F3F;
    }

    .tc-banner-container-inner {
        padding: 50px 0;
        display: flex;
        justify-content: space-between;
        gap: 50px;
        max-width: 1480px;
        margin: auto;
    }

    .tc-banner-container-inner .tc-col {
        width: 50%;
    }

    .tc-banner-container-inner .tc-col.banner-img {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .tc-slide h2,
    .tc-title-wrapper h1 {
        font-weight: 700;
        color: #fff;
        margin: 0;
        margin-bottom: 10px;
    }

    .tc-title-wrapper h1 {
        font-size: 28px;
    }

    .tc-slide h2 {
        font-size: 22px;
    }

    .tc-slide p,
    .tc-title-wrapper p {
        color: #fff;
        font-size: 16px;
        line-height: 24px;
        margin: 0;
        font-weight: 300;
        letter-spacing: 1px;
    }

    .tc-slide-menu {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin: 30px 0;
    }

    .tc-slide-menu li {
        height: 60px;
        width: 60px;
        border: 1px solid #A3C2C2;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 100%;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease-out;
    }

    .tc-slide-menu li img {
        height: 30px;
        width: 30px;
    }

    .tc-slide-menu li.tc-active,
    .tc-slide-menu li:hover {
        background: #002C2C;
        border-color: #002C2C;
    }

    .tc-slide-menu li:not(:last-child) {
        margin-right: 100px;
    }

    .tc-slide-menu li:not(:last-child)::before {
        position: absolute;
        content: '';
        background: url(./line.png) no-repeat center center / cover;
        width: 100px;
        height: 1px;
        top: 50%;
        left: 100%;
        transform: translateY(-50%);
    }

    .tc-slide {
        display: none;
    }

    .tc-slide.tc-slide-active {
        display: block;
    }

    @media screen and (max-width: 1025px) {
        .tc-banner-container-inner {
            padding: 30px;
        }

        .tc-banner-container-inner .tc-col {
            width: 60%;
        }

        .tc-banner-container-inner .tc-col.banner-img {
            width: 40%;
        }

        .tc-banner-container-inner .tc-col.banner-img img {
            width: 100%;
        }
    }

    @media screen and (max-width:992px) {
        .tc-banner-container-inner {
            gap: 30px;
            text-align: center;
        }

        .tc-banner-container-inner .tc-col {
            width: 100%;
        }

        .tc-banner-container-inner .tc-col.banner-img {
            display: none;
        }

        .tc-slide-menu {
            justify-content: center;
        }

        .tc-title-wrapper h1 {
            font-size: 26px;
        }

        .tc-slide h2 {
            font-size: 20px;
        }

        .tc-slide-menu {
            margin: 20px 0;
        }
    }

    @media screen and (max-width:541px) {
        .tc-banner-container-inner {
            padding: 15px;
        }

        .tc-title-wrapper h1 {
            font-size: 22px;
        }

        .tc-slide h2 {
            font-size: 18px;
        }

        .tc-slide p,
        .tc-title-wrapper p {
            font-size: 14px;
            line-height: 22px;
        }
    }

    @media screen and (max-width:440px) {
        .tc-slide-menu li:not(:last-child) {
            margin-right: 60px;
        }

        .tc-slide-menu li:not(:last-child)::before {
            width: 60px;
        }
    }

    @media screen and (max-width:375px) {
        .tc-slide-menu li img {
            height: 25px;
            width: 25px;
        }

        .tc-slide-menu li {
            height: 50px;
            width: 50px;
        }
    }
</style>
<section id="header-title" class="header-fileupload fullscreen"
        style="background-color:#003F3F; color:white; margin-top:-30px; margin-bottom:50px;">
    <!-- <div class="innersect ast-container ml-auto mr-auto">
        <div class="d-flex align-item-center justify-content-center">
            <h3 class="text-center text-uppercase" style="color:#ECFF8C; padding:50px 0;">
                
            </h3>
        </div>
    </div> -->

    <div class="tc-banner-container">
        <div class="tc-banner-container-inner">
            <div class="tc-col">
                <div class="tc-title-wrapper">
                    <h1><?php echo esc_attr( $title ); ?></h1>
                    <section class="info-section">
                    <?php 
                    $term_description = term_description($tag, 'template_tag');  
                    if(!empty($term_description)){

                        $allowed_tags = array(
                            'p'      => array(), // Allow <p> without any attributes
                            'strong' => array(), // Allow <strong> without any attributes
                            'h2' => array(), 
                            'h3' => array(),
                            'a'      => array(   // Allow <a> with 'href' attribute
                                'href' => array()
                            ),
                        );
                        // Escape content and allow specific HTML
                        echo wp_kses($term_description, $allowed_tags);
                        
                    }else{
                        echo sprintf(__('<p>Fast-track your business and select the best business cards by category and style that defines your brand. You can edit the prebuilt templates to the heart’s content. If you are a design expert yourself, feel free to use the exclusive design tool.</p>
                        <span>Do you need more ideas? You can easily contact us to request designs from our experts.</span>
                        <p>From textured business cards to gold and silver imprints and embossed effects, many distinct features can be added to your designs.</p>', 'transparentcard'));
                    } ?>
                </section>
                </div>
                <div class="tc-info-slide">
                    <ul class="tc-slide-menu">
                        <li class="tc-active"><img src="<?php echo esc_url( get_stylesheet_directory_uri(  ) ); ?>/assets/img/icon1.svg" alt=""></li>
                        <li><img src="<?php echo esc_url( get_stylesheet_directory_uri(  ) ); ?>/assets/img/icon2.svg" alt=""></li>
                        <li><img src="<?php echo esc_url( get_stylesheet_directory_uri(  ) ); ?>/assets/img/icon3.svg" alt=""></li>
                    </ul>
                    <div class="tc-slides">
                        <div class="tc-slide tc-slide-active">
                            <h2><?php _e('Design and Pricing', 'transparentcard'); ?></h2>
                            <p><?php echo esc_attr( !empty(get_term_meta($tag, 'design_and_pricing', true)) ? get_term_meta($tag, 'design_and_pricing', true) : __('We offer excellent printing services to ensure your cards look and feel professional. Your order arrives in a timely fashion due to our fast delivery options.', 'transparentcard') ); ?></p>
                        </div>
                        <div class="tc-slide">
                            <h2><?php _e('Features and Customization', 'transparentcard'); ?></h2>
                            <p><?php echo esc_attr( !empty(get_term_meta($tag, 'features_and_customization', true)) ? get_term_meta($tag, 'features_and_customization', true) : __('Make your business card personal with your logo, contact information, and calming colors. Choose from various templates, fonts, and layouts that reflect your brand. With our easy-to-use design tool, each element of your business card becomes easy to customize.', 'transparentcard') ); ?></p>
                            
                        </div>
                        <div class="tc-slide">
                            <h2><?php _e('Print and Delivery', 'transparentcard'); ?></h2>
                            <p><?php echo esc_attr( !empty(get_term_meta($tag, 'print_and_delivery', true)) ? get_term_meta($tag, 'print_and_delivery', true) : __('We offer excellent printing services to ensure your cards look and feel professional. Your order arrives in a timely fashion due to our fast delivery options.', 'transparentcard') ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tc-col banner-img">
                <?php if($thumbnail_id = get_term_meta( $tag, 'thumbnail_id', true )):
                    $feat_image_src = wp_get_attachment_url( $thumbnail_id ); 
                    echo sprintf('<img src="%s" alt="%s" />', $feat_image_src, __('Business Cards', 'transparentcard'));
                else:
                ?>
                <img src="<?php echo esc_url( get_stylesheet_directory_uri(  ) ); ?>/assets/img/gold-foil.jpg" alt="<?php _e('Business Cards', 'transparentcard'); ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuItems = document.querySelectorAll('.tc-slide-menu li');
        const slides = document.querySelectorAll('.tc-slide');

        menuItems.forEach((item, index) => {

            item.addEventListener('click', function () {

                menuItems.forEach(menu => menu.classList.remove('tc-active'));
                item.classList.add('tc-active');

                slides.forEach(slide => slide.classList.remove('tc-slide-active'));
                slides[index].classList.add('tc-slide-active');

            });

        })

    });
</script>


