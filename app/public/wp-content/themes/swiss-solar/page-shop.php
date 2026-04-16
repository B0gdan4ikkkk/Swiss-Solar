<?php
/**
 * Template Name: Shop Page
 * Шаблон страницы магазина
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();

// Получаем категории товаров (только с товарами)
$product_categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'parent' => 0
));
?>

<section class="hero__sect-shop w-screen flex items-start md:items-center justify-center relative">
    <div class="relative z-10 mt-[60px] md:mt-0 title-shop max-w-[162px] md:max-w-full" >
        <img src="<?php echo get_template_directory_uri(); ?>/img/title-shop.svg" alt="PHANTOM by Swiss Solar">
    </div>
<div class="absolute top-[-89px] md:top-[-96px] right-0 w-screen hero__sect-shop-img">
    <img src="<?php echo get_template_directory_uri(); ?>/img/shop-baner.jpg" alt="baner" class="hidden md:block w-full h-full z-[-10000] object-cover" >
    <img src="<?php echo get_template_directory_uri(); ?>/img/shop-baner-mobile.jpg" alt="baner" class="md:hidden w-full h-full z-[-10000]">
</div>

<div class="absolute w-full h-[124px] bottom-[-44px] md:bottom-[-49px] lg:bottom-[-28px]  z-10 left-0" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, #000000  100%);">
</div>
</section>

<!-- Основная секция магазина -->
<section class="shop-section pb-20">
    <div class="container">
        
        <!-- Заголовок SERIES -->
        <div class="mb-20">
            <?php if (!empty($search_query)): ?>
                <div class="mb-6 text-center">
                    <h2 class="text-white text-xl md:text-2xl font-medium mb-2">Search Results: "<?php echo esc_html($search_query); ?>"</h2>
                    <p class="text-[#757575] text-sm">Products found: <?php echo $products->found_posts; ?></p>
                </div>
            <?php endif; ?>
            <h1 class="text-[#757575] text-[14px] font-medium tracking-[0.2em] uppercase mb-10 text-center relative z-[100]">SERIES</h1>
            
            <!-- Табы навигации (категории) -->
            <div class="flex items-center justify-center gap-3 ">
                <?php if (!empty($product_categories) && !is_wp_error($product_categories)): ?>
                    <?php 
                    // При поиске ни одна категория не активна
                    $active_index = empty($search_query) ? 0 : -1;
                    foreach ($product_categories as $index => $category): 
                    ?>
                        <button class="shop-tab <?php echo ($index === $active_index) ? 'active' : ''; ?> text-[14px] font-medium relative pb-2 transition-colors hover:opacity-80 leading-[140%] md:w-[200px] w-[160px] text-start" 
                                style="color: <?php echo ($index === $active_index) ? 'white' : '#757575'; ?>;"
                                data-category="<?php echo esc_attr($category->slug); ?>">
                            <span class="absolute top-[-4px] left-0 w-full h-[2px] tab-underline block" 
                                  style="background-color: <?php echo ($index === $active_index) ? '#EA0029' : '#757575'; ?>;"></span>
                            <?php echo esc_html($category->name); ?>
                        </button>
                    <?php endforeach; ?>
                <?php else: ?>
                    <button class="shop-tab <?php echo empty($search_query) ? 'active' : ''; ?> text-white text-[18px] font-medium relative pb-2 transition-colors hover:opacity-80" data-category="all">
                        All Products
                        <span class="absolute bottom-0 left-0 w-full h-[2px] bg-[#EA0029] tab-underline"></span>
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Сетка продуктов -->
        <div class="products-grid grid grid-cols-1 lg:grid-cols-2 gap-3 max-w-[1300px] mx-auto">
            
            <?php
            // Запрос продуктов
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
            );

            // Проверяем наличие параметра поиска
            $search_query = isset($_GET['product_search']) ? sanitize_text_field($_GET['product_search']) : '';
            if (!empty($search_query)) {
                $args['s'] = $search_query;
                $args['orderby'] = 'relevance';
            }

            $products = new WP_Query($args);

            if ($products->have_posts()):
                while ($products->have_posts()): $products->the_post();
                    global $product;
                    
                    // Получаем категории продукта
                    $terms = get_the_terms(get_the_ID(), 'product_cat');
                    $category_slugs = array();
                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            $category_slugs[] = $term->slug;
                        }
                    }
                    $data_categories = implode(' ', $category_slugs);
                    
                    // ACF поля
                    $model_name = get_field('model_name');
                    $panel_technology = get_field('panel_technology');
                    $power = get_field('power');
                    $efficiency = get_field('efficiency');
                    $rear_side_power = get_field('rear_side_power');
                    $rear_side_power_text_raw = get_field('rear_side_power_text');
                    $rear_side_power_text = !empty($rear_side_power_text_raw) ? $rear_side_power_text_raw : 'Up to 440 Wp';
                    $warranty = get_field('warranty');
                    $warranty_text_raw = get_field('warranty_text');
                    $warranty_text = !empty($warranty_text_raw) ? $warranty_text_raw : '25 years warranty';
                    $product_technologies = get_field('product_technologies') ?: array();
                    
                    // Получаем характеристики из группы
                    $characteristics = array();
                    $characteristics_group = get_field('characteristics'); // Получаем группу
                    
                    if ($characteristics_group) {
                        // Получаем поля из группы
                        for ($i = 1; $i <= 5; $i++) {
                            $field_name = 'characteristic_' . $i;
                            if (!empty($characteristics_group[$field_name])) {
                                $characteristics[] = $characteristics_group[$field_name];
                            }
                        }
                    }
                    
                    // Получаем категорию для отображения названия
                    $primary_category = '';
                    if ($terms && !is_wp_error($terms)) {
                        $primary_category = $terms[0]->name;
                    }
            ?>
            
            <!-- Карточка продукта -->
            <div class="product-card border border-[#757575] relative overflow-hidden" data-categories="<?php echo esc_attr($data_categories); ?>">
                <a href="<?php echo esc_url(get_permalink()); ?>" class="w-full h-full absolute top-0 right-0 flex md:hidden z-[100]"></a>
                <!-- Фоновое изображение справа -->
                <?php if (has_post_thumbnail()): ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="absolute right-0 top-0 w-full h-full flex ">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'w-full h-full object-cover')); ?>
                    </a>
                <?php endif; ?>
                
                
                
                <!-- Контент -->
                <div class="relative z-10 p-6 lg:p-10">
                    <!-- Хедер: категория слева, кнопка справа -->
                    <div class="flex items-center justify-between mb-6 w-full">
                            <h3 class="text-white text-[16px] lg:text-[20px] font-medium flex items-center gap-1 md:gap-2">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/phantom.svg" alt="PHANTOM" class="h-[10px] md:h-[16px]"><?php echo !empty($primary_category) ? esc_html($primary_category) : 'PHANTOM'; ?>
                            </h3>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="learn-more-btn border border-white text-white px-4 py-2 rounded-md text-[14px] font-medium hidden sm:inline-flex items-center gap-2 hover:bg-[#EA0029] hover:border-[#EA0029] transition-all">
                            Learn more <span>></span> 
                        </a>
                    </div>

                    <!-- Модель и технология -->
                    <div class="leading-[1.09]">
                        <?php if ($model_name): ?>
                            <div class="text-[#EA0029] text-[20px] lg:text-[24px] font-semibold font-clash">
                                <p><?php echo esc_html($model_name); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ($panel_technology): ?>
                            <div class="text-white text-[20px] lg:text-[24px] font-semibold mb-1 font-clash">
                                <p><?php echo esc_html($panel_technology); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Мощность -->
                        <?php if ($power): ?>
                            <div class="text-[#EA0029] text-[20px] md:text-[50px] lg:text-[72px] font-bold md:font-extralight leading-none mb-4 md:mb-8 font-clash">
                                <p><?php echo esc_html($power); ?>W</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Характеристики efficiency, rear_side_power, warranty -->
                    <div class="mb-20 md:mb-[122px] space-y-[2px] md:space-y-1">
                        <?php if ($efficiency): ?>
                            <div class="flex items-start gap-2 pl-3 relative">
                                <span class="bg-[#EA0029] translate-y-[-50%]  block w-[3px] md:w-[4px] h-[3px] md:h-[4px] absolute top-1/2 left-0"></span>
                                <span class="text-white text-[13px] lg:text-[16px]">Up to <?php echo esc_html($efficiency); ?> efficiency</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($rear_side_power || !empty($rear_side_power_text_raw)): ?>
                            <div class="flex items-start gap-2 pl-3 relative">
                                <span class="bg-[#EA0029] translate-y-[-50%]  block w-[3px] md:w-[4px] h-[3px] md:h-[4px] absolute top-1/2 left-0"></span>
                                <span class="text-white text-[13px] lg:text-[16px]"><?php echo esc_html($rear_side_power_text); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($warranty || !empty($warranty_text_raw)): ?>
                            <div class="flex items-start gap-2 pl-3 relative">
                                <span class="bg-[#EA0029] translate-y-[-50%]  block w-[3px] md:w-[4px] h-[3px] md:h-[4px] absolute top-1/2 left-0"></span>
                                <span class="text-white text-[13px] lg:text-[16px]"><?php echo esc_html($warranty_text); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($product_technologies)): ?>
                    <div class="space-y-3">
                        <?php 
                        // Массив соответствия технологий и изображений
                        $technologies_map = array(
                            'technology_1' => 'technologes-single1.svg',
                            'technology_2' => 'technologes-single2.svg',
                            'technology_3' => 'technologes-single3.svg',
                            'technology_4' => 'technologes-single4.svg',
                        );
                        
                        // Выводим только выбранные технологии
                        foreach ($product_technologies as $tech_key):
                            if (isset($technologies_map[$tech_key])):
                        ?>
                            <div class="flex gap-3 items-center">
                                <span class="text-[#EA0029] mt-[2px] text-[5px] md:text-[8px]"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-product.svg" alt="" class="w-2 h-2"></span>
                                <div class="text-white">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/<?php echo esc_attr($technologies_map[$tech_key]); ?>" alt="Characteristic" class="max-h-[16px] md:max-h-[20px] w-auto">
                                </div>
                            </div>
                        <?php 
                            endif;
                        endforeach;
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php
                endwhile;
                wp_reset_postdata();
            else:
            ?>
                <div class="col-span-full text-center py-20">
                    <?php if (!empty($search_query)): ?>
                        <p class="text-white text-xl mb-4">Nothing found for query "<?php echo esc_html($search_query); ?>".</p>
                        <a href="<?php echo home_url('/shop/'); ?>" class="text-[#EA0029] hover:underline">Back to catalog</a>
                    <?php else: ?>
                        <p class="text-white text-xl">No products found.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</section>
<div class=" w-full items-center justify-center flex">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/flag.svg'); ?>" alt="Swiss Flag" class="w-12 h-12 md:w-12 lg:h-12">
        </div>
<?php
get_footer();
?>
