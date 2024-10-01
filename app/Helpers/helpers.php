<?php

use Magarrent\LaravelCurrencyFormatter\Facades\Currency;

if (!function_exists('formatCurrency')) {
        function formatCurrency($amount, $currency = 'USD', $noCents = false)
        {
            // Format currency menggunakan LaravelCurrencyFormatter
            return Currency::currency($currency)->format($amount, $noCents);
        }
}
