@extends('front/layouts/account')
@section('title', 'Forma de Pagamento')

@section('content')

<div class="col-lg-9 col-md-8 col-12">
  <div class="py-6 p-md-6 p-lg-10">
      <!-- heading -->
    <div class="d-flex justify-content-between mb-6 align-items-center">
      <h2 class="mb-0">Métodos de Pagamento</h2>
      <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">Adicionar Cartão </a>

    </div>
    <ul class="list-group list-group-flush">
      <!-- List group item -->
      <li class="list-group-item py-5 px-0">
        <div class="d-flex justify-content-between">
          <div class="d-flex">
              <!-- img -->
            <img src="{{ asset('images/svg-graphics/visa.svg') }}" alt="">
              <!-- text -->
            <div class="ms-4">
              <h5 class="mb-0 h6 h6">**** 1234</h5>
              <p class="mb-0 small">Expiram em 10/2023
              </p>
            </div>
          </div>
          <div>
              <!-- button -->
            <a href="#" class="btn btn-outline-gray-400 disabled btn-sm">Remover</a>
          </div>
        </div>
      </li>
      <!-- List group item -->
      <li class="list-group-item px-0 py-5">
        <div class="d-flex justify-content-between">
          <div class="d-flex">
              <!-- img -->
            <img src="{{ asset('images/svg-graphics/mastercard.svg') }}" alt="" class="me-3">
            <div>
              <h5 class="mb-0 h6">Mastercard terminado em 1234</h5>
              <p class="mb-0 small">Expiram em 03/2026</p>
            </div>
          </div>
          <div>
              <!-- button-->
            <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Remover</a>
          </div>
        </div>
      </li>
      <!-- List group item -->
      <li class="list-group-item px-0 py-5">
        <div class="d-flex justify-content-between">
          <div class="d-flex">
              <!-- img -->
            <img src="{{ asset('images/svg-graphics/discover.svg') }}" alt="" class="me-3">
            <div>
                <!-- text -->
              <h5 class="mb-0 h6">Discover terminado em 1234</h5>
              <p class="mb-0 small">Expiram em 07/2020 <span class="badge bg-warning text-dark"> Este cartão está vencido.</span></p>
            </div>
          </div>
          <div>
              <!-- btn -->
            <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Remover</a>
          </div>
        </div>
      </li>
      <!-- List group item -->
      <li class="list-group-item px-0 py-5">
        <div class="d-flex justify-content-between">
          <div class="d-flex">
              <!-- img -->
            <img src="{{ asset('images/svg-graphics/americanexpress.svg') }}" alt="" class="me-3">
              <!-- text -->
            <div>
              <h5 class="mb-0 h6">American Express terminado em 1234</h5>
              <p class="mb-0 small">Expiram em 12/2021</p>
            </div>
          </div>
          <div>
              <!-- btn -->
            <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Remover</a>
          </div>
        </div>
      </li>
      <!-- List group item -->
      <li class="list-group-item px-0 py-5 border-bottom">
        <div class="d-flex justify-content-between">
          <div class="d-flex">
              <!-- img -->
            <img src="{{ asset('images/svg-graphics/paypal.svg') }}" alt="" class="me-3">
            <div>
                <!-- text -->
              <h5 class="mb-0 h6">Paypal Express terminado em 1234</h5>
              <p class="mb-0 small">Expiram em 10/2021</p>
            </div>
          </div>
          <div>
              <!-- btn -->
            <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Remover</a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>

 <!-- Payment Modal -->
 <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
 aria-hidden="true">
 <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
   <!-- modal content -->
   <div class="modal-content">
     <!-- modal header -->
     <div class="modal-header align-items-center d-flex">
       <h5 class="modal-title" id="paymentModalLabel">
        Adicionar nova forma de pagamento
       </h5>
       <!-- button -->
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

       </button>
     </div>
     <!-- Modal body -->
     <div class="modal-body">
       <div>
         <!-- Form -->
         <form class="row mb-4">
           <div class="mb-3 col-12 col-md-12 mb-4">
             <h5 class="mb-3">Cartão de Crédito / Débito</h5>
             <!-- Radio button -->
             <div class="d-inline-flex">
               <div class="form-check me-2">
                 <input type="radio" id="paymentRadioOne" name="paymentRadioOne" class="form-check-input" />
                 <label class="form-check-label" for="paymentRadioOne"><img
                     src="{{ asset('images/payment/american-express.svg') }}" alt=""></label>
               </div>
               <!-- Radio button -->
               <div class="form-check me-2">
                 <input type="radio" id="paymentRadioTwo" name="paymentRadioOne" class="form-check-input" />
                 <label class="form-check-label" for="paymentRadioTwo"><img
                     src="{{ asset('images/payment/mastercard.svg') }}" alt=""></label>
               </div>

               <!-- Radio button -->
               <div class="form-check">
                 <input type="radio" id="paymentRadioFour" name="paymentRadioOne" class="form-check-input" />
                 <label class="form-check-label" for="paymentRadioFour"><img src="{{ asset('images/payment/visa.svg') }}"
                     alt=""></label>
               </div>
             </div>
           </div>
           <!-- Name on card -->
           <div class="mb-3 col-12 col-md-4">
             <label for="nameoncard" class="form-label">Nome no cartão</label>
             <input id="nameoncard" type="text" class="form-control" name="nameoncard" placeholder="Nome" required />
           </div>
           <!-- Month -->
           <div class="mb-3 col-12 col-md-4">
             <label class="form-label">Mês</label>
             <select class="form-select">
               <option value="">Mês</option>
               <option value="Jan">Janeiro</option>
               <option value="Feb">Fevereiro</option>
               <option value="Mar">Março</option>
               <option value="Apr">Abril</option>
               <option value="May">Maio</option>
               <option value="June">Junho</option>
               <option value="July">Julho</option>
               <option value="Aug">Agosto</option>
               <option value="Sep">Setembro</option>
               <option value="Oct">Outubro</option>
               <option value="Nov">Novembro</option>
               <option value="Dec">Dezembro</option>
             </select>
           </div>
           <!-- Year -->
           <div class="mb-3 col-12 col-md-4">
             <label class="form-label">Ano</label>
             <select class="form-select">
               <option value="">Ano</option>
               <option value="June">2022</option>
               <option value="July">2023</option>
               <option value="August">2024</option>
               <option value="Sep">2025</option>
               <option value="Oct">2026</option>
             </select>
           </div>
           <!-- Card number -->
           <div class="mb-3 col-md-8 col-12">
             <label for="cc-mask" class="form-label">Número do Cartão</label>
             <input type="text" class="form-control" id="cc-mask" data-inputmask="'mask': '9999 9999 9999 9999'" placeholder="xxxx-xxxx-xxxx-xxxx" required />
           </div>
           <!-- CVV -->
           <div class="mb-3 col-md-4 col-12">
             <div class="mb-3">
               <label for="cvv" class="form-label">CVV
                 <i class="fe fe-help-circle ms-1" data-bs-toggle="tooltip" data-placement="top"
                   title="A 3 - digit number, typically printed on the back of a card."></i></label>
                             <input type="password" class="form-control" name="cvv" id="cvv"  data-inputmask="'mask':'999'" placeholder="xxx" maxlength="3" required />
             </div>
           </div>
           <!-- Button -->
           <div class="col-md-6 col-12">
             <button class="btn btn-primary" type="submit">
               Adicionar Novo Cartão
             </button>
             <button class="btn btn-outline-gray-400 text-muted" type="button" data-bs-dismiss="modal">
               Fechar
             </button>
           </div>
         </form>
         <span><strong>Observação:</strong> você poderá remover seu cartão posteriormente na página de configuração da conta.</span>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection