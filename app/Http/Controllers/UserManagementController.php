<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 08/11/2018
 * Time: 11:00
 */

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Exports\UsersExport;
use App\History;
use App\Profile;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class UserManagementController
 * @package App\Http\Controllers
 */
class UserManagementController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required'
        ]);
        $email     = $request->get('email');
        $userTest  = User::where('email', $email)
            ->first();
        if (!empty($userTest)) {
            return back()->withErrors('Cannot create user!');
        }
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                DB::beginTransaction();
                $user           = new User();
                $user->name     = $request->get('username');
                $user->email    = $request->get('email');
                $user->password = Hash::make($request->get('password'));
                $user->save();
                $role = Role::find($request->get('role'));
                event(new UserRegistered($user, $role));
                DB::commit();
                alert()->overlay('Create User', 'Success Create User', 'success');

                return redirect(route('user.index'));
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
            Profile::where('user_id', $id)->delete();
            $user = User::find($id);
            $user->detachRoles();
            $user->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete User', 'Success Delete User', 'error');

        return redirect(route('user.index'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function block($id)
    {
        try {
            DB::beginTransaction();
            $user         = User::find($id);
            $user->status = 0;
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Block User', 'Success Block User', 'success');

        return redirect(route('user.index'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function unblock($id)
    {
        try {
            DB::beginTransaction();
            $user         = User::find($id);
            $user->status = 1;
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Block User', 'Success Unblock User', 'success');

        return redirect(route('user.index'));
    }


    /**
     * @param $userId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($userId)
    {
        $user  = User::find($userId);
        $roles = Role::all();

        return view('admin.users.edit', [
            'user'  => $user,
            'roles' => $roles
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
            'username' => 'required|min:5',
            'role'     => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                DB::beginTransaction();
                $user       = User::find($id);
                $user->name = $request->get('username');
                $user->save();
                $user->detachRoles();
                $role = Role::find($request->get('role'));
                $user->attachRole($role);
                DB::commit();
                alert()->overlay('Update User', 'Success Update User', 'info');

                return redirect(route('user.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $searchVal = $request->get('search-val');

        if (empty($searchVal)) {
            $users = User::paginate(10);
        } else {
            $searchVal = $request->get('search-val');
            $users     = User::where('name', 'like', '%' . $searchVal . '%')
                ->orWhere('email', 'like', '%' . $searchVal . '%')
                ->paginate(10);
        }

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history($id)
    {
        $user    = User::find($id);
        $profile = Profile::where('user_id', $id)
            ->first();
        $history = History::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.history', [
            'history' => $history,
            'user'    => $user,
            'profile' => $profile
        ]);
    }
}