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