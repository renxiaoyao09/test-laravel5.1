<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Userinfo;
use Hash;

class UserController extends Controller
{
    public function bbb(Request $request)
    {
        if ($request->user()) {
            // $request->user() 返回认证用户实例...
        }
        return $request->user();
    }
    public function login(Request $request)
    {
       

    }
    public function insert(Request $request)
    {
        //表单验证
        $this->validate($request,[
            'name'=>'required|regex:/^[A-Za-z][A-Za-z0-9]{2,9}$/',
            'email'=>'required|email',
            'password'=>'same:repassword'
        ],[
            'name.required'=>'用户名不能为空！',
            'name.regex'=>'用户名错误！',
            'email.required'=>'邮箱不能为空！',
            'email.email'=>'邮箱错误！',
            'password.same'=>'两次密码不一致！',
        ]);

        // 数据插入
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile = $request->profile;
        $user->remember_token = str_random(50);
        // dd($user);
        $user->save();
    }




    //文件上传处理
    public function postFileupload(Request $request){
        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('profile')){
            exit('上传文件为空！');
        }
        $file = $request->file('profile');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            exit('文件上传出错！');
        }
        //$img = $file -> getRealPath(); // 临时文件的绝对路径
        $entension = $file -> getClientOriginalExtension(); //  上传文件后缀
        $filename = date('YmdHis').mt_rand(100,999).'.'.$entension; // 重命名图片
        $date = date('Y-m-d');
        $path = $file->move(public_path().'\\uploads\\'.$date.'\\',$filename);  // 重命名保存
        $img_path = '/uploads/'.$date.'/'.$filename;  // 图片相对路径
        $serve_path = 'http://class1.com';  
        // return $path;
        return $serve_path.$img_path;
    }

    
    public function userList(Request $request)
    {
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            $lists = User::orderBy('id','desc')
            ->where(function($query) use ($request){
                // 获取关键字
                $keyword = $request->keyword;
                // 检测参数
                if(!empty($keyword)){
                    $query->where('name','like','%'.$keyword.'%');
                };
            })
            ->paginate($request->size);
        }else{
            $lists = User::orderBy('id','desc')->paginate($request->size);
        }
        return $lists;
    }






    public function __construct(){
        $this->middleware('auth');
    }

   



























































































    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create(Request $request)
    // {
    //     // // 创建模型对象
    //     // $posts = new User;
    //     // // 属性添加的方式
    //     // $posts->name = $request->name;
    //     // $posts->email = $request->email;
    //     // $posts->password = $request->password;
    //     // $posts->remember_token = str_random(32);
    //     // $posts->created_at = date('Y-m-d H:i:s');
    //     // $posts->updated_at = date('Y-m-d H:i:s');
    //     // $posts->save();
        
    //     // $id = $posts->id;
    //     // // 存详细信息
    //     // $info = new Userinfo;
    //     // $info->user_id = $id;
    //     // $info->nickname = $request->nickname;
    //     // $info->email = $request->email;
    //     // $info->sex = $request->sex;
    //     // $info->age = $request->age;
    //     // $info->save();


    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show()
    // {
    //     // $lists = User::get();
    //     // return $lists;
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     // // 创建模型对象
    //     // $posts = User::find($id);
    //     // // 属性添加的方式
    //     // $posts->name = $request->name;
    //     // $posts->email = $request->email;
    //     // $posts->password = $request->password;
    //     // $posts->updated_at = date('Y-m-d H:i:s');
    //     // // $posts->save();
        
    //     // // 存详细信息
    //     // $info = new Userinfo();
    //     // $info->nickname = $request->nickname;
    //     // $info->email = $request->email;
    //     // $info->sex = $request->sex;
    //     // $info->age = $request->age;
    //     // // $info->save();
    //     // $posts->info()->save($info);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
    // public function details($id)
    // {
    //     // $user = User::find($id);
    //     // $details = $user->info()->first();
    //     // $newJson = json_encode(
    //     //     array_merge(
    //     //         json_decode($user, true),
    //     //         json_decode($details, true) 
    //     //     )
    //     // );
    //     // return $newJson;
    // }
    // public function bbb($id)
    // {
    //     // $user = User::find($id);
    //     // $details = $user->info()->first();
    //     // $newJson = json_encode(
    //     //     array_merge(
    //     //       json_decode($user, true),
    //     //       json_decode($details, true) 
    //     //     )
    //     //   );
    //     // return $newJson;
    // }

}
