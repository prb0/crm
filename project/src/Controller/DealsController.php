<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class DealsController
{
    public function index()
    {
        return new Response(
            json_encode(
                [
                    'lul' => (object)['lul']
                ]
            )
        );
    }
}