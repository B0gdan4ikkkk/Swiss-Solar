    </main>

    <footer id="colophon" class="site-footer  relative">
        <div class="max-w-[1360px] mx-auto bg-[#1B1B1B] pt-5 pb-2 lg:py-4 sm:px-[30px] xl:px-[100px] lg:rounded-t-[7px]">
            <!-- Основной контент футера -->
            <div class="flex flex-col lg:flex-row items-center lg:items-center justify-between gap-8">
                
                <!-- Левая часть: Логотип и Copyright -->
                <div class="flex flex-col lg:flex-row items-center lg:items-end gap-2 lg:gap-[30px] order-3 lg:order-1">
                    <!-- Логотип -->
                    <a href="<?php echo home_url('/'); ?>" class="text-[#EA0029] font-clash font-semibold text-xl md:text-2xl uppercase max-h-[15px]">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="" class="max-h-[15px]">
                    </a>
                    
                    <!-- Copyright -->
                    <div class="text-[#757575] text-[10px] leading-[1] font-medium text-center">
                        COPYRIGHT @ <?php echo date('Y'); ?> SWISS SOLAR AG ALL RIGHTS RESERVED
                    </div>
                </div>

                <!-- Социальные сети -->
                <div class="flex items-center justify-center gap-5 order-1 lg:order-2">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/SwissSolarAG/" target="_blank" class="text-gray-600 hover:text-gray-400 transition-colors" aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/swiss_solar_ag" target="_blank" class="text-gray-600 hover:text-gray-400 transition-colors" aria-label="Instagram">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"/>
                                <circle cx="12" cy="12" r="4" stroke-width="2"/>
                                <circle cx="18" cy="6" r="1" fill="currentColor"/>
                            </svg>
                        </a>
                        
                        <!-- YouTube -->
                        <a href="https://www.linkedin.com/company/swiss-solar-ag/" target="_blank" class="text-gray-600 hover:text-gray-400 transition-colors" aria-label="ln">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Bold" enable-background="new 0 0 20 20" height="20" viewBox="0 0 24 24" width="20" class="w-5 h-5" fill="currentColor"><path d="m23.994 24v-.001h.006v-8.802c0-4.306-.927-7.623-5.961-7.623-2.42 0-4.044 1.328-4.707 2.587h-.07v-2.185h-4.773v16.023h4.97v-7.934c0-2.089.396-4.109 2.983-4.109 2.549 0 2.587 2.384 2.587 4.243v7.801z"></path><path d="m.396 7.977h4.976v16.023h-4.976z"></path><path d="m2.882 0c-1.591 0-2.882 1.291-2.882 2.882s1.291 2.909 2.882 2.909 2.882-1.318 2.882-2.909c-.001-1.591-1.292-2.882-2.882-2.882z"></path></svg>
                        </a>
                    </div>

                <!-- Правая часть: Социальные сети и ссылки -->
                <div class="flex flex-col lg:flex-row items-center gap-6 md:gap-8 w-full lg:w-auto order-2 lg:order-3">
                    
                    

                    <!-- Навигационные ссылки -->
                    <nav class="flex flex-wrap justify-center lg:justify-start items-center gap-3 lg:gap-8">
                        <a href="<?php echo home_url('/imprint/'); ?>" class="text-[#757575] hover:text-white text-[13px] font-geist transition-colors">
                            Imprint
                        </a>
                        <a href="<?php echo home_url('/general-business-terms/'); ?>" class="text-[#757575] hover:text-white text-[13px] font-geist transition-colors">
                            General Business Terms
                        </a>
                        <a href="<?php echo home_url('/privacy-policy/'); ?>" class="text-[#757575] hover:text-white text-[13px] font-geist transition-colors">
                            Data Privacy
                        </a>
                        <a href="<?php echo home_url('/contacts/'); ?>" class="text-[#757575] hover:text-white text-[13px] font-geist transition-colors">
                            Contacts
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Красная линия внизу -->
        <div class=" w-full h-[10px] bg-[#EA0029]"></div>
    </footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
