<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 02/11/2018
 * Time: 11:46
 */

namespace App\Http\Controllers;

use App\Profile;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $universities = University::all();
        $user         = Auth::user();
        $profile      = Profile::where('user_id', $user->id)
            ->first();

        return view('pages.profile', [
            'user'         => $user,
            'profile'      => $profile,
            'universities' => $universities
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'     => 'required',
//            'universityId' => 'required|numeric',
            'universityName' => 'required',
            'speciality'   => 'required',
            'fullname'     => 'required|min:5',
            'sex'          => 'required',
            'phone-number' => 'required|numeric',
            'birthday'     => 'required|date|date_format:Y-m-d',
            'avatar'       => 'mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            try {
                if (!empty($request->file('avatar'))) {
                    $avatarUpload = $request->file('avatar');
                    $avtNewName   = Auth::user()->id . '.' . $avatarUpload->getClientOriginalExtension();
                    $avatarUpload->move(public_path('upload/avatar'), $avtNewName);
                    $avatarPath = 'upload/avatar/' . $avtNewName;
                } else {
                    $avatarPath = Profile::where('user_id', Auth::user()->id)
                        ->first()->avatar_path;
                }

                DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update([
                        'name' => $request->get('username')
                    ]);

//                $university = University::find($request->get('universityId'));
                $university  = University::where('name', $request->get('universityName'))->first();
                if (!$university) {
                    $universityInfo['name'] = $request->get('universityName');
                    $universityInfo['speciality'][0] = $request->get('speciality');
                    $university = new University();
                    $university->saveUniversity($universityInfo);
                } else {
                    $specialities = json_decode($university->speciality);
                    if (!in_array($request->get('speciality'), $specialities)) {
                        array_push($specialities, $request->get('speciality'));
                        $data = [
                            'name'       => $request->get('universityName'),
                            'speciality' => $specialities
                        ];
                        $university->updateUniversity($data);
                    }
                }
                DB::table('profiles')
                    ->where('user_id', Auth::user()->id)
                    ->update([
                        'university'   => $university->name,
                        'speciality'   => $request->get('speciality'),
                        'fullname'     => $request->get('fullname'),
                        'sex'          => $request->get('sex'),
                        'phone_number' => $request->get('phone-number'),
                        'birthday'     => $request->get('birthday'),
                        'avatar_path'  => $avatarPath,
                    ]);

                return back()->with('success', 'Update Successfully!');
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function getSpeciality(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'universityName' => 'required'
        ]);

        if ($validator->fails()) {
            return back();
        } else {
            $university   = University::where("name", $request->universityName)->first();
            if ($university) {
                $specialities = json_decode($university->speciality);
            } else {
                $specialities = "";
            }
            return response()->json($specialities);
        }
    }
}