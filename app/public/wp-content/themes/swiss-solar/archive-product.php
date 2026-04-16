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
    <div class="relative z-10 mt-[60px] md:mt-0 md:mb-[250px] max-w-[162px] md:max-w-full">
        <img src="<?php echo get_template_directory_uri(); ?>/img/title-shop.svg" alt="PHANTOM by Swiss Solar">
    </div>
<div class="absolute top-[-89px] md:top-[-96px] right-0 w-screen h-[60dvh] md:h-screen">
    <img src="<?php echo get_template_directory_uri(); ?>/img/shop-baner.jpg" alt="baner" class="hidden md:block w-full h-full z-[-10000]">
    <img src="<?php echo get_template_directory_uri(); ?>/img/shop-baner-mobile.png" alt="baner" class="md:hidden w-full h-full z-[-10000]">
</div>

<div class="absolute w-full h-[124px] bottom-[-44px] md:bottom-[-49px] lg:bottom-[-28px]  z-10 left-0">
<img src="<?php echo get_template_directory_uri(); ?>/img/shop-baner-shadow.svg" alt="shadow" class="w-full h-auto">
</div>
</section>

<!-- Основная секция магазина -->
<section class="shop-section pb-20">
    <div class="container">
        
        <!-- Заголовок SERIES -->
        <div class="mb-20">
            <h1 class="text-[#757575] text-[14px] font-medium tracking-[0.2em] uppercase mb-10 text-center relative z-[100]">SERIES</h1>
            
            <!-- Табы навигации (категории) -->
            <div class="flex items-center justify-center gap-3 ">
                <?php if (!empty($product_categories) && !is_wp_error($product_categories)): ?>
                    <?php foreach ($product_categories as $index => $category): ?>
                        <button class="shop-tab <?php echo $index === 0 ? 'active' : ''; ?> text-[14px] font-medium relative pb-2 transition-colors hover:opacity-80 leading-[140%] md:w-[200px] w-[160px] text-start" 
                                style="color: <?php echo $index === 0 ? 'white' : '#757575'; ?>;"
                                data-category="<?php echo esc_attr($category->slug); ?>">
                            <span class="absolute top-[-4px] left-0 w-full h-[2px] tab-underline block" 
                                  style="background-color: <?php echo $index === 0 ? '#EA0029' : '#757575'; ?>;"></span>
                            <?php echo esc_html($category->name); ?>
                        </button>
                    <?php endforeach; ?>
                <?php else: ?>
                    <button class="shop-tab active text-white text-[18px] font-medium relative pb-2 transition-colors hover:opacity-80" data-category="all">
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
                    $warranty = get_field('warranty');
                    
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
                <!-- Фоновое изображение справа -->
                <?php if (has_post_thumbnail()): ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="absolute right-0 top-0 w-full h-full flex">
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
                            <div class="text-white text-[20px] lg:text-[24px] font-bold mb-1 font-clash">
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
                        
                        <?php if ($rear_side_power): ?>
                            <div class="flex items-start gap-2 pl-3 relative">
                                <span class="bg-[#EA0029] translate-y-[-50%]  block w-[3px] md:w-[4px] h-[3px] md:h-[4px] absolute top-1/2 left-0"></span>
                                <span class="text-white text-[13px] lg:text-[16px] ">Up to 440 Wp</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($warranty): ?>
                            <div class="flex items-start gap-2 pl-3 relative">
                                <span class="bg-[#EA0029] translate-y-[-50%]  block w-[3px] md:w-[4px] h-[3px] md:h-[4px] absolute top-1/2 left-0"></span>
                                <span class="text-white text-[13px] lg:text-[16px]">25 years warranty</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-3">
                    <div class="flex gap-3 items-center">
                                    <span class="text-[#EA0029] mt-[2px] text-[5px] md:text-[8px]"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-product.svg" alt="" class="w-2 h-2"></span>
                                    <div class="text-white">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single1.svg" alt="Characteristic" class="max-h-[16px] md:max-h-[20px] w-auto">
                                    </div>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <span class="text-[#EA0029] mt-[2px] text-[5px] md:text-[8px]"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-product.svg" alt="" class="w-2 h-2"></span>
                                    <div class="text-white">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single2.svg" alt="Characteristic" class="max-h-[16px] md:max-h-[20px] w-auto">
                                    </div>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <span class="text-[#EA0029] mt-[2px] text-[5px] md:text-[8px]"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-product.svg" alt="" class="w-2 h-2"></span>
                                    <div class="text-white">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single3.svg" alt="Characteristic" class="max-h-[16px] md:max-h-[20px] w-auto">
                                    </div>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <span class="text-[#EA0029] mt-[2px] text-[5px] md:text-[8px]"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-product.svg" alt="" class="w-2 h-2"></span>
                                    <div class="text-white">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single4.svg" alt="Characteristic" class="max-h-[16px] md:max-h-[20px] w-auto">
                                    </div>
                                </div>
                    </div>
                </div>
            </div>

            <?php
                endwhile;
                wp_reset_postdata();
            else:
            ?>
                <div class="col-span-full text-center py-20">
                    <p class="text-white text-xl">No products found.</p>
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
