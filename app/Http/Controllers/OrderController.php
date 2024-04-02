<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Table;
use App\Models\Table_order;
use App\Models\Table_order_detail;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class OrderController extends Controller
{
    public function index()
    {   //get session id
        $session=session()->getId();
        // dd($session);

        //cek di table order apakah ada seseion id == session id yang sedang berjalan
        $orders=Order::where('session',$session)->first();
        $order_id=$orders->id;
        //dd($order_id);
        
        //get order details
        $order_details=Order_detail::where('order_id',$order_id)->get();
        
        // $order_details=Order_detail::all();

        // $tables=Table_order::where('session',$session)->first();
        // $tableid=$tables->table_id;
        // $tablesession=$tables->session;
        // $table=Table::where('id',$tableid)->get();
        return view ('/checkout',compact('order_details','orders','session'));
        // 'tables','table','tablesession'
      
    }
    
    public function updateCustomer($id, Request $request)
    {   
        $session=session()->getId();
        $nama=$request->nama;
        $room_number=$request->room_number;
        $payment_status=$request->payment_status;
        $table=Table_order::where('session',$session)->first();

        if(empty($table)){
            $session=session()->getId();
        $total=0;
        $subtotal=0;
        $table_id=$request->table_id;
        
        // $order=Order::where('session',$session)->first();
        // $orderId=$order->id;
        // $subtotal=$order->total;
        $table_orderId=Table_order::insertGetId([
            'table_id'=>$table_id,
            'table_status'=>1,
            'session'=>$session,
            'total'=>$total
        ]);
        
        Table_order_detail::create([
            'table_order_id'=>$table_orderId,
            'subtotal'=>$subtotal
        ]);
        $order=Order::where('session',$session)->first();
        $id=$order->id;

        Order::where('id',$id)->where('session',$session)->update([
            'nama'=>$nama,
            'room_number'=>$room_number,
            'payment_status'=>$payment_status
        ]);
        $orderId=$order->id;
        $subtotal=$order->total;
        $total=0;
    
    

    Table_order_detail::where('id',$id)->where('table_order_id',$table_orderId)->update([
        'order_id'=>$orderId,
        'subtotal'=>$subtotal
    ]);
        $total=$subtotal;
    Table_order::where('session',$session)->update([
        'total'=>$total
    ]);
        }else{
            $request->validate([
                'nama'=>'required|alpha_num',
                'room_number'=>'required|alpha_num'
            ]);
    
            
            $order=Order::where('session',$session)->first();
            $id=$order->id;
    
            Order::where('id',$id)->where('session',$session)->update([
                'nama'=>$nama,
                'room_number'=>$room_number,
                'payment_status'=>$payment_status
            ]);
            $orderId=$order->id;
        $subtotal=$order->total;
        $total=0;
       
        $table_order_id=$table->id;

        Table_order_detail::where('id',$id)->where('table_order_id',$table_order_id)->update([
            'order_id'=>$orderId,
            'subtotal'=>$subtotal
        ]);
            $total=$subtotal;
        Table_order::where('session',$session)->update([
            'total'=>$total
        ]);
        }
        
        return back(compact('table'));
    }

    public function editCustomer($id)
    {
        $order = Order::findOrFail($id);
        return view(compact('order'));
    }
}
