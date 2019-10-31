<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users =  DB::table('users')
            ->select('users.name as name','email','birthday','sex','phone_number','users.created_at as created_at','roles.name as Role')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->orderBy('Role', 'asc')
            ->get();
        return $users;
//        dd($users);
    }
    public function headings(): array
    {
        return [
            'User Name',
            'Email',
            'Birthday',
            'Sex',
            'Phone Number',
            'Created At',
            'Role'
        ];
    }
}
