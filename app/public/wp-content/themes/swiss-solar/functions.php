<?php
/**
 * Swiss Solar Theme Functions
 *
 * @package SwissSolar
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Настройка темы
 */
function swiss_solar_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'swiss-solar'),
    ));
}
add_action('after_setup_theme', 'swiss_solar_setup');

/**
 * Security Headers
 * Защитные HTTP-заголовки для повышения безопасности сайта
 */
function swiss_solar_security_headers() {
    if (is_admin()) {
        return;
    }

    // Защита от clickjacking — запрет встраивания в iframe с других доменов
    header('X-Frame-Options: SAMEORIGIN');

    // Предотвращение MIME-sniffing (браузер не будет угадывать тип контента)
    header('X-Content-Type-Options: nosniff');

    // Referrer-Policy — контроль передачи referrer
    header('Referrer-Policy: strict-origin-when-cross-origin');

    // Permissions-Policy — ограничение доступа к API браузера
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');

    // Content-Security-Policy (базовая — совместима с WordPress, WooCommerce, Swiper CDN)
    // При необходимости скорректируйте под свои скрипты и стили
    $csp = array(
        "default-src 'self'",
        "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net",
        "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net",
        "img-src 'self' data: https: blob:",
        "font-src 'self' https://cdn.jsdelivr.net",
        "connect-src 'self'",
        "frame-ancestors 'self'",
        "base-uri 'self'",
        "form-action 'self'",
    );
    header('Content-Security-Policy: ' . implode('; ', $csp));
}
add_action('send_headers', 'swiss_solar_security_headers', 1);

/**
 * Скрытие версии WordPress
 * Удаляет meta generator и версию из RSS/Atom — снижает раскрытие информации атакующим
 */
function swiss_solar_remove_wp_version() {
    remove_action('wp_head', 'wp_generator');
}
add_action('init', 'swiss_solar_remove_wp_version');

add_filter('the_generator', '__return_empty_string');

/**
 * Скрытие версии WordPress из URL скриптов и стилей
 * Убирает ?ver=6.9.1 из ссылок на CSS/JS — снижает раскрытие информации
 */
function swiss_solar_remove_version_from_assets($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'swiss_solar_remove_version_from_assets', 9999);
add_filter('script_loader_src', 'swiss_solar_remove_version_from_assets', 9999);

/**
 * Подключение стилей и скриптов
 */
function swiss_solar_scripts() {
    // Подключение основного CSS файла с Tailwind
    wp_enqueue_style(
        'swiss-solar-style',
        get_stylesheet_directory_uri() . '/dist/style.css',
        array(),
        wp_get_theme()->get('Version')
    );
    
    // Подключение Swiper CSS (только на главной странице)
    if (is_front_page()) {
        wp_enqueue_style(
            'swiper-css',
            'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
            array(),
            '11.0.0'
        );
        
        wp_enqueue_script(
            'swiper-js',
            'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
            array(),
            '11.0.0',
            true
        );
    }
    
    // Подключение основного JavaScript
    wp_enqueue_script(
        'swiss-solar-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
    
    // Локализация для AJAX
    wp_localize_script('swiss-solar-script', 'swissSolarAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('swiss_solar_search_nonce'),
        'contact_nonce' => wp_create_nonce('swiss_solar_contact_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'swiss_solar_scripts');

/**
 * Регистрация таксономии References
 */
function swiss_solar_register_references_taxonomy() {
    $labels = array(
        'name'              => __('References', 'swiss-solar'),
        'singular_name'     => __('Reference', 'swiss-solar'),
        'search_items'     => __('Search References', 'swiss-solar'),
        'all_items'         => __('All References', 'swiss-solar'),
        'parent_item'       => __('Parent Reference', 'swiss-solar'),
        'parent_item_colon' => __('Parent Reference:', 'swiss-solar'),
        'edit_item'         => __('Edit Reference', 'swiss-solar'),
        'update_item'       => __('Update Reference', 'swiss-solar'),
        'add_new_item'      => __('Add New Reference', 'swiss-solar'),
        'new_item_name'     => __('New Reference Name', 'swiss-solar'),
        'menu_name'         => __('References', 'swiss-solar'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'references'),
        'show_in_rest'      => true, // Поддержка Gutenberg
    );

    // Регистрируем таксономию для постов (можно изменить на нужный тип поста)
    register_taxonomy('references', array('post', 'page'), $args);
}
add_action('init', 'swiss_solar_register_references_taxonomy');

/**
 * Регистрация кастомного типа поста References
 */
function swiss_solar_register_references_post_type() {
    $labels = array(
        'name'                  => __('References', 'swiss-solar'),
        'singular_name'         => __('Reference', 'swiss-solar'),
        'menu_name'             => __('References', 'swiss-solar'),
        'name_admin_bar'        => __('Reference', 'swiss-solar'),
        'add_new'               => __('Add New', 'swiss-solar'),
        'add_new_item'          => __('Add New Reference', 'swiss-solar'),
        'new_item'              => __('New Reference', 'swiss-solar'),
        'edit_item'             => __('Edit Reference', 'swiss-solar'),
        'view_item'             => __('View Reference', 'swiss-solar'),
        'all_items'             => __('All References', 'swiss-solar'),
        'search_items'          => __('Search References', 'swiss-solar'),
        'not_found'             => __('No references found.', 'swiss-solar'),
        'not_found_in_trash'    => __('No references found in Trash.', 'swiss-solar'),
        'featured_image'        => __('Reference Image', 'swiss-solar'),
        'set_featured_image'    => __('Set reference image', 'swiss-solar'),
        'remove_featured_image' => __('Remove reference image', 'swiss-solar'),
        'use_featured_image'    => __('Use as reference image', 'swiss-solar'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'references'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'      => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true, // Поддержка Gutenberg
    );

    register_post_type('references', $args);
}
add_action('init', 'swiss_solar_register_references_post_type');

/**
 * Регистрация кастомного типа поста Downloads
 */
function swiss_solar_register_downloads_post_type() {
    $labels = array(
        'name'                  => __('Downloads', 'swiss-solar'),
        'singular_name'         => __('Download', 'swiss-solar'),
        'menu_name'             => __('Downloads', 'swiss-solar'),
        'name_admin_bar'        => __('Download', 'swiss-solar'),
        'add_new'               => __('Add New', 'swiss-solar'),
        'add_new_item'          => __('Add New Download', 'swiss-solar'),
        'new_item'              => __('New Download', 'swiss-solar'),
        'edit_item'             => __('Edit Download', 'swiss-solar'),
        'view_item'             => __('View Download', 'swiss-solar'),
        'all_items'             => __('All Downloads', 'swiss-solar'),
        'search_items'          => __('Search Downloads', 'swiss-solar'),
        'not_found'             => __('No downloads found.', 'swiss-solar'),
        'not_found_in_trash'    => __('No downloads found in Trash.', 'swiss-solar'),
        'featured_image'        => __('Download Image', 'swiss-solar'),
        'set_featured_image'    => __('Set download image', 'swiss-solar'),
        'remove_featured_image' => __('Remove download image', 'swiss-solar'),
        'use_featured_image'    => __('Use as download image', 'swiss-solar'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'downloads'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-download',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true, // Поддержка Gutenberg
    );

    register_post_type('downloads', $args);
}
add_action('init', 'swiss_solar_register_downloads_post_type');

/**
 * Регистрация таксономии Downloads Category
 */
function swiss_solar_register_downloads_category_taxonomy() {
    $labels = array(
        'name'              => __('Download Categories', 'swiss-solar'),
        'singular_name'     => __('Download Category', 'swiss-solar'),
        'search_items'      => __('Search Categories', 'swiss-solar'),
        'all_items'         => __('All Categories', 'swiss-solar'),
        'parent_item'       => __('Parent Category', 'swiss-solar'),
        'parent_item_colon' => __('Parent Category:', 'swiss-solar'),
        'edit_item'         => __('Edit Category', 'swiss-solar'),
        'update_item'       => __('Update Category', 'swiss-solar'),
        'add_new_item'      => __('Add New Category', 'swiss-solar'),
        'new_item_name'     => __('New Category Name', 'swiss-solar'),
        'menu_name'         => __('Categories', 'swiss-solar'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'downloads-category'),
        'show_in_rest'      => true, // Поддержка Gutenberg
    );

    register_taxonomy('downloads_category', array('downloads'), $args);
}
add_action('init', 'swiss_solar_register_downloads_category_taxonomy');

/**
 * Регистрация ACF полей для Downloads (если ACF активен)
 */
function swiss_solar_register_downloads_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_downloads_fields',
            'title' => 'Download Fields',
            'fields' => array(
                array(
                    'key' => 'field_downloads_pdf_file',
                    'label' => 'PDF File',
                    'name' => 'pdf_file',
                    'type' => 'file',
                    'instructions' => 'Upload the PDF file for this download (or use PDF URL below)',
                    'required' => 0,
                    'return_format' => 'array',
                    'library' => 'all',
                    'mime_types' => 'pdf',
                ),
                array(
                    'key' => 'field_downloads_pdf_url',
                    'label' => 'PDF URL',
                    'name' => 'pdf_url',
                    'type' => 'url',
                    'instructions' => 'Enter a direct link to the PDF file (or upload a file above)',
                    'required' => 0,
                    'placeholder' => 'https://example.com/file.pdf',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'downloads',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ));
    }
}
add_action('acf/init', 'swiss_solar_register_downloads_acf_fields');

/**
 * Создание стандартных категорий для Downloads при активации темы
 */
function swiss_solar_create_default_downloads_categories() {
    // Проверяем, существуют ли уже категории
    $existing_categories = get_terms(array(
        'taxonomy' => 'downloads_category',
        'hide_empty' => false,
    ));
    
    // Если категорий нет, создаем стандартные
    if (empty($existing_categories) || is_wp_error($existing_categories)) {
        $default_categories = array(
            'data-sheet' => 'Data Sheet',
            'installational-manual' => 'Installational Manual',
            'technical-warranty' => 'Technical & Warranty',
            'certificates' => 'Certificates'
        );
        
        foreach ($default_categories as $slug => $name) {
            wp_insert_term(
                $name,
                'downloads_category',
                array(
                    'slug' => $slug
                )
            );
        }
    }
}
add_action('after_setup_theme', 'swiss_solar_create_default_downloads_categories');

/**
 * Регистрация кастомного типа поста Vacancies
 */
function swiss_solar_register_vacancies_post_type() {
    $labels = array(
        'name'                  => __('Vacancies', 'swiss-solar'),
        'singular_name'         => __('Vacancy', 'swiss-solar'),
        'menu_name'             => __('Vacancies', 'swiss-solar'),
        'name_admin_bar'        => __('Vacancy', 'swiss-solar'),
        'add_new'               => __('Add New', 'swiss-solar'),
        'add_new_item'          => __('Add New Vacancy', 'swiss-solar'),
        'new_item'              => __('New Vacancy', 'swiss-solar'),
        'edit_item'             => __('Edit Vacancy', 'swiss-solar'),
        'view_item'             => __('View Vacancy', 'swiss-solar'),
        'all_items'             => __('All Vacancies', 'swiss-solar'),
        'search_items'          => __('Search Vacancies', 'swiss-solar'),
        'not_found'             => __('No vacancies found.', 'swiss-solar'),
        'not_found_in_trash'    => __('No vacancies found in Trash.', 'swiss-solar'),
        'featured_image'        => __('Vacancy Image', 'swiss-solar'),
        'set_featured_image'    => __('Set vacancy image', 'swiss-solar'),
        'remove_featured_image' => __('Remove vacancy image', 'swiss-solar'),
        'use_featured_image'    => __('Use as vacancy image', 'swiss-solar'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'vacancies'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true, // Поддержка Gutenberg
    );

    register_post_type('vacancies', $args);
}
add_action('init', 'swiss_solar_register_vacancies_post_type');

/**
 * Регистрация таксономии Vacancies Category
 */
function swiss_solar_register_vacancies_category_taxonomy() {
    $labels = array(
        'name'              => __('Vacancy Categories', 'swiss-solar'),
        'singular_name'     => __('Vacancy Category', 'swiss-solar'),
        'search_items'      => __('Search Categories', 'swiss-solar'),
        'all_items'         => __('All Categories', 'swiss-solar'),
        'parent_item'       => __('Parent Category', 'swiss-solar'),
        'parent_item_colon' => __('Parent Category:', 'swiss-solar'),
        'edit_item'         => __('Edit Category', 'swiss-solar'),
        'update_item'       => __('Update Category', 'swiss-solar'),
        'add_new_item'      => __('Add New Category', 'swiss-solar'),
        'new_item_name'     => __('New Category Name', 'swiss-solar'),
        'menu_name'         => __('Categories', 'swiss-solar'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'vacancies-category'),
        'show_in_rest'      => true, // Поддержка Gutenberg
    );

    register_taxonomy('vacancies_category', array('vacancies'), $args);
}
add_action('init', 'swiss_solar_register_vacancies_category_taxonomy');

/**
 * Регистрация ACF полей для Vacancies (если ACF активен)
 */
function swiss_solar_register_vacancies_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_vacancies_fields',
            'title' => 'Vacancy Fields',
            'fields' => array(
                array(
                    'key' => 'field_vacancies_location',
                    'label' => 'Location',
                    'name' => 'location',
                    'type' => 'text',
                    'instructions' => 'Enter the location (e.g., Switzerland)',
                    'required' => 0,
                    'default_value' => 'Switzerland',
                ),
                array(
                    'key' => 'field_vacancies_workplace',
                    'label' => 'Workplace',
                    'name' => 'workplace',
                    'type' => 'text',
                    'instructions' => 'Enter the workplace address (e.g., CH-6300 Zug)',
                    'required' => 0,
                    'default_value' => 'CH-6300 Zug',
                ),
                array(
                    'key' => 'field_vacancies_operation_area',
                    'label' => 'Operation Area',
                    'name' => 'operation_area',
                    'type' => 'text',
                    'instructions' => 'Enter the operation area (e.g., Research & Development)',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_vacancies_position',
                    'label' => 'Position',
                    'name' => 'position',
                    'type' => 'text',
                    'instructions' => 'Enter the position type (e.g., Employee)',
                    'required' => 0,
                    'default_value' => 'Employee',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'vacancies',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ));
    }
}
add_action('acf/init', 'swiss_solar_register_vacancies_acf_fields');

/**
 * Регистрация ACF полей для Products (если ACF активен)
 */
function swiss_solar_register_products_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_products_fields',
            'title' => 'Product Fields',
            'fields' => array(
                array(
                    'key' => 'field_products_rear_side_power_text',
                    'label' => 'Rear Side Power Text',
                    'name' => 'rear_side_power_text',
                    'type' => 'text',
                    'instructions' => 'Enter the text for rear side power (e.g., "Up to 440 Wp")',
                    'required' => 0,
                    'default_value' => 'Up to 440 Wp',
                    'placeholder' => 'Up to 440 Wp',
                ),
                array(
                    'key' => 'field_products_warranty_text',
                    'label' => 'Warranty Text',
                    'name' => 'warranty_text',
                    'type' => 'text',
                    'instructions' => 'Enter the warranty text (e.g., "25 years warranty")',
                    'required' => 0,
                    'default_value' => '25 years warranty',
                    'placeholder' => '25 years warranty',
                ),
                array(
                    'key' => 'field_products_technologies',
                    'label' => 'Technologies',
                    'name' => 'product_technologies',
                    'type' => 'checkbox',
                    'instructions' => 'Select which technologies to display for this product',
                    'required' => 0,
                    'choices' => array(
                        'technology_1' => 'TOPCon Advance Technology',
                        'technology_2' => 'DuraGlassX™',
                        'technology_3' => 'Aluforce Black Frame',
                        'technology_4' => 'POE Encapsulation',
                        'technology_5' => 'Sustainability',
                        'technology_6' => 'PHANTOM Design',
                    ),
                    'allow_custom' => 0,
                    'default_value' => array(),
                    'layout' => 'vertical',
                    'toggle' => 0,
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_products_datasheet_url',
                    'label' => 'Datasheet URL',
                    'name' => 'datasheet_url',
                    'type' => 'url',
                    'instructions' => 'Enter a direct link to the datasheet PDF file (or upload a file using "file-product" field)',
                    'required' => 0,
                    'placeholder' => 'https://example.com/datasheet.pdf',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'product',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ));
    }
}
add_action('acf/init', 'swiss_solar_register_products_acf_fields');

/**
 * Schema.org Product structured data (JSON-LD) для улучшения отображения в Google
 */
function swiss_solar_product_schema() {
    if (!is_singular('product') || !class_exists('WooCommerce')) {
        return;
    }

    global $product;
    if (!$product || !($product instanceof WC_Product)) {
        $product = wc_get_product(get_the_ID());
    }
    if (!$product) {
        return;
    }

    $product_id = $product->get_id();
    $name = $product->get_name();
    $description = $product->get_short_description();
    if (empty($description)) {
        $description = wp_strip_all_tags($product->get_description());
    }
    $description = wp_trim_words($description, 55);

    // Изображение
    $image_id = $product->get_image_id();
    $image_url = $image_id 
        ? wp_get_attachment_image_url($image_id, 'full') 
        : wc_placeholder_img_src('full');

    // SKU
    $sku = $product->get_sku();

    // Цена и валюта
    $price = $product->get_price();
    $currency = get_woocommerce_currency();
    $availability = $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock';

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $name,
        'description' => $description,
        'image' => $image_url,
        'url' => get_permalink($product_id),
        'brand' => array(
            '@type' => 'Brand',
            'name' => 'Swiss Solar',
            'url' => home_url('/')
        ),
        'sku' => !empty($sku) ? $sku : (string) $product_id,
    );

    // Добавляем manufacturer (производитель)
    $schema['manufacturer'] = array(
        '@type' => 'Organization',
        'name' => 'SSWISS GROUP AG',
        'url' => home_url('/')
    );

    // Offers — для variable product создаём AggregateOffer
    if ($product->is_type('variable')) {
        $low_price = $product->get_variation_price('min', true);
        $high_price = $product->get_variation_price('max', true);
        $schema['offers'] = array(
            '@type' => 'AggregateOffer',
            'url' => get_permalink($product_id),
            'priceCurrency' => $currency,
            'lowPrice' => $low_price ? floatval($low_price) : null,
            'highPrice' => $high_price ? floatval($high_price) : null,
            'offerCount' => count($product->get_children()),
            'availability' => $availability
        );
        if (!$low_price && !$high_price) {
            unset($schema['offers']['lowPrice'], $schema['offers']['highPrice']);
        }
    } else {
        $offer = array(
            '@type' => 'Offer',
            'url' => get_permalink($product_id),
            'priceCurrency' => $currency,
            'priceValidUntil' => date('Y-m-d', strtotime('+1 year')),
            'availability' => $availability,
            'seller' => array(
                '@type' => 'Organization',
                'name' => 'SSWISS GROUP AG'
            )
        );
        if ($price) {
            $offer['price'] = floatval($price);
        }
        $schema['offers'] = $offer;
    }

    // Warranty (если есть ACF поле)
    $warranty = get_field('warranty', $product_id);
    if (!empty($warranty)) {
        $schema['warranty'] = array(
            '@type' => 'WarrantyPromise',
            'description' => esc_html($warranty)
        );
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'swiss_solar_product_schema', 5);

/**
 * Schema.org ItemList для страницы каталога продуктов
 */
function swiss_solar_itemlist_schema() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    $is_shop = is_shop() || is_post_type_archive('product');
    $is_page_shop = is_page_template('page-shop.php');

    if (!$is_shop && !$is_page_shop) {
        return;
    }

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 50,
        'orderby' => 'menu_order title',
        'order' => 'ASC'
    );

    if ($is_page_shop && isset($_GET['product_search'])) {
        $args['s'] = sanitize_text_field($_GET['product_search']);
    }

    $products_query = new WP_Query($args);
    $list_items = array();

    if ($products_query->have_posts()) {
        $position = 1;
        while ($products_query->have_posts()) {
            $products_query->the_post();
            $product = wc_get_product(get_the_ID());
            if (!$product) {
                continue;
            }
            $image_id = $product->get_image_id();
            $image_url = $image_id 
                ? wp_get_attachment_image_url($image_id, 'medium') 
                : wc_placeholder_img_src('medium');
            $list_items[] = array(
                '@type' => 'ListItem',
                'position' => $position++,
                'url' => get_permalink(),
                'name' => get_the_title(),
                'image' => $image_url
            );
        }
        wp_reset_postdata();
    }

    if (empty($list_items)) {
        return;
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'itemListElement' => $list_items,
        'numberOfItems' => count($list_items)
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'swiss_solar_itemlist_schema', 6);

/**
 * AJAX обработчик для поиска продуктов WooCommerce
 */
function swiss_solar_search_products_ajax() {
    // Проверка nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'swiss_solar_search_nonce')) {
        wp_send_json_error(array('message' => 'Security error'));
        return;
    }
    
    $query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
    
    if (empty($query) || strlen($query) < 2) {
        wp_send_json_error(array('message' => 'Query too short'));
        return;
    }
    
    // Проверяем, активен ли WooCommerce
    if (!class_exists('WooCommerce')) {
        wp_send_json_error(array('message' => 'WooCommerce is not active'));
        return;
    }
    
    // Поиск продуктов
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        's' => $query,
        'orderby' => 'relevance',
        'order' => 'DESC'
    );
    
    $products_query = new WP_Query($args);
    $products = array();
    
    if ($products_query->have_posts()) {
        while ($products_query->have_posts()) {
            $products_query->the_post();
            $product_id = get_the_ID();
            $product = wc_get_product($product_id);
            
            if (!$product) {
                continue;
            }
            
            // Получаем изображение продукта
            $image_url = '';
            if (has_post_thumbnail($product_id)) {
                $image_id = get_post_thumbnail_id($product_id);
                $image_url = wp_get_attachment_image_url($image_id, 'medium');
            } else {
                $image_url = wc_placeholder_img_src('medium');
            }
            
            // Получаем цену
            $price = '';
            if ($product->is_type('variable')) {
                $price = $product->get_price_html();
            } else {
                $price = $product->get_price_html();
            }
            
            $products[] = array(
                'id' => $product_id,
                'title' => get_the_title(),
                'url' => get_permalink(),
                'image' => $image_url,
                'price' => $price
            );
        }
        wp_reset_postdata();
    }
    
    wp_send_json_success($products);
}
add_action('wp_ajax_swiss_solar_search_products', 'swiss_solar_search_products_ajax');
add_action('wp_ajax_nopriv_swiss_solar_search_products', 'swiss_solar_search_products_ajax');

/**
 * AJAX обработчик для формы контактов
 */
function swiss_solar_contact_form_ajax() {
    // Проверка nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'swiss_solar_contact_nonce')) {
        wp_send_json_error(array('message' => 'Security error'));
        return;
    }
    
    // Получаем данные формы
    $salutation = isset($_POST['salutation']) ? sanitize_text_field($_POST['salutation']) : '';
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $company = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
    $newsletter = isset($_POST['newsletter']) ? 'Yes' : 'No';
    
    // Валидация
    if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => 'Please fill in all required fields.'));
        return;
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
        return;
    }
    
    // Получаем email админа
    $admin_email = get_option('admin_email');
    
    // Тема письма
    $subject = 'New Contact Form Submission from ' . $first_name . ' ' . $last_name;
    
    // Тело письма
    $email_body = "New contact form submission:\n\n";
    $email_body .= "Salutation: " . $salutation . "\n";
    $email_body .= "First Name: " . $first_name . "\n";
    $email_body .= "Last Name: " . $last_name . "\n";
    $email_body .= "Company/Organisation: " . $company . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Phone/Mobile No.: " . $phone . "\n";
    $email_body .= "Newsletter Subscription: " . $newsletter . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";
    
    // Заголовки письма
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . $admin_email . '>',
        'Reply-To: ' . $first_name . ' ' . $last_name . ' <' . $email . '>'
    );
    
    // Отправка письма
    $sent = wp_mail($admin_email, $subject, $email_body, $headers);
    
    if ($sent) {
        wp_send_json_success(array('message' => 'Thank you! Your message has been sent successfully.'));
    } else {
        wp_send_json_error(array('message' => 'Sorry, there was an error sending your message. Please try again later.'));
    }
}
add_action('wp_ajax_swiss_solar_contact_form', 'swiss_solar_contact_form_ajax');
add_action('wp_ajax_nopriv_swiss_solar_contact_form', 'swiss_solar_contact_form_ajax');