<?php
/**
 * Template Name: Vacancies Page
 * Шаблон страницы вакансий
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();
?>

<section class="vacancies-section w-full pt-20 md:pt-[100px] lg:pt-[130px] pb-12 md:pb-16 lg:pb-20">
    <div class="max-w-[1360px] mx-auto px-4 md:px-[116px]">
        
        <!-- Заголовок -->
        <h1 class="text-white text-[24px] md:text-[32px] font-medium  mb-4 md:mb-6 uppercase">
            JOB VACANCIES
        </h1>
        
        <!-- Красная линия под заголовком -->
        <div class="w-full md:w-[200px] h-[2px] bg-[#EA0029] mb-6 md:mb-8"></div>
        
        <!-- Вводный текст -->
        <div class="mb-8 md:mb-12">
            <p class="text-white text-[14px] md:text-[16px] leading-[140%]">
                Here you will find vacancies at SWISS SOLAR and its subsidiaries.
            </p>
        </div>
        
        <!-- Сетка вакансий -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            <?php
            // Запрос вакансий
            $vacancies_args = array(
                'post_type' => 'vacancies',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $vacancies_query = new WP_Query($vacancies_args);

            if ($vacancies_query->have_posts()):
                while ($vacancies_query->have_posts()): $vacancies_query->the_post();
                    // Получаем ACF поля
                    $location = get_field('location') ?: 'Switzerland';
                    $workplace = get_field('workplace') ?: 'CH-6300 Zug';
                    $operation_area = get_field('operation_area') ?: '';
                    $position = get_field('position') ?: 'Employee';
            ?>
            
            <!-- Карточка вакансии -->
            <div class="border border-[#757575] p-6 md:p-8 flex flex-col">
                <!-- Название вакансии -->
                <h2 class="text-white text-[18px] md:text-[20px] font-medium uppercase mb-3 md:mb-4">
                    <?php echo esc_html(get_the_title()); ?>
                </h2>
                
                <!-- Локация -->
                <p class="text-white text-[14px] md:text-[16px] mb-4 md:mb-6">
                    <?php echo esc_html($location); ?>
                </p>
                
                <!-- Детали вакансии -->
                <div class="space-y-2 mb-6 md:mb-8 flex-grow">
                    <p class="text-white text-[14px] md:text-[16px]">
                        <span class="font-medium">Workplace:</span> <?php echo esc_html($workplace); ?>
                    </p>
                    <?php if ($operation_area): ?>
                    <p class="text-white text-[14px] md:text-[16px]">
                        <span class="font-medium">Operation Area:</span> <?php echo esc_html($operation_area); ?>
                    </p>
                    <?php endif; ?>
                    <p class="text-white text-[14px] md:text-[16px]">
                        <span class="font-medium">Position:</span> <?php echo esc_html($position); ?>
                    </p>
                </div>
                
                <!-- Ссылка на описание вакансии -->
                <a href="<?php echo esc_url(get_permalink()); ?>" class="inline-flex items-center gap-2 text-white text-[14px] md:text-[16px] uppercase hover:text-[#EA0029] transition-colors mt-auto">
                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-2 h-3">
                        <path d="M1 1L7 6L1 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>JOB DESCRIPTION</span>
                </a>
            </div>
            
            <?php
                endwhile;
                wp_reset_postdata();
            else:
            ?>
            
            <!-- Сообщение, если вакансий нет -->
            <div class="col-span-1 md:col-span-2">
                <p class="text-[#757575] text-[14px] md:text-[16px]">
                    No vacancies available at the moment. Please check back later.
                </p>
            </div>
            
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>

