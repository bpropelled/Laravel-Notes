<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lease;

class LeasesController extends Controller
{
  public function index(){
      $leases = Lease::all();
      $office = Lease::find(1)->offices;
      return view('lease.index')->with(['leases' => $leases, 'office' => $office]);
  }
}
