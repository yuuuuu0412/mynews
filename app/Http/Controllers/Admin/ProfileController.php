<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Profilehistory;
use Carbon\Carbon;
class ProfileController extends Controller
{
    //
    public function add()
    {
      return view('admin.profile.create');
    }
    public function create(Request $request)
    {
      $this->validate($request, Profile::$rules);
      $profile = new Profile;
      $form = $request->all();
      unset($form['_token']);
      $profile->fill($form);
      $profile->save();
      return redirect('admin/profile/create');
    }
    public function edit()
    {
      $profile = Profile::find(1);
      return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    public function update(Request $request)
    {
      $this->validate($request, Profile::$rules);
      $profile = Profile::find(1);
      $profile_form = $request->all();
      unset($profile_form['_token']);
      $profile->fill($profile_form)->save();
      //編集履歴
      $profilehistory = new Profilehistory;
      $profilehistory->profile_id = $profile->id;
      $profilehistory->edited_at = Carbon::now();
      $profilehistory->save();

      return redirect('admin/profile/edit');
    }
}
