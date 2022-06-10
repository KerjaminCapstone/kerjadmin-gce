<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class FreelancerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freelancers = DB::table('user')->join('user_role', 'user.id_user', '=', 'user_role.id_user')
                            ->join('role', 'user_role.id_role', '=', 'role.id_role')
                            ->where('role.name', '=', 'freelancer')
                            ->select('user.id_user', 'user.email', 'user.name')
                            ->get();

        return view("pages.admin.freelancers", compact('freelancers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobChildCodes = DB::table('job_child_code')->get();

        return view("pages.admin.freelancers-create", compact("jobChildCodes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'nik' => 'required',
            'no_wa' => 'required',
            'is_male' => 'required',
            'address' => 'required',
            'password' => 'required',
            'job_child_code' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('admin.freelancers.create')
                ->with(session()->flash('alert-warning', 'Data diri kurang lengkap'))
                ->withInput();
        }
        $cleaned = $validator->validate();

        $faker = Faker::create('id_ID');
        $timeNow = Carbon::now();
        $role = DB::table('role')->where('name', 'freelancer')->first();
        $idUser = $role->id_role.'-'.$faker->regexify('[A-Za-z0-9]{8}');

        try {
            DB::table('user')->insert([
                'id_user' => $idUser,
                'email' => $cleaned['email'],
                'name' => $cleaned['name'],
                'password' => Hash::make($cleaned['password']),
                'no_wa' => $cleaned['no_wa'],
                'created_at' => $timeNow,
                'updated_at' => $timeNow,
            ]);
        } catch (QueryException $e) {
            return redirect()->route('admin.freelancers.create')
                ->with(session()->flash('alert-danger', 'Email sudah dipakai.'))
                ->withInput();
        }

        try {
            DB::table('freelance_data')->insert([
                'id_user' => $idUser,
                'nik' => $cleaned['nik'],
                'address' => $cleaned['address'],
                'is_trainee' => true,
                'rating' => 0.0,
                'is_male'=> $cleaned['is_male'] ? true : false,
                'dob' => $cleaned['dob'],
                'job_done' => true,
                'job_child_code' => $cleaned['job_child_code'],
                'date_join' => $timeNow,
                'created_at' => $timeNow,
                'updated_at' => $timeNow,
            ]);
        } catch (QueryException $e) {
            return redirect()->route('admin.freelancers.create')
                ->with(session()->flash('alert-danger', 'Nik sudah dipakai.'))
                ->withInput();
        }

        try {                
            DB::table('user_role')->insert([
                'id_user' => $idUser,
                'id_role' => $role->id_role,
            ]); 
        } catch (QueryException $e) {
            return redirect()->route('admin.freelancers.create')
                ->with(session()->flash('alert-danger', 'Terdapat kesalahan.'))
                ->withInput();
        }

        return redirect()->route('admin.freelancers.index')
                ->with(session()->flash('alert-success', 'Akun freelancer berhasil dibuat'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $freelancer = DB::table('user')
                        ->where('user.id_user', '=', $id)
                        ->join('freelance_data', 'user.id_user', '=', 'freelance_data.id_user')
                        ->first();
        $jobChildCodes = DB::table('job_child_code')->get();

        return view('pages.admin.freelancers-edit', compact('freelancer', 'jobChildCodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'nik' => 'required',
            'no_wa' => 'required',
            'is_male' => 'required',
            'address' => 'required',
            'job_child_code' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('admin.freelancers.create')
                ->with(session()->flash('alert-warning', 'Data diri kurang lengkap'))
                ->withInput();
        }
        $cleaned = $validator->validate();

        $data = DB::table('user')
                    ->where('user.id_user', '=', $id)
                    ->join('freelance_data', 'freelance_data.id_user', '=', 'user.id_user')
                    ->first();
        $pwd = isset($request->password) ? $request->password : $data->password;

        if (isset($data)) {
            try {
                $timeNow = Carbon::now();
                DB::table('user')->where('user.id_user', '=', $id)->update([
                    'email' => $cleaned['email'],
                    'name' => $cleaned['name'],
                    'password' => Hash::make($pwd),
                    'no_wa' => $cleaned['no_wa'],
                    'updated_at' => $timeNow,
                ]);
                DB::table('freelance_data')->where('freelance_data.id_user', '=', $id)->update([
                    'nik' => $cleaned['nik'],
                    'address' => $cleaned['address'],
                    'rating' => 0.0,
                    'is_male'=> $cleaned['is_male'] ? true : false,
                    'dob' => $cleaned['dob'],
                    'updated_at' => $timeNow,
                    'job_child_code' => $cleaned['job_child_code'],
                ]);
            } catch (QueryException $e) {
                return redirect()->route('admin.freelancers.create')
                    ->with(session()->flash('alert-danger', 'Terdapat kesalahan. Email, NIK, username, atau 
                        email mungkin sudah dipakai'))
                    ->withInput();
            }

            return redirect()->route('admin.freelancers.index')
                ->with(session()->flash('alert-success', 'Akun freelancer berhasil diedit'));
        } else {
            return redirect()->route('admin.freelancers.index')
                ->with(session()->flash('alert-warning', 'Akun freelancer tidak ditemukan'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::table('user')->where('user.id_user', '=', $id)->delete();
        } catch (QueryException $e) {
            return redirect()->route('admin.freelancers.create')
                ->with(session()->flash('alert-danger', 'Terjadi kesalahan. Silahkan ulangi kembali'))
                ->withInput();
        }

        return redirect()->route('admin.freelancers.index')
                ->with(session()->flash('alert-success', 'Akun freelancer berhasil dihapus'));
    }
}
