<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

class Theme_CF
{
    public function __construct(){
        add_action( 'after_setup_theme', array ( $this , 'crb_load' ) );
        add_action( 'carbon_fields_register_fields', array( $this , 'ag_settings_panel' ) );
        // add_action( 'carbon_fields_register_fields', array( $this , 'ag_tax_select' ) );
    }

    public function crb_load() {
        include_once ( ELT_DIR.'libs/cf/vendor/autoload.php' );
        \Carbon_Fields\Carbon_Fields::boot();
    }

    public function ag_settings_panel() {
        
        Container::make( 'theme_options','elt_settings', __( 'الاعدادت' ) )
        
        ->add_tab(
            __( 'Genaral Setteing', 'elt' ),
            array(
                Field::make( 'text', 'hero_title', __( 'الاسم اسفل صورة الموقع', 'alh' ) ),
                Field::make( 'text', 'watsapp_number', __( 'whatsapp رقم', 'alh' ) ),
                Field::make( 'text', 'snapchat', 'snapchat رابط' ),
                Field::make( 'text', 'phone', 'رقم التليفون' ),
                Field::make( 'text', 'instagram', 'instagram رابط' ),
                Field::make( 'rich_text', 'site_title_hero', 'عنوان الصفحة الرئيسية' ),
                Field::make( 'color', 'theme_color', 'لون خلفية الموقع' ),
                Field::make( 'image', 'site_logo', __( 'صورة شعار الموقع' ) )
                ->set_value_type( 'url' )
               
            )
        )
        ->add_tab(
            __( 'WhatsApp Setteing', 'elt' ),
            array(
                Field::make( 'text', 'watsapp_api_number', __( 'رقم whatsapp api', 'alh' ) ),
                Field::make( 'textarea', 'watsapp_api_message', __( 'whatsapp api الرسالةة', 'alh' ) )
                ->set_rows( 6 )
                ->set_attribute( 'placeholder', 'Hello, I want to purchase {PRODUCT_NAME} URL: {PRODUCT_URL} ' )
                ->set_help_text('Hello, I want to purchase {PRODUCT_NAME} URL: {PRODUCT_URL} ' )
                ,
                Field::make( 'color', 'watsapp_api_btn_color', 'whatsapp لون خلفية الزرار' ),
                
            )
        )
        ;

    }

}
