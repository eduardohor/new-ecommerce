@extends('front/layouts/store')
@section('title', 'Finalizar Compra')
@section('content')

<main>
  <!-- section-->
  <div class="mt-4">
    <div class="container">
      <!-- row -->
      <div class="row ">
        <!-- col -->
        <div class="col-12">
          <!-- breadcrumb -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="#!">Início</a></li>
              <li class="breadcrumb-item"><a href="#!">Loja</a></li>
              <li class="breadcrumb-item active" aria-current="page">Confira</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- section -->
  <section class="mb-lg-14 mb-8 mt-8">
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- col -->
        <div class="col-12">
          <div>
            <div class="mb-8">
              <!-- text -->
              <h1 class="fw-bold mb-0">Confira</h1>
              <p class="mb-0">Já tem uma conta? Clique aqui para Fazer <a href="#!">login</a>.</p>
            </div>
          </div>
        </div>
      </div>
      <div>
        <!-- row -->
        <div class="row">
          <div class="col-lg-7 col-md-12">
            <!-- accordion -->
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <!-- accordion item -->
              <div class="accordion-item py-4">

                <div class="d-flex justify-content-between align-items-center">
                  <!-- heading one -->
                  <a href="#" class="fs-5 text-inherit collapsed h4"  data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                    <i class="feather-icon icon-map-pin me-2 text-muted"></i>Adicionar endereço de entrega
                  </a>
                  <!-- btn -->
                  <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#addAddressModal">Adicionar um novo endereço </a>
                  <!-- collapse -->
                </div>
                <div id="flush-collapseOne" class="accordion-collapse collapse show"
                  data-bs-parent="#accordionFlushExample">
                  <div class="mt-5">
                    <div class="row">
                      <div class="col-lg-6 col-12 mb-4">
                        <!-- form -->
                        <div class="card card-body p-6 ">
                          <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="homeRadio" checked>
                            <label class="form-check-label text-dark" for="homeRadio">
                              Lar
                            </label>
                          </div>
                          <!-- address -->
                          <address> <strong>Jitu Chauhan</strong> <br>

                            4450 North Avenue Oakland, <br>

                            Nebraska, United States,<br>

                            <abbr title="Phone">P: 402-776-1106</abbr></address>
                          <span class="text-danger">Endereço padrão </span>

                        </div>
                      </div>
                      <div class="col-lg-6 col-12 mb-4">
                        <!-- input -->
                        <div class="card card-body p-6 ">
                          <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="officeRadio">
                            <label class="form-check-label text-dark" for="officeRadio">
                              Escritório
                            </label>
                          </div>
                          <address> <strong>Nitu Chauhan</strong> <br> 3853 Coal Road, <br>
                            Tannersville, Pennsylvania, 18372, USA,<br>

                            <abbr title="Phone">P: 402-776-1106</abbr>
                          </address>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <!-- accordion item -->
              <div class="accordion-item py-4">
                <a href="#" class="text-inherit collapsed h5"  data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  <i class="feather-icon icon-clock me-2 text-muted"></i>Prazo de entrega
                </a>
                <!-- collapse -->
                <div id="flush-collapseTwo" class="accordion-collapse collapse "
                  data-bs-parent="#accordionFlushExample">
                  <!-- nav -->
                  <ul class="nav nav-pills nav-pills-light mb-3 nav-fill mt-5" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <!-- button -->
                      <button class="nav-link active" id="pills-today-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-today" type="button" role="tab" aria-controls="pills-today"
                        aria-selected="true">Hoje <br><small>3 de outobro</small>
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <!-- button -->
                      <button class="nav-link" id="pills-monday-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-monday" type="button" role="tab" aria-controls="pills-monday"
                        aria-selected="false">seg <br><small>4 de outubro</small>
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <!-- button -->
                      <button class="nav-link" id="pills-Tue-tab" data-bs-toggle="pill" data-bs-target="#pills-Tue"
                        type="button" role="tab" aria-controls="pills-Tue" aria-selected="false">ter <br><small>5 de outubro</small></button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <!-- button -->
                      <button class="nav-link" id="pills-Wed-tab" data-bs-toggle="pill" data-bs-target="#pills-Wed"
                        type="button" role="tab" aria-controls="pills-Wed" aria-selected="false">qua <br><small>6 de outubro</small></button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <!-- button -->
                      <button class="nav-link" id="pills-Thu-tab" data-bs-toggle="pill" data-bs-target="#pills-Thu"
                        type="button" role="tab" aria-controls="pills-Thu" aria-selected="false">qui <br> <small>O7 de outubro</small> </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <!-- button -->
                      <button class="nav-link" id="pills-Fri-tab" data-bs-toggle="pill" data-bs-target="#pills-Fri"
                        type="button" role="tab" aria-controls="pills-Fri" aria-selected="false">sex <br> <small>8 de outubro
                          8</small> </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <!-- button -->
                      <button class="nav-link" id="pills-Sat-tab" data-bs-toggle="pill" data-bs-target="#pills-Sat"
                        type="button" role="tab" aria-controls="pills-Sat" aria-selected="false">sab <br> <small>9 de outubro</small>
                      </button>
                    </li>
                  </ul>
                  <!-- tab content -->
                  <div class="tab-content" id="pills-tabContent">
                    <!-- tab pane -->
                    <div class="tab-pane fade show active" id="pills-today" role="tabpanel"
                      aria-labelledby="pills-today-tab" tabindex="0">
                      <!-- list group -->
                      <ul class="list-group list-group-flush mt-4">
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">

                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault1">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>

                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <!-- badge -->
                          <div class="col-3 text-center"> <span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault2">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault2">
                                <span>Dentro de 3 horas</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault3">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault3">
                                <span>1pm - 2pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$0.00</div>
                          <div class="col-3 text-center"><span class="badge bg-success">Livre</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault4">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault4">
                                <span>2pm - 3pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <!-- badge -->
                          <div class="col-3 text-center"> <span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault5">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault5">
                                <span>3pm - 4pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <!-- badge -->
                          <div class="col-3 text-center"> <span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>

                      </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-monday" role="tabpanel" aria-labelledby="pills-monday-tab"
                      tabindex="0">
                      <ul class="list-group list-group-flush mt-4">
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">

                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault6">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault6">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>

                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault7">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault7">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault8">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault8">
                                <span>1pm - 2pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$0.00</div>
                          <div class="col-3 text-center"><span class="badge bg-success">Livre</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault9">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault9">
                                <span>2pm - 3pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault10">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault10">
                                <span>3pm - 4pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>

                      </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-Tue" role="tabpanel" aria-labelledby="pills-Tue-tab"
                      tabindex="0">
                      <ul class="list-group list-group-flush mt-4">
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">

                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault11">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault11">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>

                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault12">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault12">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault13">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault13">
                                <span>1pm - 2pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$0.00</div>
                          <div class="col-3 text-center"><span class="badge bg-success">Livre</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault14">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault14">
                                <span>2pm - 3pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault15">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault15">
                                <span>3pm - 4pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>

                      </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-Wed" role="tabpanel" aria-labelledby="pills-Wed-tab"
                      tabindex="0">
                      <ul class="list-group list-group-flush mt-4">
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">

                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault16">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault16">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>

                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault17">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault17">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault18">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault18">
                                <span>1pm - 2pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$0.00</div>
                          <div class="col-3 text-center"><span class="badge bg-success">Livre</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault19">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault19">
                                <span>2pm - 3pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault20">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault20">
                                <span>3pm - 4pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>

                      </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-Thu" role="tabpanel" aria-labelledby="pills-Thu-tab"
                      tabindex="0">
                      <ul class="list-group list-group-flush mt-4">
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">

                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault21">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault21">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>

                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault22">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault22">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <!-- badge -->
                          <div class="col-3 text-center"> <span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault23">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault23">
                                <span>1pm - 2pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$0.00</div>
                          <div class="col-3 text-center"><span class="badge bg-success">Livre</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault24">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault24">
                                <span>2pm - 3pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault25">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault25">
                                <span>3pm - 4pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>

                      </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-Fri" role="tabpanel" aria-labelledby="pills-Fri-tab"
                      tabindex="0">
                      <ul class="list-group list-group-flush mt-4">
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">

                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault26">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault26">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>

                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault27">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault27">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault28">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault28">
                                <span>1pm - 2pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$0.00</div>
                          <div class="col-3 text-center"><span class="badge bg-success">Livre</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault29">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault29">
                                <span>2pm - 3pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault30">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault30">
                                <span>3pm - 4pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>

                      </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-Sat" role="tabpanel" aria-labelledby="pills-Sat-tab"
                      tabindex="0">
                      <ul class="list-group list-group-flush mt-4">
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">

                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault31">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault31">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>

                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault32">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault32">
                                <span>Dentro de 2 horas</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault33">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault33">
                                <span>1pm - 2pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$0.00</div>
                          <div class="col-3 text-center"><span class="badge bg-success">Livre</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault34">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault34">
                                <span>2pm - 3pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>
                        <!-- list group item -->
                        <li class="list-group-item  d-flex justify-content-between align-items-center px-0 py-3">
                          <!-- col -->
                          <div class="col-4">
                            <div class="form-check">
                              <!-- form check input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault35">
                              <!-- label -->
                              <label class="form-check-label" for="flexRadioDefault35">
                                <span>3pm - 4pm</span>
                              </label>
                            </div>
                          </div>
                          <!-- price -->
                          <div class="col-3 text-center">R$3.99</div>
                          <div class="col-3 text-center"><span class="badge bg-danger">Pago</span></div>
                          <!-- col -->
                          <div class="col-2 text-end"> <a href="#"
                              class="btn btn-outline-gray-400 btn-sm text-muted">Escolher</a></div>

                        </li>

                      </ul>
                    </div>
                  </div>
                  <div class="mt-5 d-flex justify-content-end">
                    <a href="#" class="btn btn-outline-gray-400 text-muted"
                      data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                      aria-controls="flush-collapseOne">Anterior</a>
                    <a href="#" class="btn btn-primary ms-2"  data-bs-toggle="collapse"
                      data-bs-target="#flush-collapseThree" aria-expanded="false"
                      aria-controls="flush-collapseThree">Próximo</a>
                  </div>
                </div>
              </div>
              <!-- accordion item -->
              <div class="accordion-item py-4">

                <a href="#" class="text-inherit h5"  data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  <i class="feather-icon icon-shopping-bag me-2 text-muted"></i>Instruções de entrega
                  <!-- collapse --> </a>
                <div id="flush-collapseThree" class="accordion-collapse collapse "
                  data-bs-parent="#accordionFlushExample">

                  <div class="mt-5">
                    <label for="DeliveryInstructions" class="form-label sr-only"> Instruções de entrega</label>
                    <textarea class="form-control" id="DeliveryInstructions" rows="3"
                      placeholder="Instruções de entrega "></textarea>
                    <p class="form-text">Adicione instruções sobre como você deseja que seu pedido seja comprado e/ou entregue</p>
                    <div class="mt-5 d-flex justify-content-end">
                      <a href="#" class="btn btn-outline-gray-400 text-muted"
                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                        aria-controls="flush-collapseTwo">Anterior</a>
                      <a href="#" class="btn btn-primary ms-2"  data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseFour" aria-expanded="false"
                        aria-controls="flush-collapseFour">Próximo</a>
                    </div>
                  </div>
                </div>

              </div>
              <!-- accordion item -->
              <div class="accordion-item py-4">

                <a href="#" class="text-inherit h5"  data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                  <i class="feather-icon icon-credit-card me-2 text-muted"></i>Forma de pagamento
                  <!-- collapse --> </a>
                <div id="flush-collapseFour" class="accordion-collapse collapse "
                  data-bs-parent="#accordionFlushExample">

                  <div class="mt-5">
                    <div>

                      <div class="card card-bordered shadow-none mb-2">
                        <!-- card body -->
                        <div class="card-body p-6">
                          <div class="d-flex">
                            <div class="form-check">
                              <!-- checkbox -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="paypal">
                              <label class="form-check-label ms-2" for="paypal">

                              </label>
                            </div>
                            <div>
                              <!-- title -->
                              <h5 class="mb-1 h6"> Pagamento com Paypal</h5>
                              <p class="mb-0 small">Você será redirecionado ao site do PayPal para concluir sua compra com segurança.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- card -->
                      <div class="card card-bordered shadow-none mb-2">
                        <!-- card body -->
                        <div class="card-body p-6">
                          <div class="d-flex mb-4">
                            <div class="form-check ">
                              <!-- input -->
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="creditdebitcard">
                              <label class="form-check-label ms-2" for="creditdebitcard">

                              </label>
                            </div>
                            <div>
                              <h5 class="mb-1 h6"> Cartão de Crédito / Débito</h5>
                              <p class="mb-0 small">Transferência segura de dinheiro usando sua conta bancária. Apoiamos Mastercard tercard, Visa, Discover e Stripe.</p>
                            </div>
                          </div>
                          <div class="row g-2">
                            <div class="col-12">
                              <!-- input -->
                              <div class="mb-3">
                                <label class="form-label">Número do Cartão</label>
                                <input type="text" class="form-control" placeholder="1234 4567 6789 4321">
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <!-- input -->
                              <div class="mb-3 mb-lg-0">
                                <label class="form-label">Nome no Cartão </label>
                                <input type="text" class="form-control" placeholder="Enter your first name">
                              </div>
                            </div>
                            <div class="col-md-3 col-12">
                              <!-- input -->
                              <div class="mb-3  mb-lg-0 position-relative">
                                <label class="form-label">Data de validade </label>
                                <input class="form-control flatpickr " type="text" placeholder="Select Date">
                                <div class="position-absolute bottom-0 end-0 p-3 lh-1">
                                  <i class="bi bi-calendar text-muted"></i>
                                </div>

                              </div>
                            </div>
                            <div class="col-md-3 col-12">
                              <!-- input -->
                              <div class="mb-3  mb-lg-0">
                                <label class="form-label">CVV</label>
                                <input type="password" class="form-control" placeholder="***">

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- card -->
                      <div class="card card-bordered shadow-none mb-2">
                        <!-- card body -->
                        <div class="card-body p-6">
                          <!-- check input -->
                          <div class="d-flex">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="payoneer">
                              <label class="form-check-label ms-2" for="payoneer">

                              </label>
                            </div>
                            <div>
                              <!-- title -->
                              <h5 class="mb-1 h6"> Pague com Payoneer</h5>
                              <p class="mb-0 small">Você será redirecionado ao site da Payoneer para concluir sua compra com segurança.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- card -->
                      <div class="card card-bordered shadow-none">
                        <div class="card-body p-6">
                          <!-- check input -->
                          <div class="d-flex">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="cashonDelivery">
                              <label class="form-check-label ms-2" for="cashonDelivery">

                              </label>
                            </div>
                            <div>
                              <!-- title -->
                              <h5 class="mb-1 h6"> Pagamento na entrega</h5>
                              <p class="mb-0 small">Pague em dinheiro quando seu pedido for entregue.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Button -->
                      <div class="mt-5 d-flex justify-content-end">
                        <a href="#" class="btn btn-outline-gray-400 text-muted"
                          data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false"
                          aria-controls="flush-collapseThree">Anterior</a>
                        <a href="#" class="btn btn-primary ms-2">Faça o Pedido</a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>


            </div>

          </div>

          <div class="col-12 col-md-12 offset-lg-1 col-lg-4">
            <div class="mt-4 mt-lg-0">
              <div class="card shadow-sm">
                <h5 class="px-6 py-4 bg-transparent mb-0">Detalhes do Pedido</h5>
                <ul class="list-group list-group-flush">
                  <!-- list group item -->
                  <li class="list-group-item px-4 py-3">
                    <div class="row align-items-center">
                      <div class="col-2 col-md-2">
                        <img src="{{ asset('images/products/product-img-1.jpg') }}" alt="Ecommerce" class="img-fluid"></div>
                      <div class="col-5 col-md-5">
                        <h6 class="mb-0">Haldiram's Sev Bhujia</h6>
                        <span><small class="text-muted">.98 / lb</small></span>

                      </div>
                      <div class="col-2 col-md-2 text-center text-muted">
                        <span>1</span>

                      </div>
                      <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                        <span class="fw-bold">R$5.00</span>

                      </div>
                    </div>

                  </li>
                  <!-- list group item -->
                  <li class="list-group-item px-4 py-3">
                    <div class="row align-items-center">
                      <div class="col-2 col-md-2">
                        <img src="{{ asset('images/products/product-img-2.jpg') }}" alt="Ecommerce" class="img-fluid"></div>
                      <div class="col-5 col-md-5">
                        <h6 class="mb-0">NutriChoice Digestive</h6>
                        <span><small class="text-muted">250g</small></span>

                      </div>
                      <div class="col-2 col-md-2 text-center text-muted">
                        <span>1</span>

                      </div>
                      <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                        <span class="fw-bold">R$20.00</span>
                        <div class="text-decoration-line-through text-muted small">R$26.00</div>
                      </div>
                    </div>

                  </li>
                  <!-- list group item -->
                  <li class="list-group-item px-4 py-3">
                    <div class="row align-items-center">
                      <div class="col-2 col-md-2">
                        <img src="{{ asset('images/products/product-img-3.jpg') }}" alt="Ecommerce" class="img-fluid"></div>
                      <div class="col-5 col-md-5">
                        <h6 class="mb-0">Cadbury 5 Star Chocolate</h6>
                        <span><small class="text-muted">1 kg</small></span>

                      </div>
                      <div class="col-2 col-md-2 text-center text-muted">
                        <span>1</span>

                      </div>
                      <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                        <span class="fw-bold">R$15.00</span>
                        <div class="text-decoration-line-through text-muted small">R$20.00</div>
                      </div>
                    </div>

                  </li>
                  <!-- list group item -->
                  <li class="list-group-item px-4 py-3">
                    <div class="row align-items-center">
                      <div class="col-2 col-md-2">
                        <img src="{{ asset('images/products/product-img-4.jpg') }}" alt="Ecommerce" class="img-fluid"></div>
                      <div class="col-5 col-md-5">
                        <h6 class="mb-0">Onion Flavour Potato</h6>
                        <span><small class="text-muted">250g</small></span>

                      </div>
                      <div class="col-2 col-md-2 text-center text-muted">
                        <span>1</span>

                      </div>
                      <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                        <span class="fw-bold">R$15.00</span>
                        <div class="text-decoration-line-through text-muted small">R$20.00</div>
                      </div>
                    </div>

                  </li>

                  <!-- list group item -->
                  <li class="list-group-item px-4 py-3">
                    <div class="d-flex align-items-center justify-content-between   mb-2">
                      <div>
                        Subtotal do Item

                      </div>
                      <div class="fw-bold">
                        R$70.00

                      </div>

                    </div>
                    <div class="d-flex align-items-center justify-content-between  ">
                      <div>
                        Taxa de Serviço <i class="feather-icon icon-info text-muted" data-bs-toggle="tooltip"
                          title="Default tooltip"></i>

                      </div>
                      <div class="fw-bold">
                        R$3.00

                      </div>

                    </div>

                  </li>
                  <!-- list group item -->
                  <li class="list-group-item px-4 py-3">
                    <div class="d-flex align-items-center justify-content-between fw-bold">
                      <div>
                        Subtotal
                      </div>
                      <div>
                        R$73.00


                      </div>

                    </div>


                  </li>

                </ul>

              </div>


            </div>
          </div>


        </div>
      </div>


    </div>


  </section>
</main>


  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete address</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6>Are you sure you want to delete this address?</h6>
          <p class="mb-6">Jitu Chauhan<br>

            4450 North Avenue Oakland, <br>

            Nebraska, United States,<br>

            402-776-1106</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-gray-400" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- modal body -->
        <div class="modal-body p-6">
          <div class="d-flex justify-content-between mb-5">
            <!-- heading -->
            <div>
              <h5 class="h6 mb-1" id="addAddressModalLabel">Novo endereço de entrega</h5>
              <p class="small mb-0">Adicione um novo endereço de entrega para a entrega do seu pedido.</p>
            </div>
            <div>
              <!-- button -->
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          </div>
          <!-- row -->
          <div class="row g-3">
            <!-- col -->
            <div class="col-12">
              <input type="text" class="form-control" placeholder="Primeiro Nome" aria-label="First name" required="">
            </div>
            <!-- col -->
            <div class="col-12">
              <input type="text" class="form-control" placeholder="Sobrenome" aria-label="Last name" required="">
            </div>
            <!-- col -->
            <div class="col-12">

              <input type="text" class="form-control" placeholder="Endereço Linha 1">
            </div>
            <div class="col-12">
              <!-- button -->
              <input type="text" class="form-control" placeholder="Endereço Linha 2">
            </div>
            <div class="col-12">
              <!-- button -->
              <input type="text" class="form-control" placeholder="Cidade">
            </div>
            {{-- <div class="col-12">
              <!-- button -->
              <select class="form-select">
                <option selected=""> India</option>
                <option selected=""> India</option>
                <option value="1">UK</option>
                <option value="2">USA</option>
                <option value="3">UAE</option>
              </select>
            </div> --}}
            <div class="col-12">
              <!-- button -->
              <select class="form-select">
                <option selected="">São Paulo</option>
                <option value="1">Rio de Janeiro</option>
                <option value="2">Maranhão</option>
                <option value="3">Piauí</option>
              </select>
            </div>
            <div class="col-12">
              <!-- button -->
              <input type="text" class="form-control" placeholder="CEP">
            </div>
            {{-- <div class="col-12">
              <!-- button -->
              <input type="text" class="form-control" placeholder="Business Name">
            </div> --}}
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <!-- label -->
                <label class="form-check-label" for="flexCheckDefault">
                  Definir como padrão
                </label>
              </div>
            </div>
            <!-- button -->
            <div class="col-12 text-end">
              <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
              <button class="btn btn-primary" type="button">Salvar Endereço</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


@section('footer')
<!-- Javascript-->
<script src="{{ asset('libs/flatpickr/dist/flatpickr.min.js') }}"></script>
 <!-- Theme JS -->
 <script src="{{ asset('js/theme.min.js') }}"></script>
    
@endsection

@endsection