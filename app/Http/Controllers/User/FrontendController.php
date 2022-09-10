<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingGizi;
use Illuminate\Support\Facades\Auth;
use App\Models\RiwayatCekGizi;
use App\Models\Faq;
use Illuminate\Support\Facades\Redirect;


class FrontendController extends Controller
{
    public function cekgizi(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            
            if (empty($user)) {
                return [
                    "IsError"   => true,
                    "Message"   => "Silahkan login dahulu",
                    "Type"      => "Login"
                ];
            }

            $result = $this->hitungIMT($request->bb, $request->tb);

            if (empty($result)) {
                $result = [
                    "IsError"   => true,
                    "Message"   => "Data undefined, tolong masukan data dengan benar"
                ];
            } else {
                $data = array_merge($request->all(), ["user_id" => $user->id]);
                $insertData = RiwayatCekGizi::create($data);
                if ($insertData) {
                    $insertData["idEncript"] = $this->EncriptDecript($insertData["id"]);
                    $result = [
                        "IsError"   => false ,
                        "Message"   => "Data Berhasil disimpan",
                        "Data"      => $insertData
                    ];
                } else {
                    $result = [
                        "IsError"   => true,
                        "Message"   => "Data Gagal disimpan"
                    ];
                }
            }

            return $result;
        }
        return view('user.cekgizi');
    }

    public function cekgiziDetail(Request $request, $id)
    {
        $id = $this->EncriptDecript($id, "de");
        $data = RiwayatCekGizi::where("id",$id)->get();

        if ($data->count() < 1) {
            Redirect::back();
        }
        $data = $data->first();
        $gizi = $this->hitungIMT($data->bb, $data->tb);
        if (empty($gizi)) {
            Redirect::back();
        }

        return view('user.cekgiziDetail', compact('data', 'gizi'));
    }

    private function EncriptDecript(String $string, String $type = "")
    {
        $type = ($type === "de" ? "openssl_decrypt" : "openssl_encrypt");
        $string = ($type === "de" ? urldecode($string) : $string);
        $data = $type(
            $string,
            "AES-256-CBC",
            "S25UOiwpllZETMjDllYidaw2DPm4234X",
            0,
            "S25UOiwpllZETMjD"
        );
        $data = ($type === "de" ? $data : urldecode($data));
        return $data;
    }

    private function hitungIMT($bb, $tb)
    {
        $tb = $tb/100 * $tb/100;
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
    public function faq(Request $request){
        if ($request->ajax()) {
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ]);
    
            Faq::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
    
            ]);
        }
    
        return response()->json(['success' => "Berhasil kirim pertanyaan"]);
    }
    public function faqIndex(){
        $data['faq'] = Faq::select()->where('frequently','=','frequently')->get();
        return view('user.faq',$data);
    }   
}
