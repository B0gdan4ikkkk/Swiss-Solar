<?php
/**
 * Шаблон главной страницы
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();
?>
<section class="hero__sect w-screen">
<!-- Полноэкранный слайдер Swiper -->
<div class="hero-slider-wrapper absolute top-0 right-0 w-screen hero__sect-img">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            <!-- Слайд 1 -->
            <div class="swiper-slide">
                <div class="relative w-screen hero__sect-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/baner-1.jpg" alt="Slide 1" class="w-full h-full object-cover">
                    <div class="absolute inset-0 flex items-end md:items-center justify-center lg:justify-start  md:mb-0">
                        <div class="text-center lg:text-start text-white flex flex-col items-center lg:items-start mx-auto text-hero xl:mb-[0px] px-5 lg:px-0  max-w-[1360px] w-full">
                        <a href="<?php echo home_url('/shop/'); ?>" class=" mb-5  flex md:hidden items-center gap-2 py-1 px-4 rounde w-fit rounded-full bg-[#EA0029] text-white relative z-100">Store <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="Arrow" class="mt-[3px]"></a>
                            <h2 class="lg:ml-[100px] text-[40px] md:text-[76px] font-medium text-center md:text-start  max-w-[290px] md:max-w-[600px] leading-[1.1]">New Generation
                            of Power</h2>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Слайд 2 -->
            <div class="swiper-slide">
                <div class="relative w-screen hero__sect-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/baner-2.png" alt="Slide 2" class="w-full h-full object-cover" loading="lazy">
                    <div class="absolute inset-0 flex items-end md:items-center justify-center lg:justify-start  md:mb-0">
                        <div class="text-center lg:text-start text-white flex flex-col items-center lg:items-start mx-auto text-hero xl:mb-[0px] px-5 lg:px-0  max-w-[1360px] w-full">
                        <a href="<?php echo home_url('/shop/'); ?>" class=" mb-5  flex md:hidden items-center gap-2 py-1 px-4 rounde w-fit rounded-full bg-[#EA0029] text-white relative z-100">Store <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="Arrow" class="mt-[3px]"></a>
                            <h2 class="lg:ml-[100px] text-[40px] md:text-[76px] font-medium text-center md:text-start  max-w-[290px] md:max-w-full leading-[1.1]">Attention to details </h2>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Слайд 3 -->
            <div class="swiper-slide">
                <div class="relative w-screen hero__sect-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/baner-3.png" alt="Slide 3" class="w-full h-full object-cover" loading="lazy">
                    <div class="absolute inset-0 flex items-end md:items-center justify-center lg:justify-start  md:mb-0">
                        <div class="text-center lg:text-start text-white flex flex-col items-center lg:items-start mx-auto text-hero xl:mb-[0px] px-5 lg:px-0  max-w-[1360px] w-full">
                        <a href="<?php echo home_url('/shop/'); ?>" class=" mb-5  flex md:hidden items-center gap-2 py-1 px-4 rounde w-fit rounded-full bg-[#EA0029] text-white relative z-100">Store <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="Arrow" class="mt-[3px]"></a>
                            <h2 class="lg:ml-[100px] text-[40px] md:text-[76px] font-medium text-center md:text-start  max-w-[290px] md:max-w-full leading-[1.1]">Revolutionizing</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Кастомная пагинация с текстом -->
        <div class="custom-pagination-wrapper hidden md:flex absolute   w-full  justify-end items-end ">
            <div class="w-full container hidden md:flex justify-between items-end">
                <div class="flex flex-col items-start w-full container ">
                    <div class="pagination-lines flex items-center justify-start w-full gap-[10px] ml-[80px]"></div>
                    <div class="pagination-labels flex items-center justify-start w-full gap-[10px] mt-2 ml-[80px]">
                        <span class="pagination-label text-white text-[14px] font-medium w-[200px] transition-colors cursor-pointer" data-slide="0">Phantome</span>
                        <span class="pagination-label text-[#757575] text-[14px] font-medium w-[200px] transition-colors cursor-pointer" data-slide="1">Attention to details</span>
                        <span class="pagination-label text-[#757575] text-[14px] font-medium w-[200px] transition-colors cursor-pointer" data-slide="2">Revolutionizing</span>
                    </div>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/QUALITYTECHNOLOGY.svg" alt="text" class=" hidden lg:block mr-[100px]" loading="lazy">
            </div>
        </div>
    </div>
</div>
</section>

<!-- Секция Who We Are -->
<section class="who-we-are-section ">
    <div class="container flex flex-col items-center justify-center">
        <!-- Флаг в правом верхнем углу -->
        <div class="">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/flag.svg'); ?>" alt="Swiss Flag" class="w-12 h-12 md:w-12 lg:h-12" loading="lazy">
        </div>
        
        <!-- Контент по центру -->
        <div class="flex flex-col items-center justify-center text-start md:text-center max-w-[839px] mx-auto pt-5 md:pt-16 space-y-4 md:space-y-0">
            <h2 class="text-white text-4xl md:text-[32px] font-medium md:mb-6 tracking-[-5%] text-start md:text-center">Who We Are.</h2>
            <p class="text-[#9D9D9C] text-base md:text-[24px] leading-[135%] hidden md:block">
            SWISS GROUP AG is a Swiss company specializing in scientific research and the implementation of innovative standards in the field of solar energy. The company owns the brand Swiss Solar, which represents premium quality and reliability of next-generation solar modules.
            </p>
            <p class="text-[#9D9D9C] md:hidden text-[18px] leading-[120%] text-start">
            SWISS GROUP AG is a Swiss company specializing in scientific research and the implementation of innovative standards in the field of solar energy.
            </p>
            <p class="text-[#9D9D9C] md:hidden text-[18px] leading-[120%] text-start">
            The company owns the brand Swiss Solar, which represents premium quality and reliability of next-generation solar modules.
            </p>
        </div>
    </div>
</section>



<!-- Секция с изображением и текстом -->
<section class="production-section w-full mt-10 md:mt-[131px]">
    <div class="flex flex-col lg:flex-row">
        <!-- Левая часть - изображение -->
        <div class="w-full lg:max-w-[500px] max-h-[150px] sm:max-h-[300px] md:max-h-full flex-shrink-0">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/front-page-3sect.png'); ?>" alt="Swiss Solar Production" class="w-full h-full object-cover max-h-[150px] sm:max-h-[300px] md:max-h-full" loading="lazy">
        </div>
        
        <!-- Правая часть - текст на фоне #4A5C47 -->
        <div class="w-full bg-[#4A5C47] flex items-center py-12 md:py-16 lg:py-20 px-6 md:px-12 lg:px-16">
            <div class="lg:max-w-2xl flex flex-col items-center sm:items-start">
                <h2 class="text-[#F3F3F3] text-[28px] md:text-[32px] font-medium mb-4 md:mb-8 leading-[1.09] tracking-[-2%] md:max-w-[537px]">
                    All Swiss Solar™ panels are manufactured
                    at a certified Tier 1 factory using proprietary
                    patented technologies.
                </h2>
                <p class="text-white/70 text-[17px] md:text-[24px] mb-6 md:mb-12 leading-[135%] lg:max-w-[508px] tracking-[-2%]">
                    The company's total production capacity reaches 8.65 GW of solar modules per year, ensuring stable supply for large international projects.
                </p>
                <a href="<?php echo home_url('/about-us/'); ?>" class="inline-flex items-center gap-2 text-white text-base font-medium hover:opacity-80 transition-opacity leading-[120%]">
                    Read more about us
                   <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-sect-3.svg" alt="arrow" class="w-3 h-3" loading="lazy">
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Секция TOPCon Technology Slider -->
<section class="topcon-slider-section w-full pt-10 md:pt-[142px] relative overflow-hidden">
    <div class="max-w-[1030px] md:px-4 mx-auto ">
        <h1 class="text-white text-[24px] md:text-[32px] font-medium mb-4 md:mb-8 md:text-center pl-5 md:pl-0">Swiss Made Innovation</h1>
        <div class="swiper topcon-swiper relative w-full">
        <div class="swiper-wrapper">
            <!-- Слайд 1 -->
            <div class="swiper-slide">
                <div class="relative w-full h-full rounded-[7px]">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_1.png" alt="Slide 1" class="md:rounded-[7px] w-full h-full object-cover" loading="lazy">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/title_sect_4_1-2.png" alt="Technology" class="absolute w-[200px] top-[50px] left-[50px] z-[100] hidden md:block" loading="lazy">
                    <p class="md:max-w-[466px] text-[16px] md:text-[18px] max-w-[296px] leading-[135%] absolute bottom-5 md:bottom-12 left-[16px] md:left-[50px] z-100 text-white">Next-generation cell architecture with enhanced passivation for higher output, reduced LID & PID, and stable performance under high temperatures and low light.</p>
                </div>
            </div>

            <!-- Слайд 2 -->
            <div class="swiper-slide">
                <div class="relative w-full h-full rounded-[7px]">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_2.png" alt="Slide 2" class="md:rounded-[7px] w-full h-full object-cover" loading="lazy">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/title_sect_4_1-2.png" alt="Technology" class="absolute w-[200px] top-[50px] left-[50px] z-[100] hidden md:block" loading="lazy">
                    <p class="md:max-w-[466px] text-[16px] md:text-[18px] max-w-[296px] leading-[135%] absolute bottom-5 md:bottom-12 left-[16px] md:left-[50px] z-100 text-white">Next-generation cell architecture with enhanced passivation for higher output, reduced LID & PID, and stable performance under high temperatures and low light.</p>
                </div>
            </div>

            <!-- Слайд 3 -->
            <div class="swiper-slide">
                <div class="relative w-full h-full rounded-[7px]">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_3.png" alt="Slide 3" class="md:rounded-[7px] w-full h-full object-cover" loading="lazy">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/title_sect_4_3.png" alt="Technology" class="absolute w-[166px] top-[50px] left-[50px] z-[100] hidden md:block" loading="lazy">
                    <p class="md:max-w-[466px] text-[16px] md:text-[18px] max-w-[296px] leading-[135%] absolute bottom-5 md:bottom-12 left-[16px] md:left-[50px] z-100 text-white">Ultra-strong tempered glass with advanced anti-reflective coating ensures maximum transparency, impact resistance, and long-term durability in extreme climates.</p>
                </div>
            </div>

            <!-- Слайд 4 -->
            <div class="swiper-slide">
                <div class="relative w-full h-full rounded-[7px]">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_4.png" alt="Slide 4" class="md:rounded-[7px] w-full h-full object-cover" loading="lazy">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/title_sect_4_4.png" alt="Technology" class="absolute w-[90px] top-[50px] left-[50px] z-[100] hidden md:block" loading="lazy">
                    <p class="md:max-w-[466px] text-[16px] md:text-[18px] max-w-[296px] leading-[135%] absolute bottom-5 md:bottom-12 left-[16px] md:left-[50px] z-100 text-white">Performance and Product Warranty</p>
                </div>
            </div>
        </div>

        <!-- Кастомная пагинация с линиями и лейблами -->
        <div class="topcon-pagination-wrapper mt-5 md:mt-8 w-full">
            
            <!-- Мобильная версия: Swiper слайдер (до 768px) -->
            <div class="topcon-pagination-mobile md:hidden w-full">
                <div class="swiper topcon-pagination-swiper">
                    <div class="swiper-wrapper">
                        <!-- Слайд 1 -->
                        <div class="swiper-slide dots">
                            <div class="topcon-pagination-item-mobile flex flex-col items-start cursor-pointer" data-slide="0">
                                <div class="topcon-pagination-line-mobile active mb-3"></div>
                                <div class="topcon-pagination-label-mobile text-white text-start">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/title_sect_4_1-2.png" alt="Technology" class="w-[164px]" loading="lazy">
                                </div>
                            </div>
                        </div>
                        <!-- Слайд 2 -->
                        <div class="swiper-slide dots">
                            <div class="topcon-pagination-item-mobile flex flex-col items-start cursor-pointer" data-slide="1">
                                <div class="topcon-pagination-line-mobile mb-3"></div>
                                <div class="topcon-pagination-label-mobile text-[#757575] text-start">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/title_sect_4_1-2.png" alt="Technology" class="w-[164px]" loading="lazy">
                                </div>
                            </div>
                        </div>
                        <!-- Слайд 3 -->
                        <div class="swiper-slide dots">
                            <div class="topcon-pagination-item-mobile flex flex-col items-start cursor-pointer" data-slide="2">
                                <div class="topcon-pagination-line-mobile mb-3"></div>
                                <div class="topcon-pagination-label-mobile text-[#757575] text-start">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/title_sect_4_3.png" alt="Technology" class="w-[164px]" loading="lazy">
                                </div>
                            </div>
                        </div>
                        <!-- Слайд 4 -->
                        <div class="swiper-slide dots">
                            <div class="topcon-pagination-item-mobile flex flex-col items-start cursor-pointer" data-slide="3">
                                <div class="topcon-pagination-line-mobile mb-3"></div>
                                <div class="topcon-pagination-label-mobile text-[#757575] text-start">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/title_sect_4_1-2.png" alt="Technology" class="w-[164px]" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Десктопная версия: Статичная пагинация (от 768px) -->
            <div class="topcon-pagination-desktop hidden md:flex flex-col w-full">
                <div class="topcon-pagination-lines-desktop flex items-center justify-start gap-3 w-full mb-3">
                    <!-- Линии будут созданы через JavaScript -->
                </div>
                <div class="topcon-pagination-labels-desktop flex gap-3 w-full">
                    <div class="topcon-pagination-item-desktop flex flex-col items-start cursor-pointer flex-1" data-slide="0">
                        <div class="topcon-pagination-label-desktop text-white text-start">
                            <span class="text-[14px] leading-[140%] transition-colors"><span class="font-bold">TopCon</span> Advance</span>
                            <p class="text-[12px] leading-[120%] text-wrap">Next-generation cell architecture with enhanced passivation for higher output.</p>
                        </div>
                    </div>
                    <div class="topcon-pagination-item-desktop flex flex-col items-start cursor-pointer flex-1" data-slide="1">
                        <div class="topcon-pagination-label-desktop text-[#757575] text-start">
                            <span class="text-[14px] leading-[140%] transition-colors"><span class="font-bold">Dura</span>GlassX™</span>
                            <p class="text-[12px] leading-[120%] text-wrap">Ultra-strong tempered glass with advanced anti-reflective coating</p>
                        </div>
                    </div>
                    <div class="topcon-pagination-item-desktop flex flex-col items-start cursor-pointer flex-1" data-slide="2">
                        <div class="topcon-pagination-label-desktop text-[#757575] text-start">
                            <span class="text-[14px] leading-[140%] transition-colors"><span class="font-bold">Aluforce</span> Black-Frame</span>
                            <p class="text-[12px] leading-[120%] text-wrap">Next-generation cell architecture with enhanced passivation for higher output.</p>
                        </div>
                    </div>
                    <div class="topcon-pagination-item-desktop flex flex-col items-start cursor-pointer flex-1" data-slide="3">
                        <div class="topcon-pagination-label-desktop text-[#757575] text-start">
                            <span class="text-[14px] leading-[140%] transition-colors"><span class="font-bold">30 Years</span> Warranty</span>
                            <p class="text-[12px] leading-[120%] text-wrap">Performance and Product Warranty</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>

<!-- Секция Products -->
<section class="products-section w-full pt-10 md:pt-[100px] pb-10 md:pb-20">
    <div class="max-w-[1030px] mx-auto md:px-4">
        <!-- Заголовок Products -->
        <h2 class="text-white text-[24px] md:text-[32px] font-medium mb-4 md:mb-8 md:text-center pl-5 md:pl-0">Products</h2>
        
        <!-- Swiper продуктов -->
        <div class="swiper products-swiper-home w-full mb-5 md:mb-8">
            <div class="swiper-wrapper">
            
            <?php
            // Запрос последних 12 продуктов
            $products_args = array(
                'post_type' => 'product',
                'posts_per_page' => 12,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $products_query = new WP_Query($products_args);

            if ($products_query->have_posts()):
                while ($products_query->have_posts()): $products_query->the_post();
                    global $product;
                    
                    // ACF поля
                    $model_name = get_field('model_name');
                    $panel_technology = get_field('panel_technology');
                    $power = get_field('power');
                    $efficiency = get_field('efficiency');
                    $rear_side_power = get_field('rear_side_power');
                    $warranty = get_field('warranty');
                    
                    // Получаем характеристики из группы
                    $characteristics = array();
                    $characteristics_group = get_field('characteristics');
                    
                    if ($characteristics_group) {
                        for ($i = 1; $i <= 5; $i++) {
                            $field_name = 'characteristic_' . $i;
                            if (!empty($characteristics_group[$field_name])) {
                                $characteristics[] = $characteristics_group[$field_name];
                            }
                        }
                    }
                    
                    // Получаем категорию для отображения названия
                    $terms = get_the_terms(get_the_ID(), 'product_cat');
                    $primary_category = '';
                    if ($terms && !is_wp_error($terms)) {
                        $primary_category = $terms[0]->name;
                    }
            ?>
            
            <!-- Слайд продукта -->
            <div class="swiper-slide">
                <!-- Карточка продукта -->
                <div class="product-card-home border border-[#757575] relative overflow-hidden">
                    <!-- Фоновое изображение -->
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="absolute right-0 top-0 w-full h-full flex">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/phantom-baner-big.png" alt="baner panel" class=" w-full h-full object-cover" loading="lazy">
                        </a>
                    <?php endif; ?>
                    
                    <!-- Контент -->
                    <div class="relative z-10 p-6 lg:p-10">
                        <!-- Хедер: категория слева, кнопка справа -->
                        <div class="flex items-center justify-between w-full mb-12">
                            <h3 class="text-white text-[16px] lg:text-[20px] font-medium flex items-center gap-1 md:gap-2">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/phantom.svg" alt="PHANTOM" class="h-[10px] md:h-[16px]" loading="lazy"><?php echo !empty($primary_category) ? esc_html($primary_category) : 'PHANTOM'; ?>
                            </h3>
                        </div>

                        <!-- Модель и технология -->
                        <div class="leading-[1.09] mb-12">
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
                                <div class="text-[#EA0029] text-[20px] md:text-[50px] lg:text-[72px] font-bold md:font-extralight leading-none  font-clash">
                                    <p><?php echo esc_html($power); ?>W</p>
                                </div>
                            <?php endif; ?>
                        </div>


                        <div class="space-y-3 mb-[120px] md:mb-[240px]">
                                <div class="flex gap-3 items-center">
                                    <span class="text-[#EA0029] mt-[2px] text-[5px] md:text-[8px]"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-product.svg" alt="" class="w-2" loading="lazy"></span>
                                    <div class="text-white">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single1.svg" alt="Characteristic" class="max-h-[16px] md:max-h-[20px] w-auto" loading="lazy">
                                    </div>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <span class="text-[#EA0029] mt-[2px] text-[5px] md:text-[8px]"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-product.svg" alt="" class="w-2" loading="lazy"></span>
                                    <div class="text-white">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single2.svg" alt="Characteristic" class="max-h-[16px] md:max-h-[20px] w-auto" loading="lazy">
                                    </div>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <span class="text-[#EA0029] mt-[2px] text-[5px] md:text-[8px]"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-product.svg" alt="" class="w-2" loading="lazy"></span>
                                    <div class="text-white">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single3.svg" alt="Characteristic" class="max-h-[16px] md:max-h-[20px] w-auto" loading="lazy">
                                    </div>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <span class="text-[#EA0029] mt-[2px] text-[5px] md:text-[8px]"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-product.svg" alt="" class="w-2" loading="lazy"></span>
                                    <div class="text-white">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single4.svg" alt="Characteristic" class="max-h-[16px] md:max-h-[20px] w-auto" loading="lazy">
                                    </div>
                                </div>
                        </div>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="learn-more-btn border border-white text-white px-4 py-2 rounded-md text-[14px] font-medium inline-flex items-center gap-2 hover:bg-[#EA0029] hover:border-[#EA0029] transition-all">
                        Learn more <span>></span>
                    </a>
                    </div>
                    
                </div>
                
            </div>
            

            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            
            </div>
        </div>
        
        <!-- Навигационные кнопки -->
        <div class="flex flex-col md:flex-row items-center justify-center md:relative gap-4 md:gap-0 px-5 md:px-0">
            <!-- Стрелки навигации -->
            <div class="items-center justify-center bg-[#1B1B1B] rounded-[8px] hidden md:flex">
                <button class="products-swiper-prev text-white hover:text-[#EA0029] transition-colors p-3" aria-label="Previous">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <span class="block h-[25px] w-px bg-[#757575]"></span>
                <button class="products-swiper-next text-white hover:text-[#EA0029] transition-colors p-3" aria-label="Next">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            
            <!-- Кнопка All products -->
            <a href="<?php echo home_url('/shop/'); ?>" class="md:absolute md:top-0 md:right-0 bg-[#1B1B1B] text-white px-8 py-[10px] rounded-md text-[14px] font-medium hover:bg-[#EA0029] transition-colors w-auto text-center" style="box-shadow: inset 0px 1px 1px rgba(255, 255, 255, 0.2);">
                All products
            </a>
        </div>
    </div>
</section>

<!-- Секция Exclusive Packaging -->
<section class="exclusive-packaging-section w-full pb-16 md:pb-20 relative overflow-hidden">
    <!-- Фоновое изображение -->
    <div class="absolute inset-0 z-0">
        <img src="<?php echo get_template_directory_uri(); ?>/img/home_bg_sect-4.png" alt="Background" class="w-full h-full object-cover" loading="lazy">
    </div>
    <div class="absolute top-0 left-0 w-screen h-[124px] z-10" style="background: linear-gradient(to bottom, #000000 0%, rgba(0, 0, 0, 0) 100%);">

    </div>
    <div class="absolute bottom-0 left-0 w-screen h-[124px] z-10" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, #000000  100%);">

    </div>
    
    <div class="container relative z-10">
        <div class="flex flex-col lg:flex-row items-center justify-between lg:px-10">
            <!-- Левая часть - Текст -->
            <div class="w-full lg:w-[40%] lg:max-w-[380px] text-center lg:text-left mb-10 md:mb-0 flex flex-col items-center lg:items-start">
                <h2 class="text-white text-[28px] md:text-[32px] font-medium mb-4 md:mb-6 leading-[1.1] tracking-tight">
                    Exclusive Packaging
                </h2>
                <p class="text-[#757575] text-[18px] leading-[135%] max-w-[312px] md:max-w-[390px]">
                    Exclusive packaging created by our designers and engineers for the safe and reliable delivery of solar modules. 
                </p>
            </div>
            
            <!-- Правая часть - Изображение -->
            <div class="w-full lg:w-[60%] flex justify-center lg:justify-end">
                <div class="relative w-full ">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_pht.png" alt="Exclusive Packaging" class="w-full h-auto drop-shadow-2xl" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Секция Our Projects -->
<section class="our-projects-section w-full py-10 md:py-16 lg:py-20">
    <div class="container">
        <!-- Заголовок -->
        <h2 class="text-white text-[24px] md:text-[32px] font-medium mb-8 md:mb-12 text-center">Our Projects</h2>
        
        <?php
        // Получаем последние 8 референсов для мобильных
        $references_args = array(
            'post_type' => 'references',
            'posts_per_page' => 8,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $references_query = new WP_Query($references_args);

        if ($references_query->have_posts()):
            $references = array();
            while ($references_query->have_posts()): $references_query->the_post();
                $references[] = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'description' => get_the_excerpt() ?: get_the_content(),
                    'image' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
                    'link' => get_permalink(),
                    'megawatts' => get_field('megawatts'),
                    'acf' => get_field('acf'),
                    'city_ref' => get_field('city_ref')
                );
            endwhile;
            wp_reset_postdata();
            
            if (!empty($references)):
        ?>
        
        <!-- Swiper для мобильных (до 1024px) - все 8 референсов -->
        <div class="projects-swiper-mobile lg:hidden mb-8 md:mb-12 max-w-[1230px] mx-auto">
            <div class="swiper projects-swiper-refs">
                <div class="swiper-wrapper">
                    <?php foreach ($references as $ref): ?>
                    <div class="swiper-slide">
                        <div class="project-card relative overflow-hidden rounded-[7px] group cursor-pointer block">
                            <div class="relative h-[300px] md:h-[400px]">
                                <?php if ($ref['image']): ?>
                                    <img src="<?php echo esc_url($ref['image']); ?>" alt="<?php echo esc_attr($ref['title']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                <?php else: ?>
                                    <div class="w-full h-full bg-gray-800"></div>
                                <?php endif; ?>
                                <!-- Градиентный оверлей -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                                
                                <!-- Контент карточки -->
                                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 flex justify-between w-full items-end flex-wrap">
                                    <div>
                                        <h3 class="text-white text-[16px] md:text-[18px]">
                                            <?php echo esc_html($ref['title']); ?>
                                        </h3>
                                    </div>
                                    <!-- Локация и мощность -->
                                    <div class="flex items-end">
                                        <?php if ($ref['city_ref']): ?>
                                            <div class="flex flex-col items-center gap-2 pr-3 md:pr-6">
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/geolocate-icon.svg" alt="Location" class="w-4 h-4 md:w-7 md:h-10" loading="lazy">
                                                <span class="text-white text-[14px] md:text-[18px]"><?php echo esc_html($ref['city_ref']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($ref['megawatts']): ?>
                                            <div class="text-white text-[32px] md:text-[62px] pl-3 md:pl-6 border-l border-[#757575] text-nowrap">
                                                <span class="text-[48px] md:text-[72px]"> <?php echo esc_html($ref['megawatts']); ?></span> mw
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Сетка проектов для десктопа (1024px+) -->
        <div class="projects-grid hidden lg:grid grid-cols-2 gap-3 md:gap-4 max-w-[1230px] mx-auto mb-8 md:mb-12">
            
            <?php if (isset($references[0])): ?>
            <!-- Большая карточка проекта (первый референс) -->
            <div class="project-card col-span-2 relative overflow-hidden rounded-[7px] group cursor-pointer block">
                <div class="relative h-[300px] md:h-[400px] lg:h-[500px]">
                    <?php if ($references[0]['image']): ?>
                        <img src="<?php echo esc_url($references[0]['image']); ?>" alt="<?php echo esc_attr($references[0]['title']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-800"></div>
                    <?php endif; ?>
                    <!-- Градиентный оверлей -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent bottom-0"></div>
                    
                    <!-- Контент карточки -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 lg:px-10 lg:py-6 flex justify-between w-full">
                        <div>
                            <h3 class="text-white text-[20px] md:text-[32px] font-medium mb-3 md:mb-4">
                                <?php echo esc_html($references[0]['title']); ?>
                            </h3>
                            <?php if ($references[0]['description']): ?>
                                <p class="text-[#757575] text-[14px] md:text-[14px] leading-[140%] max-w-[532px]">
                                    <?php echo esc_html($references[0]['description']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <!-- Локация и мощность -->
                        <div class="flex items-end">
                            <?php if ($references[0]['city_ref']): ?>
                                <div class="flex flex-col items-center gap-2 pr-3 md:pr-6">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/geolocate-icon.svg" alt="Location" class="w-4 h-4 md:w-7 md:h-10" loading="lazy">
                                    <span class="text-white text-[14px] md:text-[18px]"><?php echo esc_html($references[0]['city_ref']); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($references[0]['megawatts']): ?>
                                <div class="text-white text-[32px] md:text-[62px] pl-3 md:pl-6 border-l border-[#757575] text-nowrap">
                                    <span class="text-[48px] md:text-[72px]"> <?php echo esc_html($references[0]['megawatts']); ?></span> mw
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (isset($references[1])): ?>
            <!-- Левая маленькая карточка (второй референс) -->
            <div class="project-card relative overflow-hidden rounded-[7px] group cursor-pointer block">
                <div class="relative h-[300px] md:h-[400px]">
                    <?php if ($references[1]['image']): ?>
                        <img src="<?php echo esc_url($references[1]['image']); ?>" alt="<?php echo esc_attr($references[1]['title']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-800"></div>
                    <?php endif; ?>
                    <!-- Градиентный оверлей -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                    
                    <!-- Контент карточки -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 flex justify-between w-full">
                        <div>
                            <h3 class="text-white text-[18px] md:text-[20px] font-medium mb-3 md:mb-4">
                                <?php echo esc_html($references[1]['title']); ?>
                            </h3>
                            <?php if ($references[1]['description']): ?>
                                <p class="text-[#757575] text-[14px] md:text-[14px] leading-[140%] max-w-[285px]">
                                    <?php echo esc_html($references[1]['description']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <!-- Локация и мощность -->
                        <div class="flex items-end">
                            <?php if ($references[1]['city_ref']): ?>
                                <div class="flex flex-col items-center gap-2 pr-3 md:pr-6">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/geolocate-icon.svg" alt="Location" class="w-4 h-4 md:w-7 md:h-10" loading="lazy">
                                    <span class="text-white text-[14px] md:text-[18px]"><?php echo esc_html($references[1]['city_ref']); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($references[1]['megawatts']): ?>
                                <div class="text-white text-[32px] md:text-[62px] pl-3 md:pl-6 border-l border-[#757575] text-nowrap">
                                    <span class="text-[48px] md:text-[72px]"> <?php echo esc_html($references[1]['megawatts']); ?></span> mw
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (isset($references[2])): ?>
            <!-- Правая маленькая карточка (третий референс) -->
            <div class="project-card relative overflow-hidden rounded-[7px] group cursor-pointer block">
                <div class="relative h-[300px] md:h-[400px]">
                    <?php if ($references[2]['image']): ?>
                        <img src="<?php echo esc_url($references[2]['image']); ?>" alt="<?php echo esc_attr($references[2]['title']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-800"></div>
                    <?php endif; ?>
                    <!-- Градиентный оверлей -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                    
                    <!-- Контент карточки -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 flex justify-between w-full">
                        <div>
                            <h3 class="text-white text-[18px] md:text-[20px] font-medium mb-3 md:mb-4">
                                <?php echo esc_html($references[2]['title']); ?>
                            </h3>
                            <?php if ($references[2]['description']): ?>
                                <p class="text-[#757575] text-[14px] md:text-[14px] leading-[140%] max-w-[285px]">
                                    <?php echo esc_html($references[2]['description']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <!-- Локация и мощность -->
                        <div class="flex items-end">
                            <?php if ($references[2]['city_ref']): ?>
                                <div class="flex flex-col items-center gap-2 pr-3 md:pr-6">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/geolocate-icon.svg" alt="Location" class="w-4 h-4 md:w-7 md:h-10" loading="lazy">
                                    <span class="text-white text-[14px] md:text-[18px]"><?php echo esc_html($references[2]['city_ref']); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($references[2]['megawatts']): ?>
                                <div class="text-white text-[32px] md:text-[62px] pl-3 md:pl-6 border-l border-[#757575] text-nowrap">
                                    <span class="text-[48px] md:text-[72px]"> <?php echo esc_html($references[2]['megawatts']); ?></span> mw
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <?php
            endif;
        else:
        ?>
        <div class="text-center py-20">
            <p class="text-white text-lg">No references found.</p>
        </div>
        <?php endif; ?>
        
        
    </div>
    <!-- Кнопка More projects -->
    <div class="flex justify-center">
            <a href="<?php echo get_post_type_archive_link('references'); ?>" class="learn-more-btn border border-white text-white px-8 py-2 rounded-md text-[14px] font-medium inline-flex items-center gap-2 hover:bg-[#EA0029] hover:border-[#EA0029] transition-all">
                More projects
            </a>
        </div>
</section>

<!-- Секция FAQ -->
<section class="faq-section w-full py-12 md:pt-20 md:pb-[190px]">
    <div class="max-w-[1000px] px-4 mx-auto">
        <!-- Заголовок -->
        <h2 class="text-white text-[24px] md:text-[32px] font-medium mb-5">
            FAQs
        </h2>
        
        <!-- Сетка вопросов -->
        <div class="faq-grid grid grid-cols-1 md:grid-cols-2 md:gap-12">
            <div>
            <!-- FAQ Item 1 -->
            <div class="faq-item border-t border-[#757575] py-4">
                <button class="faq-question w-full flex items-center gap-3 md:gap-4 text-left cursor-pointer">
                    <!-- Иконка стрелки -->
                    <div class="flex-shrink-0 faq-arrow">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/faq_arrow.svg" alt="Arrow" class="w-4 h-4 md:w-5 md:h-5 transition-transform duration-300" loading="lazy">
                    </div>
                    <!-- Вопрос -->
                    <div class="flex-1">
                        <p class="text-white text-[16px] md:text-[18px] font-geist">
                            How long do solar panels realy last?
                        </p>
                    </div>
                </button>
                <div class="faq-answer hidden mt-4 pl-7 md:pl-9">
                    <p class="text-[#757575] text-[14px] md:text-[16px] leading-[150%]">
                        Solar panels typically last 25-30 years, with most manufacturers offering warranties for this period. However, they can continue to produce electricity beyond this timeframe, though at reduced efficiency.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 2 -->
            <div class="faq-item border-t border-[#757575] py-4">
                <button class="faq-question w-full flex items-center gap-3 md:gap-4 text-left cursor-pointer">
                    <div class="flex-shrink-0 faq-arrow">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/faq_arrow.svg" alt="Arrow" class="w-4 h-4 md:w-5 md:h-5 transition-transform duration-300" loading="lazy">
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-[16px] md:text-[18px] font-geist">
                            How long do solar panels realy last?
                        </p>
                    </div>
                </button>
                <div class="faq-answer hidden mt-4 pl-7 md:pl-9">
                    <p class="text-[#757575] text-[14px] md:text-[16px] leading-[150%]">
                        Solar panels typically last 25-30 years, with most manufacturers offering warranties for this period. However, they can continue to produce electricity beyond this timeframe, though at reduced efficiency.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 3 -->
            <div class="faq-item border-t border-[#757575] py-4">
                <button class="faq-question w-full flex items-center gap-3 md:gap-4 text-left cursor-pointer">
                    <div class="flex-shrink-0 faq-arrow">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/faq_arrow.svg" alt="Arrow" class="w-4 h-4 md:w-5 md:h-5 transition-transform duration-300" loading="lazy">
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-[16px] md:text-[18px] font-geist">
                            How long do solar panels realy last?
                        </p>
                    </div>
                </button>
                <div class="faq-answer hidden mt-4 pl-7 md:pl-9">
                    <p class="text-[#757575] text-[14px] md:text-[16px] leading-[150%]">
                        Solar panels typically last 25-30 years, with most manufacturers offering warranties for this period. However, they can continue to produce electricity beyond this timeframe, though at reduced efficiency.
                    </p>
                </div>
            </div>
            </div>
            <div>
            <!-- FAQ Item 4 -->
            <div class="faq-item border-t border-[#757575] py-4">
                <button class="faq-question w-full flex items-center gap-3 md:gap-4 text-left cursor-pointer">
                    <div class="flex-shrink-0 faq-arrow">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/faq_arrow.svg" alt="Arrow" class="w-4 h-4 md:w-5 md:h-5 transition-transform duration-300" loading="lazy">
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-[16px] md:text-[18px] font-geist">
                            How long do solar panels realy last?
                        </p>
                    </div>
                </button>
                <div class="faq-answer hidden mt-4 pl-7 md:pl-9">
                    <p class="text-[#757575] text-[14px] md:text-[16px] leading-[150%]">
                        Solar panels typically last 25-30 years, with most manufacturers offering warranties for this period. However, they can continue to produce electricity beyond this timeframe, though at reduced efficiency.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 5 -->
            <div class="faq-item border-t border-[#757575] py-4">
                <button class="faq-question w-full flex items-center gap-3 md:gap-4 text-left cursor-pointer">
                    <div class="flex-shrink-0 faq-arrow">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/faq_arrow.svg" alt="Arrow" class="w-4 h-4 md:w-5 md:h-5 transition-transform duration-300" loading="lazy">
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-[16px] md:text-[18px] font-geist">
                            How long do solar panels realy last?
                        </p>
                    </div>
                </button>
                <div class="faq-answer hidden mt-4 pl-7 md:pl-9">
                    <p class="text-[#757575] text-[14px] md:text-[16px] leading-[150%]">
                        Solar panels typically last 25-30 years, with most manufacturers offering warranties for this period. However, they can continue to produce electricity beyond this timeframe, though at reduced efficiency.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 6 -->
            <div class="faq-item border-t border-[#757575] py-4">
                <button class="faq-question w-full flex items-center gap-3 md:gap-4 text-left cursor-pointer">
                    <div class="flex-shrink-0 faq-arrow">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/faq_arrow.svg" alt="Arrow" class="w-4 h-4 md:w-5 md:h-5 transition-transform duration-300" loading="lazy">
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-[16px] md:text-[18px] font-geist">
                            How long do solar panels realy last?
                        </p>
                    </div>
                </button>
                <div class="faq-answer hidden mt-4 pl-7 md:pl-9">
                    <p class="text-[#757575] text-[14px] md:text-[16px] leading-[150%]">
                        Solar panels typically last 25-30 years, with most manufacturers offering warranties for this period. However, they can continue to produce electricity beyond this timeframe, though at reduced efficiency.
                    </p>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="relative flex justify-center items-center px-4 lg:px-0">
        <div class="absolute top-0 right-0 w-full h-full z-[-9999]"><img src="<?php echo get_template_directory_uri(); ?>/img/footer-bg.png" alt="" class="w-full h-full object-cover" loading="lazy"></div>
        <div class="max-w-[1060px] mx-auto border border-white bg-[#D9D9D90D]/5 backdrop-blur-[15px] rounded-[7px] mb-12 md:mb-[192px] mt-12 md:mt-[96px] w-full">
            
            <!-- Мобильная версия (до 768px) -->
            <div class="lg:hidden flex flex-col">
                <!-- Get Help Buying? -->
                <div class="flex flex-col items-center justify-center py-8 px-4 border-b border-white">
                    <h3 class="text-[20px] font-medium text-white mb-4">Get Help Buying?</h3>
                    <a href="<?php echo home_url('/contacts/'); ?>" class="text-[14px] bg-[#EA0029] text-white px-8 py-2 transition ease duration-300 rounded-[7px] hover:opacity-90 w-full text-center">
                        Contact us
                    </a>
                </div>
                
                <!-- Download product catalog -->
                <div class="flex flex-col items-center justify-center py-8 px-4 border-b border-white">
                    <a href="/files/my-file.pdf" target="_blank" class="flex flex-col items-center gap-3 w-full">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/pdf-file.svg" alt="download-icon" class="w-8 h-8" loading="lazy">
                        <div class="text-center">
                            <span class="text-white text-[16px] leading-[135%] block">Download product catalog</span>
                            <span class="text-[#B3B3B3] text-[14px] leading-[135%]">PDF 8.25 MB</span>
                        </div>
                    </a>
                </div>
                
                <!-- Join our Newsletter -->
                <div class="py-8 px-4">
                    <div class="mb-6">
                        <h4 class="text-[20px] font-medium text-white leading-[1.09] mb-2">
                            Join our Newsletter.
                        </h4>
                        <p class="text-[#757575] text-[14px] leading-[140%]">
                            Stay tuned on the latest products and special offers
                        </p>
                    </div>
                    <form>
                        <div class="flex justify-center items-center relative mb-4">
                            <input type="email" placeholder="Email Address" class="text-white w-full ring-1 pl-5 ring-white focus:ring-0 bg-transparent py-3 placeholder:text-[#757575] border border-white rounded-full pr-24">
                            <button class="rounded-full border-white border absolute right-0 top-0 bg-transparent h-full text-white px-6 text-[14px] transition duration-300 ease hover:bg-[#EA0029] hover:border-[#EA0029]">Subscribe</button>
                        </div>
                        <div class="flex items-start gap-3">
                            <input id="newsletter-checkbox" type="checkbox" class="custom-checkbox">
                            <label for="newsletter-checkbox" class="text-[#757575] text-[10px] cursor-pointer">I agree to receive marketing emails with news, offers, and updates from SWISS SOLAR. View our <a href="<?php echo home_url('/privacy-policy/'); ?>" class="underline hover:text-white">Privacy Policy</a></label>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Десктопная версия (768px+) -->
            <div class="hidden lg:block">
                <div class="flex items-center justify-between border-b border-white">
                    <a href="/files/my-file.pdf" target="_blank" class="flex items-center justify-between gap-3 py-8 px-[55px] border-r border-white">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/pdf-file.svg" alt="downoload-icon" loading="lazy">
                        <div>
                            <span class="text-white text-[16px] md:text-[18px] leading-[135%] text-nowrap">Download product catalog</span>
                            <span class="text-[#B3B3B3] text-[14px] leading-[135%]">PDF 8.25 MB</span>
                        </div>
                    </a>
                    <div class="w-full flex items-center justify-end gap-[55px] pr-16">
                        <h3 class="text-[20px] md:text-[32px] font-medium text-white">Get Help Buying?</h3>
                        <a href="<?php echo home_url('/contacts/'); ?>" class="text-[14px] bg-[#EA0029] text-white px-8 py-2 transition ease duration-300 rounded-[7px] hover:opacity-90">Contact us</a>
                    </div>
                </div>
                <div class="pt-[65px] pb-6 flex items-start justify-between px-16">
                    <div>
                        <h4 class="text-[20px] md:text-[32px] font-medium text-white leading-[1.09] mb-1">
                            Join our Newsletter.
                        </h4>
                        <p class="text-[#757575] text-[14px] leading-[140%]">
                            Stay tuned on the latest products and special offers
                        </p>
                    </div>
                    <form>
                        <div class="flex justify-center items-center relative ">
                            <input type="email" placeholder="Email Address" class="text-white w-full md:w-[433px] ring-1 pl-5 ring-white focus:ring-0 bg-transparent py-3 placeholder:text-[#757575] border border-white rounded-full pr-24">
                            <button class="rounded-full border-white border absolute right-0 top-0 bg-transparent h-full text-white px-8 text-[14px] transition duration-300 ease hover:bg-white hover:text-black">Subscribe</button>
                        </div>
                        <div class="flex items-start pl-5 pt-4 gap-3">
                            <input id="newsletter-checkbox-desktop" type="checkbox" class="custom-checkbox">
                            <label for="newsletter-checkbox-desktop" class="text-[#757575] text-[10px] max-w-[260px] cursor-pointer">I agree to receive marketing emails with news, offers, and updates from SWISS SOLAR. View our <a href="<?php echo home_url('/privacy-policy/'); ?>" class="underline hover:text-white">Privacy Policy</a></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</section>



<?php
get_footer(); ?>

