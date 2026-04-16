<?php
/**
 * Шаблон для отображения отдельного продукта
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();

// Получаем категорию продукта
$product_category = '';
$product_category_words = array();
$terms = get_the_terms(get_the_ID(), 'product_cat');
if ($terms && !is_wp_error($terms) && !empty($terms)) {
    $product_category = $terms[0]->name;
    // Разбиваем на слова
    $product_category_words = explode(' ', $product_category);
}
// Если категория не найдена, используем дефолтное значение
if (empty($product_category)) {
    $product_category = 'PHANTOM';
    $product_category_words = array('PHANTOM');
}

// Получаем ACF поля продукта
$model_name = get_field('model_name');
$panel_technology = get_field('panel_technology');
$power = get_field('power');
$efficiency = get_field('efficiency');
$power_classes = get_field('power_classes') ?: '500, 505, 510, 515 Wp';
$size = get_field('size') ?: '1961 x 1134 x 30 mm';
$weight = get_field('weight') ?: '27,5 kg';
$warranty = get_field('warranty') ?: '30 Years Performance & Power warranty';
$product_technologies = get_field('product_technologies') ?: array();

// Получаем файл datasheet из ACF поля file-product или URL
$datasheet_file = get_field('file-product');
$datasheet_url_field = get_field('datasheet_url');
$datasheet_url = '';
$is_external_datasheet = false;

// Приоритет: сначала проверяем загруженный файл, затем URL
if ($datasheet_file) {
    if (is_array($datasheet_file)) {
        $datasheet_url = isset($datasheet_file['url']) ? $datasheet_file['url'] : (isset($datasheet_file['ID']) ? wp_get_attachment_url($datasheet_file['ID']) : '');
    } elseif (is_numeric($datasheet_file)) {
        $datasheet_url = wp_get_attachment_url($datasheet_file);
    } else {
        $datasheet_url = $datasheet_file;
    }
} elseif ($datasheet_url_field) {
    // Если используется поле URL
    $datasheet_url = esc_url_raw($datasheet_url_field);
    // Проверяем, является ли URL внешним
    $site_url = home_url();
    $parsed_site = parse_url($site_url);
    $parsed_datasheet = parse_url($datasheet_url);
    $is_external_datasheet = ($parsed_site && $parsed_datasheet && 
                              (isset($parsed_site['host']) && isset($parsed_datasheet['host']) && 
                               $parsed_site['host'] !== $parsed_datasheet['host']));
}
?>

<section class="single-product-section w-full relative">
<div class="absolute bottom-0 left-0 w-screen h-[124px] z-10 hidden lg:block" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, #000000  100%);">

</div>
    <!-- Фоновое изображение -->
    <div class="absolute inset-0 z-0 top-0 left-0 single-product-bg hidden lg:block">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/single-product-bg.jpg'); ?>" 
             alt="Background" 
             class="w-full h-full object-cover">
    </div>

    <div class="relative z-10 max-w-[1360px] mx-auto px-4 lg:px-[116px] py-6 md:py-10 lg:py-16">
        <!-- Основной контент: две колонки -->
        <div class="flex flex-col lg:flex-row gap-6 md:gap-8 lg:gap-12 items-start justify-between">
            
            <!-- Левая колонка: Текстовая информация -->
            <div class="font-clash w-full lg:w-auto order-3 lg:order-none">
                <!-- Название продукта -->
                <h1 class="text-[#626161] text-[24px] md:text-[28px] lg:text-[40px] font-medium leading-[1.1] mb-4 md:mb-8 lg:mb-20 font-clash flex items-center gap-1 md:gap-2">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/phantom.svg" alt="PHANTOM" class="h-[15px] md:h-[27px] phantom-icon"><?php echo !empty($product_category) ? esc_html($product_category) : 'PHANTOM'; ?>
                </h1>

                <!-- Основные характеристики -->
                <div class="md:mb-12 lg:mb-[90px] font-clash leading-[1.09]">
                    <?php if ($model_name): ?>
                        <div class="text-[#EA0029] text-[18px] md:text-[20px] lg:text-[24px] font-semibold font-clash"><?php echo esc_html($model_name); ?></div>
                    <?php else: ?>
                        <div class="text-[#EA0029] text-[18px] md:text-[20px] lg:text-[24px] font-semibold font-clash">54-TCA</div>
                    <?php endif; ?>
                    
                    <?php if ($panel_technology): ?>
                        <?php 
                        $panel_tech = esc_html($panel_technology);
                        $length = mb_strlen($panel_tech);
                        if ($length > 5) {
                            $start = mb_substr($panel_tech, 0, $length - 5);
                            $end = mb_substr($panel_tech, -5);
                        } else {
                            $start = '';
                            $end = $panel_tech;
                        }
                        ?>
                        <div class="text-white text-[20px] md:text-[24px] lg:text-[28px] font-medium font-clash uppercase max-w-[200px] md:max-w-full"><?php echo $start; ?><span class="font-light"><?php echo $end; ?></span></div>
                    <?php else: ?>
                        <?php 
                        $panel_tech = 'BIFACIAL DOUBLEGLASS';
                        $length = mb_strlen($panel_tech);
                        if ($length > 5) {
                            $start = mb_substr($panel_tech, 0, $length - 5);
                            $end = mb_substr($panel_tech, -5);
                        } else {
                            $start = '';
                            $end = $panel_tech;
                        }
                        ?>
                        <div class="text-white text-[20px] md:text-[24px] lg:text-[28px] font-medium font-clash uppercase max-w-[200px] md:max-w-full"><?php echo $start; ?><span class="font-light"><?php echo $end; ?></span></div>
                    <?php endif; ?>
                    
                    <!-- Мощность и эффективность -->
                    <div class="flex flex-col md:flex-row items-start gap-3 md:gap-0 mb-6 md:mb-8 w-full md:w-auto">
                        <?php if ($power): ?>
                            <div class="text-[#EA0029] text-[32px] md:text-[40px] lg:text-[64px] leading-none font-light  w-full md:w-auto md:pr-5 md:mr-3 pb-3 md:pb-0 border-b md:border-b-[0px] md:border-r border-[#757575]"><?php echo esc_html($power); ?>W</div>
                        <?php else: ?>
                            <div class="text-[#EA0029] text-[32px] md:text-[40px] lg:text-[64px] leading-none font-light w-full md:w-auto md:pr-5 md:mr-3 pb-3 md:pb-0 border-b md:border-b-[0px] md:border-r border-[#757575]">540W</div>
                        <?php endif; ?>
                        
                        <div class="text-white gap-1 text-[14px] md:text-[16px] lg:text-[20px] font-medium flex md:block flex-col md:flex-row w-full md:w-auto">
                            <span>up to</span> 
                            <?php if ($efficiency): ?>
                                <span class="text-[#EA0029] text-[32px] md:text-[40px] lg:text-[64px] font-light w-full md:w-auto border-b pb-3 md:pb-0 md:border-none border-[#757575]"><?php echo esc_html($efficiency); ?></span>
                            <?php else: ?>
                                <span class="text-[#EA0029] text-[32px] md:text-[40px] lg:text-[64px] font-light w-full md:w-auto border-b pb-3 md:pb-0 md:border-none border-[#757575]">25.90%</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
               
            </div>

            <!-- Правая колонка: Изображение панели -->
            <div class="flex-1 relative w-full lg:w-auto order-1 lg:order-none">
                <!-- Фоновое изображение для мобильных -->
                <div class="absolute inset-0 z-0 top-0 left-[-16px] single-product-bg lg:hidden block -mx-4 md:-mx-8 lg:mx-0">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/single-product-bg.jpg'); ?>" 
                         alt="Background" 
                         class="w-full h-full object-cover">
                </div>
                <div class="absolute bottom-0 left-[-16px] w-screen h-[124px] z-[100] lg:hidden block" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, #000000  100%);">

</div>
                
                <!-- Кнопка Datasheet -->
                <div class="absolute top-0 right-5 lg:right-0 z-20">


                    <a href="<?php echo esc_url($datasheet_url); ?>" 
                       target="_blank" 
                       <?php if ($is_external_datasheet): ?>rel="noopener noreferrer"<?php endif; ?>
                       class="bg-[#1B1B1B] text-white px-4 md:px-8 py-[8px] md:py-[10px] gap-1 rounded-md text-[12px] md:text-[14px] font-medium hover:bg-[#EA0029] hidden lg:flex items-center transition-colors w-auto text-center" style="box-shadow: inset 0px 1px 1px rgba(255, 255, 255, 0.2);">
                        <span class="text-[12px] md:text-[14px] pr-1">Datasheet</span>
                        <svg width="10" height="13" viewBox="0 0 10 13" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white group-hover:text-[#EA0029] transition-colors">
<path d="M4.59961 11.8V0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.7 7.7002L4.6 11.8002L0.5 7.7002" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1.09961 11.7998H8.09961" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    </a>
                    <!-- Гарантия -->
                    <div class="lg:hidden block">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/product-warranty.svg'); ?>" alt="Warranty" class="w-[70px] md:w-[93px] h-auto object-contain">
                    </div>
                </div>
                
                <!-- Швейцарский бейдж -->
                <div class="lg:hidden flex absolute top-0 left-5 z-20 flex-col items-center gap-2">
                    <div class="flex items-center justify-center">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/plus-single.svg'); ?>" alt="Swiss Cross" class="w-[40px] md:w-[53px] h-5 md:h-6">
                    </div>
                </div>

                <!-- Изображение панели -->
                <div class="relative mr-0 md:mr-10 z-10">
                    <?php if (has_post_thumbnail()): ?>
                        <?php 
                        $thumbnail_id = get_post_thumbnail_id();
                        $image_url = wp_get_attachment_image_url($thumbnail_id, 'large');
                        $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) ?: get_the_title();
                        ?>
                        <img src="<?php echo esc_url($image_url); ?>" 
                             alt="<?php echo esc_attr($image_alt); ?>" 
                             class="w-full h-auto object-contain max-h-[378px] lg:max-h-[543px]">
                    <?php else: ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/panel-single.png'); ?>" 
                             alt="PHANTOM Black Solar Panel" 
                             class="w-full h-auto object-contain max-h-[378px] lg:max-h-[543px]">
                    <?php endif; ?>
                </div>
                
                
            </div>
            <!-- Блок с иконками характеристик -->
        <div class=" items-center justify-center gap-4 relative z-10 lg:hidden flex order-2 lg:order-none w-full">
                    <!-- Efficiency -->
                    <div class="flex items-center gap-1">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-1-single.svg'); ?>" alt="Efficiency" class="w-4 h-4">
                        <span class="text-white text-[16px] whitespace-nowrap">Efficiency</span>
                    </div>
                    
                    <!-- Durability -->
                    <div class="flex items-center gap-1">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-2-single.svg'); ?>" alt="Durability" class="w-4 h-4">
                        <span class="text-white text-[16px] whitespace-nowrap">Durability</span>
                    </div>
                    
                    <!-- Reliability -->
                    <div class="flex items-center gap-1">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-3-single.svg'); ?>" alt="Reliability" class="w-4  h-4">
                        <span class="text-white text-[16px] whitespace-nowrap">Reliability</span>
                    </div>
                </div>
        </div>
        <div class="flex flex-col items-start">
            <!-- Гарантия -->
            <div class="mb-8 md:mb-12 lg:mb-0">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/product-warranty.svg'); ?>" alt="Warranty" class="hidden lg:block w-[70px] md:w-[93px] h-auto object-contain">
            </div>

        
        <!-- Горизонтальный баннер с характеристиками -->
        <div class="horizontal-banner flex flex-col md:flex-row items-stretch md:items-center justify-center  lg:justify-between font-boxed text-centers relative z-10 md:mt-8 lg:bottom-[-50px] gap-4 md:gap-0">
            <div class="flex flex-col md:flex-row items-stretch gap-4 md:gap-0">
                <!-- Блок сертификации -->
                <div class="flex flex-col gap-0 flex-shrink-0">
                    <div class="bg-[#EA0029] text-white px-4 py-1 md:py-2 text-[18px] font-medium text-center justify-center whitespace-nowrap">
                        IMPROVED LOAD
                    </div>
                    <div class="bg-[#2FAC66] text-white px-4 py-1 md:py-2 text-[18px] font-medium text-center flex items-center justify-center gap-2 whitespace-nowrap">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/check-mark.svg'); ?>" alt="Certified" class="w-3 h-3 md:w-4 md:h-4 flex-shrink-0">
                        CERTIFIED
                    </div>
                </div>

                <!-- Блок с рейтингами нагрузки -->
                <div class="md:bg-[#2A2A2A] px-4 md:px-7  flex items-center gap-4 md:gap-6 font-medium flex-shrink-0 justify-center">
                    <div class="flex items-center">
                        <div class="flex items-end gap-2">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/lvl-up.svg'); ?>" alt="Up" class="mb-[5px] w-3 h-3 md:w-4 md:h-4">
                            <div class="flex flex-col items-center leading-[24px] md:leading-[30px]">
                                <span class="text-[#9D9D9C] text-[12px] md:text-[14px]">pressure</span>
                                <span class="text-white text-[20px] md:text-[24px] lg:text-[32px]">6200</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center pl-2 md:pl-4">
                        <div class="flex items-end gap-2">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/lvl-up.svg'); ?>" alt="Up" class="mb-[5px] w-3 h-3 md:w-4 md:h-4">
                            <div class="flex flex-col items-center leading-[24px] md:leading-[30px]">
                                <span class="text-[#9D9D9C] text-[12px] md:text-[14px]">tensile</span>
                                <span class="text-white text-[20px] md:text-[24px] lg:text-[32px]">4200</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Технические характеристики - Мобильная версия (панель с фоном) -->
            <div class="md:hidden bg-[#4A5C47] rounded-lg px-6 py-10 font-medium w-full">
                <!-- Заголовок N-TYPE CELL -->
                <div class="text-center mb-4">
                    <div class="text-white text-[24px] font-bold mb-px">N-TYPE CELL</div>
                    <div class="text-[#9D9D9C] text-[14px]">lower operating temperature</div>
                </div>
                
                <!-- Разделительная линия -->
                <div class="h-px bg-white/15 w-full px-4 mb-6"></div>
                
                <!-- Три колонки метрик -->
                <div class="flex w-full justify-center">
                    <!-- Power Tolerance -->
                    <div class="flex flex-col items-center font-medium text-center  px-2 sm:px-5 border-white/15 border-r">
                        <span class="text-white text-[24px] mb-px">0~+5W</span>
                        <span class="text-[#9D9D9C] text-[14px]">power <br> tolerance</span>
                    </div>
                    
                    <!-- First Year Degradation -->
                    <div class="flex flex-col items-center font-medium text-center  px-2 sm:px-5 border-white/15 border-r">
                        <span class="text-white text-[24px] mb-px">&lt;1%</span>
                        <span class="text-[#9D9D9C] text-[14px]">first year <br> power degradation</span>
                    </div>
                    
                    <!-- Year 2-30 Degradation -->
                    <div class="flex flex-col items-center font-medium text-center px-2 sm:px-5">
                        <span class="text-white text-[24px] mb-px">0~+5W</span>
                        <span class="text-[#9D9D9C] text-[14px]">year 2-30 <br> power degradation</span>
                    </div>
                </div>
            </div>

            <!-- Технические характеристики - Десктопная версия (горизонтальная) -->
            <div class="hidden md:flex flex-nowrap items-center justify-start font-medium gap-0">
                <!-- Power Tolerance -->
                <div class="flex items-center ml-8">
                    <div class="flex flex-col items-center max-w-[96px] mx-8">
                        <span class="text-white text-center text-[24px] whitespace-nowrap">0~+5W</span>
                        <span class="text-center text-[#9D9D9C] text-[12px] leading-tight">power tolerance</span>
                    </div>
                    <div class="h-[76px] w-px bg-[#757575]"></div>
                </div>

                <!-- First Year Degradation -->
                <div class="flex items-center">
                    <div class="flex flex-col items-center max-w-[160px] mx-4">
                        <span class="text-white text-center text-[24px] whitespace-nowrap">&lt;1%</span>
                        <span class="text-center text-[#9D9D9C] text-[12px] leading-tight">first year power degradation</span>
                    </div>
                    <div class="h-[76px] w-px bg-[#757575]"></div>
                </div>

                <!-- Year 2-30 Degradation -->
                <div class="flex items-center">
                    <div class="flex flex-col items-center max-w-[160px] mx-4">
                        <span class="text-white text-center text-[24px] whitespace-nowrap">0~+5W</span>
                        <span class="text-center text-[#9D9D9C] text-[12px] leading-tight">year 2-30 power degradation</span>
                    </div>
                    <div class="h-[76px] w-px bg-[#757575]"></div>
                </div>

                <!-- Cell Type -->
                <div class="flex items-center">
                    <div class="flex flex-col items-center max-w-[197px] mx-4">
                        <span class="text-white text-[24px] whitespace-nowrap">N-TYPE CELL</span>
                        <span class="text-[#9D9D9C] text-[12px] text-center leading-tight">lower operating temperature</span>
                    </div>
                </div>
            </div>

            <!-- Швейцарский бейдж -->
            <div class=" md:ml-auto flex-col items-center gap-2 flex-shrink-0 mt-4 md:mt-0 hidden lg:flex pl-12">
                <div class="flex items-center justify-center">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/plus-single.svg'); ?>" alt="Swiss Cross" class="w-[40px] md:w-[53px] h-5 md:h-6">
                </div>
                
            </div>
        </div>
        </div>
        
    </div>
</section>

<section class="pt-12 md:pt-16 lg:pt-[140px] pb-12 md:pb-16">
    
        <!-- Секция INTEGRATED TECHNOLOGY -->
        <div class=" relative z-10 max-w-[1360px] mx-auto px-4 md:px-[116px]">
            <h2 class="text-[#9D9D9C] text-[16px] md:text-[18px] font-medium mb-5">INTEGRATED TECHNOLOGY</h2>
            
            <div class="">
                <?php 
                // Массив данных о технологиях
                $technologies_data = array(
                    'technology_1' => array(
                        'image' => 'technologes-single1.svg',
                        'title' => 'TOPCon ADVANCE TECHNOLOGY',
                        'description' => 'Next-generation cell architecture with enhanced passivation for higher output, reduced LID & PID, and stable performance under high temperatures and low light.',
                        'border_top' => true,
                        'border_bottom' => true,
                    ),
                    'technology_2' => array(
                        'image' => 'technologes-single2.svg',
                        'title' => 'DuraGlassX™',
                        'description' => 'Ultra-strong tempered glass with advanced anti-reflective coating ensures maximum transparency, impact resistance, and long-term durability in extreme climates.',
                        'border_top' => false,
                        'border_bottom' => true,
                    ),
                    'technology_3' => array(
                        'image' => 'technologes-single3.svg',
                        'title' => 'Aluforce Black Frame',
                        'description' => 'Reinforced anodized aluminum provides superior strength, corrosion resistance, and stability under heavy wind and snow loads.',
                        'border_top' => false,
                        'border_bottom' => true,
                    ),
                    'technology_4' => array(
                        'image' => 'technologes-single4.svg',
                        'title' => 'POE Encapsulation',
                        'description' => 'High-performance POE backsheet ensures excellent moisture resistance, PID protection, and reliable performance in humid and hot environments.',
                        'border_top' => false,
                        'border_bottom' => true,
                    ),
                    'technology_5' => array(
                        'image' => 'technologes-single5.svg',
                        'title' => 'Sustainability',
                        'description' => 'Lead-free, eco-compliant design manufactured under European environmental standards, reducing carbon footprint through extended module lifetime.',
                        'border_top' => false,
                        'border_bottom' => true,
                    ),
                    'technology_6' => array(
                        'image' => 'technologes-single6.svg',
                        'title' => 'PHANTOM Design',
                        'description' => 'Deep black cells with an elegant black frame deliver a modern, premium look that blends seamlessly into architectural projects.',
                        'border_top' => false,
                        'border_bottom' => false,
                    ),
                );
                
                // Выводим только выбранные технологии в правильном порядке
                if (!empty($product_technologies)):
                    // Сортируем выбранные технологии по порядку (1, 2, 3, 4, 5, 6)
                    $ordered_technologies = array();
                    for ($i = 1; $i <= 6; $i++) {
                        $tech_key = 'technology_' . $i;
                        if (in_array($tech_key, $product_technologies)) {
                            $ordered_technologies[] = $tech_key;
                        }
                    }
                    
                    $is_first = true;
                    foreach ($ordered_technologies as $tech_key):
                        if (isset($technologies_data[$tech_key])):
                            $tech = $technologies_data[$tech_key];
                            $border_classes = '';
                            if ($tech['border_top']) {
                                $border_classes .= ' border-t';
                            }
                            if ($tech['border_bottom']) {
                                $border_classes .= ' border-b';
                            }
                            $padding_classes = $tech['border_bottom'] ? 'pb-8 md:pb-[54px] mb-4 md:mb-6' : '';
                            if ($tech['border_top']) {
                                $padding_classes .= ' pt-5';
                            }
                ?>
                <div class="border-[#757575] <?php echo esc_attr($border_classes . ' ' . $padding_classes); ?>">
                    <div class="flex flex-col lg:flex-row items-start justify-between gap-3 md:gap-4">
                        <div class="flex gap-3 items-center lg:pl-5">
                            <span class="text-[#EA0029] mt-[2px] text-[5px] md:text-[8px]"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-product.svg" alt="" class="w-2 h-2"></span>
                            <div class="text-white">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/' . $tech['image']); ?>" alt="<?php echo esc_attr($tech['title']); ?>" class="">
                            </div>
                        </div>
                        <p class="text-[#9D9D9C] text-[16px] md:text-[18px] leading-[135%] max-w-[593px]"><?php echo esc_html($tech['description']); ?></p>
                    </div>
                </div>
                <?php 
                            $is_first = false;
                        endif;
                    endforeach;
                endif;
                ?>
            </div>
        </div>
        
        <!-- Секция TECHNICAL DATA -->
        <div class="mt-12 md:mt-16 lg:mt-20 relative z-10 max-w-[1360px] mx-auto px-4 md:px-[116px]">
            <h2 class="text-[#9D9D9C] text-[16px] md:text-[18px] font-medium mb-5">TECHNICAL DATA</h2>
            
            <div class="border-t border-[#757575] pt-2">
                <div class="">
                    <!-- Power classes -->
                    <div class="border-b border-[#757575] pb-2 flex justify-between items-center">
                        <span class="text-[#757575] text-[14px] md:text-[18px] pl-5">Power classes</span>
                        <span class="text-white text-[14px] md:text-[18px] lg:max-w-[593px] lg:w-full"><?php echo esc_html($power_classes); ?></span>
                    </div>
                    
                    <!-- Efficiency -->
                    <div class="border-b border-[#757575] pt-2 pb-2 flex justify-between items-center">
                        <span class="text-[#757575] text-[14px] md:text-[18px] pl-5">Efficiency</span>
                        <span class="text-white text-[14px] md:text-[18px] lg:max-w-[593px] lg:w-full"><?php echo esc_html($efficiency ? $efficiency : '23,16%'); ?></span>
                    </div>
                    
                    <!-- Size -->
                    <div class="border-b border-[#757575] pt-2 pb-2 flex justify-between items-center">
                        <span class="text-[#757575] text-[14px] md:text-[18px] pl-5">Size</span>
                        <span class="text-white text-[14px] md:text-[18px] lg:max-w-[593px] lg:w-full"><?php echo esc_html($size); ?></span>
                    </div>
                    
                    <!-- Weight -->
                    <div class="border-b border-[#757575] pt-2 pb-2 flex justify-between items-center">
                        <span class="text-[#757575] text-[14px] md:text-[18px] pl-5">Weight</span>
                        <span class="text-white text-[14px] md:text-[18px] lg:max-w-[593px] lg:w-full"><?php echo esc_html($weight); ?></span>
                    </div>
                    
                    <!-- Warranty -->
                    <div class="pt-2 pb-2 flex justify-between items-center border-b border-[#757575]">
                        <span class="text-[#757575] text-[14px] md:text-[18px] pl-5">Warranty</span>
                        <span class="text-white text-[14px] md:text-[18px] lg:max-w-[593px] lg:w-full"><?php echo esc_html($warranty); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Секция с кнопкой Download Datasheet -->
<section class="w-full py-8 md:py-12 lg:pt-16 lg:pb-[190px]">
    <div class="max-w-[1360px] mx-auto px-4 md:px-[116px]">
        <div class="border border-[#757575] px-4 md:px-6 lg:px-10 py-4 md:py-5 flex items-center justify-between md:gap-4 gap-6">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/downoload-data.jpg'); ?>" alt="Datasheet" class="w-[116px] md:hidden">
            <div class="flex flex-col md:flex-row gap-4 md:gap-0 md:items-center justify-between md:w-full">
            <!-- Текст слева -->
            <p class="text-white text-[12px] md:text-[16px] md:font-medium text-left max-w-[154px] md:max-w-none">
                You can read more information in our datasheet
            </p>
            
            <!-- Кнопка Download справа -->
            <a href="<?php echo esc_url($datasheet_url); ?>" 
               target="_blank" 
               <?php if ($is_external_datasheet): ?>rel="noopener noreferrer"<?php endif; ?>
               class="bg-[#1B1B1B] text-white px-4 md:px-6 lg:px-8 py-[8px] w-fit md:py-[10px] rounded-md text-[12px] md:text-[14px] font-medium hover:bg-[#EA0029] flex items-center gap-2 transition-colors whitespace-nowrap" style="box-shadow: inset 0px 1px 1px rgba(255, 255, 255, 0.2);">
                <span>Download</span>
                <svg width="10" height="13" viewBox="0 0 10 13" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white">
                    <path d="M4.59961 11.8V0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.7 7.7002L4.6 11.8002L0.5 7.7002" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1.09961 11.7998H8.09961" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            </div>
        </div>
    </div>
</section>


<?php
get_footer();
?>

