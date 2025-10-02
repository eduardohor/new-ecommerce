@if($product->hasActiveSale())
    <div class="countdown-timer {{ $class ?? '' }}"
         data-end-date="{{ $product->sale_end_date->toIso8601String() }}"
         data-product-id="{{ $product->id }}">
        <i class="bi bi-clock-fill me-1"></i>
        <span class="countdown-text"></span>
    </div>
@endif
