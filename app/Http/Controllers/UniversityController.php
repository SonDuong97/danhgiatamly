<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 06/12/2018
 * Time: 15:57
 */

namespace App\Http\Controllers;

use App\Profile;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class UniversityController
 * @package App\Http\Controllers
 */
class UniversityController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $universities = University::paginate(10);

        return view('admin.university.index', [
            'universities' => $universities
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.university.create');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'university' => 'required',
            'speciality' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                $data = [
                    'name'       => $request->get('university'),
                    'speciality' => $request->get('speciality')
                ];
                DB::beginTransaction();
                $university = new University();
                $university->saveUniversity($data);
                DB::commit();
                alert()->overlay('Create University', 'Success Create University', 'success');

                return redirect(route('university.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $universityName = University::find($id)->name;
            University::destroy($id);
            $profiles = Profile::where('university', $universityName)
                ->get();
            foreach ($profiles as $profile) {
                $profile->university = null;
                $profile->speciality = null;
                $profile->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete University', 'Success Delete University', 'error');

        return redirect(route('university.index'));
    }

    /**
     * @param $universityId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($universityId)
    {
        $university = University::find($universityId);

        return view('admin.university.edit', [
            'university' => $university
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'university' => 'required',
            'speciality' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                $data = [
                    'name'       => $request->get('university'),
                    'speciality' => $request->get('speciality')
                ];
                DB::beginTransaction();
                $university = University::find($id);
                $university->updateUniversity($data);
                DB::commit();
                alert()->overlay('Update University', 'Success Update University', 'success');

                return redirect(route('university.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }
}