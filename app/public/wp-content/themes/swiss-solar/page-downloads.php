<?php
/**
 * Template Name: Downloads Page
 * Шаблон страницы Downloads
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();

// Получаем категории downloads
$download_categories = get_terms(array(
    'taxonomy' => 'downloads_category',
    'hide_empty' => false,
    'parent' => 0
));

// Определяем активную категорию из URL или используем первую
$active_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
if (empty($active_category) && !empty($download_categories) && !is_wp_error($download_categories)) {
    $active_category = $download_categories[0]->slug;
}

// Табы для категорий
$tabs = array();
if (!empty($download_categories) && !is_wp_error($download_categories)) {
    foreach ($download_categories as $cat) {
        $tabs[] = array(
            'slug' => $cat->slug,
            'name' => $cat->name
        );
    }
    // Если активная категория не установлена, используем первую
    if (empty($active_category)) {
        $active_category = $download_categories[0]->slug;
    }
} else {
    // Fallback: если категории не найдены, показываем все downloads
    $tabs = array();
    $active_category = '';
}
?>

<section class="downloads-section w-full py-10 md:py-16 lg:pt-[132px] pb-20 bg-black">
    <div class="max-w-[1360px] mx-auto px-4 lg:px-[116px]">
        <!-- Заголовок -->
        <h1 class="text-white text-[24px] md:text-[32px] font-medium leading-[1.09] mb-5 md:mb-8">
            Downloads
        </h1>
        
        <!-- Основной контейнер: категории слева, документы справа -->
        <div class="flex flex-col gap-6 md:gap-12">
            <!-- Категории (слева) -->
            <div class="flex-shrink-0 w-full">
                <div class="flex flex-col md:flex-row items-start gap-0">
                    <?php foreach ($tabs as $index => $tab): ?>
                        <?php 
                        $is_active = ($active_category === $tab['slug']);
                        $tab_url = add_query_arg('category', $tab['slug'], get_permalink());
                        ?>
                        <a href="<?php echo esc_url($tab_url); ?>" 
                           class="downloads-tab <?php echo $is_active ? 'active' : ''; ?> text-[14px] md:text-[18px] w-full relative pb-2 mb-4 transition-colors hover:opacity-80 leading-[135%] whitespace-nowrap" 
                           style="color: <?php echo $is_active ? 'white' : '#757575'; ?>;">
                            <span class="absolute bottom-0 left-0 w-full block" 
                                  style="background-color: <?php echo $is_active ? '#EA0029' : '#757575'; ?>; height: <?php echo $is_active ? '2px' : '1px'; ?>;"></span>
                            <?php echo esc_html($tab['name']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Документы (справа) -->
            <div class="flex-1">
                <div class="downloads-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 md:gap-10">
            <?php
            // Запрос downloads
            $args = array(
                'post_type' => 'downloads',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
            );

            // Фильтр по категории
            if (!empty($active_category)) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'downloads_category',
                        'field'    => 'slug',
                        'terms'    => $active_category,
                    ),
                );
            }

            $downloads_query = new WP_Query($args);

            if ($downloads_query->have_posts()):
                while ($downloads_query->have_posts()): $downloads_query->the_post();
                    $pdf_file = get_field('pdf_file');
                    $pdf_url_field = get_field('pdf_url');
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    $title = get_the_title();
                    
                    // Получаем URL PDF файла (приоритет: файл, затем URL)
                    $pdf_url = '';
                    if ($pdf_file) {
                        if (is_array($pdf_file)) {
                            $pdf_url = isset($pdf_file['url']) ? $pdf_file['url'] : (isset($pdf_file['ID']) ? wp_get_attachment_url($pdf_file['ID']) : '');
                        } elseif (is_numeric($pdf_file)) {
                            $pdf_url = wp_get_attachment_url($pdf_file);
                        } else {
                            $pdf_url = $pdf_file;
                        }
                    } elseif ($pdf_url_field) {
                        $pdf_url = esc_url_raw($pdf_url_field);
                    }
            ?>
            
            <!-- Карточка документа -->
            <div class="download-card group relative p-4 md:p-9 pb-3 md:pb-5 border border-[#757575]">
                <?php if ($pdf_url): ?>
                <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" class="block">
                    <!-- Миниатюра документа -->
                    <div class="relative mb-3 pb-3 md:pb-5 overflow-hidden border-b border-[#757575] w-full">
                        <?php if ($thumbnail): ?>
                            <img src="<?php echo esc_url($thumbnail); ?>" 
                                 alt="<?php echo esc_attr($title); ?>" 
                                 class="w-full h-auto object-contain object-center">
                        <?php else: ?>
                            <!-- Плейсхолдер, если нет изображения -->
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center min-h-[200px]">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/pdf-file.svg" 
                                     alt="PDF" 
                                     class="w-16 h-16 opacity-50">
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Название документа и иконка -->
                    <div class="flex flex-col items-end justify-between gap-2">
                        <!-- Название документа -->
                        <div class="text-white text-[12px] md:text-[14px] leading-[120%] transition-colors flex-1">
                            <?php echo esc_html($title); ?>
                        </div>
                        
                        <!-- Иконка скачивания -->
                        <div class="flex items-center justify-end flex-shrink-0">
                            <svg width="10" height="13" viewBox="0 0 10 13" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white group-hover:text-[#EA0029] transition-colors">
<path d="M4.59961 11.8V0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.7 7.7002L4.6 11.8002L0.5 7.7002" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1.09961 11.7998H8.09961" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                        </div>
                    </div>
                </a>
                <?php else: ?>
                <div class="block opacity-50 cursor-not-allowed">
                    <!-- Миниатюра документа -->
                    <div class="relative mb-3 pb-3 md:pb-5 overflow-hidden border-b border-[#757575] w-full">
                        <?php if ($thumbnail): ?>
                            <img src="<?php echo esc_url($thumbnail); ?>" 
                                 alt="<?php echo esc_attr($title); ?>" 
                                 class="w-full h-auto object-contain object-center">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center min-h-[200px]">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/pdf-file.svg" 
                                     alt="PDF" 
                                     class="w-16 h-16 opacity-50">
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Название документа -->
                    <div class="text-white text-[12px] md:text-[14px] leading-[120%] transition-colors">
                        <?php echo esc_html($title); ?>
                    </div>
                    
                    <!-- Иконка скачивания -->
                    <div class="flex items-center justify-end">
                        <svg width="10" height="13" viewBox="0 0 10 13" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white">
<path d="M4.59961 11.8V0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.7 7.7002L4.6 11.8002L0.5 7.7002" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1.09961 11.7998H8.09961" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <?php
                endwhile;
                wp_reset_postdata();
            else:
            ?>
                    <div class="col-span-full text-center py-20">
                        <p class="text-white text-lg">No downloads found.</p>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="w-full items-center justify-center flex">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/flag.svg'); ?>" alt="Swiss Flag" class="w-12 h-12 md:w-12 lg:h-12">
</div>

<?php
get_footer();
?>

