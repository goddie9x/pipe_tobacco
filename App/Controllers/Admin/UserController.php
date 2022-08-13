<?php
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        return view('admin.users.create');
    }
    public function store($request)
    {
        $user = new User();
        $user->user_name = $request->user_name;
        $user->account = $request->account;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        if(isset($request->user_image) && $request->user_image['name'] != '') {
            try {
                $file = $request->user_image;
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                if (file_exists('public/images/users/' . $file_name)) {
                    $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                }
                move_uploaded_file($file_tmp, 'public/images/users/' . $file_name);
                $user->user_image = $file_name;
            } catch (\Exception $e) {
                writeLog($e);
            }
        }
        $isSaved = $user->save();
        if ($isSaved) {
            return redirect()->route('admin.users.index', ['message' => 'Thêm mới thành công']);
        }
        else{
            return redirect()->route('admin.users.create', ['message' => 'Thêm mới thất bại']);
        }
    }
    public function edit($request)
    {
        $user = User::find($request->id);
        if(count($user) > 0) {
            return view('admin.users.store', compact('user'));
        }
        else{
            return redirect()->route('admin.users.index', ['errors' => 'Không tìm thấy người dùng']);
        }
    }
    public function update($request)
    {
        $user = User::find($request->id);
        if(count($user) > 0) {
            $updateData = [
                'user_name' => $request->user_name,
                'account' => $request->account,
                'gender'=> $request->gender,
                'address'=> $request->address,
                'phone'=> $request->phone,
                'role'=> $request->role,
                'email'=> $request->email,
            ];
            if(isset($request->password)){
                $updateData['password'] = password_hash($request->password, PASSWORD_DEFAULT);
            }
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
            $idUpdated = (new User)->where(['user_id'=> $request->id])->update($updateData);
            if (is_numeric($idUpdated)) {
                return redirect()->route('users', ['message' => 'Cập nhật thành công']);
            }
            else{
                return redirect()->back(['message' => 'Cập nhật thất bại']);
            }
        }
        else {
            return redirect()->route('admin.users.index', ['errors' => 'Không tìm thấy người dùng']);
        }
    }
    public function ban($request)
    {
        $user = User::find($request->id);
        if(count($user) > 0) {
            $isUpdated = (new User)->where('user_id', $request->id)->update(['banned' => 1]);
            if ($isUpdated) {
                return redirect()->route('admin.users.index', ['message' => 'Cập nhật thành công']);
            }
            else{
                return redirect()->route('admin.users.index', ['message' => 'Cập nhật thất bại']);
            }
        }
        else {
            return redirect()->route('admin.users.index', ['errors' => 'Không tìm thấy người dùng']);
        }
    }
    public function delete($request)
    {
        $user = User::find($request->id);
        if(count($user) > 0) {
            $isDeleted = User::where([['user_id'=> $request->id]])->delete();
            if ($isDeleted) {
                if($user['user_image'] != '') {
                        unlink('public/images/users/' . $user['user_image']);
                }
                return redirect()->route('admin.users.index', ['message' => 'Xóa thành công']);
            }
            else{
                return redirect()->route('admin.users.index', ['errors' => 'Xóa thất bại']);
            }
        }
        else {
            return redirect()->route('admin.users.index', ['errors' => 'Không tìm thấy người dùng']);
        }
    }
}