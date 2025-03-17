<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Basket\Basket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\QuantityExceededException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CartController extends Controller
{
    protected $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    /**
     * Show the cart.
     */
    public function index()
    {
        return view('front.cart.index', ['basket' => $this->basket]);
    }

    /**
     * Add item to cart.
     */
    public function postAdd(Request $request)
    {
         $slug =$request -> product_slug ;
         $product = Product::where('slug', $slug)->firstOrFail();

        try {
            $this->basket->add($product, $product->qty ?? 1);
        } catch (QuantityExceededException $e) {
            return 'Quantity Exceeded';  // must be trans as the site is multi languages
        }

        return 'Product added successfully to the card ';
    }
    /**
     * Update cart item.
     */
    public function update($slug, Request $request)
    {
        $request->validate(['quantity' => 'required|integer|min:0']);

        $product = Product::where('slug', $slug)->firstOrFail();

        try {
            $this->basket->update($product, $request->quantity);
        } catch (QuantityExceededException $e) {
            return response()->json(['error' => __('site.cart.msgs.exceeded')], 400);
        }

        return response()->json(['message' => __('site.cart.msgs.updated')]);
    }

    /**
     * Update multiple cart items.
     */
    public function updateAll(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:0'
        ]);

        foreach ($this->basket->all() as $index => $item) {
            try {
                $this->basket->update($item, $request->quantities[$index] ?? 0);
            } catch (QuantityExceededException $e) {
                return response()->json(['error' => __('site.cart.msgs.exceeded')], 400);
            }
        }

        return response()->json(['message' => __('site.cart.msgs.updated')]);
    }

    /**
     * Checkout process.
     */
    public function checkout()
    {
        if (!auth('site')->check()) {
            return redirect()->route('site.auth.index');
        }
        return view('site.pages.cart.checkout');
    }

    /**
     * Make an order.
     */
    public function makeOrder(Request $request)
    {
        if ($this->finalizeOrder()) {
            return redirect()->route('site.orders')->with('success', __('site.cart.msgs.order_success'));
        }
        return redirect()->route('site.orders')->with('error', __('site.cart.msgs.order_error'));
    }

    /**
     * Finalize order request.
     */
    protected function finalizeOrder()
    {
        $user = auth('site')->user();
        if (!$user) return false;

        $address = Session::get('shipping-address');
        $shippingMethodId = Session::get('shipping-method');
        $paymentMethodId = Session::get('pilling-method');

        $order = DB::table('orders')->insertGetId([
            "member_id" => $user->id,
            "address" => json_encode(["address" => $address]),
            "payment" => json_encode(["method_id" => $paymentMethodId]),
            "status" => "pending",
            "subtotal" => $this->basket->subTotal(),
        ]);

        foreach ($this->basket->all() as $item) {
            DB::table('order_product')->insert([
                "product_id" => $item->id,
                "order_id" => $order,
                "total" => $item->getTotal(),
                "quantity" => $item->quantity
            ]);
        }

        return true;
    }

    /**
     * Payment request.
     */
    public function makePayment()
    {
        $response = $this->requestPayment($this->basket->subTotal());
        return view('site.pages.cart.makepayment', ['responseData' => json_decode($response)->id ?? null]);
    }

    /**
     * Check payment status.
     */
    public function checkPaymentStatus(Request $request)
    {
        $request->validate(['id' => 'required|string']);
        $paymentId = $request->id;

        $response = $this->verifyPayment($paymentId);
        $result = json_decode($response);

        if ($result->result->description === "Request successfully processed") {
            if ($this->finalizeOrder()) {
                return redirect()->route('site.orders')->with('success', __('site.cart.msgs.order_success'));
            }
        }

        return redirect()->route('site.orders')->with('error', __('site.cart.msgs.order_error'));
    }

    /**
     * Handle payment request.
     */
    private function requestPayment($amount)
    {
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = http_build_query([
            "authentication.userId" => env('PAYMENT_USER_ID'),
            "authentication.password" => env('PAYMENT_PASSWORD'),
            "authentication.entityId" => env('PAYMENT_ENTITY_ID'),
            "amount" => $amount,
            "currency" => "SAR",
            "paymentType" => "DB",
            "testMode" => "EXTERNAL",
            "merchantTransactionId" => auth('site')->id()
        ]);

        return $this->curlRequest($url, $data);
    }

    /**
     * Verify payment status.
     */
    private function verifyPayment($paymentId)
    {
        $url = "https://test.oppwa.com/v1/checkouts/{$paymentId}/payment?" . http_build_query([
            "authentication.userId" => env('PAYMENT_USER_ID'),
            "authentication.password" => env('PAYMENT_PASSWORD'),
            "authentication.entityId" => env('PAYMENT_ENTITY_ID')
        ]);

        return $this->curlRequest($url);
    }

    /**
     * CURL request helper.
     */
    private function curlRequest($url, $data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if ($data) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
