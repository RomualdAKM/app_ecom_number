<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function get_codes(){

        $codes = Code::all();

        return $codes;
    }
}
