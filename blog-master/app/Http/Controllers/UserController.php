<?php
/**
 * Created by PhpStorm.
 * User: ningge
 * Date: 2017/3/28
 * Time: 19:28
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserController extends Controller{

    public function UserView()
    {
        $view = DB::select('select * from users');
        return view('Admin.UserView', ['view' => $view]);
    }

    public function UserAdd(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_lock = bcrypt($password);
        $is_admin = $request->input('is_admin');
        $date = date('Y-m-d H:i:s', time()+8*60*60);
        DB::insert('insert into users(is_admin, name, email, password, created_at, updated_at)
        VALUE (?, ?, ?, ?, ?, ?)', [$is_admin, $name, $email, $password_lock, $date, $date]);
//        return view('Admin.UserAddSuccess');
        return redirect()->route('AdminU');
    }

    public function UserUpdate(Request $request, $id)
    {
        $user = Auth::user();
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_lock = bcrypt($password);
        $is_admin = $request->input('is_admin');
        $date = date('Y-m-d H:i:s', time()+8*60*60);
        DB::update('update users set is_admin = ?, name = ? , email = ? ,password = ?, updated_at = ? where id = ?',
            [$is_admin, $name, $email, $password_lock, $date, $id]);
//        return view('Admin.UserUpdateSuccess');
        return redirect()->route('AdminU');
    }

    public function UserDelete($id)
    {
        DB::delete('delete from users where id = ?', [$id]);
//        return view('Admin.UserDeleteSuccess');
        return redirect()->route('AdminU');
    }

}