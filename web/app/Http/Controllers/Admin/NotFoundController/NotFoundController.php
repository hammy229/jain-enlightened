<?php

namespace App\Http\Controllers\Admin\NotFoundController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotFoundController extends Controller
{
    // public function index(){
    //     // return view('Admin.NotFounds.404-not-found');

    //     return view('Front.404-page');

    // }

     // Frontend 404 page
     public function index()
     {
         return view('Front.404-page');
     }
 
     // Admin 404 page
     public function adminIndex()
     {
         return view('Admin.NotFounds.404-not-found');
     }
}
