<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingGizi;

class FrontendController extends Controller
{
    public function cekgizi(Request $request)
    {
        if ($request->ajax()) {
            $bb = $request->bb;
            $tb = $request->tb/100 * $request->tb/100;
            $total = $bb / $tb;
            $data = SettingGizi::orderBy('nilai_rumus', "desc")->get();
            $result = [];
            foreach ($data as $item) {
                if ($total >= $item->nilai_rumus) {
                    $item->nilai_data = $total;
                    $result = $item;
                    break;
                }
            }

            if (empty($result)) {
                $result = [
                    "IsError"   => true,
                    "Message"   => "Data undefined, tolong masukan data dengan benar"
                ];
            }

            return $result;
        }
        return view('user.cekgizi');
    }
}
