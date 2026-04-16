<?php
/**
 * Template Name: Technologies Page
 * Шаблон страницы Technologies
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();
?>

<section class="hero__sect w-screen flex items-center justify-center">
    <div class="">
        <h1 class="text-white text-[24px] md:text-[32px] font-medium mb-4 md:mb-6 leading-[1.09]  text-center tracking-[-0.02em]">Unique technologies <br>
        delivering premium performance</h1>
    </div>
    <div class="absolute top-0 left-0 z-[-10]">
        <img src="<?php echo get_template_directory_uri(); ?>/img/technologies-hero.png" alt="Technologies Hero" class="w-full min-h-[85dvh] object-cover ">
    </div>
</section>

<!-- Секция Technologies Hero -->
<section class="technologies-hero-section w-full py-12 md:py-20 lg:py-24">
    <div class="max-w-[900px] mx-auto px-4 md:px-0 flex flex-col gap-12">
        <!-- Вводный текст -->
        <div class="text-center mb-12 md:mb-16 lg:mb-8">
            <p class="text-[#757575] text-[18px] leading-[135%] max-w-[520px] mx-auto text-center tracking-[-0.02em]">
                Our core technologies deliver higher efficiency, longer durability, and superior reliability compared to conventional solar modules.
            </p>
        </div>

        <!-- Секция 1: TOPCon ADVANCE / High-performance N-Type Cell Technology -->
        <!-- Мобильная версия -->
        <div class="lg:hidden flex flex-col gap-0">
            <div class="relative w-full h-[250px] overflow-hidden">
                <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_1.png" alt="TOPCon ADVANCE Technology" class="w-full h-full object-cover">
                <div class="absolute top-8 left-6 z-10">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single1.svg" alt="TOPCon ADVANCE TECHNOLOGY" class="h-8 max-w-[180px]">
                </div>
            </div>
            <div class="bg-black flex items-center px-6 py-8">
                <div class="w-full">
                    <h2 class="text-white text-[20px] font-medium mb-3 leading-[1.1]">
                        High-performance N-Type Cell Technology
                    </h2>
                    <p class="text-[14px] leading-[135%] text-[#9D9D9C]">
                        Next-generation cell architecture with enhanced passivation for higher output, reduced LID & PID, and stable performance under high temperatures and low light.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Десктопная версия -->
        <div class="hidden lg:flex w-full justify-end gap-0 relative h-[400px] overflow-hidden rounded-[7px]">
            <!-- Левая панель: Визуал и логотип -->
            <div class="w-full absolute top-0 left-0 z-[-10]">
                <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_1.png" alt="TOPCon ADVANCE Technology" class="w-full h-full object-cover">
                <!-- Логотип TOPCon ADVANCE -->
                <div class="absolute top-8 left-8 z-10">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single1.svg" alt="TOPCon ADVANCE TECHNOLOGY" class="h-10 max-w-[280px]">
                </div>
            </div>
            <!-- Правая панель: Описание -->
            <div class="bg-black/60 flex items-start px-12 lg:px-16 py-16 lg:pt-8 lg:pb-10 lg:w-[525px]">
                <div class="w-full">
                    <h2 class="text-white text-[32px] font-medium mb-6 leading-[1.1]">
                        High-performance N-Type Cell Technology
                    </h2>
                    <p class="text-[18px] leading-[135%] text-[#9D9D9C] tracking-[-0.02em]">
                        Next-generation cell architecture with enhanced passivation for higher output, reduced LID & PID, and stable performance under high temperatures and low light.
                    </p>
                </div>
            </div>
        </div>

        <!-- Секция 2: Extended-life Glass Protection / DuraGlassX™ -->
        <!-- Мобильная версия -->
        <div class="lg:hidden flex flex-col gap-0">
            <div class="relative w-full h-[250px] overflow-hidden">
                <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_3.png" alt="DuraGlassX Technology" class="w-full h-full object-cover">
                <div class="absolute top-8 left-8 z-10">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single2.svg" alt="DuraGlassX™" class="h-8 max-w-[180px]">
                </div>
            </div>
            <div class="bg-black flex items-center px-6 py-8">
                <div class="w-full">
                    <h2 class="text-white text-[20px] font-medium mb-3 leading-[1.1]">
                        Extended-life Glass Protection
                    </h2>
                    <p class="text-[14px] leading-[135%] text-[#9D9D9C]">
                        Ultra-strong tempered glass with advanced anti-reflective coating ensures maximum transparency, impact resistance, and long-term durability in extreme climates.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Десктопная версия -->
        <div class="hidden lg:flex w-full justify-start gap-0 relative h-[400px] overflow-hidden rounded-[7px]">
            <!-- Левая панель: Описание -->
            <div class="bg-black/60 flex items-start px-12 lg:px-16 py-16 lg:pr-8 lg:pt-8 lg:pb-10 lg:w-[378px]">
                <div class="w-full">
                    <h2 class="text-white text-[32px] font-medium mb-6 leading-[1.1]">
                        Extended-life Glass Protection
                    </h2>
                    <p class="text-[18px] leading-[135%] text-[#9D9D9C]">
                        Ultra-strong tempered glass with advanced anti-reflective coating ensures maximum transparency, impact resistance, and long-term durability in extreme climates.
                    </p>
                </div>
            </div>
            <!-- Правая панель: Визуал и логотип -->
            <div class="w-full overflow-hidden absolute top-0 left-0 z-[-10] h-full">
                <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_3.png" alt="DuraGlassX Technology" class="w-full h-full object-cover">
                <!-- Логотип DuraGlassX -->
                <div class="absolute top-8 right-8 z-10">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single2.svg" alt="DuraGlassX™" class="h-8 max-w-[280px]">
                </div>
            </div>
        </div>

        <!-- Секция 3: Aluforce Black-Frame -->
        <!-- Мобильная версия -->
        <div class="lg:hidden flex flex-col gap-0">
            <div class="relative w-full h-[250px] overflow-hidden">
                <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_2.png" alt="Aluforce Black-Frame Technology" class="w-full h-full object-cover">
                <div class="absolute top-8 left-6 z-10">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single3.svg" alt="Aluforce Black-Frame" class="max-w-[180px] h-8">
                </div>
            </div>
            <div class="bg-black flex items-center px-6 py-8">
                <div class="w-full">
                    <h2 class="text-white text-[20px] font-medium mb-3 leading-[1.1]">
                        Reinforced Anodized Aluminum Frame
                    </h2>
                    <p class="text-[14px] leading-[135%] text-[#9D9D9C] tracking-[-0.02em]">
                        Reinforced anodized aluminum provides superior strength, corrosion resistance, and stability under heavy wind and snow loads.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Десктопная версия -->
        <div class="hidden lg:flex w-full justify-end gap-0 relative h-[400px] overflow-hidden rounded-[7px]">
            <!-- Левая панель: Визуал и логотип -->
            <div class="w-full overflow-hidden absolute top-0 left-0 z-[-10] h-full">
                <img src="<?php echo get_template_directory_uri(); ?>/img/home_sect_4_2.png" alt="Aluforce Black-Frame Technology" class="w-full h-full object-cover">
                <!-- Логотип Aluforce -->
                <div class="absolute top-8 left-8 z-10">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/technologes-single3.svg" alt="Aluforce Black-Frame" class="max-w-[280px] h-8">
                </div>
            </div>
            <!-- Правая панель: Описание -->
            <div class="bg-black/60 flex items-start px-12 lg:px-16 py-16 lg:pt-8 lg:pb-10 lg:w-[525px]">
                <div class="w-full">
                    <h2 class="text-white text-[32px] font-medium mb-6 leading-[1.1]">
                        Reinforced Anodized Aluminum Frame
                    </h2>
                    <p class="text-[18px] leading-[135%] text-[#9D9D9C] tracking-[-0.02em]">
                        Reinforced anodized aluminum provides superior strength, corrosion resistance, and stability under heavy wind and snow loads.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Секция Why our technology matters -->
<section class="why-technology-section w-full pb-12 md:pb-20 lg:pb-24">
    <div class="max-w-[900px] mx-auto lg:px-0 px-4">
        <!-- Заголовок секции -->
        <div class="text-center mb-6 md:mb-8">
            <h2 class="text-white text-[24px] md:text-[32px] lg:text-[40px] font-medium mb-4 leading-[1.1]">
                Why our technology matters
            </h2>
            <p class="text-white text-[14px] md:text-[16px] lg:text-[18px] leading-[135%] text-white/80 max-w-[800px] mx-auto ">
                Each of these technologies gives Swiss Solar modules measurable advantages compared to conventional solar panels.
            </p>
        </div>

        <!-- Мобильная версия с изображением -->
        <div class="lg:hidden">
            <div class="bg-white  overflow-hidden shadow-lg mb-6 rounded-[32px]">
                <img src="<?php echo get_template_directory_uri(); ?>/img/1.jpg" alt="Swiss Solar vs other solar modules comparison" class="w-full h-auto">
            </div>
        </div>

        <!-- Мобильная версия с изображением -->
        <div class="lg:hidden">
            <div class="bg-white  overflow-hidden shadow-lg rounded-[32px] mb-6">
                <img src="<?php echo get_template_directory_uri(); ?>/img/2.jpg" alt="Swiss Solar vs other solar modules comparison" class="w-full h-auto">
            </div>
        </div>

        <div class="lg:hidden">
            <div class="bg-white  overflow-hidden shadow-lg rounded-[32px] mb-6">
                <img src="<?php echo get_template_directory_uri(); ?>/img/3.jpg" alt="Swiss Solar vs other solar modules comparison" class="w-full h-auto">
            </div>
        </div>

        <div class="lg:hidden">
            <div class="bg-white  overflow-hidden shadow-lg rounded-[32px] mb-6">
                <img src="<?php echo get_template_directory_uri(); ?>/img/4.jpg" alt="Swiss Solar vs other solar modules comparison" class="w-full h-auto">
            </div>
        </div>

        <div class="lg:hidden">
            <div class="bg-white  overflow-hidden shadow-lg rounded-[32px]">
                <img src="<?php echo get_template_directory_uri(); ?>/img/5.jpg" alt="Swiss Solar vs other solar modules comparison" class="w-full h-auto">
            </div>
        </div>

        <!-- Десктопная версия с изображением -->
        <div class="hidden lg:block mb-12">
            <div class="bg-white  overflow-hidden shadow-lg rounded-[32px]">
                <img src="<?php echo get_template_directory_uri(); ?>/img/1.jpg" alt="Swiss Solar vs other solar modules comparison" class="w-full h-auto">
            </div>
        </div>

        <div class="hidden lg:block mb-12">
            <div class="bg-white  overflow-hidden shadow-lg rounded-[32px]">
                <img src="<?php echo get_template_directory_uri(); ?>/img/2.jpg" alt="Swiss Solar vs other solar modules comparison" class="w-full h-auto">
            </div>
        </div>

        <div class="hidden lg:block mb-12">
            <div class="bg-white  overflow-hidden shadow-lg rounded-[32px]">
                <img src="<?php echo get_template_directory_uri(); ?>/img/3.jpg" alt="Swiss Solar vs other solar modules comparison" class="w-full h-auto">
            </div>
        </div>


        <div class="hidden lg:block mb-12">
            <div class="bg-white  overflow-hidden shadow-lg rounded-[32px]">
                <img src="<?php echo get_template_directory_uri(); ?>/img/4.jpg" alt="Swiss Solar vs other solar modules comparison" class="w-full h-auto">
            </div>
        </div>

        <div class="hidden lg:block">
            <div class="bg-white  overflow-hidden shadow-lg rounded-[32px]">
                <img src="<?php echo get_template_directory_uri(); ?>/img/5.jpg" alt="Swiss Solar vs other solar modules comparison" class="w-full h-auto">
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>

