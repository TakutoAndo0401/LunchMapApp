<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;
use Illuminate\Support\Facades\Storage;


class ShopController extends Controller
{

    public function __construct()
    {
        //ログインしていなくても except で'index'と'show'は見れるようになる
        $this->middleware('auth')->except(['index' , 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $message = '検索ワード : '.$keyword;
            $shops = Shop::where('name','like', '%' . $keyword . '%')
                ->orWhere('address','like', '%' . $keyword . '%')
                ->get();
        } else {
            $shops = Shop::all();
            $message = '';
        }

        return view('index', ['shops'=>$shops , 'message' => $message]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop = Shop::all();
        return view('new', ['shop' => $shop]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //お店追加の保存処理(/shopの時)
    public function store(ShopRequest $request)
    {
        $shop = new Shop();
        $user = \Auth::user();

        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->body = $request->body;
        $shop->user_id = $user->id;

        $image = $shop->image = $request->file('image');
        $path = Storage::disk('s3')->putFile('/', $image, 'public');
        $shop->image = Storage::disk('s3')->url($path);



//        $shop->image = base64_encode(file_get_contents($request->image->getRealPath()));
        $shop->save();

        return redirect()->route('shop.detail' , ['id'=>$shop->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);
        //ログインユーザーのIDを取得してviewに渡す
        $user = \Auth::user();
        if($user){ //$user変数にデータがあるのならtrue
            $login_user_id = $user->id;
        }else{
            $login_user_id = '';
        }
        return view('show' , ['shop'=>$shop , 'login_user_id'=>$login_user_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::find($id);
        return view('edit' , ['shop'=>$shop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, $id)
    {
        $shop = Shop::find($id);

        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->body = $request->body;

        $image = $shop->image = $request->file('image');
        $path = Storage::disk('s3')->putFile('/', $image, 'public');
        $shop->image = Storage::disk('s3')->url($path);

//        $shop->image = base64_encode(file_get_contents($request->image->getRealPath()));

        $shop->save();
        return redirect()->route('shop.detail' , ['id'=>$shop->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $shop->delete();
        return redirect('/shops');
    }
}
