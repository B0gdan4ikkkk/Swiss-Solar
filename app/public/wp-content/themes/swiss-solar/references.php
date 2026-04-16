<?php
/**
 * Шаблон страницы References
 * Template Name: References
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();
?>

<!-- Секция Our Projects Archive -->
<section class="references-archive-section w-full py-10 md:py-16 lg:pt-[192px] pb-20 bg-black">
    <div class="max-w-[1230px] mx-auto px-4">
        <!-- Заголовок секции -->
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 lg:gap-12 mb-12 md:mb-20 lg:mb-20">
            <div class="">
                <h1 class="text-white text-[24px] md:text-[32px] font-medium leading-[1.09] ">
                Our Projects <br>
                Around the World
                </h1>
            </div>
            <div class="">
                <p class="text-[#757575] text-[16px] md:text-[19px] leading-[135%] max-w-[614px] lg:mr-[105px] tracking-[-0.2px]">
                    Discover a selection of completed Swiss Solar projects showcasing our technologies in real-world conditions. Each installation demonstrates the reliability, performance, and clean design that define our brand.
                </p>
            </div>
        </div>
        
        <?php 
        // Запрос референсов из кастомного типа поста
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $references_query = new WP_Query(array(
            'post_type' => 'references',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => $paged
        ));
        
        // Сохраняем все посты в массив для повторного использования
        $all_references = array();
        
        if ($references_query->have_posts()):
            while ($references_query->have_posts()): $references_query->the_post();
                $description = get_the_excerpt();
                if (empty($description)) {
                    $description = get_the_content();
                    // Обрезаем до 150 символов, если это полный контент
                    if (strlen($description) > 150) {
                        $description = wp_trim_words($description, 30);
                    }
                }
                
                $all_references[] = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'image' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
                    'megawatts' => get_field('megawatts'),
                    'city_ref' => get_field('city_ref'),
                    'description' => $description,
                    'link' => get_permalink()
                );
            endwhile;
        endif;
        
        if (!empty($all_references)):
        ?>
        
        <!-- Мобильная версия (до 1024px) - простая колонка -->
        <div class="references-mobile lg:hidden space-y-3 md:space-y-4 mb-8 md:mb-12">
            <?php foreach ($all_references as $ref): ?>
                <div class="project-card relative overflow-hidden rounded-[7px] group cursor-pointer block">
                    <div class="relative h-[300px] md:h-[400px]">
                        <?php if ($ref['image']): ?>
                            <img src="<?php echo esc_url($ref['image']); ?>" alt="<?php echo esc_attr($ref['title']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
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
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/geolocate-icon.svg" alt="Location" class="w-4 h-4 md:w-7 md:h-10">
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
            <?php endforeach; ?>
        </div>
        
        <!-- Десктопная версия (1024px+) - сетка с большими карточками -->
        <div class="references-desktop hidden lg:grid gap-3 md:gap-4 max-w-[1230px] mx-auto mb-8 md:mb-12">
            <?php foreach ($all_references as $index => $ref): ?>
                <?php if ($index === 0): ?>
                <!-- Первая карточка - большая (занимает 2 колонки) -->
                <div class="project-card col-span-2 relative overflow-hidden rounded-[7px] group cursor-pointer block">
                    <div class="relative h-[300px] md:h-[400px] lg:h-[500px]">
                        <?php if ($ref['image']): ?>
                            <img src="<?php echo esc_url($ref['image']); ?>" alt="<?php echo esc_attr($ref['title']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-800"></div>
                        <?php endif; ?>
                        <!-- Градиентный оверлей -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent bottom-0"></div>
                        
                        <!-- Контент карточки -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 lg:px-10 lg:py-6 flex justify-between w-full">
                            <div>
                                <h3 class="text-white text-[20px] md:text-[32px] font-medium mb-3 md:mb-4">
                                    <?php echo esc_html($ref['title']); ?>
                                </h3>
                                <?php if ($ref['description']): ?>
                                    <p class="text-[#757575] text-[14px] md:text-[14px] leading-[140%] mb-4 md:mb-6 max-w-[532px]">
                                        <?php echo esc_html($ref['description']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <!-- Локация и мощность -->
                            <div class="flex items-end">
                                <?php if ($ref['city_ref']): ?>
                                    <div class="flex flex-col items-center gap-2 pr-3 md:pr-6">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/geolocate-icon.svg" alt="Location" class="w-4 h-4 md:w-7 md:h-10">
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
                <?php else: ?>
                <!-- Первая карточка - большая (занимает 2 колонки) -->
                <div class="project-card col-span-2 relative overflow-hidden rounded-[7px] group cursor-pointer block">
                    <div class="relative h-[300px] md:h-[400px] lg:h-[500px]">
                        <?php if ($ref['image']): ?>
                            <img src="<?php echo esc_url($ref['image']); ?>" alt="<?php echo esc_attr($ref['title']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-800"></div>
                        <?php endif; ?>
                        <!-- Градиентный оверлей -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent bottom-0"></div>
                        
                        <!-- Контент карточки -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 lg:px-10 lg:py-6 flex justify-between w-full">
                            <div>
                                <h3 class="text-white text-[20px] md:text-[32px] font-medium mb-3 md:mb-4">
                                    <?php echo esc_html($ref['title']); ?>
                                </h3>
                                <?php if ($ref['description']): ?>
                                    <p class="text-[#757575] text-[14px] md:text-[14px] leading-[140%] mb-4 md:mb-6 max-w-[532px]">
                                        <?php echo esc_html($ref['description']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <!-- Локация и мощность -->
                            <div class="flex items-end">
                                <?php if ($ref['city_ref']): ?>
                                    <div class="flex flex-col items-center gap-2 pr-3 md:pr-6">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/geolocate-icon.svg" alt="Location" class="w-4 h-4 md:w-7 md:h-10">
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
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        
        <!-- Пагинация -->
        <div class="flex justify-center mt-8 md:mt-12">
            <?php
            if ($references_query->max_num_pages > 1):
                echo '<div class="pagination">';
                echo paginate_links(array(
                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'total' => $references_query->max_num_pages,
                    'current' => max(1, $paged),
                    'format' => '?paged=%#%',
                    'show_all' => false,
                    'type' => 'plain',
                    'end_size' => 2,
                    'mid_size' => 1,
                    'prev_next' => true,
                    'prev_text' => __('← Previous', 'swiss-solar'),
                    'next_text' => __('Next →', 'swiss-solar'),
                    'add_args' => false,
                    'add_fragment' => '',
                ));
                echo '</div>';
            endif;
            wp_reset_postdata();
            ?>
        </div>
        
        <?php else: ?>
            <div class="text-center py-20">
                <p class="text-white text-lg">No references found.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<div class=" w-full items-center justify-center flex">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/flag.svg'); ?>" alt="Swiss Flag" class="w-12 h-12 md:w-12 lg:h-12">
        </div>

<?php
get_footer();
?>

