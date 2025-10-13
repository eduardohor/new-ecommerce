<footer class="footer pt-5 pb-3">
    <div class="container">
        <div class="row py-3">
            <div class="col-md-4">
                <h4 class="mb-4">Links Rápidos</h4>
                <ul class="nav flex-column">
                    <!-- list -->
                    <li class="nav-item mb-2"><a href="#!" class="nav-link">Termos e Condições</a></li>
                    <li class="nav-item mb-2"><a href="#!" class="nav-link">Política de Privacidade</a></li>
                    <li class="nav-item mb-2"><a href="#!" class="nav-link">Política de Cookies</a></li>
                    <li class="nav-item mb-2"><a href="#!" class="nav-link">Sobre Nós</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4 class="mb-4">Contatos</h4>
                <!-- list -->
                <ul class="nav flex-column">
                    @if ($storeInfo)
                    <li class="nav-item mb-2"><a href="#!" class="nav-link"><i class="bi bi-geo-alt-fill"></i> {{
                            $storeInfo->state }}, {{ $storeInfo->city }}</a></li>
                    <li class="nav-item mb-2"><a href="#!" class="nav-link"><i class="bi bi-telephone-fill"></i> {{
                            $storeInfo->contact_number }}</a></li>
                    <li class="nav-item mb-2"><a href="#1" class="nav-link"><i class="bi bi-envelope-fill"></i> {{
                            $storeInfo->email }}</a></li>
                    @if ($storeInfo->cnpj)
                    <li class="nav-item mb-2"><span class="nav-link"><i class="bi bi-building"></i> CNPJ:
                            {{ $storeInfo->cnpj }}</span></li>
                    @endif
                    @endif
                </ul>
            </div>
            <div class="col-md-4">
                <h4 class="mb-4">Métodos de Pagamento</h4>
                <ul class="nav">
                    <!-- list -->
                    <li class="list-inline-item">
                        <a href="#!"><img src="{{ asset('images/payment/pix.svg') }}" alt=""></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!"><img src="{{ asset('images/payment/american-express.svg') }}" alt=""></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!"><img src="{{ asset('images/payment//mastercard.svg') }}" alt=""></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!"><img src="{{ asset('images/payment/elo.svg') }}" alt=""></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!"><img src="{{ asset('images/payment/visa.svg') }}" alt=""></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-top py-4">
            <div class="row align-items-center">
                <div class="col-md-6"><span class="small text-muted">{{ $storeInfo && $storeInfo->name ? $storeInfo->name : config('app.name') }}© <span
                            id="copyright"></span>
                        <script>
                            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                        </script>
                        |
                    </span> Todos os direitos reservados.</span>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline text-md-end mb-0 small mt-3 mt-md-0">
                        <li class="list-inline-item text-muted">Siga-nos</li>
                        <li class="list-inline-item me-1">
                            @php $facebook = optional($storeInfo)->facebook_url; @endphp
                            <a href="{{ $facebook ?? '#!' }}" class="btn btn-xs btn-social btn-icon" @if($facebook)
                                target="_blank" rel="noopener noreferrer" @endif> <svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-facebook"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                </svg></a>
                        </li>
                        <li class="list-inline-item me-1">
                            @php $xUrl = optional($storeInfo)->x_url; @endphp
                            <a href="{{ $xUrl ?? '#!' }}" class="btn btn-xs btn-social btn-icon" @if($xUrl) target="_blank"
                                rel="noopener noreferrer" @endif> <svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-twitter-x"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M1.146 0 6.313 7.689 1 16h3.146l3.665-5.8L10.938 16H16l-5.448-7.912L15.607 0H12.54l-3.21 4.932L6.95 0z" />
                                </svg></a>
                        </li>
                        <li class="list-inline-item">
                            @php $instagram = optional($storeInfo)->instagram_url; @endphp
                            <a href="{{ $instagram ?? '#!' }}" class="btn btn-xs btn-social btn-icon" @if($instagram)
                                target="_blank" rel="noopener noreferrer" @endif><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-instagram"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                </svg></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</footer>
