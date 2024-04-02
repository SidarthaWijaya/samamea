<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use sizeof;
use Session;


use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;
use Symfony\Component\HttpFoundation\Session\Session as HttpFoundationSessionSession;

class Order_detailController extends Controller

{
    public function detail($id)
    {   
        // get menu berdasarkan menu id
        $menu = Menu::findOrFail($id);
        return view ('/menudetail',compact('menu'));
    }

    
  
    public function store (Request $request)
    {
        //get session id
        $session=session()->getId();

        //apakah ada session id yang sama di dalam table order
        $order=Order::where('session',$session)->first();

        //variable buat assign nilai ke total, subtotal, service, payment status, order status
        $item=0;
        $subtotal=0;
        $tax =0;
        $service=0;
        $total=0;
        $payment_status=0;
        $order_status=0;
        $menu_id=$request->menu_id;
        $note=$request->note;
        
        //check empty data di table order
        if(empty($order)){
                //buat data baru di taable order
               $orderId = Order::insertGetId([
                    'total_qty'=>$item,
                    'session'=>$session,
                    'subtotal'=>$subtotal,
                    'tax'=>$tax,
                    'service'=>$service,
                    'total'=>$total,
                    'payment_status'=>$payment_status,
                    'order_status'=>$order_status,
                ]);
                // dd($orderId);
                
                //input data ke table order_details
                $request->validate([
                    'qty'=>'min:1',
                    'note'=> 'alpha_num|nullable',
                ]);

               $order_detail=Order_detail::create([
                    'order_id'=>$orderId,
                    'menu_id'=>$menu_id,
                    'qty' => $request['qty'],
                    'note'=>$note
                ]);
                //dd($order_detail);

            $order_details=Order_detail::where('order_id',$orderId)->get();
                //dd($order_details);
                foreach($order_details as $order_detail){
                   
                    if($order_detail->menu_id==$order_detail->menu->id){
                  
                        $subtotal+=$order_detail->menu->price*$order_detail->qty;
                        // dd($subtotal);
                    }
                    $item=count([$order_detail->menu_id]);
                }   
                 // hitung tax
                 $tax = $subtotal*10/100;

                 // hitung service 
                 $service=$subtotal*11/100;
    
                 //hitung total
                 $total=$subtotal+$tax+$service;
                 //dd($total);
                 //$order= Order::where('id',$orderId)->get();
                 //dd($order);
                 
               //update nilai subtotal, tax, service, total
                 $orderId=Order::where("id",$orderId)->update([
                    'total_qty'=>$item,
                    'subtotal'=>$subtotal,
                    'tax'=>$tax,
                    'service'=>$service,
                    'total'=>$total,
                 ]);
                  

        }
        else{
            $order_session=$order->session;
            //dd($order_session);
            $order_id=$order->id;
            // dd($order_details);
            $cek_order_id=Order_detail::where('order_id',$order_id)->first();
            $order_totalqty=$order->total_qty;
            //dd($order_totalqty);
            //dd($order_array);
            if(empty($cek_order_id)){
                $request->validate([
                    'qty'=>'min:1',
                    'note'=> 'alpha_num|nullable',
                ]);

               $order_detail=Order_detail::create([
                    'order_id'=>$order_id,
                    'menu_id'=>$menu_id,
                    'qty' => $request['qty'],
                    'note'=>$note
                ]);
                $cek_order_id=Order_detail::where('order_id',$order_id)->get();
                    foreach($cek_order_id as $cek_order){
                        if($cek_order->menu_id==$cek_order->menu->id){
                    
                            $subtotal+=$cek_order->menu->price*$cek_order->qty;
                            // dd($subtotal);
                        }
                        $item=count([$order_detail->menu_id]);
                    }
                    
                    
                    // hitung tax
                $tax = $subtotal*10/100;

                    // hitung service
                 $service=$subtotal*11/100;
        
                    //hitung total
                $total=$subtotal+$tax+$service;
                    //dd($total);
                    //$order= Order::where('id',$orderId)->get();
                    //dd($order);
                    
                    //update nilai subtotal, tax, service, total
                $orderId=Order::where("id",$order_id)->update([
                    'total_qty'=>$item,
                    'subtotal'=>$subtotal,
                    'tax'=>$tax,
                    'service'=>$service,
                    'total'=>$total,
                ]);
            }
            else if($order_session==$session){
               $order_id=$order->id;
             $order_details=Order_detail::where('order_id',$order_id)->get();
                // dd($order_details);
                
                foreach($order_details as $order_detail){
                        //dd($order);
                     if($order_detail->menu_id==$menu_id && $order_detail->note==null){
                            //dd($order_detail->menu_id);
                             //dd($order_detail->menu_id==$request->menu_id[$order] && $order_detail->note==null);
                        $update=Order_detail::where('order_id',$order_id)->where('menu_id',$menu_id)->update([
                            'qty'=>$order_detail->qty+$request['qty'],
                            
                        ]); 
                     }
                }
                
                if(order_detail::where('menu_id',$menu_id)->where('order_id',$order_id)->first()){
                    $order_details=Order_detail::where('order_id',$order_id)->get();
                    foreach($order_details as $order_detail){
                        
                        if($order_detail->menu_id==$order_detail->menu->id){
                                    //dd($order_detail->menu_id==$order_detail->menu->id);
                            $subtotal+=$order_detail->menu->price*$order_detail->qty;
                            //dd($subtotal);            
                        }
                        
                        $item=count([$order_detail->menu_id]);
                    }
                    
                }else{
                    $request->validate([
                        'qty'=>'min:1',
                        'note'=> 'alpha_num|nullable',
                    ]);
            
                    $order_detail=Order_detail::create([
                        'order_id'=>$order_id,
                        'menu_id'=>$menu_id,
                        'qty' => $request['qty'],
                        'note'=>$note
                    ]);
                    $order_details=Order_detail::where('order_id',$order_id)->get();
                    foreach($order_details as $order_detail){
                        
                        if($order_detail->menu_id==$order_detail->menu->id){
                                    //dd($order_detail->menu_id==$order_detail->menu->id);
                            $subtotal+=$order_detail->menu->price*$order_detail->qty;
                            //dd($subtotal);            
                        }
                        
                        $item=count([$order_detail->menu_id]);
                    }
                }
                
                // hitung tax
                $tax = $subtotal*10/100;

                // hitung service
                $service=$subtotal*11/100;
   
                //hitung total
                $total=$subtotal+$tax+$service;
                //dd($total);
                if($order_session==$session){
                    //dd($order_session==$session);
                     Order::where('session',$session)->update([
                        'total_qty'=>$order_totalqty+$item,
                        'subtotal'=>$subtotal,
                        'tax'=>$tax,
                        'service'=>$service,
                        'total'=>$total,
                    ]);
                } 

            }
                
        }
        return redirect('/');
    }

    public function update($id, Request $request)
    {
        $item=0;
        $subtotal=0;
        $tax =0;
        $service=0;
        $total=0;
        $session=session()->getId();
        $order=Order::where('session',$session)->first();
        
        $order_session=$order->session;
        //dd($order_session);
        $order_totalqty=$order->total_qty;
        $order_id=$order->id;

        $request->validate([
            'qty'=>'min:1',
            'note'=> 'alpha_num|nullable',
        ]);

        Order_detail::where('id',$id)->where('order_id',$order_id)->update([
            'note'=>$request->note,
            'qty'=> $request->qty
        ]);
        
        $order_details=Order_detail::where('order_id',$order_id)->get();
        foreach($order_details as $order_detail){
            
                if($order_detail->menu_id==$order_detail->menu->id){
                        //dd($order_detail->qty);
                $subtotal+=$order_detail->menu->price*$order_detail->qty;

            //dd($subtotal);            
                }
            
            $item=count([$order_detail->menu_id]);
        }
            // $subtotal+=$order->subtotal;
            // dd($subtotal);
        // hitung tax
        $tax = $subtotal*10/100;

        // hitung service
        $service=$subtotal*11/100;

        //hitung total
        $total=$subtotal+$tax+$service;
        //dd($total);
        if($order_session==$session){
            //dd($order_session==$session);
             Order::where('session',$session)->update([
                'total_qty'=>$item,
                'subtotal'=>$subtotal,
                'tax'=>$tax,
                'service'=>$service,
                'total'=>$total,
            ]);
        }
        return back();
    }


    public function edit($id)
    {
        $orderdetail = Order_detail::findOrFail($id);
        return view('update', compact('orderdetail'));
    }

   public function showorder()
   {
        $session=session()->getId();
        // dd($session);

        //cek di table order apakah ada seseion id == session id yang sedang berjalan
        $orders=Order::where('session',$session)->first();
        $order_id=$orders->id;
        //dd($order_id);
        
        //get order details
        $order_details=Order_detail::all();
        
        // $order_details=Order_detail::all();
        return view ('/order',compact('order_details','orders','session'));
   }

    public function delete($id)
    {
        Order_detail::destroy($id);
        return back();
    }

   
}
