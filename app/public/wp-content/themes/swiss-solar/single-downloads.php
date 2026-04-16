<?php
/**
 * Шаблон для отображения отдельного Download
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();

while (have_posts()): the_post();
    $pdf_file = get_field('pdf_file');
    $pdf_url_field = get_field('pdf_url');
    $title = get_the_title();
    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large');
?>

<section class="download-single-section w-full py-10 md:py-16 lg:pt-[192px] pb-20 bg-black">
    <div class="max-w-[1230px] mx-auto px-4">
        <!-- Заголовок -->
        <div class="mb-8 md:mb-12">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('downloads'))); ?>" 
               class="text-[#757575] hover:text-white transition-colors text-[14px] md:text-[16px] mb-4 inline-block">
                ← Back to Downloads
            </a>
            <h1 class="text-white text-[24px] md:text-[32px] lg:text-[48px] font-medium leading-[1.09]">
                <?php echo esc_html($title); ?>
            </h1>
        </div>

        <!-- Контент с PDF -->
        <div class="download-content">
            <?php 
                // Определяем URL и имя файла PDF
                $pdf_url = '';
                $pdf_filename = '';
                $is_external_url = false;
                
                // Приоритет: сначала проверяем загруженный файл, затем URL
                if ($pdf_file) {
                    // Обработка разных форматов ACF file поля
                    if (is_array($pdf_file)) {
                        // Если поле возвращает массив
                        $pdf_url = isset($pdf_file['url']) ? $pdf_file['url'] : (isset($pdf_file['ID']) ? wp_get_attachment_url($pdf_file['ID']) : '');
                        $pdf_filename = isset($pdf_file['filename']) ? $pdf_file['filename'] : basename($pdf_url);
                    } elseif (is_numeric($pdf_file)) {
                        // Если поле возвращает только ID
                        $pdf_url = wp_get_attachment_url($pdf_file);
                        $pdf_filename = basename(get_attached_file($pdf_file));
                    } else {
                        // Если поле возвращает URL строку
                        $pdf_url = $pdf_file;
                        $pdf_filename = basename($pdf_url);
                    }
                } elseif ($pdf_url_field) {
                    // Если используется поле URL
                    $pdf_url = esc_url_raw($pdf_url_field);
                    $pdf_filename = basename(parse_url($pdf_url, PHP_URL_PATH));
                    if (empty($pdf_filename) || $pdf_filename === '/') {
                        $pdf_filename = 'document.pdf';
                    }
                    // Проверяем, является ли URL внешним
                    $site_url = home_url();
                    $parsed_site = parse_url($site_url);
                    $parsed_pdf = parse_url($pdf_url);
                    $is_external_url = ($parsed_site && $parsed_pdf && 
                                       (isset($parsed_site['host']) && isset($parsed_pdf['host']) && 
                                        $parsed_site['host'] !== $parsed_pdf['host']));
                }
                
                if ($pdf_url): 
            ?>
                
                <!-- Превью PDF (если есть миниатюра) -->
                <?php if ($thumbnail): ?>
                <div class="mb-6 max-w-2xl">
                    <img src="<?php echo esc_url($thumbnail); ?>" 
                         alt="<?php echo esc_attr($title); ?>" 
                         class="w-full h-auto rounded border border-[#757575]">
                </div>
                <?php endif; ?>
                
                <!-- PDF Viewer -->
                <div class="pdf-viewer-container mb-6">
                    <iframe src="<?php echo esc_url($pdf_url); ?>#toolbar=1" 
                            class="w-full h-[600px] md:h-[800px] lg:h-[900px] border border-[#757575] rounded"
                            frameborder="0">
                    </iframe>
                </div>
                
                <!-- Кнопка скачивания -->
                <div class="flex items-center gap-4 mb-8">
                    <a href="<?php echo esc_url($pdf_url); ?>" 
                       <?php if (!$is_external_url): ?>download<?php endif; ?>
                       <?php if ($is_external_url): ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>
                       class="inline-flex items-center gap-2 px-6 py-3 bg-[#EA0029] text-white rounded hover:bg-[#d10024] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <?php echo $is_external_url ? 'Open PDF' : 'Download PDF'; ?>
                    </a>
                    <span class="text-[#757575] text-[14px]">
                        <?php echo esc_html($pdf_filename); ?>
                    </span>
                </div>
                
            <?php else: ?>
                <!-- Если PDF файл не найден -->
                <div class="text-center py-20">
                    <p class="text-white text-lg mb-4">PDF file not found.</p>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('downloads'))); ?>" 
                       class="text-[#EA0029] hover:text-white transition-colors">
                        Return to Downloads
                    </a>
                </div>
            <?php endif; ?>
            
            <!-- Описание (если есть) -->
            <?php if (get_the_content()): ?>
            <div class="download-description mt-8 pt-8 border-t border-[#757575]">
                <div class="prose prose-invert max-w-none text-white">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<div class="w-full items-center justify-center flex">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/flag.svg'); ?>" alt="Swiss Flag" class="w-12 h-12 md:w-12 lg:h-12">
</div>

<?php
endwhile;

get_footer();
?>

