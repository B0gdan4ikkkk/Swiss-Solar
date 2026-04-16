<?php
/**
 * Шаблон для отображения отдельной вакансии
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();

// Получаем ACF поля
$location = get_field('location') ?: 'Switzerland';
$workplace = get_field('workplace') ?: 'CH-6300 Zug';
$operation_area = get_field('operation_area') ?: '';
$position = get_field('position') ?: 'Employee';

// Получаем страницу вакансий для ссылки "Назад"
$vacancies_page = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-vacancies.php'
));
$vacancies_page_url = !empty($vacancies_page) ? get_permalink($vacancies_page[0]->ID) : home_url('/vacancies/');
?>

<section class="single-vacancy-section w-full pt-20 md:pt-[100px] lg:pt-[130px] pb-12 md:pb-16 lg:pb-20">
    <div class="max-w-[1360px] mx-auto px-4 md:px-[116px]">
        
        <!-- Кнопка "Назад" -->
        <div class="mb-8 md:mb-10">
            <a href="<?php echo esc_url($vacancies_page_url); ?>" class="inline-flex items-center gap-2 text-[#757575] text-[14px] md:text-[16px] hover:text-[#EA0029] transition-colors">
                <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-2 h-3 rotate-180">
                    <path d="M1 1L7 6L1 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Back to Vacancies</span>
            </a>
        </div>
        
        <!-- Заголовок -->
        <h1 class="text-white text-[24px] md:text-[32px] lg:text-[40px] font-medium mb-8 md:mb-10 uppercase">
            <?php echo esc_html(get_the_title()); ?>
        </h1>
        
        <!-- Информация о вакансии -->
        <div class="mb-8 md:mb-12 space-y-3 md:space-y-4">
            <div class="flex flex-col md:flex-row md:items-center gap-2">
                <span class="text-[#757575] text-[14px] md:text-[16px] font-medium min-w-[120px]">Location:</span>
                <span class="text-white text-[14px] md:text-[16px]"><?php echo esc_html($location); ?></span>
            </div>
            <div class="flex flex-col md:flex-row md:items-center gap-2">
                <span class="text-[#757575] text-[14px] md:text-[16px] font-medium min-w-[120px]">Workplace:</span>
                <span class="text-white text-[14px] md:text-[16px]"><?php echo esc_html($workplace); ?></span>
            </div>
            <?php if ($operation_area): ?>
            <div class="flex flex-col md:flex-row md:items-center gap-2">
                <span class="text-[#757575] text-[14px] md:text-[16px] font-medium min-w-[120px]">Operation Area:</span>
                <span class="text-white text-[14px] md:text-[16px]"><?php echo esc_html($operation_area); ?></span>
            </div>
            <?php endif; ?>
            <div class="flex flex-col md:flex-row md:items-center gap-2">
                <span class="text-[#757575] text-[14px] md:text-[16px] font-medium min-w-[120px]">Position:</span>
                <span class="text-white text-[14px] md:text-[16px]"><?php echo esc_html($position); ?></span>
            </div>
        </div>
        
        <!-- Длинная серая линия-разделитель -->
        <div class="w-full h-px bg-[#757575] mb-8 md:mb-12"></div>
        
        <!-- Описание вакансии -->
        <div class="max-w-[900px]">
            <div class="text-[#757575] text-[14px] md:text-[16px] leading-[160%] vacancy-content">
                <?php 
                the_content();
                ?>
            </div>
        </div>
        
        <!-- Секция с информацией о подаче заявки -->
        <div class="mt-12 md:mt-16 pt-8 md:pt-12 border-t border-[#757575]">
            <div class="max-w-[900px] space-y-4">
                <p class="text-white text-[16px] md:text-[18px] font-medium">
                    Join us in shaping future technologies. We look forward to receiving your detailed job application.
                </p>
                <p class="text-[#757575] text-[14px] md:text-[16px]">
                    You can directly send you CV to
                </p>
                <p>
                    <a href="mailto:info@swissenergy-solar.ch" class="text-[#EA0029] text-[16px] md:text-[18px] font-medium hover:underline transition-colors">
                        info@swissenergy-solar.ch
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>

