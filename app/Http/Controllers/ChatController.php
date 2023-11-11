<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function datapost(){
        $body = [
            "SeccionId" => "9bc218e0-7cc6-41d7-ab46-1c2c48257ebe",
            "Question" => [
                "Messages" => [
                    [
                        "role" => "user",
                        "content" => "como me puedes ayudarme"
                    ]
                ]
            ],
            "IncludeHistory" => true
        ];
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'ApiKey' => 'b5435493-0e0e-4d06-89a0-bb0e99ae2afb'
        ])->withBody(json_encode($body), 'application/json')
        ->post('https://ucaldaschatia-production.up.railway.app/api/v1/completion');
        
        $data = $response->json();

        return view('inicio', ['datapost' => $data]);
    }

    public function dataget(){
        $body = [
                "SeccionId" => "3fa85f64-5717-4562-b3fc-2c963f66afa1",
                "FromDate"=> "2023-10-31T01:39:43.358Z"          
        ];
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'ApiKey' => 'b5435493-0e0e-4d06-89a0-bb0e99ae2afb'
        ])->withBody(json_encode($body), 'application/json')
        ->get('https://ucaldaschatia-production.up.railway.app/api/v1/completion');
        
        $data = $response->json();

        return view('inicio', ['dataget' => $data]);
    }
}
