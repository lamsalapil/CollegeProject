<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Role;
use App\Jobs\SendMailCreateNewAccount;
use File;


class AccountController extends Controller
{
    public function index()
    {

        return view('admin.account.index',
            [
                'roles' => Role::all(),
            ]);
    }

    // Show Account
    public function getAllRowData(Request $request)
    {
        if(auth()->user()->hasRole(Role::ROLE_ADMIN))
        {
        $users = User::all();
        }
        elseif(auth()->user()->hasRole(Role::ROLE_DRIVER))
        {
            $users = User::where('role_id', '3')->get();
        }
        return Datatables::of($users)
            ->editColumn('role', function ($user) {
                return $user->role->name;
            })
            ->editColumn('gender', function ($user) {
                if($user->gender == 'O')
                {
                    return '<div class="badge badge-success">Other</div>';
                }
                elseif($user->gender == 'F')
                {
                    return '<div class="badge badge-info">Female</div>';
                }
                elseif($user->gender == 'M')
                {
                    return '<div class="badge badge-primary">Male</div>';
                }
            })
            ->editColumn('avatar', function ($data) {
                $assetAvatar = asset('admin/upload/img/'.$data->avatar);
                return '<img src="'.$assetAvatar.'" width="40" height="40" class=" rounded-circle" align="center" />';
            })
            ->editColumn('action', function ($data) {
                // is_banned = 1: lock
                // is_banned = 0: not lock\
                if(auth()->user()->hasRole(Role::ROLE_ADMIN))
                {
                    if($data->id === Auth::user()->id)
                        {
                            return 
                            '
                                <a class="btn btn-warning btn-sm rounded-pill" href="'.route('admin.account.edit',$data->id).'"><i class="fas fa-edit" title="Edit Account"></i></a>
                                <button class="btn btn-info btn-sm rounded-pill" href="'.route("admin.account.ban",['id'=>$data->id,'status_code'=>1]).'" disabled><i class="fas fa-user-lock" title="Lock account"></i></button>
                                <form method="POST" action="' . route('admin.account.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                                ' . method_field('DELETE') .
                                    '' . csrf_field() .
                                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this '.$data->email.' ?\')" disabled><i class="fa fa-trash" title="Delete Account"></i></button>
                                </form>
                            ';
                        }
                    else {
                        if($data->is_banned == 0 )
                        return '
                            <a class="btn btn-info btn-sm rounded-pill" href="'.route("admin.account.ban",['id'=>$data->id,'status_code'=>1]).'"><i class="fas fa-user-lock" title="Lock account"></i></a>
                            <a class="btn btn-warning btn-sm rounded-pill" href="'.route('admin.account.edit',$data->id).'"><i class="fas fa-edit" title="Edit Account"></i></a>
                            <form method="POST" action="' . route('admin.account.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                            ' . method_field('DELETE') .
                                '' . csrf_field() .
                                '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this '.$data->email.' ?\')"><i class="fa fa-trash" title="Delete Account"></i></button>
                            </form>
                        ';
                        else
                        return '
                            <a class="btn btn-info btn-sm rounded-pill" href="'.route("admin.account.ban",['id'=>$data->id,'status_code'=>0]).'"><i class="fas fa-lock-open" title="UnLock account"></i></a>
                            <a class="btn btn-warning btn-sm rounded-pill" href="'.route('admin.account.edit',$data->id).'"><i class="fas fa-edit" title="Edit Account"></i></a>
                            <form method="POST" action="' . route('admin.account.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                            ' . method_field('DELETE') .
                                '' . csrf_field() .
                                '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this '.$data->email.' ?\')"><i class="fa fa-trash" title="Delete Account"></i></button>
                            </form>
                        ';
                    }
                }
                elseif(auth()->user()->hasRole(Role::ROLE_DRIVER))
                {
                    if(Auth::user()->id == $data->id) // check driver current login
                    return '
                            <a class="btn btn-warning btn-sm rounded-pill" href="'.route('admin.account.edit',$data->id).'"><i class="fas fa-edit" title="Edit Account"></i></a>
                    '; 
                }
            })
            ->rawColumns(['avatar', 'action', 'gender'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }

    public function create(AccountRequest $request)
    {
        $user = new User;
        // Xử lí upload image
        if($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension(); //Lấy tên file bao gồm extension ví dụ: .png, .jpg
            $filename = time().'.'.$ext;
            $file->move('admin/upload/img/',$filename);
            $user->avatar = $filename;
        }
        $name = $request->input('name');
        $email = $request->input('email');
        $gender = $request->input('gender');
        $birthday = $request->input('date_of_birth');
        $address = $request->input('address');
        $phone_number = $request->input('phone_number');
        $role_id = $request->input('role_id');
        // Send Password by email
        $password = $this->autoRandomString(20);
        $user->name = $name;
        $user->email = $email;
        $user->gender =  $gender;
        $user->date_of_birth = $birthday;
        $user->address = $address;
        $user->phone_number = $phone_number;
        $user->password = Hash::make($password);
        $user->role_id = $role_id;
        // dd($user);
        $user->save();
        SendMailCreateNewAccount::dispatch($user, $password)->delay(now());
        
        return redirect()->back()->with('status','Created Account Succesfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        // Check user exist
        if(!$user)
        {
            abort(404);
        }
        $role_id = Role::all();
        return view('admin.account.update', compact('user','role_id'));
    }

    public function update(UpdateAccountRequest $request, $id)
    {
        $user = User::findOrFail($id);
            if($request->hasFile('avatar'))
            {
                $path = "admin/upload/img/".$user->avatar;
                // Check if file exist then delete
                if(File::exists($path))
                {
                    File::delete($path);
                }
                // Handle avatar
                $file = $request->file('avatar');
                $ext = $file->getClientOriginalExtension(); //Lấy tên file bao gồm extension ví dụ: .png, .jpg
                $filename = time().'.'.$ext;
                $file->move('admin/upload/img/',$filename);
                $user->avatar = $filename;
            }
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->gender = $request->input('gender'); 
            $user->date_of_birth = $request->input('date_of_birth');
            $user->address = $request->input('address');
            $user->phone_number = $request->input('phone_number');
            $user->role_id = $request->input('role_id');
            
            $user->update();
            // dd($user);
            return redirect('/admin/account')->with('status','Updated Account Successfully');
    }

    // Delete account
    public function delete($id)
    {
        $user = User::findOrFail($id);
        // Check user exist
        if(!$user)
        {
            abort(404);
        }
        $user->delete();
        return redirect()->back()->with('status', 'Account Deleted Successfully');
    }

    // Check lock account
    public function banAccount($id, $status_code)
    {
        $ban_account = User::whereId($id)->update([
            'is_banned' => $status_code
        ]);
        if($status_code == 0 )
        {
            return redirect('/admin/account')->with('message', 'Account is Unlock successfully');
        }
        elseif($status_code == 1 ){
            return redirect('/admin/account')->with('success', 'Account is banned successfully');
        }
        
        return redirect()->route('admin.account.index')->with('error','Fail to ban account');
    }


    // Random string
    private function autoRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
