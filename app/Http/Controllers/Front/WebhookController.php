<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Jobs\ConfirmPaymentEmailJob;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Exceptions\MPApiException;

class WebhookController extends Controller
{
    protected $payment;

    public function __construct(Payment $payment)
    {
        MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));
        $this->payment = $payment;
    }

    public function handleMercadoPago(Request $request)
    {
        $data = $request->all();

        Log::info('Webhook Mercadopago.', ['data' => $data]);

        if (!isset($data['data']['id']) || !isset($data['type'])) {
            Log::warning('Webhook recebido com dados incompletos.', ['data' => $data]);
            return response()->json(['status' => 'error', 'message' => 'Dados incompletos'], 400);
        }

        $transactionId = $data["data"]["id"];
        $client = new PaymentClient();

        try {
            switch ($data['type']) {
                case "payment":
                    $response = $client->get($transactionId);

                    Log::info('response.', ['response' => $response->status]);


                    if ($data['action'] == 'payment.updated') {
                        $payment = $this->payment->where('transaction_id', $transactionId)->first();

                        if (!$payment) {
                            Log::warning('Pagamento não encontrado.', ['transaction_id' => $transactionId]);
                            return response()->json(['status' => 'error', 'message' => 'Pagamento não encontrado'], 404);
                        }

                        $order = $payment->order;
                        $emailUser = $order->user->email;
                        $payment->status = $response->status;
                        $payment->save();

                        if ($payment->status == 'completed') {
                            $order->status = 'processing';
                            $order->save();

                            ConfirmPaymentEmailJob::dispatch($emailUser, $order->order_number);
                        }
                    }

                    if ($data['action'] == 'payment.created') {
                        // Lógica para pagamento criado, se necessário
                        Log::info('Pagamento criado.', ['transaction_id' => $transactionId]);
                    }

                    break;

                default:
                    Log::info('Tipo de evento não suportado.', ['type' => $data['type']]);
                    return response()->json(['status' => 'error', 'message' => 'Tipo de evento não suportado'], 400);
            }

            return response()->json(['status' => 'success'], 200);
        } catch (MPApiException $e) {
            Log::error('Erro na API do MercadoPago.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['status' => 'error', 'message' => 'Erro na API do MercadoPago'], 500);
        } catch (\Exception $e) {
            Log::error('Erro inesperado.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['status' => 'error', 'message' => 'Erro inesperado'], 500);
        }
    }
}
