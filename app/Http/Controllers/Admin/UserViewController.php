<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-04-004
 * @time 10:56
 */


namespace App\Http\Controllers\Admin;


use App\Entity\User;
use App\Entity\UserMeta;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\UserController;
use Illuminate\Http\Request;


class UserViewController extends Controller
{
    public function toUserList(Request $request){
        $users = null;
        $mode = $request->get('mode','');
        if ($mode == 'search'){
            $phone = $request->get('phone','');
            $user_id = $request->get('user_id','');
            $nickname = $request->get('nickname','');
            if ($phone != ''){
                $users = User::where('phone','LIKE','%'.$phone.'%')->paginate(1000);
            }
            if ($user_id != ''){
                $users = User::where('user_id','LIKE','%'.$user_id.'%')->paginate(1000);
            }
            if ($nickname != ''){
                $users = User::where('nickname','LIKE','%'.$nickname.'%')->paginate(1000);
            }

        }else{
            $users = User::paginate(10);

        }

        return view('Admin.User.user-list')->with('users',$users);
    }
    public function toEditUser($user_id){
        $user =  User::find($user_id)->toArray();
        $meta = [];
        $meta_data = UserMeta::where('user_id',$user_id)->get();
        foreach ($meta_data as $data){
            unset($data['u_meta_id']);
            unset($data['user_id']);
            unset($data['created_at']);
            unset($data['updated_at']);
            $meta = array_merge($meta,[$data['slug']=>[$data['meta_key']=>unserialize($data['meta_value'])]]);
        }

        return view('Admin.User.edit-user')->with('user',$user)->with('meta',$meta);
    }
    public function editUserSubmit(Request $request,$user_id){
        $arrs = $request->all();
        $meta_arr = [];
        foreach ($arrs as $key=>$value){
            if (strpos($key,'meta') !== false){
                $key = str_replace('meta_','',$key);
                $meta_arr = array_merge($meta_arr,[$key=>$value]);
            }
        }
        $uc = new UserController();
        $is_update = $uc->updateUserMetaWithArray($user_id,$meta_arr);
        $notice = '';
        if ($is_update){
            $nickname = $request->get('nickname','');
            $email = $request->get('email','');
            $phone = $request->get('phone','');
            $user = User::find($user_id);
            $user->update(['nickname'=>$nickname,'email'=>$email,'phone'=>$phone]);
            $notice = '修改成功';
            return redirect('/admin/user-list')->with('notice',$notice);
        }else{
            $notice = '修改失败，请联系管理员查看情况';
            return redirect('/admin/user-list')->with('notice',$notice);
        }

    }
    public function toAddUser(){
        return view('Admin.User.add-user');
    }

    public function addUserSubmit(Request $request){
        $username = $request->get('username','');
        $password = $request->get('password','');
        $nickname = $request->get('nickname','');
        $email = $request->get('email','');
        $phone = $request->get('phone','');
        if ($username == ''||$password == ''||$nickname == ''||$email == ''){
            return false;
        }
        $new_user = new User();
        $new_user->username = $username;
        $new_user->password = $password;
        $new_user->nickname = $nickname;
        $new_user->email = $email;
        $new_user->phone = $phone;
        $new_user->activition_key = 'created_by_admin';
        $new_user->status = 1;
        $new_user->save();
        $new_user_meta = new UserMeta();
        $new_user_meta->user_id = $new_user->user_id;
        $new_user_meta->meta_key = 'score';
        $new_user_meta->slug = '积分';
        $new_user_meta->meta_value = serialize(0);
        $new_user_meta->save();
        return redirect('/admin/user-list');
    }
}
