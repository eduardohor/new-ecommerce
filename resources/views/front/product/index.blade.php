@extends('front/layouts/store')
@section('title', 'Produto')
@section('content')

@section('head')

<link href="{{ asset('libs/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">
<link href="{{ asset('libs/slick-carousel/slick/slick.css') }}" rel="stylesheet" />
<link href="{{ asset('libs/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet" />

<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
      
@endsection
 
  <main>
  <div class="mt-4">
    <div class="container">
      <!-- row -->
      <div class="row ">
        <!-- col -->
        <div class="col-12">
          <!-- breadcrumb -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="#">Início</a></li>
              <li class="breadcrumb-item"><a href="#">Bakery Biscuits</a></li>

              <li class="breadcrumb-item active" aria-current="page">Napolitanke Ljesnjak</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <section class="mt-8">
    <div class="container">
      <div class="row">

        <div class="col-md-6">
          <!-- img slide -->
          <div class="product" id="product">
            <div class="zoom" onmousemove="zoom(event)"
              style="background-image: url({{ asset('images/products/product-single-img-1.jpg') }})">
              <!-- img -->
              <!-- img --><img src="{{ asset('images/products/product-single-img-1.jpg') }}" alt="">
            </div>
            <div>
              <div class="zoom" onmousemove="zoom(event)"
                style="background-image: url({{ asset('images/products/product-single-img-2.jpg') }})">
                <!-- img -->
                <img src="{{ asset('images/products/product-single-img-2.jpg') }}" alt="">
              </div>
            </div>
            <div>
              <div class="zoom" onmousemove="zoom(event)"
                style="background-image: url({{ asset('images/products/product-single-img-3.jpg') }})">
                <!-- img -->
                <img src="{{ asset('images/products/product-single-img-3.jpg') }}" alt="">
              </div>
            </div>
            <div>
              <div class="zoom" onmousemove="zoom(event)"
                style="background-image: url({{ asset('images/products/product-single-img-4.jpg') }})">
                <!-- img -->
                <img src="{{ asset('images/products/product-single-img-4.jpg') }}" alt="">
              </div>
            </div>
          </div>
          <!-- product tools -->
          <div class="product-tools">
            <div class="thumbnails row g-3" id="productThumbnails">
              <div class="col-3">
                <div class="thumbnails-img">
                  <!-- img -->
                  <img src="{{ asset('images/products/product-single-img-1.jpg') }}" alt="">
                </div>
              </div>
              <div class="col-3">
                <div class="thumbnails-img">
                  <!-- img -->
                  <img src="{{ asset('images/products/product-single-img-2.jpg') }}" alt="">
                </div>
              </div>
              <div class="col-3">
                <div class="thumbnails-img">
                  <!-- img -->
                  <img src="{{ asset('images/products/product-single-img-3.jpg') }}" alt="">
                </div>
              </div>
              <div class="col-3">
                <div class="thumbnails-img">
                  <!-- img -->
                  <img src="{{ asset('images/products/product-single-img-4.jpg') }}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="ps-lg-10 mt-6 mt-md-0">
            <!-- content -->
            <a href="#!" class="mb-4 d-block">Bakery Biscuits</a>
            <!-- heading -->
            <h1 class="mb-1">Napolitanke Ljesnjak </h1>
            <div class="mb-4">
              <!-- rating -->
              <!-- rating --> <small class="text-warning"> <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-half"></i></small><a href="#" class="ms-2">(30 Comentários)</a></div>
            <div class="fs-4">
              <!-- price --><span class="fw-bold text-dark">R$32</span> <span
                class="text-decoration-line-through text-muted">R$35</span><span><small class="fs-6 ms-2 text-danger">26%
                  de desconto</small></span>
            </div>
            <!-- hr -->
            <hr class="my-6">
            <div class="mb-5"><button type="button" class="btn btn-outline-secondary">250g</button>
              <!-- btn --> <button type="button" class="btn btn-outline-secondary">500g</button>
              <!-- btn --> <button type="button" class="btn btn-outline-secondary">1kg</button></div>
              <div>


                <!-- input -->
                <div class="input-group input-spinner  ">
                  <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                  <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field form-control-sm form-input   ">
                  <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                </div>

            </div>
            <div class="mt-3 row justify-content-start g-2 align-items-center">

              <div class="col-xxl-4 col-lg-4 col-md-5 col-5 d-grid">
                <!-- button -->
                <!-- btn --> <button type="button" class="btn btn-primary"><i class="feather-icon icon-shopping-bag me-2"></i>Adicionar</button>
              </div>
              <div class="col-md-4 col-4">
                <!-- btn -->
                <a class="btn btn-light " href="#" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Comparar"><i class="bi bi-arrow-left-right"></i></a>
                <a class="btn btn-light " href="shop-wishlist.html" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Wishlist"><i class="feather-icon icon-heart"></i></a>
              </div>
            </div>
            <!-- hr -->
            <hr class="my-6">
            <div>
              <!-- table -->
              <table class="table table-borderless mb-0">

                <tbody>
                  <tr>
                    <td>Código do Produto:</td>
                    <td>FBB00255</td>

                  </tr>
                  <tr>
                    <td>Disponibilidade:</td>
                    <td>Em estoque</td>

                  </tr>
                  <tr>
                    <td>Tipo:</td>
                    <td>Frutas</td>

                  </tr>
                  <tr>
                    <td>Envio:</td>
                    <td><small>01 dia de envio.<span class="text-muted">(Retirada gratuita hoje)</span></small></td>

                  </tr>


                </tbody>
              </table>

            </div>
            <div class="mt-8">
              <!-- dropdown -->
              <div class="dropdown">
                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Compartilhar
                </a>

                <ul class="dropdown-menu" >
                  <li><a class="dropdown-item" href="#"><i class="bi bi-facebook me-2"></i>Facebook</a></li>
                  <li><a class="dropdown-item" href="#"><i class="bi bi-twitter me-2"></i>Twitter</a></li>
                  <li><a class="dropdown-item" href="#"><i class="bi bi-instagram me-2"></i>Instagram</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mt-lg-14 mt-8 ">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
            <!-- nav item -->
            <li class="nav-item" role="presentation">
              <!-- btn --> <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane"
                aria-selected="true">Detalhes do Produto</button>
            </li>
            <!-- nav item -->
            <li class="nav-item" role="presentation">
              <!-- btn --> <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane"
                aria-selected="false">Informação</button>
            </li>
            <!-- nav item -->
            <li class="nav-item" role="presentation">
              <!-- btn --> <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane"
                aria-selected="false">Avaliações</button>
            </li>
            <!-- nav item -->
            <li class="nav-item" role="presentation">
              <!-- btn --> <button class="nav-link" id="sellerInfo-tab" data-bs-toggle="tab"
                data-bs-target="#sellerInfo-tab-pane" type="button" role="tab" aria-controls="sellerInfo-tab-pane"
                aria-selected="false" disabled>Informações do Vendedor</button>
            </li>
          </ul>
          <!-- tab content -->
          <div class="tab-content" id="myTabContent">
            <!-- tab pane -->
            <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab"
              tabindex="0">
              <div class="my-8">
                <div class="mb-5">
                  <!-- text -->
                  <h4 class="mb-1">Valor Nutricional e Benefícios</h4>
                  <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisi, tellus iaculis urna
                    bibendum
                    in lacus, integer. Id imperdiet vitae varius sed magnis eu nisi nunc sit. Vel, varius
                    habitant ornare ac rhoncus. Consequat risus facilisis ante ipsum netus risus adipiscing
                    sagittis sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="mb-5">
                  <h5 class="mb-1">Dicas de Armazenamento</h5>
                  <p class="mb-0">Nisi, tellus iaculis urna bibendum in lacus, integer. Id imperdiet vitae varius sed
                    magnis eu
                    nisi nunc sit. Vel, varius habitant ornare ac rhoncus. Consequat risus facilisis ante ipsum
                    netus risus adipiscing sagittis sed.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  </p>
                </div>
                <!-- content -->
                <div class="mb-5">
                  <h5 class="mb-1">Unidade</h5>
                  <p class="mb-0">3 unidades</p>
                </div>
                <div class="mb-5">
                  <h5 class="mb-1">Vendedor</h5>
                  <p class="mb-0">DMart Pvt. LTD</p>
                </div>
                <div>
                  <h5 class="mb-1">Isenção de Responsabilidade</h5>
                  <p class="mb-0">A imagem mostrada é uma representação e pode variar ligeiramente do produto real. Todos os esforços são feitos para manter a precisão de todas as informações exibidas.</p>
                </div>
              </div>
            </div>
            <!-- tab pane -->
            <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
              <div class="my-8">
                <div class="row">
                  <div class="col-12">
                    <h4 class="mb-4">Detalhes</h4>
                  </div>
                  <div class="col-12 col-lg-6">
                    <table class="table table-striped">
                      <!-- table -->
                      <tbody>
                        <tr>
                          <th>Peso</th>
                          <td>1000 Gramas</td>
                        </tr>
                        <tr>
                          <th>Tipo de Ingrediente</th>
                          <td>Vegetariano</td>
                        </tr>
                        <tr>
                          <th>Marca</th>
                          <td>Dmart</td>
                        </tr>
                        <tr>
                          <th>Quantidade do Pacote de Itens</th>
                          <td>1</td>
                        </tr>
                        <tr>
                          <th>Forma</th>
                          <td>Larry, o Pássaro</td>
                        </tr>
                        <tr>
                          <th>Fabricante</th>
                          <td>Dmart</td>
                        </tr>
                        <tr>
                          <th>Quantidade Líquida</th>
                          <td>340,0 Gramas</td>
                        </tr>
                        <tr>
                          <th>Dimensões do produto</th>
                          <td>9,6 x 7,49 x 18,49 centímetros</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-12 col-lg-6">
                    <table class="table table-striped">
                      <!-- table -->
                      <tbody>
                        <tr>
                          <th>ASIN</th>
                          <td>SB0025UJ75W</td>
                        </tr>
                        <tr>
                          <th>Classificação dos Mais Vendidos</th>
                          <td>Nº 2 em frutas</td>
                        </tr>
                        <tr>
                          <th>Data Disponível Pela Primeira Vez</th>
                          <td>30 de abril de 2022</td>
                        </tr>
                        <tr>
                          <th>Peso do Item</th>
                          <td>500g</td>
                        </tr>
                        <tr>
                          <th>Nome Genérico</th>
                          <td>Banana Robusta</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- tab pane -->
            <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
              <div class="my-8">
                <!-- row -->
                <div class="row">
                  <div class="col-md-4">
                    <div class="me-lg-12 mb-6 mb-md-0">
                      <div class="mb-5">
                        <!-- title -->
                        <h4 class="mb-3">Avaliações de Clientes</h4>
                        <span>
                          <!-- rating --> <small class="text-warning"> <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i></small><span class="ms-3">4,1 de 5</span><small
                            class="ms-3">11,130 avaliações globais</small></span>
                      </div>
                      <div class="mb-8">
                        <!-- progress -->
                        <div class="d-flex align-items-center mb-2">
                          <div class="text-nowrap me-3 text-muted"><span
                              class="d-inline-block align-middle text-muted">5</span><i
                              class="bi bi-star-fill ms-1 small text-warning"></i></div>
                          <div class="w-100">
                            <div class="progress" style="height: 6px;">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;"
                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div><span class="text-muted ms-3">53%</span>
                        </div>
                        <!-- progress -->
                        <div class="d-flex align-items-center mb-2">
                          <div class="text-nowrap me-3 text-muted"><span
                              class="d-inline-block align-middle text-muted">4</span><i
                              class="bi bi-star-fill ms-1 small text-warning"></i></div>
                          <div class="w-100">
                            <div class="progress" style="height: 6px;">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="50"></div>
                            </div>
                          </div><span class="text-muted ms-3">22%</span>
                        </div>
                        <!-- progress -->
                        <div class="d-flex align-items-center mb-2">
                          <div class="text-nowrap me-3 text-muted"><span
                              class="d-inline-block align-middle text-muted">3</span><i
                              class="bi bi-star-fill ms-1 small text-warning"></i></div>
                          <div class="w-100">
                            <div class="progress" style="height: 6px;">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 35%;"
                                aria-valuenow="35" aria-valuemin="0" aria-valuemax="35"></div>
                            </div>
                          </div><span class="text-muted ms-3">14%</span>
                        </div>
                        <!-- progress -->
                        <div class="d-flex align-items-center mb-2">
                          <div class="text-nowrap me-3 text-muted"><span
                              class="d-inline-block align-middle text-muted">2</span><i
                              class="bi bi-star-fill ms-1 small text-warning"></i></div>
                          <div class="w-100">
                            <div class="progress" style="height: 6px;">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 22%;"
                                aria-valuenow="22" aria-valuemin="0" aria-valuemax="22"></div>
                            </div>
                          </div><span class="text-muted ms-3">5%</span>
                        </div>
                        <!-- progress -->
                        <div class="d-flex align-items-center mb-2">
                          <div class="text-nowrap me-3 text-muted"><span
                              class="d-inline-block align-middle text-muted">1</span><i
                              class="bi bi-star-fill ms-1 small text-warning"></i></div>
                          <div class="w-100">
                            <div class="progress" style="height: 6px;">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 14%;"
                                aria-valuenow="14" aria-valuemin="0" aria-valuemax="14"></div>
                            </div>
                          </div><span class="text-muted ms-3">7%</span>
                        </div>
                      </div>
                      <div class="d-grid">
                        <h4>Avalie este produto</h4>
                        <p class="mb-0">Compartilhe seus pensamentos com outros clientes.</p>
                        <a href="#" class="btn btn-outline-gray-400 mt-4 text-muted">Escreva a Avaliação</a>
                      </div>

                    </div>
                  </div>
                  <!-- col -->
                  <div class="col-md-8">
                    <div class="mb-10">
                      <div class="d-flex justify-content-between align-items-center mb-8">
                        <div>
                          <!-- heading -->
                          <h4>Avaliações</h4>
                        </div>
                        <div>
                          <select class="form-select">
                            <option selected>Principais Avaliações</option>
                            <option value="1">Mais Recente</option>
                            <option value="2">Mais Antigo</option>
                          </select>
                        </div>

                      </div>
                      <div class="d-flex border-bottom pb-6 mb-6">
                        <!-- img -->
                        <!-- img --><img src="{{ asset('') }}images/avatar/avatar-10.jpg" alt=""
                          class="rounded-circle avatar-lg">
                        <div class="ms-5">
                          <h6 class="mb-1">
                            Shankar Subbaraman

                          </h6>
                          <!-- select option -->
                          <!-- content -->
                          <p class="small"> <span class="text-muted">30 de Dezembro de 2022</span>
                            <span class="text-primary ms-3 fw-bold">Compra Verificada</span></p>
                          <!-- rating -->
                          <div class=" mb-2">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span class="ms-3 text-dark fw-bold">Precisa verificar novamente o peso no ponto de entrega</span>
                          </div>
                          <!-- text-->
                          <p>A qualidade do produto é boa. Mas o peso parecia inferior a 1kg. Por ser enviado em pacote aberto, existe a possibilidade de furto no meio. FreshCart envia os vegetais e frutas através de tampas plásticas lacradas e código de barras no peso etc.</p>
                          <div>
                            <div class="border icon-shape icon-lg border-2 ">
                              <!-- img --><img src="{{ asset('') }}images/products/product-img-1.jpg" alt=""
                                class="img-fluid ">
                            </div>
                            <div class="border icon-shape icon-lg border-2 ms-1 ">
                              <!-- img --><img src="{{ asset('') }}images/products/product-img-2.jpg" alt=""
                                class="img-fluid ">
                            </div>
                            <div class="border icon-shape icon-lg border-2 ms-1 ">
                              <!-- img --><img src="{{ asset('') }}images/products/product-img-3.jpg" alt=""
                                class="img-fluid ">
                            </div>

                          </div>
                          <!-- icon -->
                          <div class="d-flex justify-content-end mt-4">
                            <a href="#" class="text-muted"><i class="feather-icon icon-thumbs-up me-1"></i>Útil</a>
                            <a href="#" class="text-muted ms-4"><i class="feather-icon icon-flag me-2"></i>Denunciar Abuso</a>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex border-bottom pb-6 mb-6 pt-4">
                        <!-- img --><img src="{{ asset('') }}images/avatar/avatar-12.jpg" alt=""
                          class="rounded-circle avatar-lg">
                        <div class="ms-5">
                          <h6 class="mb-1">
                            Robert Thomas

                          </h6>
                          <!-- content -->
                          <p class="small"> <span class="text-muted">29 de Dezembro de 2022</span>
                            <span class="text-primary ms-3 fw-bold">Compra Verificada</span></p>
                          <!-- rating -->
                          <div class=" mb-2">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                            <span class="ms-3 text-dark fw-bold">Precisa verificar novamente o peso no ponto de entrega</span>
                          </div>

                          <p>A qualidade do produto é boa. Mas o peso parecia inferior a 1kg. Por ser enviado em pacote aberto, existe a possibilidade de furto no meio. FreshCart envia os vegetais e frutas através de tampas plásticas lacradas e código de barras no peso etc.</p>

                          <!-- icon -->
                          <div class="d-flex justify-content-end mt-4">
                            <a href="#" class="text-muted"><i class="feather-icon icon-thumbs-up me-1"></i>Útil</a>
                            <a href="#" class="text-muted ms-4"><i class="feather-icon icon-flag me-2"></i>Denunciar Abuso</a>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex border-bottom pb-6 mb-6 pt-4">
                        <!-- img --><img src="{{ asset('') }}images/avatar/avatar-9.jpg" alt=""
                          class="rounded-circle avatar-lg">
                        <div class="ms-5">
                          <h6 class="mb-1">
                            Barbara Tay

                          </h6>
                          <!-- content -->
                          <p class="small"> <span class="text-muted">28 de Dezembro de 2022</span>
                            <span class="text-danger ms-3 fw-bold">Compra Não Verificada</span></p>
                          <!-- rating -->
                          <div class=" mb-2">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                            <span class="ms-3 text-dark fw-bold">Precisa verificar novamente o peso no ponto de entrega</span>
                          </div>

                          <p>Sempre que peço bananas frescas, recebo bananas amarelo-esverdeadas exatamente como eu queria, então vá em frente, é muito raro você superar as maduras.</p>

                          <!-- icon -->
                          <div class="d-flex justify-content-end mt-4">
                            <a href="#" class="text-muted"><i class="feather-icon icon-thumbs-up me-1"></i>Útil</a>
                            <a href="#" class="text-muted ms-4"><i class="feather-icon icon-flag me-2"></i>Denunciar Abuso</a>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex border-bottom pb-6 mb-6 pt-4">
                        <!-- img --><img src="{{ asset('') }}images/avatar/avatar-8.jpg" alt=""
                          class="rounded-circle avatar-lg">
                        <div class="ms-5 flex-grow-1">
                          <h6 class="mb-1">
                            Sandra Langevin

                          </h6>
                          <!-- content -->
                          <p class="small"> <span class="text-muted">8 December 2022</span>
                            <span class="text-danger ms-3 fw-bold">Compra Não Verificada</span></p>
                          <!-- rating -->
                          <div class=" mb-2">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                            <span class="ms-3 text-dark fw-bold">Great product</span>
                          </div>

                          <p>Ótimo produto e excelente qualidade. pacote. A entrega pode ser agilizada. </p>

                          <!-- icon -->
                          <div class="d-flex justify-content-end mt-4">
                            <a href="#" class="text-muted"><i class="feather-icon icon-thumbs-up me-1"></i>Útil</a>
                            <a href="#" class="text-muted ms-4"><i class="feather-icon icon-flag me-2"></i>Denunciar Abuso</a>
                          </div>
                        </div>
                      </div>
                      <div>
                        <a href="#" class="btn btn-outline-gray-400 text-muted">Ler Mais Comentários</a>
                      </div>
                    </div>
                    <div>
                      <!-- rating -->
                      <h3 class="mb-5">Criar Revisão</h3>
                      <div class="border-bottom py-4 mb-4">
                        <h4 class="mb-3">Avaliação Geral</h4>
                        <div id="rater"></div>
                      </div>
                      <div class="border-bottom py-4 mb-4">
                        <h4 class="mb-0">Recursos de Taxa</h4>
                        <div class="my-5">
                          <h5>Sabor</h5>
                          <div id="rate-2"></div>
                        </div>
                        <div class="my-5">
                          <h5>Custo-benefício</h5>
                          <div id="rate-3"></div>
                        </div>
                        <div class="my-5">
                          <h5>Aroma</h5>
                          <div id="rate-4"></div>
                        </div>


                      </div>
                      <!-- form control -->
                      <div class="border-bottom py-4 mb-4">
                        <h5>Adicione um título</h5>
                        <input type="text" class="form-control" placeholder="O que é mais importante saber">
                      </div>
                      <div class="border-bottom py-4 mb-4">
                        <h5>Adicione uma foto ou vídeo</h5>
                        <p>Os compradores consideram imagens e vídeos mais úteis do que apenas texto.</p>
                        <!-- form -->
                        <form action="#" class="dropzone profile-dropzone">
                          <div class="fallback">
                            <input name="file" type="file" multiple />
                          </div>
                        </form>

                      </div>
                      <div class=" py-4 mb-4">
                        <!-- heading -->
                        <h5>Adicione um comentário por escrito</h5>
                        <textarea class="form-control" rows="3"
                          placeholder="O que você gostou ou não gostou? Para que você usou este produto?"></textarea>

                      </div>
                      <!-- button -->
                      <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-primary">Enviar Revisão</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>
            <!-- tab pane -->
            <div class="tab-pane fade" id="sellerInfo-tab-pane" role="tabpanel" aria-labelledby="sellerInfo-tab"
              tabindex="0">...</div>
          </div>
        </div>
      </div>
    </div>



  </section>

  <!-- section -->
  <section class="my-lg-14 my-14">
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-12">
          <!-- heading -->
          <h3>Itens Relacionados</h3>
        </div>
      </div>
      <!-- row -->
      <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-2 mt-2">
        <!-- col -->
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <!-- badge -->

              <div class="text-center position-relative ">
                <div class=" position-absolute top-0 start-0">
                  <span class="badge bg-danger">Sale</span>
                </div>
                <a href="#!">
                  <!-- img --><img src="{{ asset('images/products/product-img-1.jpg') }}" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <!-- action btn -->
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <!-- heading -->
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Snack &
                    Munchies</small></a></div>
              <h2 class="fs-6"><a href="#!" class="text-inherit text-decoration-none">Haldiram's Sev Bhujia</a></h2>
              <div>

                <!-- rating --> <small class="text-warning"> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small> <span class="text-muted small">4.5(149)</span>
              </div>
              <!-- price -->
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$18</span> <span class="text-decoration-line-through text-muted">R$24</span>
                </div>
                <!-- btn -->
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <!-- col -->
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <!-- badge -->
              <div class="text-center position-relative"> <a href="#!"><img
                    src="{{ asset('images/products/product-img-2.jpg') }}" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <!-- action btn -->
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Lista de Favoritos"><i
                      class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <!-- heading -->
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Bakery &
                    Biscuits</small></a></div>
              <h2 class="fs-6"><a href="#!" class="text-inherit text-decoration-none">NutriChoice Digestive </a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small> <span class="text-muted small">4.5 (25)</span>
              </div>
              <!-- price -->
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$24</span>
                </div>
                <!-- btn -->
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <!-- col -->
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <!-- badge -->
              <div class="text-center position-relative"> <a href="#!"><img
                    src="{{ asset('images/products/product-img-3.jpg') }}" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <!-- action btn -->
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Lista de Favoritos"><i
                      class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <!-- heading -->
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Bakery &
                    Biscuits</small></a></div>
              <h2 class="fs-6"><a href="#!" class="text-inherit text-decoration-none">Cadbury 5 Star Chocolate</a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i></small> <span class="text-muted small">5 (469)</span>
              </div>
              <!-- price -->
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$32</span> <span class="text-decoration-line-through text-muted">R$35</span>
                </div>
                <!-- btn -->
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <!-- col -->
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <!-- badge -->
              <div class="text-center position-relative"> <a href="#!"><img
                    src="{{ asset('images/products/product-img-4.jpg') }}" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <!-- action btn -->
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Lista de Favoritos"><i
                      class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <!-- heading -->
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Snack &
                    Munchies</small></a></div>
              <h2 class="fs-6"><a href="#!" class="text-inherit text-decoration-none">Onion Flavour Potato</a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <i class="bi bi-star"></i></small> <span class="text-muted small">3.5 (456)</span>
              </div>
              <!-- price -->
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$3</span> <span class="text-decoration-line-through text-muted">R$5</span>
                </div>
                <!-- btn -->
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <!-- col -->
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <!-- badge -->
              <div class="text-center position-relative"> <a href="#!"><img
                    src="{{ asset('images/products/product-img-9.jpg') }}" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <!-- action btn -->
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Lista de Favoritos"><i
                      class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <!-- heading -->
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Snack &
                    Munchies</small></a></div>
              <h2 class="fs-6"><a href="#!" class="text-inherit text-decoration-none">Slurrp Millet Chocolate </a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small> <span class="text-muted small">4.5 (67)</span>
              </div>
              <!-- price -->
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$6</span> <span class="text-decoration-line-through text-muted">R$10</span>
                </div>
                <!-- btn -->
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
  <!-- modal -->
  <!-- Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-8">
        <div class="position-absolute top-0 end-0 me-3 mt-3">
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <!-- img slide -->
            <div class="product productModal" id="productModal">
              <div
                class="zoom"
                onmousemove="zoom(event)"
                style="
                  background-image: url({{ asset('images/products/product-single-img-1.jpg') }});
                "
              >
                <!-- img -->
                <img
                  src="{{ asset('images/products/product-single-img-1.jpg') }}"
                  alt=""
            >
              </div>
              <div>
                <div
                  class="zoom"
                  onmousemove="zoom(event)"
                  style="
                    background-image: url({{ asset('images/products/product-single-img-2.jpg') }});
                  "
                >
                  <!-- img -->
                  <img
                    src="{{ asset('images/products/product-single-img-2.jpg') }}"
                    alt=""
              >
                </div>
              </div>
              <div>
                <div
                  class="zoom"
                  onmousemove="zoom(event)"
                  style="
                    background-image: url({{ asset('images/products/product-single-img-3.jpg') }});
                  "
                >
                  <!-- img -->
                  <img
                    src="{{ asset('images/products/product-single-img-3.jpg') }}"
                    alt=""
              >
                </div>
              </div>
              <div>
                <div
                  class="zoom"
                  onmousemove="zoom(event)"
                  style="
                    background-image: url({{ asset('images/products/product-single-img-4.jpg') }});
                  "
                >
                  <!-- img -->
                  <img
                    src="{{ asset('images/products/product-single-img-4.jpg') }}"
                    alt=""
              >
                </div>
              </div>
            </div>
            <!-- product tools -->
            <div class="product-tools">
              <div class="thumbnails row g-3" id="productModalThumbnails">
                <div class="col-3" class="tns-nav-active">
                  <div class="thumbnails-img">
                    <!-- img -->
                    <img
                      src="{{ asset('images/products/product-single-img-1.jpg') }}"
                      alt=""
                >
                  </div>
                </div>
                <div class="col-3">
                  <div class="thumbnails-img" >
                    <!-- img -->
                    <img
                      src="{{ asset('images/products/product-single-img-2.jpg') }}"
                      alt=""
                >
                  </div>
                </div>
                <div class="col-3">
                  <div class="thumbnails-img">
                    <!-- img -->
                    <img
                      src="{{ asset('images/products/product-single-img-3.jpg') }}"
                      alt=""
                >
                  </div>
                </div>
                <div class="col-3">
                  <div class="thumbnails-img">
                    <!-- img -->
                    <img
                      src="{{ asset('images/products/product-single-img-4.jpg') }}"
                      alt=""
                >
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ps-lg-8 mt-6 mt-lg-0">
              <a href="#!" class="mb-4 d-block">Bakery Biscuits</a>
              <h2 class="mb-1 h1">Napolitanke Ljesnjak</h2>
              <div class="mb-4">
                <small class="text-warning">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small
                ><a href="#" class="ms-2">(30 comentários)</a>
              </div>
              <div class="fs-4">
                <span class="fw-bold text-dark">R$32</span>
                <span class="text-decoration-line-through text-muted">R$35</span
                ><span
                  ><small class="fs-6 ms-2 text-danger">26% de desconto</small></span
                >
              </div>
              <hr class="my-6">
              <div class="mb-4">
                <button type="button" class="btn btn-outline-secondary">
                  250g
                </button>
                <button type="button" class="btn btn-outline-secondary">
                  500g
                </button>
                <button type="button" class="btn btn-outline-secondary">
                  1kg
                </button>
              </div>
              <div>
                <!-- input -->
                <!-- input -->
                <div class="input-group input-spinner  ">
                  <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                  <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field form-control-sm form-input   ">
                  <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                </div>
              </div>
              <div
                class="mt-3 row justify-content-start g-2 align-items-center"
              >

                <div class="col-lg-4 col-md-5 col-6 d-grid">
                  <!-- button -->
                  <!-- btn -->
                  <button type="button" class="btn btn-primary">
                    <i class="feather-icon icon-shopping-bag me-2"></i>Adicionar
                  </button>
                </div>
                <div class="col-md-4 col-5">
                  <!-- btn -->
                  <a
                    class="btn btn-light"
                    href="#"
                    data-bs-toggle="tooltip"
                    data-bs-html="true"
                    aria-label="Compare"
                    ><i class="bi bi-arrow-left-right"></i
                  ></a>
                  <a
                    class="btn btn-light"
                    href="#!"
                    data-bs-toggle="tooltip"
                    data-bs-html="true"
                    aria-label="Wishlist"
                    ><i class="feather-icon icon-heart"></i
                  ></a>
                </div>
              </div>
              <hr class="my-6">
              <div>
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td>Código do Produto:</td>
                      <td>FBB00255</td>
                    </tr>
                    <tr>
                      <td>Disponibilidade:</td>
                      <td>In Stock</td>
                    </tr>
                    <tr>
                      <td>Tipo:</td>
                      <td>Frutas</td>
                    </tr>
                    <tr>
                      <td>Envio:</td>
                      <td>
                        <small
                          >01 dia de envio.<span class="text-muted"
                            >(Retirada gratuita hoje)</span
                          ></small
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@section('footer')
  <!-- Javascript-->
  <script src="{{ asset('libs/rater-js/index.js') }}"></script>
  <script src="{{ asset('libs/dropzone/dist/min/dropzone.min.js') }}"></script>

  <script src="{{ asset('libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
  <script src="{{ asset('js/vendors/tns-slider.js') }}"></script>
  <script src="{{ asset('js/vendors/zoom.js') }}"></script>
  <script src="{{ asset('js/vendors/increment-value.js') }}"></script>
   
 {{-- <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
 <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('libs/simplebar/dist/simplebar.min.js') }}"></script> --}}
 
 <!-- Theme JS -->
 <script src="{{ asset('js/theme.min.js') }}"></script>
 

    
@endsection

@endsection