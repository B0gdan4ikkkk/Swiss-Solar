<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div>
    <header id="masthead" class="site-header relative top-0 z-50">
        <div class=" bg-black relative header-container lg:block" style="box-shadow: inset 1px 1px 1px 0px rgba(230, 230, 230, 0.25);">
            <!-- Десктопная версия -->
            <div class="hidden lg:flex items-center justify-between py-4 md:py-6 px-[100px] max-w-[1360px] mx-auto">
                <div class="site-branding flex-shrink-0">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="block">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="!h-4 md:!h-6">
                    </a>
                </div>

                <div class="flex items-center space-x-7">
                    <nav id="site-navigation" class="main-navigation flex flex-1 items-center gap-8">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'container'      => false,
                            'menu_class'     => 'flex items-center justify-center space-x-8',
                            'fallback_cb'    => false,
                            'link_before'    => '<span class="text-white hover:text-gray-300 font-medium transition-colors text-[18px]">',
                            'link_after'     => '</span>',
                        ));
                        ?>
                        <a href="<?php echo home_url('/shop/'); ?>" class="flex items-center gap-2 py-1 px-4 rounded-full bg-[#EA0029] text-white">Store <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="Arrow" class="mt-[3px]"></a>
                    </nav>
                    <div class="flex items-center gap-4">
                        <button id="search-toggle" class="text-white hover:text-gray-300 transition-colors">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/search.svg'); ?>" alt="Поиск" class="w-5 h-5">
                        </button>
                        <div class="relative px-3 flex items-center justify-center">
                            <button id="language-toggle" class="text-white hover:text-gray-300 transition-colors group">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/language.svg'); ?>" alt="Язык" class="w-5 h-5 group-hover:hidden">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/hover-language.svg'); ?>" alt="Язык" class="w-5 h-5 hidden group-hover:block">
                            </button>
                            <!-- Дропдаун языков -->
                            <div id="language-dropdown" class="language-dropdown absolute top-full w-full right-0 mt-2 hidden bg-black rounded-lg pb-1 z-50">
                                <div class="language-list">
                                    <?php echo do_shortcode('[gtranslate style="language_codes_vertical" languages="en,de,pl,cs"]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Мобильная версия хедера -->
            <div class="lg:hidden flex items-center justify-between py-5 px-5">
                <div class="site-branding flex-shrink-0">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="block">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="!h-4 md:!h-6">
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="<?php echo home_url('/shop/'); ?>" class="hidden md:flex items-center gap-2 py-1 px-4 rounded-full bg-[#EA0029] text-white">Store <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="Arrow" class="mt-[3px]"></a>
                    <button id="menu-toggle" class="text-white hover:text-gray-300 focus:outline-none transition-colors" aria-expanded="false">
                        <img id="burger-icon" src="<?php echo esc_url(get_template_directory_uri() . '/img/burger-menu.svg'); ?>" alt="Menu" class="w-6 md:w-8 h-6 md:h-8">
                        <img id="close-icon" src="<?php echo esc_url(get_template_directory_uri() . '/img/cross.svg'); ?>" alt="Close" class="w-6 h-6 hidden">
                    </button>
                </div>
            </div>

            <!-- Дропдаун меню при наведении на хедер (только для десктопа) -->
            <div id="header-dropdown" class="header-dropdown absolute top-full left-0 w-full bg-black hidden z-50 rounded-b-[7px] lg:block " >
                <div class="container">
                    <div class="flex justify-end  pt-2 pb-12 pr-[230px]">
                    <div class="flex flex-col gap-4 pr-[22px]">
                            <a href="<?php echo home_url('/about-us/'); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">About US</a>
                            <a href="<?php echo home_url('/vacancies/'); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Vacancies</a>
                            <a href="<?php echo home_url('/news/'); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">News</a>
                            <a href="<?php echo home_url('/contacts/'); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Contact</a>
                        </div>
                        <div class="flex flex-col gap-4  pr-[120px]">
                            <a href="<?php echo home_url('/shop/'); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Solar Modules</a>
                            <a href="<?php echo home_url('/technologies/'); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Technologies</a>
                        </div>
                       
                        <div class="flex flex-col gap-4">
                            <?php 
                            $downloads_page = get_page_by_path('downloads');
                            if (!$downloads_page) {
                                $downloads_page = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'page-downloads.php'));
                                $downloads_page = !empty($downloads_page) ? $downloads_page[0] : null;
                            }
                            $downloads_url = $downloads_page ? get_permalink($downloads_page->ID) : home_url('/downloads/');
                            ?>
                            <a href="<?php echo esc_url(add_query_arg('category', 'data-sheet', $downloads_url)); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Data Sheet</a>
                            <a href="<?php echo esc_url(add_query_arg('category', 'installational-manual', $downloads_url)); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Installation Manual</a>
                            <a href="<?php echo esc_url(add_query_arg('category', 'technical-warranty', $downloads_url)); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Technical & Warranty</a>
                            <a href="<?php echo esc_url(add_query_arg('category', 'certificates', $downloads_url)); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Certificates</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Мобильное меню -->
        <div id="mobile-menu" class="mobile-menu-overlay fixed inset-0 bg-black z-50 hidden lg:hidden top-0 h-fit" style="box-shadow: inset 1px 1px 1px 0px rgba(230, 230, 230, 0.25);">
            <div class="mobile-menu-content h-fit flex flex-col">
                <!-- Заголовок меню -->
                <div class="flex items-center justify-between mx-5 pt-4 pb-12 border-b border-[#757575] ">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="block">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="h-4 md:h-6">
                    </a>
                    <button id="mobile-menu-close" class=" text-white hover:text-gray-300 focus:outline-none transition-colors">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/cross.svg'); ?>" alt="Close" class="w-4 md:w-5 h-4 md:h-5">
                    </button>
                </div>
                
                <!-- Список меню -->
                <nav class="flex-1 overflow-y-auto">
                    <!-- Products с выпадающим списком -->
                    <div class="mobile-menu-group">
                        <input type="checkbox" id="mobile-menu-products" class="mobile-menu-checkbox hidden">
                        <label for="mobile-menu-products" class="mobile-menu-item-toggle mx-5 py-2 text-white border-b border-[#757575] flex items-center justify-between text-[18px]">
                        <span class="flex items-center gap-3">
                            <span class="font-medium">Products</span>
                        </span>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/arrow-menu.svg'); ?>" alt="Arrow" class="mobile-menu-arrow w-3 h-3 transition-transform mr-6">
                        </label>
                        <div class="mobile-submenu mx-5 border-b border-[#757575] flex flex-col gap-[5px]">
                            <a href="<?php echo home_url('/shop/'); ?>" class="mobile-menu-item mx-4 text-white mt-2">Solar Modules</a>
                            <a href="<?php echo home_url('/technologies/'); ?>" class="mobile-menu-item mx-4 text-white mb-2">Technologies</a>
                        </div>
                    </div>

                    <!-- Company с выпадающим списком -->
                    <div class="mobile-menu-group">
                        <input type="checkbox" id="mobile-menu-company" class="mobile-menu-checkbox hidden">
                        <label for="mobile-menu-company" class="mobile-menu-item-toggle mx-5 py-2 text-white border-b border-[#757575] flex items-center justify-between text-[18px]">
                            <span class="flex items-center gap-3">
                                <span class="font-medium">Company</span>
                            </span>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/arrow-menu.svg'); ?>" alt="Arrow" class="mobile-menu-arrow w-3 h-3 transition-transform mr-6">
                        </label>
                        <div class="mobile-submenu mx-5 border-b border-[#757575] flex flex-col gap-[5px]">
                            <a href="<?php echo home_url('/about-us/'); ?>" class="mobile-menu-item mx-4 text-white mt-2">About US</a>
                            <a href="<?php echo home_url('/vacancies/'); ?>" class="mobile-menu-item mx-4 text-white">Vacancies</a>
                            <a href="<?php echo home_url('/news/'); ?>" class="mobile-menu-item mx-4 text-white">News</a>
                            <a href="<?php echo home_url('/contacts/'); ?>" class="mobile-menu-item mx-4 text-white mb-2">Contact</a>
                        </div>
                    </div>

                    <!-- References -->
                    <a href="<?php echo home_url('/references/') ?>" class="mobile-menu-item mx-5 py-2 text-white border-b border-[#757575] flex items-center justify-between text-[18px]">
                        <span class="flex items-center gap-3">
                            <span class="font-medium">References</span>
                        </span>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/arrow-menu.svg'); ?>" alt="Arrow" class="w-3 h-3 mr-6">
                    </a>

                    <!-- Downloads с выпадающим списком -->
                    <div class="mobile-menu-group">
                        <input type="checkbox" id="mobile-menu-downloads" class="mobile-menu-checkbox hidden">
                        <label for="mobile-menu-downloads" class="mobile-menu-item-toggle mx-5 py-2 text-white border-b border-[#757575] flex items-center justify-between text-[18px]">
                            <span class="flex items-center gap-3">
                                <a href="<?php echo home_url('/downloads/') ?>" class="font-medium">Downloads</a>
                            </span>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/arrow-menu.svg'); ?>" alt="Arrow" class="mobile-menu-arrow w-3 h-3 transition-transform mr-6">
                        </label>
                        <div class="mobile-submenu mx-5 border-b border-[#757575] flex flex-col gap-[5px]">
                            <?php 
                            $downloads_page = get_page_by_path('downloads');
                            if (!$downloads_page) {
                                $downloads_page = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'page-downloads.php'));
                                $downloads_page = !empty($downloads_page) ? $downloads_page[0] : null;
                            }
                            $downloads_url = $downloads_page ? get_permalink($downloads_page->ID) : home_url('/downloads/');
                            ?>
                            <a href="<?php echo esc_url(add_query_arg('category', 'data-sheet', $downloads_url)); ?>" class="mobile-menu-item mx-4 text-white mt-2">Data Sheet</a>
                            <a href="<?php echo esc_url(add_query_arg('category', 'installational-manual', $downloads_url)); ?>" class="mobile-menu-item mx-4 text-white ">Installation Manual</a>
                            <a href="<?php echo esc_url(add_query_arg('category', 'technical-warranty', $downloads_url)); ?>" class="mobile-menu-item mx-4 text-white ">Technical & Warranty</a>
                            <a href="<?php echo esc_url(add_query_arg('category', 'certificates', $downloads_url)); ?>" class="mobile-menu-item mx-4 text-white mb-2">Certificates</a>
                        </div>
                    </div>

                    <!-- Languages с выпадающим списком -->
                    <div class="mobile-menu-group mb-10">
                        <input type="checkbox" id="mobile-menu-languages" class="mobile-menu-checkbox hidden">
                        <label for="mobile-menu-languages" class="mobile-menu-item-toggle mx-5 py-2 text-white border-b border-[#757575] flex items-center justify-between text-[18px]">
                            <span class="flex items-center gap-2">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/language.svg'); ?>" alt="Language" class="w-5 h-5">
                                <span class="mobile-current-language text-white text-[18px]">Language</span>
                            </span>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/arrow-menu.svg'); ?>" alt="Arrow" class="mobile-menu-arrow w-3 h-3 transition-transform mr-6">
                        </label>
                        <div class="mobile-submenu mx-5 flex flex-col gap-[5px]">
                            <div class="mobile-menu-languages-list">
                                <?php echo do_shortcode('[gtranslate style="language_codes_vertical" languages="en,de,pl,cs"]'); ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
            <!-- Дропдаун меню при наведении на хедер -->
        <div id="header-dropdown" class="header-dropdown absolute top-full left-0 w-full bg-black hidden z-50 rounded-b-[7px]">
            <div class="container">
                <div class="flex justify-end gap-[99px] pt-[24px] pb-12 pr-[250px]">
                    <div class="flex flex-col gap-4">
                        <a href="<?php echo home_url('/about-us/'); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">About US</a>
                        <a href="<?php echo home_url('/vacancies/'); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Vacancies</a>
                        <a href="<?php echo home_url('/news/'); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">News</a>
                        <a href="<?php echo home_url('/contacts/'); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Contact</a>
                    </div>
                    <div class="flex flex-col gap-4">
                        <?php 
                        $downloads_page = get_page_by_path('downloads');
                        if (!$downloads_page) {
                            $downloads_page = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'page-downloads.php'));
                            $downloads_page = !empty($downloads_page) ? $downloads_page[0] : null;
                        }
                        $downloads_url = $downloads_page ? get_permalink($downloads_page->ID) : home_url('/downloads/');
                        ?>
                        <a href="<?php echo esc_url(add_query_arg('category', 'data-sheet', $downloads_url)); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Data Sheet</a>
                        <a href="<?php echo esc_url(add_query_arg('category', 'installational-manual', $downloads_url)); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Installation Manual</a>
                        <a href="<?php echo esc_url(add_query_arg('category', 'technical-warranty', $downloads_url)); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Technical & Warranty</a>
                        <a href="<?php echo esc_url(add_query_arg('category', 'certificates', $downloads_url)); ?>" class="text-white hover:text-gray-300 transition-colors text-lg font-medium">Certificates</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
        <!-- Модальное окно поиска -->
        <div id="search-modal" class="search-modal absolute top-0 left-0 w-full bg-black z-50 hidden" style="box-shadow: inset 1px 1px 1px 0px rgba(230, 230, 230, 0.25);">
            <div class="search-modal-content w-full flex items-center justify-center" style="min-height: 100px;">
                <div class="w-full max-w-full flex items-center justify-between px-[100px] py-4">
                    <input 
                        type="text" 
                        id="search-input" 
                        class="search-input bg-transparent text-white text-2xl md:text-4xl placeholder-white placeholder-opacity-50 focus:outline-none flex-1" 
                        placeholder="Search..." 
                        autocomplete="off"
                    >
                    <button 
                        id="search-close" 
                        class="search-close text-white hover:text-gray-300 transition-colors ml-4 cursor-pointer flex-shrink-0"
                        aria-label="Закрыть поиск"
                    >
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Результаты поиска -->
            <div id="search-results" class="search-results absolute top-full left-0 w-full bg-black max-h-[calc(100vh-200px)] overflow-y-auto hidden">
                <div class="container mx-auto px-[100px] py-8">
                    <div id="search-results-content" class="search-results-content"></div>
                </div>
            </div>
        </div>
        
    </header>

    <main id="main" class="site-main min-h-screen">
