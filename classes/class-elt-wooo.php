<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class ELT_WOO {
    public function __construct() {
        add_action( 'woocommerce_before_main_content', [$this , 'woocommerce_before_main_content'], 10 );
        add_action( 'is_active_sidebar', [$this , 'woo_remove_sidebar'] );
        remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
        add_action( 'woocommerce_after_add_to_cart_button', array($this, 'render_button'));

        add_shortcode( 'elt-tabbed-proudcts', [$this, 'tabbed_products'] );
        
    }

    public function woocommerce_before_main_content()
    {
        if( is_shop())
        {
        return get_template_part( 'template-parts/main-hero');
        }
    }

    public function woo_remove_sidebar() {              
        if( ! is_product() ||
            ! is_cart() ||
            ! is_checkout() ||
            ! is_account_page() )
        {
            remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
        }
    }

    public function render_button(){
        global $product;
    

        $replaces = [
            '{PRODUCT_NAME}' => $product->get_name(),
            '{PRODUCT_URL}'  => get_permalink($product->get_id()),
        ];

        $mobile  = get_option( '_watsapp_api_number', true );
        $message = get_option( '_watsapp_api_message', true );
        $order_text = __( 'للطلب والاستفسار', 'elt' );

        if( !empty( $message ) ){
            foreach($replaces as $key => $value){
                $message  = str_replace(strtoupper($key), $value, $message );
            }
        }

        $whatsapp_url = 'https://api.whatsapp.com/send?phone=' . $mobile . '&text=' . urlencode($message);
        $color = get_option('_watsapp_api_btn_color', '#ff005c');
        $style = 'style="background-color:'. $color .'"';
        ?>

        <div class="elt_cart_button ">
            <a target="_blank"  href="<?php echo $whatsapp_url; ?>" class="orderButton" <?php echo $style; ?>>
            <?php echo $order_text; ?><img src="<?php echo ELT_URI . 'assets/image/cart.svg'; ?>" class=""></a>
        </div>

        <?php
        
     }

    public function tabbed_products(){

    $qc_woo_tabbed_shortcode_preview = get_option('qc_woo_tabbed_shortcode_preview');

    ob_start();
    $product_number = esc_attr(get_option('product_number'));
    $column_number  = esc_attr(get_option('column_number'));

    elt_plugin_scripts();
    elt_plugin_styles();
    ?>
    <div class="elt__container">
        <div id="nav-holder">
            <div class="elt__category_nav" id="elt__tabs">
                <?php
                $args = array(
                    'number'        => '',
                    'order'         => get_option('category_order'),
                    'orderby'       => 'title',
                    'hide_empty'    => 1,
                    'exclude'       => 15,
                    //'include'       => $category_ids,
                );

                $product_categories = get_terms('product_cat', $args); ?>
                <ul>
                    <?php
                    $i = 0;
                    foreach ($product_categories as $cat) {

                        $slug_url = (get_option('qcld_use_category_tab') == 'id') ? $cat->term_id : $cat->term_id;


                        ?>
                        <li><a id="<?php echo esc_attr($slug_url); ?>"
                                class="product-<?php echo esc_attr($slug_url); echo($i == 0 ? ' active' : ''); ?>" data-name="<?php echo esc_attr($cat->name); ?>" href="#">

                                <?php
                                if(!empty(get_option('qc_woo_tabbed_enable_category_image')) || ( isset($cat_image_on_top) && $cat_image_on_top == 'enable' ) ){
                                    qcld_get_category_image($cat->term_id); 
                                }
                                ?>
                                <?php echo esc_attr($cat->name); ?></a>
                        </li>
                        <?php
                        $i++;
                    }
                    wp_reset_query();
                    ?>
                </ul>
                <!--   <div class="clear"></div>-->
            </div>
        </div>
        <div class="product_content" id="elt__tabs_container">
            <?php
            $i = 0;
            foreach ($product_categories as $cat) {
                $slug_url = (get_option('qcld_use_category_tab') == 'id') ? $cat->term_id : $cat->term_id;
                ?>
                <div class="each_cat<?php echo($i == 0 ? ' active' : ''); ?>" id="product-<?php echo esc_attr($slug_url); ?>">
                    <?php
                    echo do_shortcode('[product_category category="' . esc_attr($cat->slug) . '" per_page=' . esc_attr($product_number) . ' columns=' . esc_attr($column_number) . ' orderby="' . esc_attr(get_option('qcld_orderby_product')) . '" order="' . esc_attr(get_option('order_product_by')) . '"]');
                    ?>
                </div>
                <?php $i++;
            }
            wp_reset_query();

            ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
    }

}
