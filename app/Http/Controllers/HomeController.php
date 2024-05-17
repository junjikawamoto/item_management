<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        /* テーブルから全てのレコードを取得する */
        $query = Item::query();

        /* キーワードから検索処理 */
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行します
            $query->where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('id', 'LIKE', "%{$keyword}%");
            
        }
        $items=$query->get();
        return view('item.index', ['items' => $items]);
    }
}
