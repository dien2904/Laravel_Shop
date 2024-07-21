<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $users = User::paginate(15);

        $template = 'user.index';
        return view('dashboard.layout',compact(
            'template' ,
            'users'
        ));
    }


    public function create()
    {
       
        $template = 'user.create';
        return view('dashboard.layout',compact(
            'template' ,
        ));

    }


    public function CreatedUser(Request $request)
    {
        // Validate the request inputs
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:15',
            'password' => 'required|min:6',
        ]);

        // Create a new User instance
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = Hash::make($request->input('password')); // Hash the password before saving

        // Save the user to the database
        $user->save();

        // Redirect to a specific route with a success message
        return redirect()->route('auth.user')->with('success', 'Created successfully.');
    }

    public function edit($id)
    {
       

    
        $result = User::where('id', $id)->first();
        $template = 'user.edit';
        
        // var_dump($results[0]->name);
       
        return view('dashboard.layout',compact(
            'template' ,
            'result' 
            
        ));
    }

    public function update(Request $request , string $id)
    {
        $validated =  $request->validate([
            'name' => 'required|max:255',
            'email' => 'required' ,
            'role' => 'required' ,
            // 'phone' => 'max:100' ,
        ]);
        var_dump($request->all());

        $updated = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => $request->get('role'),
            // 'phone' => $request->get('phone'),
        ];
        $blog = User::where('id', $id)->update($updated);
        return redirect()->route('auth.user')->with('success', 'Cập nhật thành công');
    }


    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('auth.user')->with('success', 'delete successfully');
    }


    public function login()
    {
        return view('user.login');
    }

    public function register()
    {
        return view('user.register');
    }
}
