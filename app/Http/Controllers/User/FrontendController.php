<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingGizi;
use Illuminate\Support\Facades\Auth;
use App\Models\RiwayatCekGizi;
use App\Models\Faq;
use App\Models\Content;
use App\Models\Leaflet;
use Illuminate\Support\Facades\Redirect;
use App\Models\Articles;
use App\Models\ArticleCategory;
use App\Models\Reaction;
use Illuminate\Support\Facades\DB;
use App\Models\CommentArticle;


class FrontendController extends Controller
{
    public function cekgizi(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();

            // if (empty($user)) {
            //     return [
            //         "IsError"   => true,
            //         "Message"   => "Silahkan login dahulu",
            //         "Type"      => "Login"
            //     ];
            // }

            $result = $this->hitungIMT($request->bb, $request->tb);

            if (empty($result)) {
                $result = [
                    "IsError"   => true,
                    "Message"   => "Data undefined, tolong masukan data dengan benar"
                ];
            } else {
                $randomString = time() . $this->randomString(15);
                $data = array_merge($request->all(), ["user_id" => empty($user->id) ? 0 : $user->id, "random_string" => $randomString]);
                $insertData = RiwayatCekGizi::create($data);
                if ($insertData) {
                    $insertData["idEncript"] = $randomString;
                    $result = [
                        "IsError"   => false,
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
        $data = RiwayatCekGizi::where("random_string", $id)->get();
        if ($data->count() < 1) {
            return Redirect::to("/");
        }
        $data = $data->first();
        $gizi = $this->hitungIMT($data->bb, $data->tb);
        if (empty($gizi)) {
            Redirect::to("/");
        }

        return view('user.cekgiziDetail', compact('data', 'gizi'));
    }

    public function listArticles(Request $request)
    {
        $categori = ArticleCategory::all();
        $artikel = Articles::latest()->paginate(10);
        $artikelterkait = Articles::latest()->limit(4)->get();
        return view('user.blog', compact('categori', 'artikel', 'artikelterkait'));
    }

    public function category(Request $request, $kode)
    {
        $categori = ArticleCategory::all();
        $this->code = $kode;
        $artikel = Articles::latest()->whereHas('category', function ($q) {
            $q->where('kode', $this->code);
        })->paginate(10);
        $artikelterkait = Articles::latest()->limit(4)->get();
        return view('user.blog', compact('categori', 'artikel', 'artikelterkait'));
    }

    public function author(Request $request, $kode)
    {
        $categori = ArticleCategory::all();
        $artikel = Articles::latest()->where('user_id', $kode)->paginate(10);
        $artikelterkait = Articles::latest()->limit(4)->get();
        return view('user.blog', compact('categori', 'artikel', 'artikelterkait'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $data = Articles::latest()
            ->where('title', "like", "%" . $search . "%")
            ->where('desc_content', "like", "%" . $search . "%");
        $categori = ArticleCategory::all();
        $artikel = $data->paginate(10)->appends($request->except('page'));
        $artikelterkait = Articles::latest()->limit(4)->get();
        return view('user.blog', compact('categori', 'artikel', 'artikelterkait' , 'search'));
    }

    public function show(Request $request, $kode)
    {
        $categori = ArticleCategory::all();
        $artikel = Articles::latest()->where("kode", $kode)->first();

        if (empty($artikel)) {
            return Redirect::to("/");
        }

        $listReaction = $this->getReaction($artikel->id);
        $artikel->emoticon = $this->reactionHtml($listReaction);

        $artikelterkait = Articles::latest()->limit(4)->get();
        return view('user.detail_blog', compact('categori', 'artikel', 'artikelterkait'));
    }

    public function leaflet(Request $request)
    {
        $search = $request->search;
        $data = Leaflet::latest()
            ->where('title', "like", "%" . $search . "%");
        $leaflet = $data->paginate(10)->appends($request->except('page'));
        return view('user.leaflet', compact("leaflet"));
    }

    public function leafletDetail(Request $request)
    {
        $kode = $request->kode;
        if (empty($kode)) return Redirect::to("/leaflet");

        $data = Leaflet::latest()->where('kode', $kode);
        $leaflet = $data->first();
        if (empty($kode) || empty($leaflet->file)) return Redirect::to("/leaflet");
        
        return view('user.leafletDetail', compact("leaflet"));
    }

    public function reaction(Request $request)
    {
        $filter["article_id"] = $request->article_id;
        $result = [
            "IsError" => false,
            "Message"   => "Aman euy"
        ];

        $user = Auth::user();
        if (!empty($user->id)) {
            $filter["user_id"] = $user->id;
        } else {
            $filter["session_id"] = session()->getId();
        }

        $data = array_merge($filter, ["reaction" => $request->reaction]);
        $upsert = Reaction::updateOrCreate(
            $filter,
            $data
        );
        if ($upsert) {
            $listReaction = $this->getReaction($request->article_id);
            $result["data"] = $this->reactionHtml($listReaction);
        }
        return $result;
    }

    public function getReaction($article_id)
    {
        return DB::table("reaction")->select(DB::raw('GROUP_CONCAT(distinct(reaction) SEPARATOR ",") AS reaction, count(id) as count'))->where("article_id", $article_id)->first();
    }

    public function reactionHtml($data)
    {
        $result = [];
        if (empty($data->reaction)) {
            return $result;
        }

        $reaction = explode(",", $data->reaction);
        foreach ($reaction as $item) {
            $result["emoticon"][] = '<span class="like-btn-' . $item . '"></span>';
        }
        $result["emoticon"] = implode("", $result["emoticon"]);
        $result['count'] = $data->count . " Reaction";

        return $result;
    }

    private function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
    public function faq(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
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

    public function feIndex()
    {
        $data['faq'] = Faq::select()->where('frequently', '=', 'frequently')->get();
        $data['content'] = Content::select()->where('kode', 'like', '%instagram%')->get();
        $data["category"] = ArticleCategory::where("is_show_navbar", true)->get();
        return view('user.index', $data);
    }

    public function comment(Request $request)
    {
        if (empty(Auth::user()->id)) {
            return [
                "IsError"   => true,
                "Message"   => "Silahkan login Dahulu",
                "action"    => "login"
            ];
        }

        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        $insert = CommentArticle::create($data);

        return [
            "IsError" => false,
            "Message" => "Data disimpan"
        ];
    }

    public function login(Request $request)
    {
        $email      = $request->input('email');
        $password   = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return response()->json([
                'IsError' => false,
                'Message' => "Login Successed"
            ], 200);
        } else {
            return response()->json([
                'IsError' => true,
                'Message' => 'Login Gagal!'
            ], 200);
        }
    }
}
