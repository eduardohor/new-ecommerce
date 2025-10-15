@php
    $whatsAppNumber = optional($storeInfo)->whatsapp_number ?? optional($storeInfo)->contact_number;
    $whatsAppMessage = rawurlencode('Olá! Gostaria de tirar uma dúvida.');
@endphp

@if ($whatsAppNumber)
    @php
        $sanitizedNumber = preg_replace('/\D+/', '', $whatsAppNumber);
        if (strpos($sanitizedNumber, '55') !== 0) {
            $sanitizedNumber = '55' . $sanitizedNumber;
        }
        $whatsAppUrl = "https://wa.me/{$sanitizedNumber}?text={$whatsAppMessage}";
    @endphp
    <a href="{{ $whatsAppUrl }}"
        class="whatsapp-float"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Atendimento via WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
@endif
