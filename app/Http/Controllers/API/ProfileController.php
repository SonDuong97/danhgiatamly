<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Requests\getSpecialityRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UploadImageRequest;
use App\Profile;
use App\University;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        try {
            $universities = University::all();
            $universities->transform(function ($item) {
                $item->speciality = json_decode($item->speciality);
                return $item;
            });
            $user = auth()->user();
            $profile = Profile::where('user_id', $user->id)
                ->first();
            return ApiResponse::success(compact('universities', 'user', 'profile'));
        } catch (\Exception $e) {
            return ApiResponse::fail(500, $e->getMessage());
        }
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update([
                    'name' => $request->get('username')
                ]);

            $university = University::find($request->get('universityId'));

            Profile::where('user_id', Auth::user()->id)
                ->update([
                    'university'   => $university->name,
                    'speciality'   => $request->get('speciality'),
                    'fullname'     => $request->get('fullname'),
                    'sex'          => $request->get('sex'),
                    'phone_number' => $request->get('phone-number'),
                    'birthday'     => $request->get('birthday'),
                ]);

            return Profile::where('user_id', Auth::id())
                ->first();

        } catch (\Exception $exception) {
            return ApiResponse::fail(500, $exception->getMessage());
        }
    }

    public function upload(UploadImageRequest $request)
    {
        try {
            if (!empty($request->file('avatar'))) {
                $avatarUpload = $request->file('avatar');
                $avtNewName = Auth::user()->id . '.' . $avatarUpload->getClientOriginalExtension();
                $avatarUpload->move(public_path('upload/avatar'), $avtNewName);
                $avatarPath = 'upload/avatar/' . $avtNewName;
                Profile::where('user_id', Auth::user()->id)
                    ->update([
                        'avatar_path' => $avatarPath,
                    ]);
                return Profile::where('user_id', Auth::id())
                    ->first();
            }
        } catch (\Exception $exception) {
            return ApiResponse::fail(500, $exception->getMessage());
        }
    }

    public function getSpeciality(getSpecialityRequest $request)
    {
        try {
            $university = University::find($request->input('universityId'));
            $specialities = json_decode($university->speciality);

            return ApiResponse::success(compact('specialities'));
        } catch (\Exception $exception) {
            return ApiResponse::fail(500, $exception->getMessage());
        }
    }

}
