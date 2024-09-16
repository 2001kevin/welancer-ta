<?php

namespace App\Http\Controllers;

use App\Models\TerminPembayaran;
use App\Models\transaksi;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TerminPembayaranController extends Controller
{

    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function index(){
        $termins = TerminPembayaran::orderBy('created_at', 'desc')->get();
        return view('dashboard.payment.index', compact('termins'));
    }

    public function userIndex(){
        $user_id = Auth::user()->id;
        $transaksis = transaksi::where('user_id', $user_id)->pluck('id');
        $termins = TerminPembayaran::orderBy('created_at', 'desc')->whereIn('transaksi_id', $transaksis)->get();
        // dd($termins);
        return view('dashboard.payment.userIndex', compact('termins'));
    }

    public function createTransaction(Request $request)
    {
        $id_termin = $request->input('id_termin');
        $termin = TerminPembayaran::find($id_termin);
        $params = [
            'transaction_details' => [
                'order_id' => uniqid() . '_' . $id_termin,
                'gross_amount' => (int)$termin->jumlah_pembayaran, // Total pembayaran
            ],

            'customer_details' => [
                'first_name' => auth()->user()->name,
                'last_name' => '',
                'email' => auth()->user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function successTermin(Request $req) {
        $orderId = $req->query('order_id');
        $statusCode = $req->query('status_code');
        $transactionStatus = $req->query('transaction_status');

        if (!$orderId || !$statusCode || !$transactionStatus) {
            return response()->json(['message' => 'Invalid parameters'], 400);
        }

        list($order_id, $termin_id) = explode('_', $orderId);

        $termin = TerminPembayaran::find($termin_id);
        // if (!$termin) {
        //     return redirect()->route('user.pernikahan.index')->with('gagal', 'Terjadi kesalahan dalam menyelesaikan transaksi');
        // }

        $transactionDetails = $this->getTransactionStatus($orderId);
        // if (!$transactionDetails) {
        //     return redirect()->route('user.pernikahan.index')->with('gagal', 'Terjadi kesalahan dalam menyelesaikan transaksi');
        // }

        // Log::info('Transaction details:', (array) $transactionDetails);
        $data = $this->formatTransactionData($transactionDetails);
        $termin->payment_status = $data['transaction_status'];
        $termin->payment_type = $data['payment_type'];
        $termin->transaction_time = $data['transaction_time'];
        $termin->currency = $data['currency'];
        $termin->order_id = $data['order_id'];
        $termin->status_code = $data['status_code'];
        $termin->signature_key = $data['signature_key'];
        $termin->payment_id = $data['transaction_id'];
        $termin->payment_status = $data['transaction_status'];
        $termin->fraud_status = $data['fraud_status'];
        $termin->expiry_time = $data['expiry_time'];
        $termin->bank = $data['bank'];
        $termin->va_number = $data['va_number'];
        $termin_id = $termin->id;
        $termin_id_next = $termin_id + 1;

        if (in_array($transactionDetails['transaction_status'], ['capture', 'settlement'])) {
            $termin->status_pembayaran = 'Payment Succesfull';
            $termin->status_termin = 'not payable';
            $transaksi_id = $termin->transaksi_id;
            $termin->save();
            
            $transaksi = transaksi::find($transaksi_id);
            // Ambil rincian termin dan hitung jumlahnya
            $rincian_termin = json_decode($transaksi->rincian_termin); // Asumsikan dalam bentuk array JSON
            $jumlah_termin = count($rincian_termin);

            // Buat status dinamis sesuai dengan jumlah termin
            for ($i = 1; $i <= $jumlah_termin; $i++) {
                if ($transaksi->status == 'Waiting for Payment' && $i == 1) {
                    $transaksi->status = 'Termin ' . $i . ' Completed';
                    $transaksi->save();
                    break;
                } elseif ($transaksi->status == 'Termin ' . ($i - 1) . ' Completed' && $i > 1) {
                    $transaksi->status = 'Termin ' . $i . ' Completed';
                    $transaksi->save();
                    break;
                }
            }

            // Jika semua termin sudah selesai, set status menjadi "All Payment Completed"
            if ($transaksi->status == 'Termin ' . $jumlah_termin . ' Completed') {
                $transaksi->status = 'All Payment Completed';
                $transaksi->save();
            }
        } else {
            $termin->status_pembayaran = 'Payment Pending';
            $termin->save();
        }

        $termin_next = TerminPembayaran::find($termin_id_next);
        $termin_next->status_termin = 'payable';
        $termin_next->save();

        // $transaction = WVTransaction::where('order_id', $order_id)->first();
        // if ($transaction) {
        //     $transaction->update($data);
        // } else {
        //     $booking->transaction()->create($data);
        // }

        return redirect()->route('user-termin');
    }

    protected function getTransactionStatus($order_id) {
        $client = new Client();
        $serverKey = Config::$serverKey;
        $baseUrl = Config::$isProduction ? 'https://api.midtrans.com/v2/' : 'https://api.sandbox.midtrans.com/v2/';

        try {
            $response = $client->request('GET', $baseUrl . $order_id . '/status', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($serverKey . ':')
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }
        } catch (\Exception $e) {
            Log::error('Midtrans API request failed: ' . $e->getMessage());
        }

        return null;
    }

    protected function formatTransactionData(array $transactionDetails) {
        $data = $transactionDetails;

        if (isset($transactionDetails['bill_key']) && isset($transactionDetails['biller_code'])) {
            $data['bank'] = 'Mandiri';
            $data['va_number'] = $transactionDetails['bill_key'] . '-' . $transactionDetails['biller_code'];
        } else if ($transactionDetails['payment_type'] == 'credit_card' && isset($transactionDetails['bank'])) {
            $data['bank'] = strtoupper($transactionDetails['bank']);
        } else {
            if (isset($transactionDetails['va_numbers']) && is_array($transactionDetails['va_numbers']) && count($transactionDetails['va_numbers']) > 0) {
                $firstVaNumber = $transactionDetails['va_numbers'][0];

                $data['bank'] = isset($firstVaNumber['bank']) ? strtoupper($firstVaNumber['bank']) : null;
                $data['va_number'] = isset($firstVaNumber['va_number']) ? $firstVaNumber['va_number'] : null;
            } else {
                $data['bank'] = null;
                $data['va_number'] = null;
            }
        }

        return $data;
    }
}
