<?php
/**
 * Template Name: News Page
 * Шаблон страницы новостей
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();
?>

<section class="news-section w-full pt-20 md:pt-[100px] lg:pt-[130px] pb-12 md:pb-16 lg:pb-20">
    <div class="max-w-[1360px] mx-auto px-4 md:px-[116px]">
        
        <!-- Заголовок -->
        <h1 class="text-white text-[24px] md:text-[32px] font-medium mb-4 md:mb-6 uppercase">
            NEWS
        </h1>
        
        <!-- Красная линия под заголовком -->
        <div class="w-full md:w-[200px] h-[2px] bg-[#EA0029] mb-8 md:mb-12"></div>
        
        <!-- Сетка новостей -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            <?php
            // Запрос обычных постов WordPress
            $news_args = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $news_query = new WP_Query($news_args);

            if ($news_query->have_posts()):
                while ($news_query->have_posts()): $news_query->the_post();
                    // Форматируем дату в формат DD/MM/YYYY
                    $post_date = get_the_date('d/m/Y');
            ?>
            
            <!-- Карточка новости -->
            <div class="border border-[#757575] p-6 md:p-8 flex flex-col">
                <!-- Название новости -->
                <h2 class="text-white text-[18px] md:text-[20px] font-medium uppercase mb-3 md:mb-4">
                    <?php echo esc_html(get_the_title()); ?>
                </h2>
                
                <!-- Дата -->
                <p class="text-white text-[14px] md:text-[16px] mb-6 md:mb-8">
                    <?php echo esc_html($post_date); ?>
                </p>
                
                <!-- Ссылка на полную новость -->
                <a href="<?php echo esc_url(get_permalink()); ?>" class="inline-flex items-center gap-2 text-white text-[14px] md:text-[16px] uppercase hover:text-[#EA0029] transition-colors mt-auto">
                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-2 h-3">
                        <path d="M1 1L7 6L1 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>SHOW MORE</span>
                </a>
            </div>
            
            <?php
                endwhile;
                wp_reset_postdata();
            else:
            ?>
            
            <!-- Сообщение, если новостей нет -->
            <div class="col-span-1 md:col-span-2">
                <p class="text-[#757575] text-[14px] md:text-[16px]">
                    No news available at the moment. Please check back later.
                </p>
            </div>
            
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>

