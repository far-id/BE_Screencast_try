<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Screencast\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function store()
    {
        $order = Auth::user()->orders()->create([
            'order_identifier' => 'order-'. time(),
            'playlist_ids' => Auth::user()->carts->pluck('playlist_id'),
            'total' => Auth::user()->carts->sum('price')
        ]);

        $params = [
            "enable_payment" => [
                "credit_card", "cimb_clicks", "bca_klikbca",
                "bca_klikpay", "bri_epay", "echannel", "permata_va",
                "bca_va", "bni_va", "bri_va", "other_va", "gopay",
                "indomaret", "danamon_online", "akulaku", "shopeepay"
            ],

            "transaction_details" => [
                'order_id' => $order->order_identifier,
                'gross_amount' => $order->total
            ],

            "customer_details" => Auth::user(),

            "expiry" => [
                'start_time' => now()->format("Y-m-d H:i:s T"),
                'unit' => 'days',
                'duration' => 1
            ]
        ];

        $header = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '. base64_encode(config('payment.server_key')),
        ];

        $url = "https://app.sandbox.midtrans.com/snap/v1/transactions";

        $response = Http::withHeaders($header)->post($url, $params);

        return $response;
    }

    public function notificationHandler(Request $request)
    {
        // midtrans mengirimkan order key yang harus divalidasi yg berisi :
        // SHA512(order_id=status_code+gross_amount+serverkey)
        // baca di https://docs.midtrans.com/en/after-payment/http-notification
        $signature = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . config('payment.server_key'));

        if ($signature !== $request->signature_key ) {
            abort(403);
        }

        // cari ordernya dari database, ambil order dan usernya, lakukan kepemilikan dari playlist sesuai usernya
        // jadi playlist kan masuk ke cart.playlist_id, dari cart.playlist_id nya masuk ke order.playlist_ids sebagai array dan user melakukan pembayaran, setelah pembayaran selesai buat order.playlist_ids kedalam purchased_playlist, lalu hapus playlist yang telah dibeli dari carts dan juga ordernya?

        $order = Order::where('order_identifier', $request->order_id)->first();
        $user = $order->user;

        foreach ($order->playlist_ids as $i ) {
            $playlist = Playlist::find($i);
            $user->buy($playlist);
        }

        $order->delete();
        $user->carts()->delete();

        return;
    }
}
