<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\RiwayatCekGizi;
use App\Models\SettingGizi;

class RiwayatGiziController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DataTables::of(RiwayatCekGizi::query())->toArray();
            $data["data"] = array_map(function ($item) {
                $item["action"] = '
                <button class="btn btn-success icon btn-update" data-id="' . $item["id"] . '">
                    <i data-feather="eye"></i>
                </button>
                ';
                $imt = $this->hitungIMT($item["bb"], $item["tb"]);
                if (empty($imt)) $imt = 0;
                else $imt = $imt->nilai_data;

                $item["imt"] = number_format($imt,2,",",".");
                return $item;
            }, $data["data"]);
            // print_r($data["data"]);
            unset($data["queries"]);
            return $data;
        }

        return view('admin.riwayat_gizi');
    }

    private function hitungIMT($bb, $tb)
    {
        $tb = $tb / 100 * $tb / 100;
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
        return $result;
    }
}
