<?php

namespace App\Http\Controllers\Api\Payments\Paypal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaypalWebhooksControler extends Controller
{
  
  public function handleWebhooks(){
        Log::info('$request');
      return response()->json([
          'success' => true
      ],200);
        
  }
}
