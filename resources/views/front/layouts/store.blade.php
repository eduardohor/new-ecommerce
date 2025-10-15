<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Codescandy" name="author">
    <title>@yield('title')</title>

    <meta name="description" content="@yield('description', 'Ecommerce')">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">

    <!-- Libs CSS -->
    <link href="{{ asset('libs/feather-webfont/dist/feather-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
    <style>
        .cookie-consent-banner {
            position: fixed;
            inset: auto 0 0 0;
            z-index: 1080;
            background-color: #ffffff;
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.08);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 0;
            display: none;
        }

        .cookie-consent-banner.cookie-consent-banner--visible {
            display: block;
        }

        .cookie-consent-text {
            color: #3d4f58;
        }

        .cookie-consent-banner .btn {
            min-width: 140px;
        }

        .whatsapp-float {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            background-color: #25d366;
            color: #ffffff;
            box-shadow: 0 0.5rem 1.5rem rgba(37, 211, 102, 0.35);
            z-index: 1090;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .whatsapp-float:hover,
        .whatsapp-float:focus {
            background-color: #1ebe5d;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 0.75rem 1.6rem rgba(37, 211, 102, 0.45);
        }

        .whatsapp-float i {
            font-size: 1.75rem;
        }

        @media (max-width: 575.98px) {
            .whatsapp-float {
                bottom: 1rem;
                right: 1rem;
                width: 3rem;
                height: 3rem;
            }

            .whatsapp-float i {
                font-size: 1.5rem;
            }
        }
    </style>

    @yield('head')

    <!-- Google tag (gtag.js) -->

    <!-- End Tag -->

</head>

<body>

    @include('front.partials.header')

    @yield('content')

    @include('front.partials.footer')
    @include('front.partials.whatsapp-button')

    <div id="cookie-consent-banner" class="cookie-consent-banner" role="region" aria-label="Aviso de cookies">
        <div class="container">
            <div class="row align-items-center gy-3">
                <div class="col-lg-8">
                    <p class="cookie-consent-text mb-0">
                        Usamos cookies essenciais para o funcionamento do site e, opcionalmente, cookies analíticos
                        e de marketing para melhorar sua experiência. Leia nossa
                        <a href="{{ route('institutional.show', 'politica-de-cookies') }}" class="text-decoration-underline">
                            Política de Cookies
                        </a>.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="d-flex flex-column flex-sm-row justify-content-lg-end gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm"
                            data-cookie-consent="reject">
                            Rejeitar não essenciais
                        </button>
                        <button type="button" class="btn btn-primary btn-sm"
                            data-cookie-consent="accept">
                            Aceitar todos
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript-->

    <!-- Theme JS -->

    <!-- Libs JS -->
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/jquery-countdown/dist/jquery.countdown.min.js') }}"></script>

    <script>
        // Contador Regressivo Global para Ofertas
        $(document).ready(function() {
            // Contador Compacto (ícone + tempo curto)
            $('.countdown-timer').each(function() {
                let $element = $(this);
                let $textElement = $element.find('.countdown-text');
                let endDate = new Date($element.data('end-date')).getTime();

                function updateCountdown() {
                    let now = new Date().getTime();
                    let distance = endDate - now;

                    if (distance < 0) {
                        $textElement.html("Oferta encerrada");
                        $element.addClass('text-muted');
                        clearInterval(timer);
                        return;
                    }

                    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    let timeString = '';
                    if (days > 0) timeString += days + 'd ';
                    timeString += ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);

                    $textElement.html(timeString);
                }

                updateCountdown();
                let timer = setInterval(updateCountdown, 1000);
            });

            // Contador Grande (formato descritivo completo)
            $('.deals-countdown').each(function() {
                var $this = $(this);
                var finalDate = $this.data('countdown');

                $this.countdown(finalDate, function(event) {
                    $this.html(event.strftime(
                        '<span class="countdown-section">' +
                        '<span class="countdown-amount hover-up">%D</span>' +
                        '<span class="countdown-period"> dias </span>' +
                        '</span>' +
                        '<span class="countdown-section">' +
                        '<span class="countdown-amount hover-up">%H</span>' +
                        '<span class="countdown-period"> horas </span>' +
                        '</span>' +
                        '<span class="countdown-section">' +
                        '<span class="countdown-amount hover-up">%M</span>' +
                        '<span class="countdown-period"> min </span>' +
                        '</span>' +
                        '<span class="countdown-section">' +
                        '<span class="countdown-amount hover-up">%S</span>' +
                        '<span class="countdown-period"> seg </span>' +
                        '</span>'
                    ));
                });
            });
        });
    </script>

    @yield('footer')

    <script>
        (function () {
            var COOKIE_NAME = 'cookie_consent';
            var CONSENT_DAYS = 180;
            var banner = document.getElementById('cookie-consent-banner');

            if (!banner) {
                return;
            }

            function setCookie(name, value, days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                var cookie = name + '=' + encodeURIComponent(value) + ';expires=' + date.toUTCString() + ';path=/;SameSite=Lax';
                if (window.location.protocol === 'https:') {
                    cookie += ';Secure';
                }
                document.cookie = cookie;
            }

            function getCookie(name) {
                var nameEQ = name + '=';
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) === ' ') {
                        c = c.substring(1, c.length);
                    }
                    if (c.indexOf(nameEQ) === 0) {
                        return decodeURIComponent(c.substring(nameEQ.length, c.length));
                    }
                }
                return null;
            }

            function getConsent() {
                var raw = getCookie(COOKIE_NAME);
                if (!raw) {
                    return null;
                }
                try {
                    return JSON.parse(raw);
                } catch (error) {
                    return null;
                }
            }

            function showBanner() {
                banner.classList.add('cookie-consent-banner--visible');
            }

            function hideBanner() {
                banner.classList.remove('cookie-consent-banner--visible');
            }

            function saveConsent(consent) {
                setCookie(COOKIE_NAME, JSON.stringify({
                    essential: true,
                    analytics: !!consent.analytics,
                    marketing: !!consent.marketing,
                    updated_at: new Date().toISOString()
                }), CONSENT_DAYS);
                hideBanner();
                if (typeof window.CustomEvent === 'function') {
                    document.dispatchEvent(new CustomEvent('cookie-consent:updated', { detail: consent }));
                }
            }

            var acceptButton = banner.querySelector('[data-cookie-consent="accept"]');
            var rejectButton = banner.querySelector('[data-cookie-consent="reject"]');

            if (acceptButton) {
                acceptButton.addEventListener('click', function () {
                    saveConsent({ analytics: true, marketing: true });
                });
            }

            if (rejectButton) {
                rejectButton.addEventListener('click', function () {
                    saveConsent({ analytics: false, marketing: false });
                });
            }

            document.addEventListener('click', function (event) {
                if (event.target && event.target.dataset && event.target.dataset.cookieConsent === 'manage') {
                    event.preventDefault();
                    showBanner();
                }
            });

            window.cookieConsent = {
                get: getConsent,
                set: saveConsent,
                open: showBanner
            };

            if (!getConsent()) {
                showBanner();
            }
        })();
    </script>

</body>

</html>
