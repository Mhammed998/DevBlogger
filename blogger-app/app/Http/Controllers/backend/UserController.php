<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash as FacadesHash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:read-users', ['only' => ['index']]);
        $this->middleware('permission:create-users', ['only' => ['create','save']]);
        $this->middleware('permission:edit-users', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-users', ['only' => ['delete']]);
    }

    public function index(Request $request): View
    {
        $users = User::latest()->paginate(10);
        return view('backend.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        return view('backend.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:password_confirmation',
            'roles_names' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = FacadesHash::make($input['password']);

        if($request->hasFile('avatar')){

            $image = $request->avatar;
            $imageExt = $image->extension();
            $imageName = time() . '.' . $imageExt;
            $image->move(public_path('backend/uploads/users'), $imageName);

           $user= User::create([
                'name' =>  $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
                'avatar' => $imageName ,
                'about' => $input['about'],
                'roles_names' => $input['roles_names']
            ]);

        }else{
            $user = User::create($input);
        }




        $user->assignRole($request->input('roles_names'));

        toast('User has been created !','success');
        return redirect()->route('users.index');


    }


    public function show($id): View
    {
        $user = User::find($id);
        return view('backend.users.show',compact('user'));
    }


    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('backend.users.edit',compact('user','roles','userRole'));
    }


    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles_names' => 'required',
        ]);


        $input = $request->all();
        $user = User::find($id);


        if($request->hasFile('avatar')){


            $imagePath = 'backend/uploads/users/' . $user->avatar;
            // check if category has image then delete it
            if(file_exists(public_path($imagePath)) ){
                File::delete($imagePath);
            }

            $image = $request->avatar;
            $imageExt = $image->extension();
            $imageName = time() . '.' . $imageExt;
            $image->move(public_path('backend/uploads/users'), $imageName);

           $user->update([
                'name' =>  $input['name'],
                'email' => $input['email'],
                'avatar' => $imageName ,
                'about' => $input['about'],
                'roles_names' => $input['roles_names']
            ]);

        }else{
            $user->update($input);
        }

        FacadesDB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles_names'));

        toast('User information has been updated !','success');
        return redirect()->route('users.index');

    }


    public function destroy($id): RedirectResponse
    {
       $delUser= User::find($id);
        $imagePath = 'backend/uploads/users/' . $delUser->avatar;
        // check if category has image then delete it
        if(file_exists(public_path($imagePath)) ){
            File::delete($imagePath);
        }

        $delUser->delete();
        toast('User has been deleted !','success');
        return redirect()->route('users.index');

    }




    /*
     * updates user password ( old password === password in DB ?
     * enter NEW password and confirm it : wrong password)
    */

    public function updatePassword(Request $request , $id){
        $this->validate($request, [
            'password' => 'required|same:password_confirmation',
        ]);


        $user = User::find($id);
        $passwords = $request->all();
        $oldPass = $passwords['old_password'];
        $userPass = $user->password;
        $newPass= $passwords['password'];

        //check if the old password is correct..!
        if(FacadesHash::check($oldPass, $userPass)){
            $newHashedPass = bcrypt($newPass);
            $user->update([
                'password' => $newHashedPass
            ]);

            toast('User password has been updated !','success');
            return redirect()->back();

        }else{
            toast('Wrong password !','error');

        }


    }



}
