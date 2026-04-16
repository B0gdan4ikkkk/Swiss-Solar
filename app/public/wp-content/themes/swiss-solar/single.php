<?php
/**
 * Шаблон для отображения отдельной новости/поста
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();

// Получаем страницу новостей для ссылки "Назад"
$news_page = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-news.php'
));
$news_page_url = !empty($news_page) ? get_permalink($news_page[0]->ID) : home_url('/news/');

// Форматируем дату
$post_date = get_the_date('d/m/Y');
?>

<section class="single-news-section w-full pt-20 md:pt-[100px] lg:pt-[130px] pb-12 md:pb-16 lg:pb-20">
    <div class="max-w-[1360px] mx-auto px-4 md:px-[116px]">
        
        <!-- Кнопка "Назад" -->
        <div class="mb-8 md:mb-10">
            <a href="<?php echo esc_url($news_page_url); ?>" class="inline-flex items-center gap-2 text-[#757575] text-[14px] md:text-[16px] hover:text-[#EA0029] transition-colors">
                <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-2 h-3 rotate-180">
                    <path d="M1 1L7 6L1 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Back to News</span>
            </a>
        </div>
        
        <!-- Заголовок -->
        <h1 class="text-white text-[24px] md:text-[32px] lg:text-[40px] font-medium mb-6 md:mb-8 uppercase">
            <?php echo esc_html(get_the_title()); ?>
        </h1>
        
        <!-- Дата -->
        <div class="mb-8 md:mb-12">
            <p class="text-white text-[14px] md:text-[16px]">
                <?php echo esc_html($post_date); ?>
            </p>
        </div>
        
        <!-- Длинная серая линия-разделитель -->
        <div class="w-full h-px bg-[#757575] mb-8 md:mb-12"></div>
        
        <!-- Изображение, если есть -->
        <?php if (has_post_thumbnail()): ?>
        <div class="mb-8 md:mb-12">
            <?php the_post_thumbnail('large', array('class' => 'w-full h-auto object-cover')); ?>
        </div>
        <?php endif; ?>
        
        <!-- Контент новости -->
        <div class="max-w-[900px]">
            <div class="text-[#757575] text-[14px] md:text-[16px] leading-[160%] news-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>

