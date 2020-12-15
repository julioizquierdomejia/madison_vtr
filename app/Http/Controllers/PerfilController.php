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
            'email' => 'required|email|max:255|unique:users,email,'.$id,
        );
        $this->validate($request, $rules);

        //$roles = $request->get('roles');

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        //$user->password = bcrypt('12345678');
        $user->save();
        
        $user_info = InfoUser::where('user_id', $user->id)->first();
        if ($user_info == null) {
            $user_info = new InfoUser();
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

    public function upload_photo(Request $request)
    {
        $photo = $request->file('file');
        if($photo) {
            //here we are geeting userid alogn with an image
            $userid = $request->get('userid');

            $imageName = strtotime(now()).rand(11111,99999).'.'.$photo->getClientOriginalExtension();
            $user_image = new InfoUser();
            $original_name = $photo->getClientOriginalName();
            $user_image->photo = $imageName;

            if(!is_dir(public_path() . '/uploads/photos/'.$userid.'/')){
                mkdir(public_path() . '/uploads/photos/'.$userid.'/', 0777, true);
            }
        $new_path = '/uploads/photos/'.$userid.'/';
        $photo->move(public_path() . $new_path, $imageName);

        // we are updating our image column with the help of user id
        $user_image->where('user_id', $userid)->update(['photo'=>$imageName]);

        return response()->json(['status'=>"success",'photo'=>$new_path.$imageName,'userid'=>$userid]);
        }
    }
}
