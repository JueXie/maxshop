<?php


namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\MaxResponse;
use Illuminate\Http\Request;
use App\Entity\User;
use App\Entity\UserMeta;


class UserController extends Controller
{


    public function getUserByID(Request $request){
        $json = new MaxResponse();
        $user_id = $request->get('user_id','');

        $user =  User::find($user_id)->toArray();

        if ($user == []){
            $json->status = -1;
            $json->message = "没有找到该用户或用户不存在";
            return $json->toJson();
        }
        $meta = $this->getUserMetaData($user_id);
        $response = array_merge($user,$meta);

        return $response;

    }

    public function getUsers(){
        $users = User::all()->toArray();
        $response = [];
        foreach ($users as $user){
            $meta = $this->getUserMetaData($user['user_id']);
            $temp = array_merge($user,$meta);
            array_push($response,$temp);
        }
        return $response;
    }

    public function newUser(Request $request){
        $json = new MaxResponse();
        //获取数据
        $username = $request->get('username','');
        $password = $request->get('password','');
        $nickname = $request->get('nickname','');
        $email = $request->get('email','');
        if ($username == ''||$password == ''||$nickname == ''||$email == ''){
            $json->status = 404;
            $json->message = '用户名，密码，昵称，邮件不能为空';
            return $json->toJson();
        }
        $user = $this->newMaxUser($username,$password,$nickname,$email);
        $user->save();
        $json->status = 200;
        $json->message = '新建用户成功';
        return $json->toJson();
    }


    /**
     * 非路由方法
     */

    /**
     * @param $user_id
     * @return array meta_data
     */
    public function getUserMetaData($user_id){
        $meta_arr = [];
        $meta_data = UserMeta::where('user_id',$user_id)->get();
        foreach ($meta_data as $data){
            unset($data['u_meta_id']);
            unset($data['user_id']);
            unset($data['created_at']);
            unset($data['updated_at']);
            $meta_arr = array_merge($meta_arr,[$data['meta_key']=>unserialize($data['meta_value'])]);
        }
        return $meta_arr;
    }
    //TODO  获取用户指定key的值
    public function getUserMetaDataByKey($user_id,$meta_key){
        $meta_data = UserMeta::where(['user_id'=>$user_id,'meta_key'=>$meta_key])->first();
        if ($meta_data == null){
            return false;
        }else{
            return unserialize($meta_data->meta_value);
        }

    }

    /**
     * @param $user_id
     * @param $meta_key
     * @param $meta_slug
     * @param $meta_value
     * @return bool  插入数据库成功返回true
     *
     */
    public function insertUserMeta($user_id,$meta_key,$meta_slug,$meta_value){
        if (!is_string($meta_key)){
            return false;
        }
        $meta_data = UserMeta::where(['user_id'=>$user_id,'slug'=>$meta_slug,'meta_key'=>$meta_key])->first();
        if ($meta_data == null){
            $meta_data = new UserMeta();
            $meta_data->user_id = $user_id;
            $meta_data->meta_key = $meta_key;
            $meta_data->slug = $meta_slug;
            $meta_data->meta_value = serialize($meta_value);
            $meta_data->save();
        }else{
            //使用update方式能够自动维护更新时间字段
            $meta_data->update(['meta_value'=>serialize($meta_value)]);
        }
        return true;
    }

    /**
     * @param $user_id
     * @param $meta_key
     * @param $meta_value
     * @return bool 更新成功返回true
     *
     */
    public function updateUserMeta($user_id,$meta_key,$meta_value){
        if (!is_string($meta_key)){
            return false;
        }
        $meta_data = UserMeta::where(['user_id'=>$user_id,'meta_key'=>$meta_key])->first();
        if ($meta_data == null){
            return false;
        }else{
            //使用update方式能够自动维护更新时间字段
            $meta_data->update(['meta_value'=>serialize($meta_value)]);
        }
        return true;
    }

    /**
     * @param $user_id
     * @param $array
     * @return bool 更新成功返回true
     */
    public function updateUserMetaWithArray($user_id,$array){
        if (!is_array($array)){
            return false;
        }
        foreach ($array as $key=>$value){
            $meta_data = UserMeta::where(['user_id'=>$user_id,'meta_key'=>$key])->first();
            if ($meta_data == null){
                return false;
            }else{
                //使用update方式能够自动维护更新时间字段
                $meta_data->update(['meta_value'=>serialize($value)]);
            }
        }
        return true;
    }
    public function newMaxUser($username,$password,$nickname,$email){
        $new_user = new User();
        $new_user->username = $username;
        $new_user->password = $password;
        $new_user->nickname = $nickname;
        $new_user->email = $email;
        $new_user_meta = new UserMeta();
        $new_user_meta->user_id = $new_user->user_id;
        $new_user_meta->meta_key = 'score';
        $new_user_meta->slug = '积分';
        $new_user_meta->meta_value = serialize(0);
        $new_user_meta->save();
        return $new_user;
    }

}
