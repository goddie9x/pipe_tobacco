<?php
namespace App\Controllers\Frontend;
use Core\Controller;
use App\Middlewares\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slide;
use App\Models\News;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        $productsHot = Product::getProductHotByPage();
        $slide = Slide::getSlidesByPage('home');
        $categories = Category::queryAllCategoriesActive();
        $brands = (new Brand)->where(['brand_status' => 1])->get();
        $products=[];
        foreach ($categories as $category) {
            $products[$category['category_id']] = Product::getProductsByCategoryID($category['category_id']);
        }
        return view('frontend.home', compact('productsHot', 'categories', 'brands', 'products', 'slide'));
    }
    public function search($request)
    {
        $keyword = $request->q;
        $products = Product::getProductsByKeyword($keyword);
        $news = News::getNewsByKeyword($keyword);
        return view('frontend.search', compact('products', 'news','keyword'));
    }
    public function account($request)
    {
        return view('frontend.account.index');
    }
    public function password($request)
    {
        return view('frontend.account.password');
    }
    public function updateAccount($request)
    {
        $user = User::find($currentUser->user_id);
        if(count($user) > 0) {
            $updateData;
            if(isset($request->password)){
                if($request->password == $request->re_password){
                    $oldPasswod = password_hash($request->old_password, PASSWORD_DEFAULT);
                    if($oldPasswod != $user->password){
                        return redirect()->back([
                            'errors' => 'Mật khẩu cũ không đúng'
                        ]);
                    }
                    $updateData['password'] = password_hash($request->password, PASSWORD_DEFAULT);
                }
                else{
                    return redirect()->back()->with('errors', 'Mật khẩu không khớp');
                }
            }
            else{
                $updateData = [
                    'user_name' => $request->user_name,
                    'gender'=> $request->gender,
                    'address'=> $request->address,
                    'phone'=> $request->phone,
                    'email'=> $request->email,
                ];
                if(isset($request->user_image) && $request->user_image['name'] != '') {
                    try {
                        $file = $request->user_image;
                        $file_name = $file['name'];
                        $file_tmp = $file['tmp_name'];
                        if (file_exists('public/images/users/' . $file_name)) {
                            $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                        }
                        move_uploaded_file($file_tmp, 'public/images/users/' . $file_name);
                        $updateData['user_image'] = $file_name;
                        if($user['user_image'] != '') {
                            unlink('public/images/users/' . $user['user_image']);
                        }
                    } catch (\Exception $e) {
                        writeLog($e);
                    }
                }
            }
            $idUpdated = (new User)->where(['user_id'=> $request->id])->update($updateData);
            if($idUpdated > 0) {
                return redirect()->back('message', 'Cập nhật thành công');
            }
            else{
                return redirect()->back('errors', 'Cập nhật thất bại');
            }
        }
        else{
            return redirect()->back('errors', 'Cập nhật thất bại');
        }
    }
    public function orders($request)
    {
        return view('frontend.account.orders');
    }
    public function cart($request)
    {
        return view('frontend.cart');
    }
}