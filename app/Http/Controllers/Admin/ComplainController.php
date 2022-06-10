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

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {//query belom diganti
        // PERBAIKI QUERY
        $complaints = DB::select(DB::raw("select rv.title, rv.desc, rv.
                            from report_violation rv , `order` o 
                            where rv.id_order =o.id_order "));
        return view("pages.admin.complain", compact('complaints'));
    }

}
