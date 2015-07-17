<?php
/*
 * Admin panel controller
 */
namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Country;
use Validator;
use Storage;

class AdminController extends Controller
{
    /*
     * Users actions
     */

    public function Index(Request $request)
    {
        /*
         * displays users list table
         */
        if ($request->user()) {
            // if user loged in get this user data, and all users data
            $user = $request->user();
            $users = User::orderby('id', 'desc')->paginate(10);
        }
        // render view
        return view('admin.dashboard', array('user' => $user, 'users' => $users));
    }
    
    public function edit(Request $request)
    {
        /*
         * display user edit form
         */
        // get editing user data
        $user = User::find($request->id);
        // get countries array to select
        $countryArr = Country::lists('name', 'id');
        // render view
        return view('admin.edit', array('user' => $user, 'countries' => $countryArr));
    }

    public function delete(Request $request)
    {
        /*
         * delete user
         */
        // get loged in user
        $user = $request->user();
        // get user for delete
        $userDel = User::find($request->id);
        if ($user->id != $userDel->id) {
            // if user to delete is not loged in delete
            $userDel->delete();
        }
        // return to users list
        return redirect('admin/');
    }

    public function save(Request $request)
    {
        /*
         * save user change (edit form)
         */
        $verifier = App::make('validation.presence');
        $verifier->setConnection('mysql');
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:35',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'image' => 'image'
        ]);
        $validator->setPresenceVerifier($verifier);

        //validation check
        if ($validator->fails()) {
            // if errors
            // stay in form
            return redirect('admin/edit/'.$request->id)
                ->withErrors($validator)
                ->withInput();
        }
        // if no errors find editing user
        $user =  User::find($request->id);
        // set new attributes
        $user->name = $request->name;
        $user->email = $request->email;
        $user->country_id = $request->country_id;
        // is upload image save image
        if ($request->hasFile('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $file_name = $user->name."_".$request->id.".".$ext;
            $img_save = Storage::put(
                        $file_name,
                        file_get_contents($request->file('image')->getRealPath())
                        );
            if ($img_save) {
                // if image save success save image name in user attribute
                $user->picture_id = $file_name;
            }
        }
        // end save image
        if ($user->save()) {
            // if saved success redirect to users list
            return redirect('admin/');
        }
    }
    /*
     * End users actions
     */
}