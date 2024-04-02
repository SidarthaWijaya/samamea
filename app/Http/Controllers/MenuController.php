<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Table;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Session;

class MenuController extends Controller
{
    public function index()
    {   // get semua menu yang terdapat di table menu
        $menus = Menu::all();

        //get session id
        $session=session()->getId();
        //dd($session);
        return view('menu',compact('menus','session'));
    }

    public function search(Request $request)
    {
        $search =$request->get('search');
        $searchMenu= Menu::where('name', 'LIKE', "%{$search}%")->get();
        // ->orWhere('price', 'LIKE', "%{$search}%")
        // ->get();

        return view('search', compact('searchMenu'));
        //dd($getproduct);
       
    }
    

}
