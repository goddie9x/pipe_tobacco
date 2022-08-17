<?php
namespace App\Models;
use Core\Model;
class InvoicePerProduct extends Model
{
    protected $table = 'invoice_per_product';
    protected $primaryKey = 'invoice_per_product_id';

    public static function getAll()
    {
        return self::select('user_name,product_path,user.user_id as user_id,account,product_name,product_image,date,cost,invoice_per_product_id,invoice.invoice_id as invoice_id,product.product_id as product_id,quantity,p_cost')
        ->join('invoice', 'invoice.invoice_id = invoice_per_product.invoice_id')
        ->join('product', 'product.product_id = invoice_per_product.product_id')
        ->join('user', 'user.user_id = invoice.user_id')
        ->orderBy('date desc')
        ->get();
    }
    public static function getAllForUserId($user_id)
    {
        return self::select('user_name,product_path,user.user_id as user_id,account,product_name,product_image,date,cost,invoice_per_product_id,invoice.invoice_id as invoice_id,product.product_id as product_id,quantity,p_cost')
        ->join('invoice', 'invoice.invoice_id = invoice_per_product.invoice_id')
        ->join('product', 'product.product_id = invoice_per_product.product_id')
        ->join('user', 'user.user_id = invoice.user_id')
        ->where(['user.user_id'=> $user_id])
        ->orderBy('date desc')
        ->get();
    }
}