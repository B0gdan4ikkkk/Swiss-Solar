<?php
/**
 * Template Name: About Us Page
 * Шаблон страницы About Us
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();
?>

<section class="hero__sect-shop w-screen flex items-start md:items-center justify-center relative mb-3 md:mb-0">
    <div class="w-full h-full relative z-10 flex flex-col md:grid md:grid-cols-2 items-start md:items-center justify-end md:justify-start container">
        <h1 class="font-mediumg text-[20px] md:text-[32px] text-white md:ml-[100px] md:h-[208px]">Who We Are.</h1>
        <div class="text-[16px] md:text-[18px] text-[#757575] space-y-4 max-w-[380px] hidden md:block">
            <p>SWISS GROUP AG is a Swiss company specializing in scientific research and the implementation of innovative standards in the field of solar energy.</p>
            <p>The company owns the brand Swiss Solar, which represents premium quality and reliability of next-generation solar modules.</p>
        </div>
    </div>
    <div class="absolute top-[-89px] md:top-[-96px] right-0 w-screen h-[60dvh] md:h-screen">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about-baner.jpg" alt="baner" class="hidden md:block w-full h-full z-[-10000]">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about-baner-mob.jpg" alt="baner" class="md:hidden w-full h-full z-[-10000]">
    </div>
</section>

<div class="text-[16px] md:text-[18px] text-[#757575] space-y-4 md:hidden block container  ">
    <p class="pt-4 border-t border-[#757575]">SSWISS GROUP AG is a Swiss company specializing in scientific research and the implementation of innovative standards in the field of solar energy.</p>
    <p>The company owns the brand Swiss Solar, which represents premium quality and reliability of next-generation solar modules.</p>
</div>

<div class="flex-col flex mt-10 md:mt-0">
<!-- Секция Vision and Strategy -->
<section class="vision-strategy-section w-full md:pt-16 lg:pt-20 pb-12 md:pb-[100px] lg:pb-[140px] bg-black order-2 md:order-none">
    <div class="">
        <div class="max-w-[1230px] mx-auto px-4">
            
            <!-- Секция Our Vision of Solar Excellence -->
            <div class="mb-10 md:mb-12 lg:mb-16">
                <div class="mb-4 md:mb-6">
                    <h2 class="text-white text-[20px] md:text-[32px] font-medium leading-[1.09] mb-2">
                        Our Vision
                        <br>
                        of Solar Excellence
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-12 lg:gap-16 border-[#757575] border-t pt-4 md:pt-6">
                    <div>
                        <p class="text-[#757575] text-[16px] md:text-[18px] leading-[140%]">
                            At Swiss Solar, we believe that clean energy should be both accessible and enduring.
                        </p>
                    </div>
                    <div>
                        <p class="text-[#757575] text-[16px] md:text-[18px] leading-[140%]">
                            Rooted in Swiss engineering traditions, we design solar modules that perform under extreme conditions and stand the test of time. Every product reflects our commitment to precision, quality, and sustainability.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Секция Strategy -->
            <div>
                <div class="mb-4 md:mb-6">
                    <h2 class="text-white text-[20px] md:text-[32px] font-medium leading-[1.1]">
                        Strategy
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-12 lg:gap-16 border-[#757575] border-t pt-4 md:pt-6">
                    <div>
                        <p class="text-[#757575] text-[16px] md:text-[18px] leading-[140%]">
                            Swiss Solar strives to expand worldwide to provide customers with quick access to our services and products. We constantly increase investments in research and development of new products to offer customers only state-of-the-art solutions that will enable them to implement projects with the lowest LCOE.
                        </p>
                    </div>
                    <div>
                        <p class="text-[#757575] text-[16px] md:text-[18px] leading-[140%]">
                            We are continuously improving the power, performance and reliability of our modules to achieve their technological advantage in the market and become the world's leading supplier of innovative solar modules.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Секция с изображением и текстом -->
<section class="production-section w-full mb-10 md:mb-16 order-1 md:order-none">
    <div class="flex flex-col lg:flex-row">
        <!-- Левая часть - изображение -->
        <div class="w-full lg:max-w-[500px] max-h-[150px] sm:max-h-[300px] md:max-h-full flex-shrink-0">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/front-page-3sect.png'); ?>" alt="Swiss Solar Production" class="w-full h-full object-cover max-h-[150px] sm:max-h-[300px] md:max-h-full">
        </div>
        
        <!-- Правая часть - текст на фоне #4A5C47 -->
        <div class="w-full bg-[#4A5C47] flex items-center py-12 md:py-16 lg:py-20 px-6 md:px-12 lg:px-16">
            <div class="lg:max-w-2xl flex flex-col items-center sm:items-start">
                <h2 class="text-[#F3F3F3] text-[28px] md:text-[32px] font-medium mb-4 md:mb-8 leading-[1.09] tracking-[-2%] md:max-w-[537px]">
                    All Swiss Solar™ panels are manufactured
                    at a certified Tier 1 factory using proprietary
                    patented technologies.
                </h2>
                <p class="text-white/70 text-[17px] md:text-[24px] mb-6 md:mb-12 leading-[135%] lg:max-w-[508px] tracking-[-2%]">
                    The company's total production capacity reaches 8.65 GW of solar modules per year, ensuring stable supply for large international projects.
                </p>
                <a href="<?php echo home_url('/about-us/'); ?>" class="inline-flex items-center gap-2 text-white text-base font-medium hover:opacity-80 transition-opacity leading-[120%]">
                    Read more about us
                   <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-sect-3.svg" alt="arrow" class="w-3 h-3">
                </a>
            </div>
        </div>
    </div>
</section>


</div>

<section>
<div class="max-w-[1230px] mx-auto px-4 mb-12 md:mb-[192px]">
            
            <!-- Секция Our Vision of Solar Excellence -->
            <div class="">
                <div class="mb-4 md:mb-6">
                    <h2 class="text-white text-[20px] md:text-[32px] font-medium leading-[1.09] mb-2">       
                    Our future
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-12 lg:gap-16 border-[#757575] border-t pt-4 md:pt-6">
                    <div>
                        <p class="text-[#757575] text-[16px] md:text-[18px] leading-[140%]">
                        The strategic vision and ambitions of our international Swiss Solar team give us confidence in achieving our goals. Guided by innovation and precision, we continue to expand our presence and capabilities in the global solar energy market.
                        </p>
                    </div>
                    <div>
                        <p class="text-[#757575] text-[16px] md:text-[18px] leading-[140%]">
                        Continuous performance monitoring and adaptive goal-setting allow us to maintain a leading position in the field of integrated photovoltaic solutions. This disciplined approach ensures that every project reflects the reliability and excellence associated with Swiss engineering.
                        </p>
                    </div>
                </div>
            </div>
</div>
</section>

<div class=" w-full items-center justify-center flex">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/flag.svg'); ?>" alt="Swiss Flag" class="w-12 h-12 md:w-12 lg:h-12">
        </div>

<?php
get_footer();
?>

