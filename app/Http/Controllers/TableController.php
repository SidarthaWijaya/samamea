<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use App\Models\Table_order;
use App\Models\Table_order_detail;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        // $table=Table::all();
        // dd($table);
        $session=session()->getId();
        $order=Order::where('session',$session)->first();
        $orderId=$order->id;
        dd($orderId);
    }

    public function create(Request $request,$id)
    {
        $session=session()->getId();
        $total=0;
        $subtotal=0;
        $table=Table::findOrFail($id);
        // $order=Order::where('session',$session)->first();
        // $orderId=$order->id;
        // $subtotal=$order->total;
        $table_orderId=Table_order::insertGetId([
            'table_id'=>$table->id,
            'table_status'=>1,
            'session'=>$session,
            'total'=>$total
        ]);
        
        Table_order_detail::create([
            'table_order_id'=>$table_orderId,
            'subtotal'=>$subtotal
        ]);
        
        // $table_order_details= Table_order_detail::where('order_id',$orderId)->get();
        // foreach( $table_order_details as $table_order_detail){
        //     $total+=$subtotal;
        // }
            

        // $orderId=Table_order::where("session",$session)->update([
        //     'total'=>$total
        // ]);
        return redirect('/');
    }

    public function updateTable($id)
    {
        $session=session()->getId();
        $order=Order::where('session',$session)->first();
        $orderId=$order->id;
        $subtotal=$order->total;

        $table=Table_order::where('session',$session)->first();
        $table_order_id=$table->id;

        Table_order_detail::where('id',$id)->where('table_order_id',$table_order_id)->update([
            'order_id'=>$orderId,
            'subtotal'=>$subtotal
        ]);

        Table_order::where('id',$id)->where('session',$session)->update([
            'total'=>$subtotal
        ]);

        
    }
    // public function inputDataTable(Request $request)
    // {
    //     $session=session()->getId();
    //     $total=0;
    //     $subtotal=0;
    //     $table_id=$request->table_id;
        
    //     // $order=Order::where('session',$session)->first();
    //     // $orderId=$order->id;
    //     // $subtotal=$order->total;
    //     $table_orderId=Table_order::insertGetId([
    //         'table_id'=>$table_id,
    //         'table_status'=>1,
    //         'session'=>$session,
    //         'total'=>$total
    //     ]);
        
    //     Table_order_detail::create([
    //         'table_order_id'=>$table_orderId,
    //         'subtotal'=>$subtotal
    //     ]);
    //     return redirect('/checkout');
    // }



    public function showTable()
    {
        $tables=Table::all();
        return view('checkout',compact('tables'));
    }
}
