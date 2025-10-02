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

    @yield('head')

    <!-- Google tag (gtag.js) -->

    <!-- End Tag -->

</head>

<body>

    @include('front.partials.header')

    @yield('content')

    @include('front.partials.footer')

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

</body>

</html>
