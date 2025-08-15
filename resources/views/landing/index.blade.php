<!DOCTYPE html>
<html class="scroll-smooth" lang="en">

<head>
    <meta charset="utf-8" />
    <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect" />
    <link as="style"
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Manrope%3Awght%40400%3B500%3B700%3B800&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900"
        onload="this.rel='stylesheet'" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    screens: {
                        'xs': '475px',
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @keyframes marquee-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        @keyframes marquee-right {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(0);
            }
        }

        :root {
            --primary-color: #4ade80;
            --background-color: #ffffff;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --surface-color: #f9fafb;
            --border-color: #e5e7eb;
        }

        body {
            font-family: Manrope, "Noto Sans", sans-serif;
        }

        .animate-marquee-left {
            animation: marquee-left 30s linear infinite;
        }

        .animate-marquee-right {
            animation: marquee-right 30s linear infinite;
        }

        /* Mobile menu styles */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        .mobile-menu-overlay {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .mobile-menu-overlay.open {
            opacity: 1;
            visibility: visible;
        }
    </style>
    <title>DineEase - The All-in-One Platform for Restaurant Success</title>
    <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon" />
</head>

<body class="bg-[var(--background-color)] text-[var(--text-primary)]">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        <header
            class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-[var(--border-color)] bg-[var(--background-color)]/80 px-4 py-3 backdrop-blur-sm sm:px-10">
            <div class="flex items-center gap-3">
                <svg class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 48 48"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.8261 17.4264C16.7203 18.1174 20.2244 18.5217 24 18.5217C27.7756 18.5217 31.2797 18.1174 34.1739 17.4264C36.9144 16.7722 39.9967 15.2331 41.3563 14.1648L24.8486 40.6391C24.4571 41.267 23.5429 41.267 23.1514 40.6391L6.64374 14.1648C8.00331 15.2331 11.0856 16.7722 13.8261 17.4264Z"
                        fill="currentColor"></path>
                    <path clip-rule="evenodd"
                        d="M39.998 12.236C39.9944 12.2537 39.9875 12.2845 39.9748 12.3294C39.9436 12.4399 39.8949 12.5741 39.8346 12.7175C39.8168 12.7597 39.7989 12.8007 39.7813 12.8398C38.5103 13.7113 35.9788 14.9393 33.7095 15.4811C30.9875 16.131 27.6413 16.5217 24 16.5217C20.3587 16.5217 17.0125 16.131 14.2905 15.4811C12.0012 14.9346 9.44505 13.6897 8.18538 12.8168C8.17384 12.7925 8.16216 12.767 8.15052 12.7408C8.09919 12.6249 8.05721 12.5114 8.02977 12.411C8.00356 12.3152 8.00039 12.2667 8.00004 12.2612C8.00004 12.261 8 12.2607 8.00004 12.2612C8.00004 12.2359 8.0104 11.9233 8.68485 11.3686C9.34546 10.8254 10.4222 10.2469 11.9291 9.72276C14.9242 8.68098 19.1919 8 24 8C28.8081 8 33.0758 8.68098 36.0709 9.72276C37.5778 10.2469 38.6545 10.8254 39.3151 11.3686C39.9006 11.8501 39.9857 12.1489 39.998 12.236ZM4.95178 15.2312L21.4543 41.6973C22.6288 43.5809 25.3712 43.5809 26.5457 41.6973L43.0534 15.223C43.0709 15.1948 43.0878 15.1662 43.104 15.1371L41.3563 14.1648C43.104 15.1371 43.1038 15.1374 43.104 15.1371L43.1051 15.135L43.1065 15.1325L43.1101 15.1261L43.1199 15.1082C43.1276 15.094 43.1377 15.0754 43.1497 15.0527C43.1738 15.0075 43.2062 14.9455 43.244 14.8701C43.319 14.7208 43.4196 14.511 43.5217 14.2683C43.6901 13.8679 44 13.0689 44 12.2609C44 10.5573 43.003 9.22254 41.8558 8.2791C40.6947 7.32427 39.1354 6.55361 37.385 5.94477C33.8654 4.72057 29.133 4 24 4C18.867 4 14.1346 4.72057 10.615 5.94478C8.86463 6.55361 7.30529 7.32428 6.14419 8.27911C4.99695 9.22255 3.99999 10.5573 3.99999 12.2609C3.99999 13.1275 4.29264 13.9078 4.49321 14.3607C4.60375 14.6102 4.71348 14.8196 4.79687 14.9689C4.83898 15.0444 4.87547 15.1065 4.9035 15.1529C4.91754 15.1762 4.92954 15.1957 4.93916 15.2111L4.94662 15.223L4.95178 15.2312ZM35.9868 18.996L24 38.22L12.0131 18.996C12.4661 19.1391 12.9179 19.2658 13.3617 19.3718C16.4281 20.1039 20.0901 20.5217 24 20.5217C27.9099 20.5217 31.5719 20.1039 34.6383 19.3718C35.082 19.2658 35.5339 19.1391 35.9868 18.996Z"
                        fill="currentColor" fill-rule="evenodd"></path>
                </svg>
                <h2 class="text-lg font-bold leading-tight tracking-[-0.015em] text-[var(--text-primary)] sm:text-xl">DineEase</h2>
            </div>
            <nav class="hidden items-center gap-8 md:flex">
                <a class="text-sm font-medium text-[var(--text-primary)] hover:text-green-500 transition-colors rounded-md px-2 py-1 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                    href="#features">Features</a>
                <a class="text-sm font-medium text-[var(--text-primary)] hover:text-green-500 transition-colors rounded-md px-2 py-1 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                    href="#how-it-works">How it Works</a>
                <a class="text-sm font-medium text-[var(--text-primary)] hover:text-green-500 transition-colors rounded-md px-2 py-1 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                    href="#pricing">Pricing</a>
                <a class="text-sm font-medium text-[var(--text-primary)] hover:text-green-500 transition-colors rounded-md px-2 py-1 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                    href="#contact">Contact Us</a>
            </nav>
            <div class="hidden items-center gap-2 md:flex">
                <button
                    class="flex h-10 min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full bg-gray-200 px-4 text-sm font-bold leading-normal tracking-[0.015em] text-gray-800 transition-colors hover:bg-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2">
                    <span class="truncate">Talk to sales</span>
                </button>
                <button
                    class="flex h-10 min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full bg-green-500 px-4 text-sm font-bold leading-normal tracking-[0.015em] text-white transition-colors hover:bg-green-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2">
                    <span class="truncate">Get started</span>
                </button>
            </div>
            <button id="mobile-menu-button" class="md:hidden focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2 rounded p-2">
                <svg id="hamburger-icon" class="h-6 w-6" fill="none" height="24" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
                    xmlns="http://www.w3.org/2000/svg">
                    <line x1="3" x2="21" y1="12" y2="12"></line>
                    <line x1="3" x2="21" y1="6" y2="6"></line>
                    <line x1="3" x2="21" y1="18" y2="18"></line>
                </svg>
                <svg id="close-icon" class="h-6 w-6 hidden" fill="none" height="24" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
                    xmlns="http://www.w3.org/2000/svg">
                    <line x1="18" x2="6" y1="6" y2="18"></line>
                    <line x1="6" x2="18" y1="6" y2="18"></line>
                </svg>
            </button>
        </header>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay" class="mobile-menu-overlay fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"></div>

        <!-- Mobile Menu Sidebar -->
        <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 h-full w-80 bg-[var(--background-color)] shadow-xl z-50 md:hidden">
            <div class="flex flex-col h-full">
                <!-- Mobile Menu Header -->
                <div class="flex items-center justify-between border-b border-[var(--border-color)] px-4 py-3">
                    <div class="flex items-center gap-3">
                        <svg class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 48 48"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.8261 17.4264C16.7203 18.1174 20.2244 18.5217 24 18.5217C27.7756 18.5217 31.2797 18.1174 34.1739 17.4264C36.9144 16.7722 39.9967 15.2331 41.3563 14.1648L24.8486 40.6391C24.4571 41.267 23.5429 41.267 23.1514 40.6391L6.64374 14.1648C8.00331 15.2331 11.0856 16.7722 13.8261 17.4264Z"
                                fill="currentColor"></path>
                            <path clip-rule="evenodd"
                                d="M39.998 12.236C39.9944 12.2537 39.9875 12.2845 39.9748 12.3294C39.9436 12.4399 39.8949 12.5741 39.8346 12.7175C39.8168 12.7597 39.7989 12.8007 39.7813 12.8398C38.5103 13.7113 35.9788 14.9393 33.7095 15.4811C30.9875 16.131 27.6413 16.5217 24 16.5217C20.3587 16.5217 17.0125 16.131 14.2905 15.4811C12.0012 14.9346 9.44505 13.6897 8.18538 12.8168C8.17384 12.7925 8.16216 12.767 8.15052 12.7408C8.09919 12.6249 8.05721 12.5114 8.02977 12.411C8.00356 12.3152 8.00039 12.2667 8.00004 12.2612C8.00004 12.261 8 12.2607 8.00004 12.2612C8.00004 12.2359 8.0104 11.9233 8.68485 11.3686C9.34546 10.8254 10.4222 10.2469 11.9291 9.72276C14.9242 8.68098 19.1919 8 24 8C28.8081 8 33.0758 8.68098 36.0709 9.72276C37.5778 10.2469 38.6545 10.8254 39.3151 11.3686C39.9006 11.8501 39.9857 12.1489 39.998 12.236ZM4.95178 15.2312L21.4543 41.6973C22.6288 43.5809 25.3712 43.5809 26.5457 41.6973L43.0534 15.223C43.0709 15.1948 43.0878 15.1662 43.104 15.1371L41.3563 14.1648C43.104 15.1371 43.1038 15.1374 43.104 15.1371L43.1051 15.135L43.1065 15.1325L43.1101 15.1261L43.1199 15.1082C43.1276 15.094 43.1377 15.0754 43.1497 15.0527C43.1738 15.0075 43.2062 14.9455 43.244 14.8701C43.319 14.7208 43.4196 14.511 43.5217 14.2683C43.6901 13.8679 44 13.0689 44 12.2609C44 10.5573 43.003 9.22254 41.8558 8.2791C40.6947 7.32427 39.1354 6.55361 37.385 5.94477C33.8654 4.72057 29.133 4 24 4C18.867 4 14.1346 4.72057 10.615 5.94478C8.86463 6.55361 7.30529 7.32428 6.14419 8.27911C4.99695 9.22255 3.99999 10.5573 3.99999 12.2609C3.99999 13.1275 4.29264 13.9078 4.49321 14.3607C4.60375 14.6102 4.71348 14.8196 4.79687 14.9689C4.83898 15.0444 4.87547 15.1065 4.9035 15.1529C4.91754 15.1762 4.92954 15.1957 4.93916 15.2111L4.94662 15.223L4.95178 15.2312ZM35.9868 18.996L24 38.22L12.0131 18.996C12.4661 19.1391 12.9179 19.2658 13.3617 19.3718C16.4281 20.1039 20.0901 20.5217 24 20.5217C27.9099 20.5217 31.5719 20.1039 34.6383 19.3718C35.082 19.2658 35.5339 19.1391 35.9868 18.996Z"
                                fill="currentColor" fill-rule="evenodd"></path>
                        </svg>
                        <h2 class="text-lg font-bold leading-tight tracking-[-0.015em] text-[var(--text-primary)] sm:text-xl">DineEase</h2>
                    </div>
                    <button id="mobile-menu-close" class="p-2 rounded-lg hover:bg-[var(--surface-color)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2 transition-colors">
                        <svg class="h-6 w-6" fill="none" height="24" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                            <line x1="18" x2="6" y1="6" y2="18"></line>
                            <line x1="6" x2="18" y1="6" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Menu Navigation -->
                <nav class="flex-1 px-4 py-6">
                    <div class="space-y-1">
                        <a class="mobile-menu-link block px-4 py-3 text-base font-medium text-[var(--text-primary)] hover:text-green-500 hover:bg-[var(--surface-color)] rounded-lg transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                            href="#features">Features</a>
                        <a class="mobile-menu-link block px-4 py-3 text-base font-medium text-[var(--text-primary)] hover:text-green-500 hover:bg-[var(--surface-color)] rounded-lg transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                            href="#how-it-works">How it Works</a>
                        <a class="mobile-menu-link block px-4 py-3 text-base font-medium text-[var(--text-primary)] hover:text-green-500 hover:bg-[var(--surface-color)] rounded-lg transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                            href="#pricing">Pricing</a>
                        <a class="mobile-menu-link block px-4 py-3 text-base font-medium text-[var(--text-primary)] hover:text-green-500 hover:bg-[var(--surface-color)] rounded-lg transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                            href="#contact">Contact Us</a>
                    </div>
                </nav>

                <!-- Mobile Menu Footer -->
                <div class="border-t border-[var(--border-color)] px-4 py-6 space-y-3">
                    <button
                        class="w-full flex h-10 items-center justify-center rounded-full bg-gray-200 px-4 text-sm font-bold leading-normal tracking-[0.015em] text-gray-800 transition-colors hover:bg-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2">
                        <span class="truncate">Talk to sales</span>
                    </button>
                    <button
                        class="w-full flex h-10 items-center justify-center rounded-full bg-green-500 px-4 text-sm font-bold leading-normal tracking-[0.015em] text-white transition-colors hover:bg-green-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2">
                        <span class="truncate">Get started</span>
                    </button>
                </div>
            </div>
        </div>
        <main class="flex-1">
            <section
                class="relative flex min-h-[100vh] sm:min-h-[90vh] md:h-[90vh] w-full items-center justify-center bg-[var(--background-color)] px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-0">
                <div class="absolute inset-0 z-0">
                    <img alt="Bright and airy restaurant interior" class="h-full w-full object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBirPDkqVHtG3Hfmz2D6jR44Om8tI5wlx1dqc5JEhPuzsKdAqD3sYgidGp-v0K2CyDAMHH818aOfMDX29UBDc_UzKVSNAr4xD_DLeFUEmHm2376uKvaGLAN0XD4vTco2pIV3aDedzGHhs3WNxZU1JUJsQmXQ4saAiqnxzdi2-7-2z0R0dOGW8W9OH2CxRPKVrp4uV2uPRpI_asQQIE74cAZDF1b5oAfC7KX_-R6dtjxuoGkClhZ433OYIs3jQVgr1iQ5tvOUg1z-fnT" />
                    <div class="absolute inset-0 bg-gradient-to-b from-white/20 via-white/80 to-white"></div>
                </div>
                <div class="relative z-10 flex w-full max-w-6xl flex-col items-center gap-6 sm:gap-8 md:gap-10 text-center">
                    <h1
                        class="text-3xl font-black leading-tight tracking-tighter text-[var(--text-primary)] xs:text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl max-w-5xl">
                        The All-In-One Platform for Restaurant Success</h1>
                    <p class="max-w-xl sm:max-w-2xl lg:max-w-3xl text-base sm:text-lg md:text-xl lg:text-2xl text-[var(--text-secondary)] leading-relaxed">DineEase empowers restaurants
                        to thrive. From seamless online ordering to efficient table management, we provide the tools you
                        need to streamline operations, enhance customer experiences, and boost your bottom line.</p>
                    <button
                        class="flex h-11 sm:h-12 md:h-14 min-w-[200px] sm:min-w-[240px] md:min-w-[280px] max-w-[90vw] sm:max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full bg-green-500 px-4 sm:px-6 md:px-8 text-sm sm:text-base md:text-lg font-bold leading-normal tracking-[0.015em] text-white transition-transform hover:scale-105 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2">
                        <span class="truncate">Get Started for Free</span>
                    </button>
                </div>
            </section>
            <section class="container mx-auto px-4 py-16 sm:px-6 lg:px-8 lg:py-24" id="features">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-[var(--text-primary)] sm:text-3xl lg:text-4xl">Key Features
                    </h2>
                    <p class="mt-4 text-base text-[var(--text-secondary)] sm:text-lg">DineEase offers a comprehensive suite of
                        features designed to address the unique challenges faced by restaurants.</p>
                </div>
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        class="flex flex-col gap-4 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                            <svg class="text-green-500" fill="currentColor" height="28px" viewBox="0 0 256 256"
                                width="28px" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M72,104a8,8,0,0,1,8-8h96a8,8,0,0,1,0,16H80A8,8,0,0,1,72,104Zm8,40h96a8,8,0,0,0,0-16H80a8,8,0,0,0,0,16ZM232,56V208a8,8,0,0,1-11.58,7.15L192,200.94l-28.42,14.21a8,8,0,0,1-7.16,0L128,200.94,99.58,215.15a8,8,0,0,1-7.16,0L64,200.94,35.58,215.15A8,8,0,0,1,24,208V56A16,16,0,0,1,40,40H216A16,16,0,0,1,232,56Zm-16,0H40V195.06l20.42-10.22a8,8,0,0,1,7.16,0L96,199.06l28.42-14.22a8,8,0,0,1,7.16,0L160,199.06l28.42-14.22a8,8,0,0,1,7.16,0L216,195.06Z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-[var(--text-primary)] sm:text-xl">Online Ordering</h3>
                        <p class="text-sm text-[var(--text-secondary)] sm:text-base">Accept orders directly from your website or app, with
                            customizable menus and payment options.</p>
                    </div>
                    <div
                        class="flex flex-col gap-4 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                            <svg class="text-green-500" fill="currentColor" height="28px" viewBox="0 0 256 256"
                                width="28px" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-[var(--text-primary)] sm:text-xl">Table Management</h3>
                        <p class="text-sm text-[var(--text-secondary)] sm:text-base">Manage reservations, waitlists, and table assignments
                            with ease, optimizing seating efficiency.</p>
                    </div>
                    <div
                        class="flex flex-col gap-4 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                            <svg class="text-green-500" fill="currentColor" height="28px" viewBox="0 0 256 256"
                                width="28px" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M136,80v43.47l36.12,21.67a8,8,0,0,1-8.24,13.72l-40-24A8,8,0,0,1,120,128V80a8,8,0,0,1,16,0Zm-8-48A95.44,95.44,0,0,0,60.08,60.15C52.81,67.51,46.35,74.59,40,82V64a8,8,0,0,0-16,0v40a8,8,0,0,0,8,8H72a8,8,0,0,0,0-16H49c7.15-8.42,14.27-16.35,22.39-24.57a80,80,0,1,1,1.66,114.75,8,8,0,1,0-11,11.64A96,96,0,1,0,128,32Z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-[var(--text-primary)] sm:text-xl">Real-time Analytics</h3>
                        <p class="text-sm text-[var(--text-secondary)] sm:text-base">Track key metrics like sales, customer satisfaction,
                            and order fulfillment in real-time.</p>
                    </div>
                </div>
            </section>
            <section class="bg-[var(--surface-color)] py-16 sm:py-24" id="how-it-works">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-2xl font-bold tracking-tight text-[var(--text-primary)] sm:text-3xl lg:text-4xl">How
                            DineEase Works</h2>
                        <p class="mt-4 text-base text-[var(--text-secondary)] sm:text-lg">DineEase seamlessly integrates into your
                            existing operations, providing a user-friendly interface for both staff and customers.</p>
                    </div>
                    <div class="relative mt-16">
                        <div aria-hidden="true" class="absolute left-1/2 top-0 -ml-px h-full w-0.5 bg-gray-200"></div>
                        <div class="relative flex flex-col items-center gap-12 lg:flex-row lg:gap-8">
                            <div
                                class="flex w-full flex-col items-center text-center lg:w-1/3 lg:items-end lg:pr-8 lg:text-right">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-green-500 text-white ring-8 ring-white">
                                    <span class="text-3xl font-bold">1</span>
                                </div>
                                <img alt="Illustration of a restaurant owner setting up their profile on a tablet"
                                    class="mt-6 h-48 w-auto rounded-lg"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2JFfnyDydEU9SHa7EvOLUh8tGviKH9Za1f-fW8D0z_vaIdkCTZStXlR7PQuNOL6mNEEExLP_09d2qZpHRvHNTXE5gGhCUEm5VzGCPElwZ8gSaZZOC3btyCsc-VLwtflQyQSSIzCUl0P8ekk_bNB5du4UsRjnuN1x_LIhVJ9vSkmTorACJ6XWaMtqnxh3XP2k8ODmwEfNj67ERDT0nXtDFuTyOX1pUrp1kqmY32xUmrmDXSeSEY0_7TDEN6NtI-omA90_lVQRa31OI" />
                                <h3 class="mt-6 text-xl font-bold text-[var(--text-primary)] sm:text-2xl">Set Up Your Profile</h3>
                                <p class="mt-2 text-sm text-[var(--text-secondary)] sm:text-base">Create your restaurant profile, customize
                                    your menu, and set up your payment options. It's quick and easy to get started.</p>
                            </div>
                            <div class="flex w-full flex-col items-center text-center lg:w-1/3">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-green-500 text-white ring-8 ring-white">
                                    <span class="text-3xl font-bold">2</span>
                                </div>
                                <img alt="Illustration of a waiter managing orders and tables on a digital dashboard"
                                    class="mt-6 h-48 w-auto rounded-lg"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQsxk23Vgc-sYB0PkcQOBljUY5nHP76LmfdJTlt5BP8paRg9CXHL3xnthRaI_-atKCZkWgawvFyYmSoT4uhY8_Rf-apBA-DBRuLEKMj-s2oIbggIPIB4QV9DGe5Hx-71a9d-8dpJ_7r2ZG8gJFOezrPpzXKbvPBq7wk1eJIHBgLaQHP3ZyHWkxMx5xKGNjpDeD_TrwQ1PdrffRnB3JkiOWxQ1PQI4BHAU-DdW2T-wqrZLqEfnsxf7umU6GHSNtk-MtYbU6PTK2fh8X" />
                                <h3 class="mt-6 text-xl font-bold text-[var(--text-primary)] sm:text-2xl">Manage Orders &amp;
                                    Tables</h3>
                                <p class="mt-2 text-sm text-[var(--text-secondary)] sm:text-base">Use our intuitive dashboard to manage
                                    incoming orders, track table availability, and handle reservations seamlessly.</p>
                            </div>
                            <div
                                class="flex w-full flex-col items-center text-center lg:w-1/3 lg:items-start lg:pl-8 lg:text-left">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-green-500 text-white ring-8 ring-white">
                                    <span class="text-3xl font-bold">3</span>
                                </div>
                                <img alt="Illustration of happy customers dining at a restaurant"
                                    class="mt-6 h-48 w-auto rounded-lg"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBk4MGuMGfZMce8yCeIi6aUY1WpLmg7tjaK286dwK--iNh_uHFRXVnNJZofyxnCQqhMKl-ITUHQW3FG1TRdk2-YVpFWaAOkWpDmFyqsad85VTdOxzRSC7enAcF-Nunbo934GByZ9rr0STolhbEYMTYbqXfz19s7AC7xZvC4i83mAFP2cyf-WeIB634CRvqCGDeibKfv03vFAE-ORxIOleAFoX9F_AWHBMOFYkEwQgZVNVXzuRBN_XVK22-4KnUe-k4PRpl1N4TiX6B" />
                                <h3 class="mt-6 text-xl font-bold text-[var(--text-primary)] sm:text-2xl">Delight Your Customers
                                </h3>
                                <p class="mt-2 text-sm text-[var(--text-secondary)] sm:text-base">Provide a top-notch experience with easy
                                    online ordering, shorter wait times, and excellent service.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="container mx-auto px-4 py-16 sm:px-6 lg:px-8 lg:py-24" id="testimonials">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-[var(--text-primary)] sm:text-4xl">What Our
                        Customers Are Saying</h2>
                    <p class="mt-4 text-lg text-[var(--text-secondary)]">We're proud to have helped so many restaurants
                        streamline their operations and improve their customer experience.</p>
                </div>
                <div class="mt-12 flex flex-col gap-8 overflow-hidden">
                    <div class="flex animate-marquee-right">
                        <div class="flex w-full shrink-0 items-center justify-around gap-8">
                            <div
                                class="flex w-[45%] shrink-0 flex-col gap-6 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                                <div class="flex items-center gap-4">
                                    <img alt="John Doe" class="h-14 w-14 rounded-full object-cover"
                                        src="https://lh3.googleusercontent.com/a-/AOh14GhI-gA0S5WJ-YJv8Q0I3_1-0_1-0/s96-c/photo.jpg" />
                                    <div>
                                        <h3 class="text-lg font-bold text-[var(--text-primary)]">John Doe</h3>
                                        <p class="text-sm text-[var(--text-secondary)]">Owner, The Gourmet Kitchen</p>
                                    </div>
                                </div>
                                <p class="text-[var(--text-secondary)]">"DineEase has been a game-changer for our
                                    restaurant. The online ordering system is incredibly easy to use, and our customers
                                    love it. We've seen a significant increase in takeout orders since we started using
                                    it."</p>
                            </div>
                            <div
                                class="flex w-[45%] shrink-0 flex-col gap-6 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                                <div class="flex items-center gap-4">
                                    <img alt="Jane Smith" class="h-14 w-14 rounded-full object-cover"
                                        src="https://lh3.googleusercontent.com/a-/AOh14GhJ_1-0_1-0_1-0_1-0_1-0/s96-c/photo.jpg" />
                                    <div>
                                        <h3 class="text-lg font-bold text-[var(--text-primary)]">Jane Smith</h3>
                                        <p class="text-sm text-[var(--text-secondary)]">Manager, The Cozy Corner</p>
                                    </div>
                                </div>
                                <p class="text-[var(--text-secondary)]">"The table management feature has made our
                                    lives so much easier. We can now manage reservations and waitlists with a few
                                    clicks, which has helped us to reduce wait times and improve customer satisfaction."
                                </p>
                            </div>
                        </div>
                        <div class="flex w-full shrink-0 items-center justify-around gap-8">
                            <div
                                class="flex w-[45%] shrink-0 flex-col gap-6 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                                <div class="flex items-center gap-4">
                                    <img alt="John Doe" class="h-14 w-14 rounded-full object-cover"
                                        src="https://lh3.googleusercontent.com/a-/AOh14GhI-gA0S5WJ-YJv8Q0I3_1-0_1-0/s96-c/photo.jpg" />
                                    <div>
                                        <h3 class="text-lg font-bold text-[var(--text-primary)]">John Doe</h3>
                                        <p class="text-sm text-[var(--text-secondary)]">Owner, The Gourmet Kitchen</p>
                                    </div>
                                </div>
                                <p class="text-[var(--text-secondary)]">"DineEase has been a game-changer for our
                                    restaurant. The online ordering system is incredibly easy to use, and our customers
                                    love it. We've seen a significant increase in takeout orders since we started using
                                    it."</p>
                            </div>
                            <div
                                class="flex w-[45%] shrink-0 flex-col gap-6 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                                <div class="flex items-center gap-4">
                                    <img alt="Jane Smith" class="h-14 w-14 rounded-full object-cover"
                                        src="https://lh3.googleusercontent.com/a-/AOh14GhJ_1-0_1-0_1-0_1-0_1-0/s96-c/photo.jpg" />
                                    <div>
                                        <h3 class="text-lg font-bold text-[var(--text-primary)]">Jane Smith</h3>
                                        <p class="text-sm text-[var(--text-secondary)]">Manager, The Cozy Corner</p>
                                    </div>
                                </div>
                                <p class="text-[var(--text-secondary)]">"The table management feature has made our
                                    lives so much easier. We can now manage reservations and waitlists with a few
                                    clicks, which has helped us to reduce wait times and improve customer satisfaction."
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex animate-marquee-left">
                        <div class="flex w-full shrink-0 items-center justify-around gap-8">
                            <div
                                class="flex w-[45%] shrink-0 flex-col gap-6 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                                <div class="flex items-center gap-4">
                                    <img alt="Sarah Lee" class="h-14 w-14 rounded-full object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlA8T61U_WVJXNhDQkHVQePMG78ZfzmzcHfDsGWQD3X6WYucAgmnBdimoAUSdkan6umVdUdX8OEwsKpOcjLqSX8Y4wjt6HY4OYgpuHz_Yjy0SJSO69TI_XjKWKe7ien2FD-sWHYMaBfESmt2JrbGaSDZ2EWEmfws2ell8nWQ3S-M9tbped7eublBBKGaAu7NHWqyc1CLL_QkC3BT-y6rZQ5IUk4TSBtlvBcmP7jUODPcDCfSRK63EnIJp1zd5k1Wv-fmpwveBLDrv9" />
                                    <div>
                                        <h3 class="text-lg font-bold text-[var(--text-primary)]">Sarah Lee</h3>
                                        <p class="text-sm text-[var(--text-secondary)]">Chef, The Modern Eatery</p>
                                    </div>
                                </div>
                                <p class="text-[var(--text-secondary)]">"The real-time analytics are a fantastic tool.
                                    I can see what's selling and what's not, which helps me with menu planning and
                                    inventory management. It's a must-have for any serious restaurateur."</p>
                            </div>
                            <div
                                class="flex w-[45%] shrink-0 flex-col gap-6 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                                <div class="flex items-center gap-4">
                                    <img alt="Michael Chen" class="h-14 w-14 rounded-full object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDVzhcuigFf6no4W61wVygNx49hRun2JFGa_tfA8Jm91lyVGqizz_qB6GvEOO7hH2z9q7Gq943jcZb8bZzzJDTiIDrtXRBIVJGnfTg_seAgr3P11kKlKayk-VvkgyRaOKij_i4NNNp9AqgE5O_SRO655RLyrr18LPVbyb6qcr4jtfw2Np5jmr8ItCYb6PQy6s1LFTpaL7Nky0LzJp7UJVl1ugHqR-EwQuyvHUhdHjvv8BqEJ9i_Idgau7qAJiMBZvyZNA6Iuopu4a-p" />
                                    <div>
                                        <h3 class="text-lg font-bold text-[var(--text-primary)]">Michael Chen</h3>
                                        <p class="text-sm text-[var(--text-secondary)]">Co-founder, The Fusion Bistro
                                        </p>
                                    </div>
                                </div>
                                <p class="text-[var(--text-secondary)]">"We've been using DineEase for over a year now,
                                    and it has completely transformed our operations. The platform is intuitive,
                                    reliable, and has helped us grow our business exponentially."</p>
                            </div>
                        </div>
                        <div class="flex w-full shrink-0 items-center justify-around gap-8">
                            <div
                                class="flex w-[45%] shrink-0 flex-col gap-6 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                                <div class="flex items-center gap-4">
                                    <img alt="Sarah Lee" class="h-14 w-14 rounded-full object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA9fek01ndo8AlZDO-7yjHF3IK7MSzZC0caeeCwhy6wetgw1JWtiRYA8kSN5z0y_n5wfEucXiM6foGzUzZqQ4qweXjX2CQ5rcaNBTMGJAOvsp-yxku4QtoTzj02WJehD6wGnCS4UgtlC9Ikn-l_iVnOxXOLSYHr33oFbp48cJvx9v9mPKKx3x8oJd83Ufc99BT8yWVDIrhBrfwSHTAshdkY2D3SrfnFTE1n3eGmoIo0-HdNO6WOJoSfulOwqu47C_au952i9L0kykMD" />
                                    <div>
                                        <h3 class="text-lg font-bold text-[var(--text-primary)]">Sarah Lee</h3>
                                        <p class="text-sm text-[var(--text-secondary)]">Chef, The Modern Eatery</p>
                                    </div>
                                </div>
                                <p class="text-[var(--text-secondary)]">"The real-time analytics are a fantastic tool.
                                    I can see what's selling and what's not, which helps me with menu planning and
                                    inventory management. It's a must-have for any serious restaurateur."</p>
                            </div>
                            <div
                                class="flex w-[45%] shrink-0 flex-col gap-6 rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-6 transition-shadow hover:shadow-lg hover:shadow-green-500/10">
                                <div class="flex items-center gap-4">
                                    <img alt="Michael Chen" class="h-14 w-14 rounded-full object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB45j5f0Et_4QYyrgxekolOSMqUXGuJjF_a_dNY7wkYK1MffxeT1SFxLYwerjZsVlMm66yczMqbIZQdh1yVMxMuHrRSNLMUZGzzYTp3vo1rrLgZz-oi1OoFaL3f6Tmn70RseSPovYFSK_yn1Xqqt_GnJhq1Q1a3maRFy8NmyA7S5QNF4a9GVt1cQMSKqdz0hDq1DJV93lsRxcMOW5yAgNARc9QJnjkvDGAWwFWjcs1GkIMw3wv2vOFuvtnzwU-GmePtMN3ocMwIEP-4" />
                                    <div>
                                        <h3 class="text-lg font-bold text-[var(--text-primary)]">Michael Chen</h3>
                                        <p class="text-sm text-[var(--text-secondary)]">Co-founder, The Fusion Bistro
                                        </p>
                                    </div>
                                </div>
                                <p class="text-[var(--text-secondary)]">"We've been using DineEase for over a year now,
                                    and it has completely transformed our operations. The platform is intuitive,
                                    reliable, and has helped us grow our business exponentially."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="container mx-auto px-4 py-16 sm:px-6 lg:px-8 lg:py-24" id="faq">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-[var(--text-primary)] sm:text-3xl lg:text-4xl">Frequently
                        Asked Questions</h2>
                    <p class="mt-4 text-base text-[var(--text-secondary)] sm:text-lg">Have questions? We've got answers. If you
                        can't find what you're looking for, feel free to contact us.</p>
                </div>
                <div class="mt-12 mx-auto max-w-3xl">
                    <div class="space-y-4">
                        <details
                            class="group rounded-lg bg-[var(--surface-color)] p-6 [&_summary::-webkit-details-marker]:hidden outline-none focus-within:ring-2 focus-within:ring-green-400 focus-within:ring-offset-2"
                            open="">
                            <summary
                                class="flex cursor-pointer items-center justify-between gap-1.5 text-[var(--text-primary)] outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2 rounded">
                                <h2 class="text-base font-medium sm:text-lg">What is DineEase?</h2>
                                <span class="relative h-5 w-5 shrink-0">
                                    <svg class="h-5 w-5 shrink-0 transition-transform duration-300 group-open:-rotate-180"
                                        fill="none" height="24" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </span>
                            </summary>
                            <p class="mt-4 leading-relaxed text-sm text-[var(--text-secondary)] sm:text-base">DineEase is an all-in-one
                                platform designed to help restaurant owners streamline their operations. It offers
                                features like online ordering, table management, real-time analytics, and more to
                                enhance efficiency and customer experience.</p>
                        </details>
                        <details
                            class="group rounded-lg bg-[var(--surface-color)] p-6 [&_summary::-webkit-details-marker]:hidden outline-none focus-within:ring-2 focus-within:ring-green-400 focus-within:ring-offset-2">
                            <summary
                                class="flex cursor-pointer items-center justify-between gap-1.5 text-[var(--text-primary)] outline-none">
                                <h2 class="text-base font-medium sm:text-lg">How much does DineEase cost?</h2>
                                <span class="relative h-5 w-5 shrink-0">
                                    <svg class="h-5 w-5 shrink-0 transition-transform duration-300 group-open:-rotate-180"
                                        fill="none" height="24" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </span>
                            </summary>
                            <p class="mt-4 leading-relaxed text-sm text-[var(--text-secondary)] sm:text-base">We offer various pricing plans
                                tailored to the needs of different restaurants. Please visit our Pricing section or
                                contact our sales team for detailed information.</p>
                        </details>
                        <details
                            class="group rounded-lg bg-[var(--surface-color)] p-6 [&_summary::-webkit-details-marker]:hidden outline-none focus-within:ring-2 focus-within:ring-green-400 focus-within:ring-offset-2">
                            <summary
                                class="flex cursor-pointer items-center justify-between gap-1.5 text-[var(--text-primary)] outline-none">
                                <h2 class="text-base font-medium sm:text-lg">Is there a free trial available?</h2>
                                <span class="relative h-5 w-5 shrink-0">
                                    <svg class="h-5 w-5 shrink-0 transition-transform duration-300 group-open:-rotate-180"
                                        fill="none" height="24" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </span>
                            </summary>
                            <p class="mt-4 leading-relaxed text-sm text-[var(--text-secondary)] sm:text-base">Yes, we offer a free trial so
                                you can experience the benefits of DineEase firsthand. Sign up on our website to get
                                started.</p>
                        </details>
                        <details
                            class="group rounded-lg bg-[var(--surface-color)] p-6 [&_summary::-webkit-details-marker]:hidden outline-none focus-within:ring-2 focus-within:ring-green-400 focus-within:ring-offset-2">
                            <summary
                                class="flex cursor-pointer items-center justify-between gap-1.5 text-[var(--text-primary)] outline-none">
                                <h2 class="text-base font-medium sm:text-lg">Which payment methods are supported?</h2>
                                <span class="relative h-5 w-5 shrink-0">
                                    <svg class="h-5 w-5 shrink-0 transition-transform duration-300 group-open:-rotate-180"
                                        fill="none" height="24" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </span>
                            </summary>
                            <p class="mt-4 leading-relaxed text-sm text-[var(--text-secondary)] sm:text-base">DineEase supports a wide range
                                of payment methods, including major credit cards, debit cards, and popular digital
                                wallets, ensuring a seamless checkout experience for your customers.</p>
                        </details>
                    </div>
                </div>
            </section>
            <section class="bg-[var(--surface-color)] py-16 sm:py-24" id="pricing">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-2xl font-bold tracking-tight text-[var(--text-primary)] sm:text-3xl lg:text-4xl">Ready to
                            transform your restaurant?</h2>
                        <p class="mt-4 text-base text-[var(--text-secondary)] sm:text-lg">Join the growing number of restaurants
                            that are using DineEase to achieve their business goals.</p>
                        <div class="mt-8 flex justify-center">
                            <button
                                class="flex h-12 min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full bg-green-500 px-6 text-base font-bold leading-normal tracking-[0.015em] text-white transition-transform hover:scale-105 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2">
                                <span class="truncate">Get started</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-[var(--background-color)] py-8 sm:py-16 lg:py-24" id="contact">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-3xl text-center">
                        <h2 class="text-2xl font-bold tracking-tight text-[var(--text-primary)] sm:text-3xl lg:text-4xl">Contact Us
                        </h2>
                        <p class="mt-4 text-base text-[var(--text-secondary)] sm:text-lg">We'd love to hear from you. Reach out with
                            any questions or to learn more.</p>
                    </div>
                    <div class="mt-6 mx-auto max-w-3xl sm:mt-10 lg:mt-12">
                        <div
                            class="rounded-xl border border-[var(--border-color)] bg-[var(--surface-color)] p-4 shadow-lg sm:p-6 lg:p-8">
                            <form class="space-y-4 sm:space-y-6">
                                <div>
                                    <label class="sr-only" for="name">Name</label>
                                    <input class="w-full rounded-lg border-[var(--border-color)] p-2.5 text-sm outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 sm:p-3"
                                        id="name" placeholder="Name" type="text" />
                                </div>
                                <div>
                                    <label class="sr-only" for="email">Email</label>
                                    <input class="w-full rounded-lg border-[var(--border-color)] p-2.5 text-sm outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 sm:p-3"
                                        id="email" placeholder="Email" type="email" />
                                </div>
                                <div>
                                    <label class="sr-only" for="message">Message</label>
                                    <textarea class="w-full rounded-lg border-[var(--border-color)] p-2.5 text-sm outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 sm:p-3" id="message" placeholder="Message"
                                        rows="6"></textarea>
                                </div>
                                <div class="mt-4">
                                    <button
                                        class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-full bg-green-500 px-5 py-3 text-sm font-bold text-white transition-colors hover:bg-green-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                                        type="submit">
                                        <span class="truncate">Send Message</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div
                            class="mt-8 flex flex-col sm:flex-row justify-center items-center gap-6 text-sm text-[var(--text-secondary)]">
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4" fill="none" height="24" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                                <span>(123) 456-7890</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4" fill="none" height="24" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span>support@dineease.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer class="border-t border-[var(--border-color)] bg-[var(--background-color)]" id="resources">
            <div class="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center justify-between gap-6 md:flex-row">
                    <div class="flex flex-wrap justify-center gap-x-6 gap-y-2">
                        <a class="text-sm text-[var(--text-secondary)] hover:text-[var(--text-primary)] rounded-md px-2 py-1 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                            href="#features">Features</a>
                        <a class="text-sm text-[var(--text-secondary)] hover:text-[var(--text-primary)] rounded-md px-2 py-1 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                            href="#how-it-works">How it Works</a>
                        <a class="text-sm text-[var(--text-secondary)] hover:text-[var(--text-primary)] rounded-md px-2 py-1 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                            href="#pricing">Pricing</a>
                        <a class="text-sm text-[var(--text-secondary)] hover:text-[var(--text-primary)] rounded-md px-2 py-1 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                            href="#">About Us</a>
                        <a class="text-sm text-[var(--text-secondary)] hover:text-[var(--text-primary)] rounded-md px-2 py-1 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2"
                            href="#contact">Contact Us</a>
                    </div>
                    <div class="flex justify-center gap-4">
                        <a class="text-[var(--text-secondary)] hover:text-[var(--text-primary)] rounded-md p-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2" href="#">
                            <svg fill="currentColor" height="24px" viewBox="0 0 256 256" width="24px"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M247.39,68.94A8,8,0,0,0,240,64H209.57A48.66,48.66,0,0,0,168.1,40a46.91,46.91,0,0,0-33.75,13.7A47.9,47.9,0,0,0,120,88v6.09C79.74,83.47,46.81,50.72,46.46,50.37a8,8,0,0,0-13.65,4.92c-4.31,47.79,9.57,79.77,22,98.18a110.93,110.93,0,0,0,21.88,24.2c-15.23,17.53-39.21,26.74-39.47,26.84a8,8,0,0,0-3.85,11.93c.75,1.12,3.75,5.05,11.08,8.72C53.51,229.7,65.48,232,80,232c70.67,0,129.72-54.42,135.75-124.44l29.91-29.9A8,8,0,0,0,247.39,68.94Zm-45,29.41a8,8,0,0,0-2.32,5.14C196,166.58,143.28,216,80,216c-10.56,0-18-1.4-23.22-3.08,11.51-6.25,27.56-17,37.88-32.48A8,8,0,0,0,92,169.08c-.47-.27-43.91-26.34-44-96,16,13,45.25,33.17,78.67,38.79A8,8,0,0,0,136,104V88a32,32,0,0,1,9.6-22.92A30.94,30.94,0,0,1,167.9,56c12.66.16,24.49,7.88,29.44,19.21A8,8,0,0,0,204.67,80h16Z">
                                </path>
                            </svg>
                        </a>
                        <a class="text-[var(--text-secondary)] hover:text-[var(--text-primary)] rounded-md p-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2" href="#">
                            <svg fill="currentColor" height="24px" viewBox="0 0 256 256" width="24px"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm8,191.63V152h24a8,8,0,0,0,0-16H136V112a16,16,0,0,1,16-16h16a8,8,0,0,0,0-16H152a32,32,0,0,0-32,32v24H96a8,8,0,0,0,0,16h24v63.63a88,88,0,1,1,16,0Z">
                                </path>
                            </svg>
                        </a>
                        <a class="text-[var(--text-secondary)] hover:text-[var(--text-primary)] rounded-md p-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2" href="#">
                            <svg fill="currentColor" height="24px" viewBox="0 0 256 256" width="24px"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160ZM176,24H80A56.06,56.06,0,0,0,24,80v96a56.06,56.06,0,0,0,56,56h96a56.06,56.06,0,0,0,56-56V80A56.06,56.06,0,0,0,176,24Zm40,152a40,40,0,0,1-40,40H80a40,40,0,0,1-40-40V80A40,40,0,0,1,80,40h96a40,40,0,0,1,40,40ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mt-6 text-center text-sm text-[var(--text-secondary)]">
                    <p>© 2023 DineEase. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');
            const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');

            let isMenuOpen = false;

            function toggleMenu() {
                isMenuOpen = !isMenuOpen;
                
                if (isMenuOpen) {
                    // Open menu
                    mobileMenu.classList.add('open');
                    mobileMenuOverlay.classList.add('open');
                    hamburgerIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    document.body.style.overflow = 'hidden'; // Prevent body scroll
                } else {
                    // Close menu
                    mobileMenu.classList.remove('open');
                    mobileMenuOverlay.classList.remove('open');
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.style.overflow = ''; // Restore body scroll
                }
            }

            function closeMenu() {
                if (isMenuOpen) {
                    toggleMenu();
                }
            }

            // Toggle menu when button is clicked
            mobileMenuButton.addEventListener('click', toggleMenu);

            // Close menu when close button inside drawer is clicked
            mobileMenuClose.addEventListener('click', closeMenu);

            // Close menu when overlay is clicked
            mobileMenuOverlay.addEventListener('click', closeMenu);

            // Close menu when a navigation link is clicked
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', closeMenu);
            });

            // Close menu when escape key is pressed
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isMenuOpen) {
                    closeMenu();
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768 && isMenuOpen) { // md breakpoint
                    closeMenu();
                }
            });
        });
    </script>
</body>

</html>
