<?php

namespace Patienttimeline\Http\Controllers;

use Illuminate\Http\Request;
use Patienttimeline\Http\Requests;
use Patienttimeline\Http\Controllers\Controller;

use Mockery\CountValidator\Exception;
use Response;
use Auth;
use DB;
use QueryException;
use Carbon;
use File;
use Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check())
        {
            return view('admin/index');
        }
        else
        {
            return redirect('admin/login');
        }
    }

    /**
     *
     * User not logged in
     *
     * @return view
     */
    public function loginPage()
    {
        if (Auth::check())
        {
            return redirect()->intended('admin')->with('message-with-warning', 'You are already logged in');
        }
        else
        {
            return view('admin/login/index');
        }
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')]))
        {
            // Authentication passed...
            return redirect()->intended('admin')->with('message-with-success', 'Successfully logged in');
        }
        else
        {
            return redirect()->back()->with('message-with-error', 'Incorrect username/password')->withInput(array('username' => $request->input('username')));
        }
    }

    /**
     * Handle log out.
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('admin/login')->with('message-with-success', 'Successfully logged out');

    }
}
