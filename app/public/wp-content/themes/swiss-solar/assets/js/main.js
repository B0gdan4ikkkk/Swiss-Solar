/**
 * Основной JavaScript файл темы Swiss Solar
 */
(function() {
    'use strict';

    // Мобильное меню
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const burgerIcon = document.getElementById('burger-icon');
    const closeIcon = document.getElementById('close-icon');

    function openMobileMenu() {
        if (mobileMenu) {
            mobileMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (burgerIcon) burgerIcon.classList.add('hidden');
            if (closeIcon) closeIcon.classList.remove('hidden');
            if (menuToggle) menuToggle.setAttribute('aria-expanded', 'true');
            
            // Закрываем все подменю при открытии меню
            document.querySelectorAll('.mobile-submenu').forEach(function(submenu) {
                submenu.style.maxHeight = '0';
                submenu.style.opacity = '0';
            });
            
            // Сбрасываем все checkbox и стрелки
            document.querySelectorAll('.mobile-menu-checkbox').forEach(function(checkbox) {
                checkbox.checked = false;
            });
            
            document.querySelectorAll('.mobile-menu-arrow').forEach(function(arrow) {
                arrow.style.transform = 'rotate(0deg)';
            });
            
            // Инициализация подменю после открытия меню
            setTimeout(initMobileSubmenus, 100);
            
            // Обновление языков после открытия меню
            setTimeout(updateMobileLanguageNames, 150);
        }
    }

    function closeMobileMenu() {
        if (mobileMenu) {
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = '';
            if (burgerIcon) burgerIcon.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
            if (menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
            
            // Закрываем все подменю при закрытии меню
            document.querySelectorAll('.mobile-submenu').forEach(function(submenu) {
                submenu.style.maxHeight = '0';
                submenu.style.opacity = '0';
            });
            
            // Сбрасываем все checkbox и стрелки
            document.querySelectorAll('.mobile-menu-checkbox').forEach(function(checkbox) {
                checkbox.checked = false;
            });
            
            document.querySelectorAll('.mobile-menu-arrow').forEach(function(arrow) {
                arrow.style.transform = 'rotate(0deg)';
            });
        }
    }

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            if (isExpanded) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }

    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMobileMenu);
    }

    // Закрытие меню при клике вне его области
    if (mobileMenu) {
        mobileMenu.addEventListener('click', function(e) {
            if (e.target === mobileMenu) {
                closeMobileMenu();
            }
        });
    }

    // Управление подменю в мобильном меню
    function initMobileSubmenus() {
        const menuToggles = document.querySelectorAll('.mobile-menu-item-toggle');
        
        menuToggles.forEach(function(toggle) {
            // Проверяем, не добавлен ли уже обработчик
            if (toggle.hasAttribute('data-initialized')) {
                return;
            }
            toggle.setAttribute('data-initialized', 'true');
            
            // Находим соответствующий checkbox и подменю
            const checkbox = toggle.previousElementSibling;
            const submenu = toggle.nextElementSibling;
            const arrow = toggle.querySelector('.mobile-menu-arrow');
            
            // Проверяем, что подменю существует и имеет правильный класс
            if (!submenu || !submenu.classList.contains('mobile-submenu')) {
                return;
            }
            
            // Изначально скрываем подменю через JavaScript
            submenu.style.maxHeight = '0';
            submenu.style.opacity = '0';
            
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Определяем, открыто ли подменю
                const currentHeight = submenu.style.maxHeight || window.getComputedStyle(submenu).maxHeight;
                const isOpen = currentHeight !== '0px' && currentHeight !== '0' && currentHeight !== '';
                
                // Закрываем все другие подменю
                document.querySelectorAll('.mobile-submenu').forEach(function(sub) {
                    if (sub !== submenu) {
                        sub.style.maxHeight = '0';
                        sub.style.opacity = '0';
                        // Сбрасываем checkbox других подменю
                        const otherGroup = sub.closest('.mobile-menu-group');
                        if (otherGroup) {
                            const otherCheckbox = otherGroup.querySelector('.mobile-menu-checkbox');
                            const otherToggle = otherGroup.querySelector('.mobile-menu-item-toggle');
                            if (otherCheckbox) otherCheckbox.checked = false;
                            if (otherToggle) {
                                const otherArrow = otherToggle.querySelector('.mobile-menu-arrow');
                                if (otherArrow) {
                                    otherArrow.style.transform = 'rotate(0deg)';
                                }
                            }
                        }
                    }
                });
                
                // Переключаем текущее подменю
                if (isOpen) {
                    // Закрываем
                    submenu.style.maxHeight = '0';
                    submenu.style.opacity = '0';
                    if (checkbox) checkbox.checked = false;
                    if (arrow) {
                        arrow.style.transform = 'rotate(0deg)';
                    }
                } else {
                    // Открываем
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    submenu.style.opacity = '1';
                    if (checkbox) checkbox.checked = true;
                    if (arrow) {
                        arrow.style.transform = 'rotate(90deg)';
                    }
                }
            });
        });
    }

    // Инициализация при загрузке страницы
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileSubmenus);
    } else {
        initMobileSubmenus();
    }

    // Дропдаун языков
    const languageToggle = document.getElementById('language-toggle');
    const languageDropdown = document.getElementById('language-dropdown');

    if (languageToggle && languageDropdown) {
        languageToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            languageDropdown.classList.toggle('hidden');
        });

        // Закрытие при клике вне дропдауна
        document.addEventListener('click', function(e) {
            if (!languageDropdown.contains(e.target) && !languageToggle.contains(e.target)) {
                languageDropdown.classList.add('hidden');
            }
        });

        // Закрываем дропдаун при клике на ссылку языка
        const languageItems = document.querySelectorAll('.gt_language_code');
        languageItems.forEach(function(item) {
            item.addEventListener('click', function() {
                languageDropdown.classList.add('hidden');
            });
        });
    }

    // Инициализация Swiper слайдера с кастомной пагинацией
    function initHeroSwiper() {
        const heroSwiperElement = document.querySelector('.hero-swiper');
        
        if (heroSwiperElement && typeof Swiper !== 'undefined') {
            const swiper = new Swiper('.hero-swiper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                speed: 1000,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                on: {
                    init: function() {
                        initCustomPagination(this);
                        updateCustomPagination(this);
                    },
                    slideChange: function() {
                        updateCustomPagination(this);
                    },
                },
            });

            // Инициализация кастомной пагинации
            function initCustomPagination(swiperInstance) {
                const paginationContainer = document.querySelector('.pagination-lines');
                const slideCount = swiperInstance.slides.length;
                
                // Определяем реальное количество слайдов (без дубликатов от loop)
                const realSlideCount = slideCount > 3 ? Math.floor(slideCount / 2) : slideCount;
                
                // Создаем линии
                for (let i = 0; i < realSlideCount; i++) {
                    const line = document.createElement('div');
                    line.className = 'pagination-line';
                    line.addEventListener('click', function() {
                        swiperInstance.slideToLoop(i);
                    });
                    paginationContainer.appendChild(line);
                }

                // Клики по тексту
                const labels = document.querySelectorAll('.pagination-label');
                labels.forEach((label, index) => {
                    label.addEventListener('click', function() {
                        swiperInstance.slideToLoop(index);
                    });
                });
            }

            // Функция обновления кастомной пагинации
            function updateCustomPagination(swiperInstance) {
                const lines = document.querySelectorAll('.pagination-line');
                const labels = document.querySelectorAll('.pagination-label');
                const realIndex = swiperInstance.realIndex;

                // Обновляем линии
                lines.forEach((line, index) => {
                    line.classList.remove('active');
                    if (index === realIndex) {
                        line.classList.add('active');
                    }
                });

                // Обновляем тексты
                labels.forEach((label, index) => {
                    label.classList.remove('active');
                    if (index === realIndex) {
                        label.classList.add('active');
                        label.style.color = 'white';
                    } else {
                        label.style.color = '#9CA3AF';
                    }
                });
            }
        }
    }

    // Дропдаун меню при наведении на ссылки меню
    const headerDropdown = document.getElementById('header-dropdown');
    const primaryMenu = document.getElementById('primary-menu');
    const headerContainer = document.querySelector('.header-container');

    if (headerDropdown && primaryMenu && headerContainer) {
        let hoverTimeout;
        const menuLinks = primaryMenu.querySelectorAll('a');

        // Функция показа дропдауна
        function showDropdown() {
            clearTimeout(hoverTimeout);
            headerDropdown.classList.remove('hidden');
            headerContainer.classList.add('dropdown-open');
        }

        // Функция скрытия дропдауна
        function hideDropdown() {
            hoverTimeout = setTimeout(function() {
                headerDropdown.classList.add('hidden');
                headerContainer.classList.remove('dropdown-open');
            }, 200);
        }

        // Добавляем обработчики на каждую ссылку меню
        menuLinks.forEach(function(link) {
            link.addEventListener('mouseenter', showDropdown);
            link.addEventListener('mouseleave', hideDropdown);
        });

        // Предотвращаем закрытие при наведении на сам дропдаун
        headerDropdown.addEventListener('mouseenter', function() {
            clearTimeout(hoverTimeout);
        });

        headerDropdown.addEventListener('mouseleave', function() {
            headerDropdown.classList.add('hidden');
            headerContainer.classList.remove('dropdown-open');
        });
    }

    // Управление языками в мобильном меню
    const languageMap = {
        'cs': 'Czech',
        'en': 'English',
        'de': 'German',
        'pl': 'Polish'
    };

    function updateMobileLanguageNames() {
        const languageLinks = document.querySelectorAll('.mobile-menu-languages-list .glink, .mobile-menu-languages-list .gt_language_code');
        const currentLanguageSpan = document.querySelector('.mobile-current-language');

        languageLinks.forEach(function(link, index) {
            const langCode = link.getAttribute('data-gt-lang');
            if (langCode && languageMap[langCode]) {
                // Заменяем текст на полное название
                link.textContent = languageMap[langCode];
                
                // Применяем стили как у других пунктов подменю
                link.classList.add('mobile-menu-item', 'mx-4', 'text-white');
                
                // Добавляем отступы для первого и последнего элемента
                if (index === 0) {
                    link.classList.add('mt-2');
                } else {
                    link.classList.remove('mt-2');
                }
                if (index === languageLinks.length - 1) {
                    link.classList.add('mb-2');
                } else {
                    link.classList.remove('mb-2');
                }
            }
        });

        // Обновляем текущий язык в заголовке
        const currentLangLink = document.querySelector('.mobile-menu-languages-list .gt-current-lang');
        if (currentLangLink && currentLanguageSpan) {
            const currentLangCode = currentLangLink.getAttribute('data-gt-lang');
            if (currentLangCode && languageMap[currentLangCode]) {
                currentLanguageSpan.textContent = languageMap[currentLangCode];
            }
        }
    }

    function initMobileLanguages() {
        // Инициализация при загрузке
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(updateMobileLanguageNames, 200);
            });
        } else {
            setTimeout(updateMobileLanguageNames, 200);
        }

        // Обновление при изменении языка (GTranslate может динамически менять классы)
        const observer = new MutationObserver(function(mutations) {
            let shouldUpdate = false;
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    shouldUpdate = true;
                } else if (mutation.type === 'childList') {
                    shouldUpdate = true;
                }
            });
            if (shouldUpdate) {
                setTimeout(updateMobileLanguageNames, 50);
            }
        });

        // Наблюдаем за изменениями в списке языков
        const languagesList = document.querySelector('.mobile-menu-languages-list');
        if (languagesList) {
            observer.observe(languagesList, {
                attributes: true,
                attributeFilter: ['class'],
                subtree: true,
                childList: true
            });
        }

        // Также обновляем при клике на язык
        document.addEventListener('click', function(e) {
            if (e.target.closest('.mobile-menu-languages-list .glink, .mobile-menu-languages-list .gt_language_code')) {
                setTimeout(updateMobileLanguageNames, 100);
            }
        });
    }

    // Инициализация языков
    initMobileLanguages();

    // Инициализация при загрузке DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHeroSwiper);
    } else {
        initHeroSwiper();
    }

    // Инициализация TOPCon Technology слайдера с кастомными точками и лейблами
    function initTopconSwiper() {
        const topconSwiperElement = document.querySelector('.topcon-swiper');
        
        if (topconSwiperElement && typeof Swiper !== 'undefined') {
            const isMobile = window.innerWidth < 768;
            let paginationSwiper = null;

            // Основной слайдер изображений
            const mainSwiper = new Swiper('.topcon-swiper', {
                loop: false, // Отключаем бесконечный loop
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                speed: 1000,
                effect: '',
                fadeEffect: {
                    crossFade: true
                },
                on: {
                    init: function() {
                        if (isMobile) {
                            initMobilePaginationSlider(this);
                        } else {
                            initDesktopPagination(this);
                        }
                    },
                    slideChange: function() {
                        if (isMobile) {
                            updateMobilePagination(this);
                        } else {
                            updateDesktopPagination(this);
                        }
                    },
                },
            });

            // Инициализация мобильного слайдера пагинации
            function initMobilePaginationSlider(mainSwiperInstance) {
                const paginationSwiperElement = document.querySelector('.topcon-pagination-swiper');
                
                if (!paginationSwiperElement) return;

                // Создаем слайдер пагинации для мобильных
                paginationSwiper = new Swiper('.topcon-pagination-swiper', {
                    slidesPerView: 'auto', // Автоматическая ширина слайдов
                    spaceBetween: 16, // Отступ между слайдами
                    speed: 1000,
                    loop: false, // Отключаем бесконечный loop
                    allowTouchMove: false, // Отключаем свайп на пагинации
                });

                // Синхронизация: клики по элементам пагинации переключают основной слайдер
                const paginationItems = document.querySelectorAll('.topcon-pagination-item-mobile');
                paginationItems.forEach((item, index) => {
                    item.addEventListener('click', function() {
                        mainSwiperInstance.slideTo(index);
                    });
                });
            }

            // Обновление мобильной пагинации
            function updateMobilePagination(mainSwiperInstance) {
                const activeIndex = mainSwiperInstance.activeIndex;
                const lines = document.querySelectorAll('.topcon-pagination-line-mobile');
                const labels = document.querySelectorAll('.topcon-pagination-label-mobile');

                // Переключаем слайд пагинации
                if (paginationSwiper) {
                    paginationSwiper.slideTo(activeIndex);
                }

                // Обновляем стили линий
                lines.forEach((line, index) => {
                    line.classList.remove('active');
                    if (index === activeIndex) {
                        line.classList.add('active');
                    }
                });

                // Обновляем стили лейблов
                labels.forEach((label, index) => {
                    if (index === activeIndex) {
                        label.style.color = 'white';
                    } else {
                        label.style.color = '#757575';
                    }
                });
            }

            // Инициализация десктопной статичной пагинации
            function initDesktopPagination(mainSwiperInstance) {
                const paginationLinesContainer = document.querySelector('.topcon-pagination-lines-desktop');
                const paginationItems = document.querySelectorAll('.topcon-pagination-item-desktop');
                const slideCount = mainSwiperInstance.slides.length;
                
                if (!paginationLinesContainer) return;
                
                // Создаем линии для каждого слайда
                for (let i = 0; i < slideCount; i++) {
                    const line = document.createElement('div');
                    line.className = 'topcon-pagination-line-desktop';
                    
                    if (i === 0) {
                        line.classList.add('active');
                    }
                    
                    line.addEventListener('click', function() {
                        mainSwiperInstance.slideTo(i);
                    });
                    
                    paginationLinesContainer.appendChild(line);
                }

                // Клики по элементам пагинации
                paginationItems.forEach((item, index) => {
                    item.addEventListener('click', function() {
                        mainSwiperInstance.slideTo(index);
                    });
                });
            }

            // Обновление десктопной пагинации
            function updateDesktopPagination(mainSwiperInstance) {
                const activeIndex = mainSwiperInstance.activeIndex;
                const lines = document.querySelectorAll('.topcon-pagination-line-desktop');
                const labels = document.querySelectorAll('.topcon-pagination-label-desktop');
                const items = document.querySelectorAll('.topcon-pagination-item-desktop');

                // Обновляем линии (активная линия flex: 2, остальные flex: 1)
                lines.forEach((line, index) => {
                    line.classList.remove('active');
                    if (index === activeIndex) {
                        line.classList.add('active');
                    }
                });

                // Обновляем элементы (активный элемент flex: 2, остальные flex: 1)
                items.forEach((item, index) => {
                    item.classList.remove('active');
                    if (index === activeIndex) {
                        item.classList.add('active');
                    }
                });

                // Обновляем лейблы
                labels.forEach((label, index) => {
                    label.classList.remove('active');
                    if (index === activeIndex) {
                        label.style.color = 'white';
                    } else {
                        label.style.color = '#757575';
                    }
                });
            }

            // Реинициализация при изменении размера экрана
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    const newIsMobile = window.innerWidth < 768;
                    if (isMobile !== newIsMobile) {
                        location.reload();
                    }
                }, 250);
            });
        }
    }

    // Инициализация TOPCon слайдера при загрузке DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTopconSwiper);
    } else {
        initTopconSwiper();
    }

    // Инициализация переключения табов на странице магазина
    function initShopTabs() {
        const tabs = document.querySelectorAll('.shop-tab');
        const productCards = document.querySelectorAll('.product-card');
        
        // Проверяем наличие параметра поиска в URL
        const urlParams = new URLSearchParams(window.location.search);
        const hasSearch = urlParams.has('product_search');
        
        // Если есть поиск, показываем все найденные продукты
        if (hasSearch) {
            productCards.forEach(card => {
                card.style.display = 'block';
            });
        }
        
        if (tabs.length === 0) return;
        
        // Инициализация при загрузке страницы (только если нет поиска)
        if (!hasSearch) {
            // Находим активный таб или делаем активным первый
            let activeTab = document.querySelector('.shop-tab.active');
            if (!activeTab && tabs.length > 0) {
                activeTab = tabs[0];
                activeTab.classList.add('active');
            }
            
            // Устанавливаем правильные стили для активного таба
            if (activeTab) {
                activeTab.style.color = 'white';
                const activeUnderline = activeTab.querySelector('.tab-underline');
                if (activeUnderline) {
                    activeUnderline.style.backgroundColor = '#EA0029';
                }
                
                // Фильтруем продукты по активной категории
                const selectedCategory = activeTab.getAttribute('data-category');
                productCards.forEach(card => {
                    const cardCategories = card.getAttribute('data-categories');
                    if (selectedCategory === 'all' || (cardCategories && cardCategories.includes(selectedCategory))) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        }
        
        // Обработчики кликов
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const selectedCategory = this.getAttribute('data-category');
                
                // Если есть параметр поиска, убираем его из URL
                if (hasSearch) {
                    urlParams.delete('product_search');
                    const newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
                    window.location.href = newUrl;
                    return;
                }
                
                // Обновляем активный таб
                tabs.forEach(t => {
                    t.classList.remove('active');
                    // Сбрасываем цвет текста на серый
                    t.style.color = '#757575';
                    // Сбрасываем цвет линии на серый
                    const underline = t.querySelector('.tab-underline');
                    if (underline) {
                        underline.style.backgroundColor = '#757575';
                    }
                });
                
                // Устанавливаем активный таб
                this.classList.add('active');
                this.style.color = 'white';
                const activeUnderline = this.querySelector('.tab-underline');
                if (activeUnderline) {
                    activeUnderline.style.backgroundColor = '#EA0029';
                }
                
                // Фильтруем продукты по категории
                productCards.forEach(card => {
                    const cardCategories = card.getAttribute('data-categories');
                    
                    if (selectedCategory === 'all' || (cardCategories && cardCategories.includes(selectedCategory))) {
                        card.style.display = 'block';
                        // Анимация появления
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        
                        setTimeout(() => {
                            card.style.transition = 'all 0.5s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 100);
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // Инициализация табов магазина при загрузке DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initShopTabs);
    } else {
        initShopTabs();
    }

    // Инициализация Swiper для секции Products на главной странице
    function initProductsSwiper() {
        const productsSwiperEl = document.querySelector('.products-swiper-home');
        if (!productsSwiperEl) return;

        const productsSwiper = new Swiper('.products-swiper-home', {
            slidesPerView: 1.25,
            spaceBetween: 12,
            speed: 600,
            slidesOffsetBefore: 20,
            slidesOffsetAfter: 20,
            navigation: {
                nextEl: '.products-swiper-next',
                prevEl: '.products-swiper-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 1.2,
                    spaceBetween: 12,
                    slidesOffsetBefore: 0,
                    slidesOffsetAfter: 0,
                },
                1024: {
                    slidesPerView: 2,
                    spaceBetween: 12,
                    slidesOffsetBefore: 0,
                    slidesOffsetAfter: 0,
                }
            }
        });
    }

    // Инициализация Products Swiper при загрузке DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initProductsSwiper);
    } else {
        initProductsSwiper();
    }

    // Инициализация Swiper для секции References (мобильные устройства)
    function initReferencesSwiper() {
        const referencesSwiperEl = document.querySelector('.projects-swiper-refs');
        if (!referencesSwiperEl) return;

        const referencesSwiper = new Swiper('.projects-swiper-refs', {
            slidesPerView: 1.25,
            spaceBetween: 12,
            speed: 600,
            slidesOffsetBefore: 20,
            slidesOffsetAfter: 20,
            breakpoints: {
                768: {
                    slidesPerView: 1.25,
                    spaceBetween: 12,
                    slidesOffsetBefore: 20,
                    slidesOffsetAfter: 20,
                }
            }
        });
    }

    // Инициализация References Swiper при загрузке DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initReferencesSwiper);
    } else {
        initReferencesSwiper();
    }

    // Инициализация FAQ аккордеонов
    function initFAQAccordions() {
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.closest('.faq-item');
                const answer = faqItem.querySelector('.faq-answer');
                const arrow = faqItem.querySelector('.faq-arrow img');
                const isOpen = !answer.classList.contains('hidden');
                
                // Закрываем все остальные аккордеоны
                document.querySelectorAll('.faq-item').forEach(item => {
                    if (item !== faqItem) {
                        const otherAnswer = item.querySelector('.faq-answer');
                        const otherArrow = item.querySelector('.faq-arrow img');
                        otherAnswer.classList.add('hidden');
                        otherArrow.style.transform = 'rotate(0deg)';
                    }
                });
                
                // Переключаем текущий аккордеон
                if (isOpen) {
                    answer.classList.add('hidden');
                    arrow.style.transform = 'rotate(0deg)';
                } else {
                    answer.classList.remove('hidden');
                    arrow.style.transform = 'rotate(90deg)';
                }
            });
        });
    }

    // Инициализация FAQ аккордеонов при загрузке DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFAQAccordions);
    } else {
        initFAQAccordions();
    }

    // Модальное окно поиска
    const searchToggle = document.getElementById('search-toggle');
    const searchModal = document.getElementById('search-modal');
    const searchClose = document.getElementById('search-close');
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    const searchResultsContent = document.getElementById('search-results-content');
    
    let searchTimeout;

    // Открытие модального окна поиска
    function openSearchModal() {
        if (searchModal) {
            searchModal.classList.remove('hidden');
            // Не блокируем скролл body, так как модальное окно находится в хедере
            // Фокус на поле ввода после небольшой задержки для анимации
            setTimeout(() => {
                if (searchInput) {
                    searchInput.focus();
                }
            }, 100);
        }
    }

    // Закрытие модального окна поиска
    function closeSearchModal() {
        if (searchModal) {
            searchModal.classList.add('hidden');
            if (searchInput) {
                searchInput.value = '';
            }
            if (searchResults) {
                searchResults.classList.add('hidden');
            }
            if (searchResultsContent) {
                searchResultsContent.innerHTML = '';
            }
        }
    }

    // Обработчик открытия поиска
    if (searchToggle) {
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            openSearchModal();
        });
    }

    // Обработчик закрытия поиска
    if (searchClose) {
        searchClose.addEventListener('click', function(e) {
            e.preventDefault();
            closeSearchModal();
        });
    }

    // Закрытие при нажатии Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && searchModal && !searchModal.classList.contains('hidden')) {
            closeSearchModal();
        }
    });

    // Закрытие при клике вне модального окна
    if (searchModal) {
        searchModal.addEventListener('click', function(e) {
            if (e.target === searchModal) {
                closeSearchModal();
            }
        });
    }

    // Поиск продуктов WooCommerce
    function searchProducts(query) {
        if (!query || query.length < 2) {
            if (searchResults) {
                searchResults.classList.add('hidden');
            }
            if (searchResultsContent) {
                searchResultsContent.innerHTML = '';
            }
            return;
        }

        // Проверяем наличие объекта swissSolarAjax
        if (typeof swissSolarAjax === 'undefined') {
            console.error('swissSolarAjax is not defined');
            if (searchResultsContent) {
                searchResultsContent.innerHTML = '<div class="search-no-results">Error: search object not initialized</div>';
            }
            return;
        }

        // Показываем индикатор загрузки
        if (searchResultsContent) {
            searchResultsContent.innerHTML = '<div class="search-loading">Searching...</div>';
        }
        if (searchResults) {
            searchResults.classList.remove('hidden');
        }

        // AJAX запрос для поиска продуктов
        const formData = new FormData();
        formData.append('action', 'swiss_solar_search_products');
        formData.append('query', query);
        formData.append('nonce', swissSolarAjax.nonce);

        fetch(swissSolarAjax.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (searchResultsContent) {
                if (data.success && data.data && data.data.length > 0) {
                    let html = '';
                    data.data.forEach(product => {
                        const image = product.image || '';
                        const price = product.price || '';
                        const title = product.title || 'No title';
                        const url = product.url || '#';
                        html += `
                            <a href="${url}" class="search-result-item">
                                ${image ? `<img src="${image}" alt="${title}">` : ''}
                                <h3>${title}</h3>
                                ${price ? `<div class="price">${price}</div>` : ''}
                            </a>
                        `;
                    });
                    searchResultsContent.innerHTML = html;
                } else {
                    searchResultsContent.innerHTML = '<div class="search-no-results">Nothing found</div>';
                }
            }
        })
        .catch(error => {
            console.error('Search error:', error);
            if (searchResultsContent) {
                searchResultsContent.innerHTML = '<div class="search-no-results">Error during search. Check console for details.</div>';
            }
        });
    }

    // Обработчик ввода в поле поиска - только Enter для поиска
    if (searchInput) {
        // Поиск при нажатии Enter - перенаправление на страницу shop
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const query = e.target.value.trim();
                if (query.length >= 2) {
                    // Закрываем модальное окно
                    closeSearchModal();
                    // Перенаправляем на страницу shop с параметром поиска
                    const shopUrl = '/shop/';
                    const searchUrl = shopUrl + '?product_search=' + encodeURIComponent(query);
                    window.location.href = searchUrl;
                }
            }
        });
    }

    // Обработка формы контактов
    const contactForm = document.getElementById('contact-form');
    const contactFormMessage = document.getElementById('contact-form-message');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Проверяем наличие объекта swissSolarAjax
            if (typeof swissSolarAjax === 'undefined') {
                console.error('swissSolarAjax is not defined');
                return;
            }
            
            // Скрываем предыдущие сообщения
            if (contactFormMessage) {
                contactFormMessage.classList.add('hidden');
                contactFormMessage.classList.remove('success', 'error');
            }
            
            // Получаем данные формы
            const formData = new FormData(contactForm);
            formData.append('action', 'swiss_solar_contact_form');
            formData.append('nonce', swissSolarAjax.contact_nonce);
            
            // Отключаем кнопку отправки
            const submitButton = contactForm.querySelector('button[type="submit"]');
            const originalButtonText = submitButton ? submitButton.textContent : '';
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Sending...';
            }
            
            // Отправляем AJAX запрос
            fetch(swissSolarAjax.ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (contactFormMessage) {
                    contactFormMessage.classList.remove('hidden');
                    
                    if (data.success) {
                        contactFormMessage.classList.add('success');
                        contactFormMessage.textContent = data.data.message || 'Thank you! Your message has been sent successfully.';
                        // Очищаем форму
                        contactForm.reset();
                    } else {
                        contactFormMessage.classList.add('error');
                        contactFormMessage.textContent = data.data.message || 'Sorry, there was an error sending your message. Please try again later.';
                    }
                }
                
                // Восстанавливаем кнопку
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.textContent = originalButtonText;
                }
                
                // Прокручиваем к сообщению
                if (contactFormMessage) {
                    contactFormMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            })
            .catch(error => {
                console.error('Contact form error:', error);
                if (contactFormMessage) {
                    contactFormMessage.classList.remove('hidden');
                    contactFormMessage.classList.add('error');
                    contactFormMessage.textContent = 'Sorry, there was an error sending your message. Please try again later.';
                }
                
                // Восстанавливаем кнопку
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.textContent = originalButtonText;
                }
            });
        });
    }

    // Кастомный выпадающий список для Salutation
    function initCustomSelect() {
        const selectWrapper = document.querySelector('.custom-select-wrapper');
        if (!selectWrapper) return;

        const button = selectWrapper.querySelector('.custom-select-button');
        const dropdown = selectWrapper.querySelector('.custom-select-dropdown');
        const hiddenInput = selectWrapper.querySelector('input[type="hidden"]');
        const options = dropdown.querySelectorAll('.custom-select-option');
        const valueDisplay = button.querySelector('.custom-select-value');

        // Открытие/закрытие dropdown
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const isExpanded = button.getAttribute('aria-expanded') === 'true';
            button.setAttribute('aria-expanded', !isExpanded);
            dropdown.classList.toggle('hidden');
        });

        // Выбор опции
        options.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const value = this.getAttribute('data-value');
                const text = this.textContent.trim();

                // Обновляем скрытое поле и отображаемое значение
                hiddenInput.value = value;
                valueDisplay.textContent = text;

                // Обновляем выбранную опцию
                options.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');

                // Закрываем dropdown
                button.setAttribute('aria-expanded', 'false');
                dropdown.classList.add('hidden');
            });
        });

        // Закрытие при клике вне dropdown
        document.addEventListener('click', function(e) {
            if (!selectWrapper.contains(e.target)) {
                button.setAttribute('aria-expanded', 'false');
                dropdown.classList.add('hidden');
            }
        });

        // Закрытие при нажатии Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                button.setAttribute('aria-expanded', 'false');
                dropdown.classList.add('hidden');
            }
        });

        // Устанавливаем начальное значение
        const initialOption = dropdown.querySelector('.custom-select-option[data-value="Mr"]');
        if (initialOption) {
            initialOption.classList.add('selected');
        }
    }

    // Инициализация кастомного select при загрузке DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCustomSelect);
    } else {
        initCustomSelect();
    }

})();

// Функция для обновления CSS переменной --vh (для решения проблемы с прыжками viewport на мобильных)
function updateVH() {
    const vh = window.innerHeight / 100;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}

// Обновляем переменную при загрузке страницы
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', updateVH);
} else {
    updateVH();
}

// Обновляем переменную при изменении размера окна (с debounce для производительности)
let resizeTimeout;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(updateVH, 100);
});

// Обновляем переменную при изменении ориентации устройства
window.addEventListener('orientationchange', function() {
    setTimeout(updateVH, 100);
});

// Также обновляем при изменении видимости страницы (на случай, если браузер изменил размер)
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        setTimeout(updateVH, 100);
    }
});