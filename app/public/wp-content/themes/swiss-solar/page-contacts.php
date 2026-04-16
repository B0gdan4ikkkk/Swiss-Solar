<?php
/**
 * Template Name: Contacts Page
 * Шаблон страницы контактов
 *
 * @package SwissSolar
 * @since 1.0.0
 */

get_header();
?>

<!-- Секция контактов -->
<section class="contacts-section w-full pt-20 md:pt-[100px] lg:pt-[130px] bg-black min-h-[90vh] pb-20">
    <div class="max-w-[1360px] mx-auto px-4 lg:px-[100px]">
        <div class="">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-start">
                
                <!-- Левая колонка: Форма -->
                <div class="lg:pr-8 lg:max-w-[500px]">
                    <h1 class="text-white text-[24px] md:text-[32px] font-medium leading-[1.09] mb-4">
                        Get in Touch
                    </h1>
                    
                    <form id="contact-form" class="contact-form space-y-4">
                        <!-- Salutation -->
                        <div class="lg:w-1/2 relative">
                            <label for="salutation" class="block text-white text-[14px] mb-2">Salutation</label>
                            <div class="custom-select-wrapper relative">
                                <input type="hidden" id="salutation" name="salutation" value="Mr" required>
                                <button type="button" class="custom-select-button w-full bg-transparent border border-[#757575] text-white px-4 py-2 text-[14px] rounded-[4px] focus:outline-none focus:border-[#EA0029] transition-colors text-left flex items-center justify-between cursor-pointer" aria-haspopup="listbox" aria-expanded="false">
                                    <span class="custom-select-value">Mr</span>
                                    <svg class="custom-select-arrow w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <ul class="custom-select-dropdown absolute top-full left-0 w-full bg-black border border-[#757575] mt-1 rounded-[4px] z-50 hidden max-h-48 overflow-y-auto">
                                    <li class="custom-select-option px-4 py-2 text-white text-[14px] cursor-pointer hover:bg-[#1B1B1B] transition-colors" data-value="Mr">Mr</li>
                                    <li class="custom-select-option px-4 py-2 text-white text-[14px] cursor-pointer hover:bg-[#1B1B1B] transition-colors" data-value="Mrs">Mrs</li>
                                    <li class="custom-select-option px-4 py-2 text-white text-[14px] cursor-pointer hover:bg-[#1B1B1B] transition-colors" data-value="Ms">Ms</li>
                                    <li class="custom-select-option px-4 py-2 text-white text-[14px] cursor-pointer hover:bg-[#1B1B1B] transition-colors" data-value="Dr">Dr</li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- First Name & Last Name -->
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label for="first_name" class="block text-white text-[14px] mb-2">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="w-full bg-transparent rounded-[4px] border border-[#757575] text-white px-4 py-2 text-[14px] focus:outline-none focus:border-[#EA0029] transition-colors" required>
                            </div>
                            <div>
                                <label for="last_name" class="block text-white text-[14px] mb-2">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="w-full bg-transparent rounded-[4px] border border-[#757575] text-white px-4 py-2 text-[14px] focus:outline-none focus:border-[#EA0029] transition-colors" required>
                            </div>
                        </div>
                        
                        <!-- Company/Organisation -->
                        <div>
                            <label for="company" class="block text-white text-[14px] mb-2">Company/Organisation</label>
                            <input type="text" id="company" name="company" class="w-full bg-transparent rounded-[4px] border border-[#757575] text-white px-4 py-2 text-[14px] md:text-[16px] focus:outline-none focus:border-[#EA0029] transition-colors">
                        </div>
                        
                        <!-- E-mail -->
                        <div>
                            <label for="email" class="block text-white text-[14px] mb-2">E-mail</label>
                            <input type="email" id="email" name="email" class="w-full bg-transparent rounded-[4px] border border-[#757575] text-white px-4 py-2 text-[14px] focus:outline-none focus:border-[#EA0029] transition-colors" required>
                        </div>
                        
                        <!-- Phone/Mobile No. -->
                        <div>
                            <label for="phone" class="block text-white text-[14px] mb-2">Phone/Mobile No.</label>
                            <input type="tel" id="phone" name="phone" class="w-full bg-transparent rounded-[4px] border border-[#757575] text-white px-4 py-2 text-[14px] focus:outline-none focus:border-[#EA0029] transition-colors">
                        </div>
                        
                        <!-- Your Message -->
                        <div>
                            <label for="message" class="block text-white text-[14px] mb-2">Your Message</label>
                            <textarea id="message" name="message" rows="3" class="w-full bg-transparent rounded-[4px] border border-[#757575] text-white px-4 py-2 text-[14px] focus:outline-none focus:border-[#EA0029] transition-colors resize-none" required></textarea>
                        </div>
                        
                        <!-- Newsletter Checkbox -->
                        <div class="space-y-2">
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input type="checkbox" id="newsletter" name="newsletter" value="1" class="custom-checkbox">
                                <span class="text-white text-[14px] font-medium uppercase leading-[140%]">
                                    YES, I WANT TO RECEIVE THE SWISS SOLAR NEWSLETTER
                                </span>
                            </label>
                            <p class="text-[#757575] text-[10px] uppercase leading-[100%]">
                                SUBSCRIBE TO OUR NEWSLETTER TO RECEIVE REGULAR UPDATES ON SWISS SOLAR PRODUCTS, EVENT, NEWS AND MORE. YOUR INFORMATION WILL NOT BE SHARED WITH THIRD PARTIES. YOU MAY CANCEL YOUR SUBSCRIPTION AT ANY TIME.
                            </p>
                        </div>
                        
                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="bg-[#1B1B1B] text-white px-4 md:px-8 py-[8px] md:py-[10px] gap-1 rounded-md text-[12px] md:text-[14px] font-medium hover:bg-[#EA0029] hidden lg:flex items-center transition-colors w-auto text-center" style="box-shadow: inset 0px 1px 1px rgba(255, 255, 255, 0.2);">
                                Submit
                            </button>
                        </div>
                        
                        <!-- Success/Error Messages -->
                        <div id="contact-form-message" class="hidden"></div>
                    </form>
                </div>
                
                <!-- Правая колонка: Описание и контакты -->
                <div class="">
                    <!-- Описание -->
                    <div class="lg:pb-16 pb-8 border-b border-[#757575] mb-6">
                        <p class="text-[#757575] text-[16px] md:text-[18px] leading-[140%] mb-4">
                        We’re here to answer your questions and provide all the information you need about Swiss Solar products, technologies, and partnerships.
                        </p>
                        <p class="text-[#757575] text-[16px] md:text-[18px] leading-[140%]">
                            Reach out to our team and we'll respond as soon as possible.
                        </p>
                    </div>
                    
                    <!-- Switzerland Contact Details -->
                    <div class="lg:pb-16 pb-8 border-b border-[#757575] mb-6">
                        <h2 class="text-white text-[24px] md:text-[32px] font-medium leading-[1.09] mb-2">
                            Switzerland
                        </h2>
                        
                        <div class="space-y-1 text-[#757575] text-[16px] md:text-[18px] leading-[140%]">
                            <p class="font-medium">
                                SSWISS GROUP AG
                            </p>
                            <p>
                                Baarerstrasse 25, 6300 Zug, Switzerland
                            </p>
                            <p>
                                Phone: <a href="tel:+41446880209" class="hover:text-[#EA0029] transition-colors underline">+41 446 880209</a>
                            </p>
                            <p>
                                E-Mail: <a href="mailto:info@swissenergy-solar.ch" class="hover:text-[#EA0029] transition-colors underline">info@swissenergy-solar.ch</a>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Netherlands Contact Details -->
                    <div>
                        <h2 class="text-white text-[24px] md:text-[32px] font-medium leading-[1.09] mb-2">
                            Netherlands
                        </h2>
                        
                        <div class="space-y-1 text-[#757575] text-[16px] md:text-[18px] leading-[140%]">
                            <p>
                                Monacoweg 2, Port 9310, 4455 SZ Nieuwdorp, The Netherlands
                            </p>
                            <p>
                                Phone: <a href="tel:+41446880209" class="hover:text-[#EA0029] transition-colors underline">+41 446 880209</a>
                            </p>
                            <p>
                                E-Mail: <a href="mailto:info@swissenergy-solar.ch" class="hover:text-[#EA0029] transition-colors underline">info@swissenergy-solar.ch</a>
                            </p>
                        </div>
                    </div>
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
