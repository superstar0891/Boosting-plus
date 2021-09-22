<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoosterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.boosters.index');
    }

    public function createOrUpdate(Request $request, User $booster)
    {
        if (Auth::user()->id != $booster->id && Auth::user()->type != 'Administrator') {
            return abort(404);
        }
        //Set our action for our alert message
        $action = $booster->exists ? "updated" : "created";

        if ($request->isMethod('post')) {
            return \DB::transaction(function () use ($request, $booster, $action) {
                $booster->name = $request->input('name');
                $booster->email = $request->input('email');
                $booster->password = bcrypt($request->input('password'));
                $booster->type = 'Booster';
                $booster->save();
                //Redirect to the booster index page
                return redirect(route('dashboard.boosters'))->with('success', 'The user has been ' . $action . '.');
            });
        }
        return view('dashboard.boosters.form', [
            'booster' => $booster->exists ? $booster : null, //Only send our user if it exists(i.e we're editing it)
            'action' => ($action == "created") ? "Creating" : "Updating", //May aswell send the view what we're actually doing too!
        ]);
    }

    public function delete(User $booster)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        $booster->delete();

        return redirect(route('dashboard.boosters'))->with('success', 'Booster Deleted.');
    }

    public function impersonate(User $booster)
    {
        if(Auth::user()->type != 'Administrator') {
            return redirect()->back();
        }
        Auth::user()->impersonate($booster);

        return redirect()->back();
    }

    public function leaveImpersonation()
    {
        Auth::user()->leaveImpersonation();

        return redirect()->back();
    }
}
