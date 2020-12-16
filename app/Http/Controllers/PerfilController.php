<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\InfoUser;

class PerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();
        $planes = Plan::all();
        return view('admin.perfil.index', compact('user', 'planes'));
    }

    public function update(Request $request)
    {
        $id = \Auth::user()->id;

        $rules = array(
            'empresa' => 'required|min:3',
            'cargo' => 'required|min:3',
            'name' => 'required|min:3',
            //'email' => 'required|email|max:255|unique:users,email,'.$id,
        );
        $this->validate($request, $rules);

        //$roles = $request->get('roles');

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        //$user->email = $request->get('email');
        //$user->password = bcrypt('12345678');
        $user->save();
        
        $user_info = InfoUser::where('user_id', $user->id)->first();
        if ($user_info == null) {
            $user_info = new InfoUser();
            $user_info->user_id = $user->id;
        }
        $user_info->empresa = $request->get('empresa');
        $user_info->cargo = $request->get('cargo');
        $user_info->save();

        $user_id = $user->id;

        /*foreach ($roles as $key => $item) {
            $role_user = new RoleUser();
            $role_user->user_id = $user->id;
            $role_user->role_id = $item;
            $role_user->save();
        }*/

        //return redirect()->back()->with('success', 'Profile updated.');
        return response()->json(['status'=>"success", 'user_id'=>$user_id]);
    }

    public function security(Request $request)
    {
        $id = \Auth::user()->id;

        $rules = array(
            'email' => 'nullable|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
        );
        $this->validate($request, $rules);

        //$roles = $request->get('roles');

        $user = User::findOrFail($id);
        if ($request->get('email')) {
            $user->email = $request->get('email');
            $user->save();
        }
        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
            $user->save();
        }

        return response()->json(['status'=>"success", 'user'=>$user]);
    }

    public function upload_photo(Request $request)
    {
        $photo = $request->file('file');
        if($photo) {
            //here we are geeting userid alogn with an image
            $userid = \Auth::user()->id;

            $imageName = strtotime(now()).rand(11111,99999).'.'.$photo->getClientOriginalExtension();
            $original_name = $photo->getClientOriginalName();

            if(!is_dir(public_path() . '/uploads/photos/'.$userid.'/')){
                mkdir(public_path() . '/uploads/photos/'.$userid.'/', 0777, true);
            }
            $new_path = '/uploads/photos/'.$userid.'/';
            $photo->move(public_path() . $new_path, $imageName);

            // we are updating our image column with the help of user id
            InfoUser::where('user_id', $userid)
                    ->update(['photo'=>$imageName]);

            $user_info = InfoUser::where('user_id', $userid)->first();

            return response()->json(['status'=>"success",'photo'=>$new_path.$user_info->photo,'userid'=>$userid]);
        }
    }
}
