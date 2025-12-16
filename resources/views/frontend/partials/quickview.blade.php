@php $gtext = gtext(); @endphp
<div class="row">
    <div class="col-md-6">
        <div class="product-gallery">
            <div class="product-image">
                <img src="{{ asset('public/media/'.$data->f_thumbnail) }}" alt="{{ $data->title }}" class="img-fluid" id="quick-view-image">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="product-details">
            <h3 class="product-title">{{ $data->title }}</h3>
            <div class="product-price">
                @if($data->sale_price != '')
                    @if($gtext['currency_position'] == 'left')
                        <span class="new-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($data->sale_price) }}</span>
                    @else
                        <span class="new-price">{{ NumberFormat($data->sale_price) }}{{ $gtext['currency_icon'] }}</span>
                    @endif
                @endif
                @if(($data->is_discount == 1) && ($data->old_price !=''))
                    @if($gtext['currency_position'] == 'left')
                        <span class="old-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($data->old_price) }}</span>
                    @else
                        <span class="old-price">{{ NumberFormat($data->old_price) }}{{ $gtext['currency_icon'] }}</span>
                    @endif
                @endif
            </div>

            <!-- Size Option -->
            @if($data->variation_size != '')
                <div class="widget-size">
                    <h6 class="widget-title">{{ __('Size') }}</h6>
                    <div class="widget-desc">
                        <ul class="mysize">
                            @foreach(explode(',', $data->variation_size) as $size)
                                <li class="size-option" data-size="{{ trim($size) }}"><a href="javascript:void(0);">{{ trim($size) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Color Option -->
            @if($data->variation_color != '')
                <div class="widget-color">
                    <h6 class="widget-title">{{ __('Color') }}</h6>
                    <div class="widget-desc">
                        <ul class="mycolor">
                            @foreach(explode(',', $data->variation_color) as $color)
                                <li class="color-option" data-color="{{ trim($color) }}" style="background-color:{{ trim($color) }};"></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="quantity-cart">
                <div class="quantity-box">
                    <button class="qty-btn minus" id="modal_minus">-</button>
                    <input type="number" class="quantity" id="modal_quantity" value="1" min="1" max="{{ $data->is_stock == 1 ? $data->stock_qty : 999 }}">
                    <button class="qty-btn plus" id="modal_plus">+</button>
                </div>
                <!-- Logic note: .product_addtocart class is used by cart.js for the final add action -->
                <!-- We add data attributes for validation -->
                <a href="javascript:void(0);"
                   class="btn theme-btn product_addtocart"
                   data-id="{{ $data->id }}"
                   data-stockqty="{{ $data->stock_qty }}"
                   data-is_stock="{{ $data->is_stock }}"
                   data-is_stock_status="{{ $data->stock_status_id }}"
                   id="modal_add_to_cart_btn"
                   >
                   {{ __('Add To Cart') }}
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Minimal JS for the modal interactions (Size/Color selection, Quantity)
    // We can reuse or duplicate logic from product.blade.php/cart.js if needed,
    // but since this is loaded via AJAX, we might need to re-bind or use delegated events.
    // However, existing cart.js uses $(document).on('click', '.product_addtocart'), so it should work if we match classes.

    // Size Selection
    $('.size-option').on('click', function() {
        $('.size-option').removeClass('active');
        $(this).addClass('active');
    });

    // Color Selection
    $('.color-option').on('click', function() {
        $('.color-option').removeClass('active');
        $(this).addClass('active');
    });

    // Quantity Logic for Modal
    $('#modal_plus').on('click', function() {
        var qtyInput = $('#modal_quantity');
        var val = parseInt(qtyInput.val());
        var max = parseInt(qtyInput.attr('max'));
        if(val < max) {
            qtyInput.val(val + 1);
        }
    });

    $('#modal_minus').on('click', function() {
        var qtyInput = $('#modal_quantity');
        var val = parseInt(qtyInput.val());
        if(val > 1) {
            qtyInput.val(val - 1);
        }
    });

    // Sync modal quantity to the main hidden input that cart.js reads?
    // Actually cart.js reads `$("#quantity").val()`.
    // We should ensure cart.js reads strictly from the *visible* quantity input or we override it.
    // For now, let's make sure we update the correct ID or change how cart.js reads it.
    // Existing cart.js reads `$("#quantity").val()`.
    // We will simple override `$("#quantity")` if it exists or ensure this input has that ID *within this context*.
    // Better yet, update cart.js to read from the context of the button pressed?
    // No, cart.js is global.
    // I will give this input id="quantity" BUT this might conflict if there is another ID quantity on page (product details page).
    // Homepage doesn't have #quantity.

    // Let's use specific IDs and modify cart.js to look for them if present, or better:
    // Update cart.js to handle specific modal quantity input.
</script>
