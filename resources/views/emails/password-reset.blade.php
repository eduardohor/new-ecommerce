<div style="text-align:center; margin: 10px 0;">
    <img src="{{ url('images/logo/freshcart-logo.svg') }}" alt="{{ config('app.name') }} Logo"
        style="width: 100%; max-width: 250px; margin-bottom: 10px;">
</div>
<div
    style="font-family: Arial, sans-serif; color: #002b00; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px;">
    <div style="text-align:center">
        <img src="{{ url('images/svg-graphics/forgot_password.svg') }}" alt="Reset Password"
            style="width: 50%; max-width: 120px;">
    </div>
    <h1 style="color: #002b00; margin: 0; text-align:center; margin:10px 0; font-size: 24px;">Recuperação de Senha</h1>
    <div style="padding: 20px;">
        <p style="font-size: 16px;">Olá, {{ $user->name }}</p>
        <p style="font-size: 16px;">Recebemos uma solicitação para recuperar a senha da sua conta em {{
            config('app.name') }}. Se você fez essa solicitação, clique no botão abaixo para criar uma nova senha.</p>
        <p style="text-align: center;">
            <a href="{{ $resetUrl }}"
                style="display: inline-block; padding: 10px 20px; margin: 14px 0; font-size: 16px; color: #fff; background-color: #0AAD0A; text-decoration: none; border-radius: 4px;">Redefinir
                Senha</a>
        </p>
        <p style="text-align:center; font-size: 16px;">Se você não solicitou a recuperação de senha, por favor, ignore
            este e-mail.</p>
    </div>
</div>
<div style="margin: 0 auto; text-align:center; padding: 10px 0;">
    <p style="font-size: 14px;">{{ config('app.name') }}© 2024. Todos os direitos reservados.</p>
</div>
