<?php
/*
 * Admin panel controller
 */
namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Request;
use App\User;
use App\Country;
use TrlHelper;
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
            // get all users data
            $users = User::orderby('id', 'desc')->paginate(10);

        // render view
        return view('admin.dashboard', array('users' => $users));
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
        return TrlHelper::t()->redirect('admin/');
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
            /*
            return redirect($request->curLang->prefix.'/admin/edit/'.$request->id)
                ->withErrors($validator)
                ->withInput();
            */
            return TrlHelper::t()->redirect('admin/edit/'.$request->id)
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
            return TrlHelper::t()->redirect('admin/');
        }
    }
    /*
     * End users actions
     */

    /*
     * MULTILANGUAGE SECTION
     */


    /*
     * Languages actions
     */
    public function languages(Request $request)
    {
        /*
         * display languages list
         */
        return view('admin.lang_list');
    }

    public function addLang(Request $request)
    {
        return view('admin.add_lang');
    }

    public function saveNewLang(Request $request) {
        $verifier = App::make('validation.presence');
        $verifier->setConnection('mysql');
        $validator = Validator::make(Request::all(), [
            'name' => 'required|max:35',
            'prefix' => 'required|unique:languages,prefix,',
            'image' => 'image'
        ]);
        $validator->setPresenceVerifier($verifier);
        if ($validator->fails()) {
            /*
            return redirect($request->curLang->prefix.'/admin/addLang/')
                ->withErrors($validator)
                ->withInput();
            */
            return TrlHelper::t()->redirect('admin/addLang/')
                ->withErrors($validator)
                ->withInput();
        }
        $newLang = new App\Language();
        $newLang->name = Request::input('name');
        $newLang->prefix = Request::input('prefix');
        if (Request::input('visible')) {
            $newLang->visible = Request::input('visible');
        }
        // is upload image save image
        if (Request::hasFile('image')) {
            $ext = Request::file('image')->getClientOriginalExtension();
            $file_name = Request::input('prefix') . "." . $ext;
            $img_save = Storage::put(
                $file_name,
                file_get_contents($request->file('image')->getRealPath())
            );
            if ($img_save) {
                // if image save success save image name in user attribute
                $newLang->ico = $file_name;
            }
        }


        if ($newLang->save()) {

            return TrlHelper::t()->redirect('admin/languages/');
        }
    }

    public function deleteLang(Request $request)
    {

        $langDel = App\Language::find($request->id);
        $langDel->delete();
        // return to languages list
        return TrlHelper::t()->redirect('admin/languages');

    }

    public function editLang(Request $request)
    {
        $editLang = App\Language::find($request->id);
        return view('admin.edit_lang', array('editLang' => $editLang));
    }

    public function saveEditLang(Request $request)
    {
        $editLang = App\Language::find($request->id);
        $verifier = App::make('validation.presence');
        $verifier->setConnection('mysql');
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:35',
            'prefix' => 'required|unique:languages,prefix,'.$request->id,
            'image' => 'image'
        ]);
        $validator->setPresenceVerifier($verifier);
        if ($validator->fails()) {
            /*
            return redirect($request->curLang->prefix.'/admin/editLang/'.$request->id)
                ->withErrors($validator)
                ->withInput();
            */

            return TrlHelper::t()->redirect('admin/editLang/'.$request->id)
                ->withErrors($validator)
                ->withInput();
        }

        $editLang->name = $request->name;
        $editLang->prefix = $request->prefix;
        $editLang->visible = $request->visible;

        // is upload image save image
        if ($request->hasFile('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $file_name = $request->prefix . "." . $ext;
            $img_save = Storage::put(
                $file_name,
                file_get_contents($request->file('image')->getRealPath())
            );
            if ($img_save) {
                // if image save success save image name in user attribute
                $editLang->ico = $file_name;
            }
        }

        if ($editLang->save()) {
            return TrlHelper::t()->redirect('admin/languages/');
        }

    }

    /*
     * END Languages actions
     */

    /*
     * Labels action
     */
    public function labels(Request $request)
    {
        /*
         * renders labels list
         */
        $labels = App\Label::all();
        return view('admin.label_list', array('labels' => $labels));
    }

    public function addLabel(Request $request)
    {
        /*
         * renders add label form
         */
        return view('admin.add_label');
    }

    public function saveNewLabel(Request $request) {
        $verifier = App::make('validation.presence');
        $verifier->setConnection('mysql');
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:35|unique:labels,name,',
        ]);
        $validator->setPresenceVerifier($verifier);
        if ($validator->fails()) {
            /*
            return redirect($request->curLang->prefix.'/admin/addLabel/')
                ->withErrors($validator)
                ->withInput();
            */
            return TrlHelper::t()->redirect('admin/addLabel/')
                ->withErrors($validator)
                ->withInput();
        }
        $newLabel = new App\Label();
        $newLabel->name = $request->name;

        if ($newLabel->save()) {
            $new_id = $newLabel->id;
            // write Translations
            $langs = App\Language::all();
            foreach ($langs as $lang) {
                $lang_input = $lang->prefix;
                $txt = '';
                if($request->$lang_input){
                    $txt = $request->$lang_input;
                }
                $trl = new App\LabelsTranslation();
                $trl->lang_id = $lang->id;
                $trl->label_id = $new_id;
                $trl->text = $txt;
                $trl->save();
            }
            return TrlHelper::t()->redirect('admin/labels/');
        }
    }

    public function deleteLabel(Request $request)
    {

        $labelDel = App\Label::find($request->id);
        $labelDel->delete();
        // return to languages list
        return TrlHelper::t()->redirect('admin/labels/');

    }

    public function editLabel(Request $request)
    {
        $editLabel = App\Label::find($request->id);
        // format translation array to edit translation
        $trlsArr = array();
        foreach ($editLabel->getTranslations as $trl) {
            $trlsArr[$trl->lang_id] = $trl->text;
        }
        return view('admin.edit_label', array('editLabel' => $editLabel, 'trlsArr' => $trlsArr));
    }

    public function saveEditLabel(Request $request)
    {
        $editLabel = App\Label::find($request->id);

        $verifier = App::make('validation.presence');
        $verifier->setConnection('mysql');
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:35|unique:languages,name,'.$request->id,

        ]);
        $validator->setPresenceVerifier($verifier);
        if ($validator->fails()) {
            /*
            return redirect($request->curLang->prefix.'/admin/editLabel/'.$request->id)
                ->withErrors($validator)
                ->withInput();
            */
            return TrlHelper::t()->redirect('admin/editLabel/'.$request->id)
                ->withErrors($validator)
                ->withInput();
        }

        $editLabel->name = $request->name;

        if ($editLabel->save()) {
            $langs = App\Language::all();
            foreach ($langs as $lang) {
                $lang_input = $lang->prefix;
                $txt = '';
                if($request->$lang_input){
                    $txt = $request->$lang_input;
                }
                $trl = App\LabelsTranslation::where('lang_id', $lang->id)->where('label_id', $request->id)->first();
                $trl->text = $txt;
               // print_r($trl);
               // die;
                $trl->save();
            }
            return TrlHelper::t()->redirect('admin/labels/');
        }

    }
    /*
     * End labels actions
     */

    /*
    * END MULTILANGUAGE SECTION
    */
}