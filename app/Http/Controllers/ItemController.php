<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
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
     * 商品一覧
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

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'detail' => 'required|max:100',
                'type' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }
    /**
     * 商品削除
     */
    public function delete(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();

        return redirect('/items');
    }
}
