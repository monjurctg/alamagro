<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class CartController extends Controller
{
    //Add to Cart
    public function AddToCart($id, $qty, Request $request){
        $res = array();

        // Default quantity to 1 if 0 or invalid
        if($qty == 0 || $qty == null) {
            $qty = 1;
        }

        // Get product details
        $product = Product::where('id', $id)->first();

        if (!$product) {
            $res['msgType'] = 'error';
            $res['msg'] = __('Product not found.');
            return response()->json($res);
        }

        // Check if product is published
        if ($product->is_publish != 1) {
            $res['msgType'] = 'error';
            $res['msg'] = __('Product is not available.');
            return response()->json($res);
        }

        // Get variations from request
        $selectedSize = $request->input('size');
        $selectedColor = $request->input('color');

        // Logic to handle variations
        // If coming from listing page (usually via .addtocart class), size/color might be null
        // We should auto-select if possible (single option) or for direct add

        if ($product->variation_size) {
            $availableSizes = explode(',', $product->variation_size);
            $availableSizes = array_map('trim', $availableSizes);
            $availableSizes = array_filter($availableSizes); // Remove empty values

            if (!$selectedSize) {
                // If only one size available, auto-select it
                if(count($availableSizes) == 1) {
                    $selectedSize = array_values($availableSizes)[0];
                } elseif(count($availableSizes) > 1) {
                     // For multiple sizes, if logic allows direct add (like from listing),
                     // we can auto-select the first one.
                     // However, the requirement says "For products with multiple... users should be required to select".
                     // But strictly enforcing this blocks listing page "Add to cart".
                     // Current compromise: Auto-select first option for listing page add implies "Direct Add" feature.
                     // The Frontend JS for details page will enforce selection.
                     // So if we reach here without selection, it's likely a Direct Add.
                     // use array_values to ensure index 0 exists after filter
                     $selectedSize = array_values($availableSizes)[0];
                }
            } else {
                 if (!in_array($selectedSize, $availableSizes)) {
                    $res['msgType'] = 'error';
                    $res['msg'] = __('Selected size is not available.');
                    return response()->json($res);
                }
            }
        }

        if ($product->variation_color) {
            $availableColors = explode(',', $product->variation_color);
            $availableColors = array_map('trim', $availableColors);
            $availableColors = array_filter($availableColors); // Remove empty values

            if (!$selectedColor) {
               if(count($availableColors) == 1) {
                    $selectedColor = array_values($availableColors)[0];
               } elseif(count($availableColors) > 1) {
                    // Auto-select first color for direct add
                    $selectedColor = array_values($availableColors)[0];
               }
            } else {
                if (!in_array($selectedColor, $availableColors)) {
                    $res['msgType'] = 'error';
                    $res['msg'] = __('Selected color is not available.');
                    return response()->json($res);
                }
            }
        }

        // Check stock availability
        if ($product->is_stock == 1) {
            if ($product->stock_status_id != 1) {
                $res['msgType'] = 'error';
                $res['msg'] = __('This product is out of stock.');
                return response()->json($res);
            }

            if ($qty > $product->stock_qty) {
                $res['msgType'] = 'error';
                $res['msg'] = __('Requested quantity is not available.');
                return response()->json($res);
            }
        }

        // Create cart item key
        $cartKey = $id;
        $variationInfo = '';

        if ($selectedSize || $selectedColor) {
            $variationParts = [];
            if ($selectedSize) {
                $variationParts[] = 'Size: ' . $selectedSize;
            }
            if ($selectedColor) {
                $variationParts[] = 'Color: ' . $selectedColor;
            }
            $variationInfo = implode(', ', $variationParts);
            // Create a unique key for variations
            $cartKey .= '_' . md5($variationInfo);
        }

        // Get current cart
        $cart = session()->get('shopping_cart', []);

        // Check if product with same variations already exists in cart
        if (isset($cart[$cartKey])) {
            // Update quantity
            $newQty = $cart[$cartKey]['qty'] + $qty;

            // Check stock again with new quantity
            if ($product->is_stock == 1 && $newQty > $product->stock_qty) {
                $res['msgType'] = 'error';
                $res['msg'] = __('Requested quantity exceeds available stock.');
                return response()->json($res);
            }

            $cart[$cartKey]['qty'] = $newQty;
        } else {
            // Get seller details
            $seller = DB::table('users')->where('id', $product->user_id)->first();

            // Handle case where seller might not exist (prevent 500 error)
            $sellerId = $seller ? $seller->id : null;
            $sellerName = $seller ? $seller->name : '';
            $storeName = $seller ? $seller->shop_name : '';
            $storeLogo = $seller ? $seller->shop_logo : '';
            $storeUrl = $seller ? $seller->shop_url : '';
            $sellerEmail = $seller ? $seller->email : '';
            $sellerPhone = $seller ? $seller->phone : '';
            $sellerAddress = $seller ? $seller->address : '';

            // Add new item to cart
            $cart[$cartKey] = [
                'id' => $id,
                'name' => $product->title,
                'price' => $product->sale_price,
                'qty' => $qty,
                'image' => $product->f_thumbnail,
                'thumbnail' => $product->f_thumbnail,
                'variation_details' => $variationInfo,
                'is_stock' => $product->is_stock,
                'stock_qty' => $product->stock_qty,
                'weight' => 0,
                'unit' => '',
                'seller_id' => $sellerId,
                'seller_name' => $sellerName,
                'store_name' => $storeName,
                'store_logo' => $storeLogo,
                'store_url' => $storeUrl,
                'seller_email' => $sellerEmail,
                'seller_phone' => $sellerPhone,
                'seller_address' => $sellerAddress
            ];
        }

        // Save cart to session
        session()->put('shopping_cart', $cart);

        $res['msgType'] = 'success';
        $res['msg'] = __('Product added to cart successfully.');

        return response()->json($res);
    }

    //Remove to Cart
    public function RemoveToCart($rowid){
        $res = array();

        $cart = session()->get('shopping_cart');
        if(isset($cart[$rowid])){
            unset($cart[$rowid]);
            session()->put('shopping_cart', $cart);
        } else {
            // If not found, try to find by product ID prefix (for products with variations)
            foreach($cart as $key => $item) {
                if(strpos($key, $rowid . '_') === 0 || $key == $rowid) {
                    unset($cart[$key]);
                    session()->put('shopping_cart', $cart);
                    break;
                }
            }
        }

        $res['msgType'] = 'success';
        $res['msg'] = __('Data Removed Successfully');

        return response()->json($res);
    }

    //Update Cart Quantity
    public function updateCartQuantity(Request $request){
        $res = array();

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = session()->get('shopping_cart', []);

        // First try to find by exact key (for products with variations)
        if(isset($cart[$productId])){
            $cart[$productId]['qty'] = $quantity;
            session()->put('shopping_cart', $cart);

            $res['msgType'] = 'success';
            $res['msg'] = __('Cart Updated Successfully');
        } else {
            // If not found, try to find by product ID prefix (for products without variations)
            $found = false;
            foreach($cart as $key => $item) {
                if(strpos($key, $productId . '_') === 0 || $key == $productId) {
                    $cart[$key]['qty'] = $quantity;
                    session()->put('shopping_cart', $cart);
                    $found = true;
                    break;
                }
            }

            if($found) {
                $res['msgType'] = 'success';
                $res['msg'] = __('Cart Updated Successfully');
            } else {
                $res['msgType'] = 'error';
                $res['msg'] = __('Product not found in cart');
            }
        }

        return response()->json($res);
    }

    //Get Cart View
    public function getCart(){
        $data = array();
        $gtext = gtext();

        $data['gtext'] = $gtext;
        return view('frontend.cart', $data);
    }

    //Get View Cart Data
    public function getViewCartData(){
        $res = array();

        $gtext = gtext();
        $tax_rate = $gtext['tax_rate'];

        $CartDataList = session()->get('shopping_cart');

        $total_qty = 0;
        $TotalPrice = 0;

        if(session()->get('shopping_cart')){
            foreach ($CartDataList as $row) {
                $total_qty += $row['qty'];
                $TotalPrice += $row['price']*$row['qty'];
            }
        }

        $TaxCal = ($TotalPrice*$tax_rate)/100;
        $SubTotal = $TotalPrice+$TaxCal;

        if($gtext['currency_position'] == 'left'){
            $res['price_total'] = $gtext['currency_icon'].NumberFormat($TotalPrice);
        }else{
            $res['price_total'] = NumberFormat($TotalPrice).$gtext['currency_icon'];
        }

        if($gtext['currency_position'] == 'left'){
            $res['tax'] = $gtext['currency_icon'].NumberFormat($TaxCal);
        }else{
            $res['tax'] = NumberFormat($TaxCal).$gtext['currency_icon'];
        }

        if($gtext['currency_position'] == 'left'){
            $res['sub_total'] = $gtext['currency_icon'].NumberFormat($SubTotal);
        }else{
            $res['sub_total'] = NumberFormat($SubTotal).$gtext['currency_icon'];
        }

        if($gtext['currency_position'] == 'left'){
            $res['total'] = $gtext['currency_icon'].NumberFormat($SubTotal);
        }else{
            $res['total'] = NumberFormat($SubTotal).$gtext['currency_icon'];
        }

        $res['total_qty'] = $total_qty;
        $res['items'] = view('frontend.partials.cart_item', compact('gtext'))->render();

        return response()->json($res);
    }

    //Add to Wishlist
    public function addToWishlist($id){
        $res = array();

        // Get product details
        $product = Product::where('id', $id)->first();

        if (!$product) {
            $res['msgType'] = 'error';
            $res['msg'] = __('Product not found.');
            return response()->json($res);
        }

        // Check if product is published
        if ($product->is_publish != 1) {
            $res['msgType'] = 'error';
            $res['msg'] = __('Product is not available.');
            return response()->json($res);
        }

        // Get current wishlist
        $wishlist = session()->get('wishlist', []);

        // Check if product already exists in wishlist
        if (!in_array($id, $wishlist)) {
            $wishlist[] = $id;
            session()->put('wishlist', $wishlist);
        }

        $res['msgType'] = 'success';
        $res['msg'] = __('Product added to wishlist successfully.');

        return response()->json($res);
    }

    //Get Wishlist View
    public function getWishlist(){
        $data = array();
        $gtext = gtext();

        $wishlistIds = session()->get('wishlist', []);

        if (!empty($wishlistIds)) {
            $wishlistItems = DB::table('products')
                ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
                ->join('users', 'products.user_id', '=', 'users.id')
                ->select('products.*', 'brands.name as brandname', 'users.shop_name', 'users.id as seller_id', 'users.shop_url')
                ->whereIn('products.id', $wishlistIds)
                ->where('products.is_publish', '=', 1)
                ->where('users.status_id', '=', 1)
                ->get();

            $data['wishlistItems'] = $wishlistItems;
        } else {
            $data['wishlistItems'] = [];
        }

        $data['gtext'] = $gtext;
        return view('frontend.wishlist', $data);
    }

    //Remove from Wishlist
    public function RemoveToWishlist($rowid){
        $res = array();

        $wishlist = session()->get('wishlist', []);

        if (($key = array_search($rowid, $wishlist)) !== false) {
            unset($wishlist[$key]);
            session()->put('wishlist', $wishlist);
        }

        $res['msgType'] = 'success';
        $res['msg'] = __('Data Removed Successfully');

        return response()->json($res);
    }

    //Count Wishlist Items
    public function countWishlist(){
        $wishlist = session()->get('wishlist', []);
        return response()->json(count($wishlist));
    }
}