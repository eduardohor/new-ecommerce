<div style="text-align:center; margin: 20px 0;">
    <img src="{{ $storeInfo && $storeInfo->logo ? asset('storage/' . $storeInfo->logo) : asset('images/logo/freshcart-logo.svg') }}"
        alt="{{ config('app.name') }} Logo" style="width: 100%; max-width: 250px; margin-bottom: 20px;">
</div>

<div
    style="font-family: Arial, sans-serif; color: #002b00; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px;">
    <div style="text-align:center">
        <img src="{{ asset('images/svg-graphics/welcome.svg') }}" alt="Welcome" style="width: 50%; max-width: 150px;">
    </div>
    <h1 style="color: #002b00; margin: 0; text-align:center; margin: 20px 0; font-size: 28px;">Bem-vindo(a) à {{
        $storeInfo && $storeInfo->name ? $storeInfo->name : config('app.name') }}!</h1>
    <div style="padding: 20px;">
        <p style="font-size: 16px; margin-bottom: 20px;">Olá, {{ $user->name }},</p>
        <p style="font-size: 16px; line-height: 1.6;">Estamos muito felizes em ter você conosco! A partir de agora, você
            terá acesso a todas as funcionalidades exclusivas que a {{ $storeInfo && $storeInfo->name ? $storeInfo->name
            : config('app.name') }} tem a oferecer.</p>
        <p style="font-size: 16px; line-height: 1.6;">Para começar, que tal explorar alguns dos nossos recursos e
            descobrir como podemos ajudar você a alcançar seus objetivos? Se precisar de qualquer ajuda, nossa equipe de
            suporte estará à disposição.</p>
        <p style="text-align: center; margin-top: 30px;">
            <a href="{{ asset('/') }}" target="_blank"
                style="display: inline-block; padding: 12px 24px; font-size: 16px; color: #fff; background-color: #0AAD0A; text-decoration: none; border-radius: 4px;">Explore
                Agora</a>
        </p>
        <p style="font-size: 16px; line-height: 1.6; margin-top: 30px;">Aproveite sua jornada com a {{
            $storeInfo && $storeInfo->name ? $storeInfo->name : config('app.name') }}. Estamos aqui para apoiar você em
            cada passo do caminho!</p>
    </div>
</div>

<div style="margin: 0 auto; text-align:center; padding: 20px 0;">
    <p style="font-size: 14px; color: #555;">{{ $storeInfo->name ?? config('app.name') }}© 2024. Todos os direitos reservados.</p>
</div>
