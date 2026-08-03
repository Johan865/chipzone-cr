<?php

namespace App\Services;

use App\Models\Order;

/**
 * Abstrae la comunicación con la pasarela de pago real.
 *
 * En este esqueleto queda en modo "simulado" para que el flujo de
 * checkout funcione de inmediato. Para producción, reemplazar el
 * cuerpo de charge() por la llamada real al SDK de Stripe o PayPal
 * (composer require stripe/stripe-php) y nunca loguear datos de tarjeta.
 */
class PaymentGatewayService
{
    public function charge(Order $order, string $method, array $paymentData): array
    {
        if (config('services.stripe.secret') && $method === 'credit_card') {
            return $this->chargeWithStripeSandbox($order);
        }

        // Modo simulado: usar mientras no se conecte una pasarela real
        // (útil para desarrollo y para la demo en clase).
        return [
            'success' => true,
            'status' => 'completed',
            'reference' => 'SIM-' . strtoupper(uniqid()),
        ];
    }

    /**
     * Integración real con Stripe en modo sandbox (test mode).
     *
     * Pasos para activarla:
     * 1. composer require stripe/stripe-php
     * 2. Crear cuenta gratuita en https://dashboard.stripe.com/register
     * 3. Copiar la "Secret key" de modo TEST (empieza con sk_test_...)
     * 4. Agregar en .env: STRIPE_SECRET=sk_test_xxxxx
     * 5. Agregar en config/services.php:
     *      'stripe' => ['secret' => env('STRIPE_SECRET')],
     */
    private function chargeWithStripeSandbox(Order $order): array
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            // Stripe trabaja en la unidad mínima de la moneda (sin decimales para CRC)
            $intent = $stripe->paymentIntents->create([
                'amount' => (int) round($order->total),
                'currency' => 'crc',
                'confirm' => true,
                'payment_method' => 'pm_card_visa', // tarjeta de prueba de Stripe
                'automatic_payment_methods' => ['enabled' => true, 'allow_redirects' => 'never'],
                'description' => "Pedido #{$order->id} - ChipZone CR",
            ]);

            return [
                'success' => $intent->status === 'succeeded',
                'status' => $intent->status === 'succeeded' ? 'completed' : 'failed',
                'reference' => $intent->id,
            ];
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return ['success' => false, 'status' => 'failed', 'reference' => null];
        }
    }

    public function generateTrackingNumber(): string
    {
        return 'CZ-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }
}
