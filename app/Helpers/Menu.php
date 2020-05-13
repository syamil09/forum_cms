<?php

namespace App\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Menu extends Controller
{
    public function list()
    {
        if (Cache::has('menu'))
        {
            return Cache::get('menu');
        }
        Cache::remember('menu', 60, function () {
            return $this->get(env('GATEWAY_URL') . 'cms/menu', Session::get('token'))['data'];
        });
        return Cache::get('menu');
    }

}
