<?php

namespace App\Http\Controllers\Install;

use App\Entity\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;

class ViewController extends BaseController
{

    protected $results = [];

    public function step1(){
        //需要检查的PHP扩展在这里添加
        $requirement = [ 'php' => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
            'fileinfo'
        ],
            'apache' => [
                'mod_rewrite',
            ],];
        $requirements = $this->phpCheck($requirement);
        $phpSupportInfo = $this->checkPHPversion();
        return view('installer.step1')->with('requirements',$requirements)->with('phpSupportInfo',$phpSupportInfo);
    }
    public function step2(){
        $folder =  [
            'storage/framework/'     => '775',
            'storage/logs/'          => '775',
            'bootstrap/cache/'       => '775',
        ];
        $permissions = $this->permissionCheck($folder);
        return view('installer.step2')->with('permissions',$permissions);
    }
    public function step3(){
        return view('installer.step3');
    }
    public function step4(){
        return view('installer.step4');
    }
    public function step5(){
        return view('installer.step5');
    }
    public function welcome(){
        return view('installer.welcome');
    }

    /**
     * @param Request $request
     * @return string ture或者false用于数据库连接是否成功校验
     */
    public function dbValidate(Request $request){
        $db_name = $request->input('db_name','');
        $db_username = $request->input('db_username','');
        $db_password = $request->input('db_password','');
        $db_host = $request->input('db_host','');
        $db_port = $request->input('db_port','');
        $db_connection = @mysqli_connect($db_host,$db_username,$db_password,$db_name,$db_port);
        //由于前端是用jQuery.validate插件的remote远程校验，只能接受ture或者false返回值
        if ($db_connection){
            return "true";
        }else{
            return "false";
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * todo现在默认是mysql，后面还需要做数据库类型判断，如sqlite还需要做相关的业务处理
     */
    public function dataSubmit(Request $request){
        //获取前端传来的数据
        $appname = $request->input('appname','');
        $appurl = $request->input('appurl','');
        $appenv = $request->input('appenv','');
        $appid = $request->input('minipro_id','');
        $appsecrect = $request->input('minipro_secrect','');
        $debug = $request->input('debug','');
        $db_type = $request->input('db_type','');
        $db_host = $request->input('db_host','');
        $db_port = $request->input('db_port','');
        $db_name = $request->input('db_name','');
        $db_username = $request->input('db_username','');
        $db_password = $request->input('db_password','');
        $cache_driver = $request->input('cache_driver','');
        $session_driver = $request->input('session_driver','');
        $queue_driver = $request->input('queue_driver','');
        $redis_host = $request->input('redis_host','');
        $redis_password = $request->input('redis_password','');
        $redis_port = $request->input('redis_port','');
        $mail_driver = $request->input('mail_driver','stmp');
        $mail_host = $request->input('mail_host','mailtrap.io');
        $mail_port = $request->input('mail_port','2525');

        //获取.env和.env.example的路径
        $envPath = base_path('.env');
        $envExamplePath = base_path('.env.example');
        //判断是否存在.env文件
        if (!file_exists($envPath)) {
            //判断是否存在.env.example文件
            if (file_exists($envExamplePath)) {
                //如果有就把.env.example复制到.env
                copy($envExamplePath, $envPath);
            } else {
                //如果都没有就创建一个.env文件
                touch($envPath);
            }
        }
        //.env的配置文件字符串信息
        $envFileData =
            'APP_NAME=' . $appname . "\n" .
            'APP_ENV=' . $appenv . "\n" .
            'APP_KEY=' . 'base64:bODi8VtmENqnjklBmNJzQcTTSC8jNjBysfnjQN59btE=' . "\n" .
            'APP_ID='.$appid."\n".
            'APP_SECRECT='.$appsecrect."\n".
            'APP_DEBUG=' . $debug . "\n" .
            'APP_URL=' . $appurl . "\n\n" .
            'DB_CONNECTION=' . $db_type . "\n" .
            'DB_HOST=' . $db_host . "\n" .
            'DB_PORT=' . $db_port . "\n" .
            'DB_DATABASE=' . $db_name . "\n" .
            'DB_USERNAME=' . $db_username . "\n" .
            'DB_PASSWORD=' . $db_password . "\n\n" .
            'CACHE_DRIVER=' . $cache_driver . "\n" .
            'SESSION_DRIVER=' . $session_driver . "\n" .
            'QUEUE_DRIVER=' . $queue_driver . "\n\n" .
            'REDIS_HOST=' . $redis_host . "\n" .
            'REDIS_PASSWORD=' . $redis_password . "\n" .
            'REDIS_PORT=' . $redis_port . "\n\n" .
            'MAIL_DRIVER=' . $mail_driver . "\n" .
            'MAIL_HOST=' . $mail_host . "\n" .
            'MAIL_PORT=' . $mail_port . "\n" .
            'MAIL_USERNAME=' . 'null' . "\n" .
            'MAIL_PASSWORD=' . 'null' . "\n" .
            'MAIL_ENCRYPTION=' . 'null' . "\n\n" .
            'PUSHER_APP_ID=' . 'app_id' . "\n" .
            'PUSHER_APP_KEY=' . 'app_key' . "\n" .
            'PUSHER_APP_SECRET=' . 'app_secret';
        $results = "成功";
        try {
            file_put_contents($envPath, $envFileData);

        }
        catch(Exception $e) {
            $results = "失败";
        }
        //重新生成APP_KEY；
        Artisan::call('key:generate', ["--force"=> true]);

        return redirect('/install/step4')->with('results',$results);//redirect的with方法传递的是一次性cookie
    }

    /**
     * @param Request $request
     * @return string
     * todo 只是简单的安装数据库，还有许多条件未判断比如数据库版本等等，还有返回数据方便前端处理
     */
    public function installDB(Request $request){
        //判断数据库配置目录下有没有sql文件
        if(!file_exists(database_path('maxshop.sql'))){
            return "数据库备份文件不存在,请联系开发者下载(QQ:734714758)";
        }
        //获取sql文件的内容
        $sql_file_contents = file_get_contents(database_path('maxshop.sql'));
        //以“；”断开sql的内容保存为数组
        $sql_arr = explode(';',$sql_file_contents);
        //获取前端发来的配置信息
        $admin_name = $request->input('admin_name','');
        $admin_password = $request->input('admin_password','');
        $conn = @mysqli_connect(env('DB_HOST'),env('DB_USERNAME'),env('DB_PASSWORD'),env('DB_DATABASE'),env('DB_PORT'));

        if (mysqli_connect_errno($conn)){
            return "数据库连接失败,请手动修改网站根目录下的.env文件";
        }else{
            mysqli_query($conn,'set names utf8;');
            foreach ($sql_arr as $value){
                mysqli_query($conn,$value);
            }

                $admin = new Admin();
                $admin->name = $admin_name;
                $admin->password = 'max'.md5($admin_password);
                $admin->permission = "all";
                $admin->status = 1;
//                $admin->save();
                touch('./install.block');
                return redirect('/install/step5');
        }

    }
    /*
     * 检查php版本以及扩展
     */
    protected function phpCheck(array $requirements){
        $results = [];

        foreach($requirements as $type => $requirement)
        {
            switch ($type) {
                case 'php':
                    foreach($requirements[$type] as $requirement)
                    {
                        $results['requirements'][$type][$requirement] = true;

                        if(!extension_loaded($requirement))
                        {
                            $results['requirements'][$type][$requirement] = false;

                            $results['errors'] = true;
                        }
                    }
                    break;
                case 'apache':
                    foreach ($requirements[$type] as $requirement) {
                        // if function doesn't exist we can't check apache modules
                        if(function_exists('apache_get_modules'))
                        {
                            $results['requirements'][$type][$requirement] = true;

                            if(!in_array($requirement,apache_get_modules()))
                            {
                                $results['requirements'][$type][$requirement] = false;

                                $results['errors'] = true;
                            }
                        }
                    }
                    break;
            }
        }

        return $results;
    }

    protected function checkPHPversion($minPhpVersion = "7.0.0"){
        $minVersionPhp = $minPhpVersion;
        $currentPhpVersion = $this->getPhpVersionInfo();
        $supported = false;


        if (version_compare($currentPhpVersion['version'], $minVersionPhp) >= 0) {
            $supported = true;
        }

        $phpStatus = [
            'full' => $currentPhpVersion['full'],
            'current' => $currentPhpVersion['version'],
            'minimum' => $minVersionPhp,
            'supported' => $supported
        ];

        return $phpStatus;
    }

    private static function getPhpVersionInfo()
    {
        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        return [
            'full' => $currentVersionFull,
            'version' => $currentVersion
        ];
    }


    /*
     * 检查目录权限
     */

    protected function permissionCheck(array $folders){
        $this->results['permissions']=[];
        $this->results['errors'] = null;
        foreach($folders as $folder => $permission)
        {
            if(!($this->getPermission($folder) >= $permission))
            {
                $this->addFileAndSetErrors($folder, $permission, false);
            }
            else {
                $this->addFile($folder, $permission, true);
            }
        }

        return $this->results;
    }
    private function getPermission($folder)
    {
        return substr(sprintf('%o', fileperms(base_path($folder))), -4);
    }

    private function addFile($folder, $permission, $isSet)
    {

        array_push($this->results['permissions'], [
            'folder' => $folder,
            'permission' => $permission,
            'isSet' => $isSet
        ]);
    }
    private function addFileAndSetErrors($folder, $permission, $isSet)
    {

        $this->addFile($folder, $permission, $isSet);

        $this->results['errors'] = true;
    }
}
