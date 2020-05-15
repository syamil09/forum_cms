<?php

namespace App\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Menu extends Controller
{
    public function list($sidebar = false)
    {
        if (!Cache::has('menu')) {
            $GroupMenus = Cache::remember('menu', 60, function () {
                return $this->get(env('GATEWAY_URL') . 'cms/menu', Session::get('token'))['data'];
            });
        } else {
            $GroupMenus = Cache::get('menu');
        }

        if ($sidebar === true) {
            $privilages = session()->get('privileges');
            foreach ($GroupMenus as $iGM => $groupMenu) {
                foreach ($groupMenu['menu'] as $iM => $menu) {
                    $MenuPrivilages = collect($privilages)->where('menu_id', $menu['id'])->first();
                    $GroupMenus[$iGM]['menu'][$iM]['view'] = $MenuPrivilages['view'];
                    if ($MenuPrivilages['view'] == "1") {
                        $GroupMenus[$iGM]['totalMenu'] = empty($GroupMenus[$iGM]['totalMenu']) ? 1 : $GroupMenus[$iGM]['totalMenu'] + 1;
                    } else {
                        $GroupMenus[$iGM]['totalMenu'] = empty($GroupMenus[$iGM]['totalMenu']) ? 0 : $GroupMenus[$iGM]['totalMenu'];
                    }
                }
            }
        }
        return $GroupMenus;

    }

}
