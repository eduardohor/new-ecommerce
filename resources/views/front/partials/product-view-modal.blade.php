<div class="modal fade" id="productViewModal" tabindex="-1" aria-labelledby="productViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-8">
                <div class="position-absolute top-0 end-0 me-3 mt-3">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <!-- img slide -->
                        <div class="product productModal" id="productModal">

                        </div>
                        <!-- product tools -->
                        <div class="product-tools">
                            <div class="thumbnails row g-3" id="productModalThumbnails">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-8 mt-6 mt-lg-0">
                            <a href="#!" class="mb-4 d-block category"></a>
                            <h2 class="mb-1 title"></h2>
                            {{-- Avaliações --}}
                            {{-- <div class="mb-4">
                                <small class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i></small><a href="#" class="ms-2">(30 avaliações)</a>
                            </div> --}}
                            <div class="fs-4">
                                <span class="fw-bold text-dark" id="sale_price"></span>
                                <span class="text-decoration-line-through text-muted"
                                    id="regular_price"></span><span><small class="fs-6 ms-2 text-danger"
                                        id="discount"></small></span>
                            </div>
                            <hr class="my-6">
                            {{-- <div class="mb-4">
                                <button type="button" class="btn btn-outline-secondary" id="weight">
                                    250g
                                </button>
                            </div> --}}
                            <div>
                                <!-- input -->
                                <!-- input -->
                                <div class="input-group input-spinner  ">
                                    <input type="button" value="-" class="button-minus  btn  btn-sm "
                                        data-field="quantity">
                                    <input type="number" step="1" max="10" value="1" name="quantity" id="quantity"
                                        class="quantity-field form-control-sm form-input   ">
                                    <input type="button" value="+" class="button-plus btn btn-sm "
                                        data-field="quantity">
                                </div>
                            </div>
                            <div class="mt-3 row justify-content-start g-2 align-items-center">

                                <div class="col-lg-4 col-md-5 col-6 d-grid">
                                    <!-- button -->
                                    <!-- btn -->
                                    <button type="button" class="btn btn-primary" onclick="postAddToCart()">
                                        Adicionar
                                    </button>
                                </div>
                                {{-- <div class="col-md-4 col-5">
                                    <!-- btn -->
                                    <a class="btn btn-light" href="#" data-bs-toggle="tooltip" data-bs-html="true"
                                        aria-label="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                    <a class="btn btn-light" href="#!" data-bs-toggle="tooltip" data-bs-html="true"
                                        aria-label="Wishlist"><i class="feather-icon icon-heart"></i></a>
                                </div> --}}
                            </div>
                            <hr class="my-6">
                            <div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Código do Produto:</td>
                                            <td id="product_code"></td>
                                        </tr>
                                        <tr>
                                            <td>Disponibilidade:</td>
                                            <td id="in_stock"></td>
                                        </tr>
                                        <tr>
                                            <td>Categoria:</td>
                                            <td class="category"></td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Envia:</td>
                                            <td>
                                                <small>01 dia de envio.<span class="text-muted">(Retirada gratuita
                                                        hoje)</span></small>
                                            </td>
                                        </tr> --}}
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


<script>
    var currentProductId = null;
  window.csrfToken = @json(csrf_token());

  // Funções de utilidade

  function formatPrice(price) {
    return parseFloat(price).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
  }

  function formatWeight(weight) {
    var parsedWeight = parseFloat(weight);
    return parsedWeight >= 1 ? parsedWeight.toLocaleString('pt-BR') + ' kg' : (parsedWeight * 1000).toLocaleString('pt-BR') + 'g';
  }

  function createZoomImage(imagePath) {
    var zoomDiv = $('<div class="zoom" onmousemove="zoom(event)" style="background-image: url(\'' + "{{ asset('storage') }}/" + imagePath + '\');"></div>');
    var img = $('<img>').attr('src', "{{ asset('storage') }}" + '/' + imagePath).attr('alt', 'Product Image');
    zoomDiv.append(img);
    return zoomDiv;
  }

  function createThumbnail(imagePath, isActive) {
    var thumbnailDiv = $('<div class="col-3"></div>');
    var thumbnailImg = $('<img>').attr('src', "{{ asset('storage/') }}" + '/' + imagePath).attr('alt', 'Thumbnail Image');

    if (isActive) {
      thumbnailDiv.addClass('tns-nav-active');
    }

    thumbnailDiv.append($('<div class="thumbnails-img"></div>').append(thumbnailImg));
    return thumbnailDiv;
  }

  // Função para atualizar o conteúdo do modal
  function updateModalContent(product) {
    currentProductId = product.id;

    var modal = $('#productViewModal');
    var productModalContainer = modal.find("#productModal");
    var thumbnailsContainer = modal.find("#productModalThumbnails");

    productModalContainer.empty();
    thumbnailsContainer.empty();

    product.product_images.forEach(function (image, index) {
      var zoomDiv = createZoomImage(image.image_path);
      productModalContainer.append(zoomDiv);

      var thumbnailDiv = createThumbnail(image.image_path, index === 0);
      thumbnailsContainer.append(thumbnailDiv);
    });

    modal.find(".category")
    .text(product.category.name)
    .attr('href', "{{ route('category-products', ['slug' => ':slug']) }}".replace(':slug', product.category.slug));

    modal.find('#productViewModalLabel').text(product.category.name);
    modal.find('#productViewModal img').attr('src', "{{ asset('storage/') }}" + '/' + product.product_images[0].image_path);
    modal.find('.title').text(product.title);
    modal.find('#regular_price').text(formatPrice(product.regular_price));
    modal.find('#weight').text(formatWeight(product.weight));
    modal.find('#product_code').text(product.product_code);

    modal.find('#in_stock').text("Sem estoque").addClass('text-danger');

    if (product.in_stock == 1) {
      modal.find('#in_stock').text("Em estoque").removeClass('text-danger');
    }

    var hasSalePrice = parseFloat(product.sale_price) > 0;
    modal.find('#sale_price').toggle(hasSalePrice).text(formatPrice(product.sale_price));

    modal.find('#regular_price').toggleClass('text-decoration-line-through text-muted', hasSalePrice)
                              .toggleClass('fw-bold text-dark', !hasSalePrice);

    var discountPercentage = 0;
    if (hasSalePrice) {
      var regularPrice = parseFloat(product.regular_price);
      var salePrice = parseFloat(product.sale_price);
      discountPercentage = ((regularPrice - salePrice) / regularPrice) * 100;
    }

    modal.find('#discount').toggle(hasSalePrice).text(Math.round(discountPercentage) + '% de desconto');
  }

  // Função para mostrar o modal e inicializar o slider
  function showProductViewModal(product) {
    updateModalContent(product);
    $('#productViewModal').modal('show');

    var slider;

    if ($(".productModal").length > 0) {
      slider = tns({
        container: "#productModal",
        items: 1,
        startIndex: 0,
        navContainer: "#productModalThumbnails",
        navAsThumbnails: true,
        autoplay: false,
        autoplayTimeout: 1500,
        swipeAngle: false,
        speed: 1500,
        controls: false,
        autoplayButtonOutput: false,
        loop: false,
      });
    }

    $.ajax({
      url: '/adicionar-view-produto/' + product.id,
      type: 'GET',
      success: function(response) {
      },
      error: function(error) {
      }
    });
  }

  function postAddToCart() {
  var quantity = $('#quantity').val();

  if (currentProductId) {

    $.ajax({
      url: '/adicionar-ao-carrinho',
      type: 'POST',
      data: {
        _token: window.csrfToken,
        product_id: currentProductId,
        quantity: quantity,
      },
      success: function(response) {
        window.location.href = '{{ route('cart.show') }}';
      },
      error: function(error) {
        console.error("Erro ao adicionar o produto ao carrinho:", error);
      }
    });

  } else {
    console.error("ID do Produto não disponível.");
  }
}

</script>
