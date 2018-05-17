<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\company;

class AdminController extends Controller
{
    public function index()
    {
      return view('admin.index');
    }

    public function division()
    {
      $companies = company::all();

      $data = array('companies' =>$companies , );
      return view('admin.division')->with($data);
    }

    public function jobvacancy()
    {
      return view('admin.jobvacancy');
    }

    public function jobvacancy_add()
    {
      return view('admin.jobvacancyadd');
    }

    public function jobvacancy_create(Request $request)
    {
      dd($request);


    }
}
