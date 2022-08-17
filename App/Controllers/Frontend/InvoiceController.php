<?php
namespace App\Controllers\Frontend;
use Core\Controller;
use App\Models\InvoicePerProduct;
use App\Models\Invoice;
use App\Middlewares\Auth;
class InvoiceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = InvoicePerProduct::getAllForUserId($user['user_id']);
        return view('frontend.cart.index', compact('cart'));
    }
    public function addCart($request){
        $user = Auth::user();
        $quantity = $request->quantity;
        $p_cost = $request->p_cost;
        $invoice = new Invoice();
        $invoice->date = date('Y-m-d H:i:s');
        $invoice->cost = $quantity * $p_cost;
        $invoice->user_id = $user['user_id'];
        $invoice_id = $invoice->save();
        if(is_numeric($invoice_id)){
            $invoicePerProduct = new InvoicePerProduct();
            $invoicePerProduct->invoice_id = $invoice_id;
            $invoicePerProduct->product_id = $request->product_id;
            $invoicePerProduct->quantity = $quantity;
            $invoicePerProduct->p_cost = $request->p_cost;
            $invoicePerProductId = $invoicePerProduct->save();
            if(is_numeric($invoicePerProductId)){
                return redirect()->back([
                    'message' => 'Product added to cart',
                ]);
            }
            else{
                return redirect()->back([
                    'message' => 'Product not added to cart',
                ]);
            }
        }
        else{
            return redirect()->back([
                'message' => 'Product not added to cart',
            ]);
        }
    }
    public function removeCart($request){
        $user = Auth::user();
        $invoice = (new Invoice)->where(['invoice_id'=>$request->id,'user_id'=>$user['user_id']])->first();
        if($invoice!=null){
            $isDeleted = (new InvoicePerProduct)->where(['invoice_id'=>$invoice['invoice_id']])->delete();
            if($isDeleted){
                if($isDeleted){
                    $isDeleted = (new Invoice)->where(['invoice_id'=>$invoice['invoice_id']])->delete();
                    return redirect()->back([
                        'message' => 'Product removed from cart',
                    ]);
                }
                else{
                    return redirect()->back([
                        'message' => 'Product not removed from cart',
                    ]);
                }
            }
            else{
                return redirect()->back([
                    'errors' => 'Product not removed from cart',
                ]);
            }
        }
        else{
            return redirect()->back([
                'errors' => 'Product not removed from cart',
            ]);
        }
    }
}