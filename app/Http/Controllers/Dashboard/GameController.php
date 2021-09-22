<?php

namespace App\Http\Controllers\Dashboard;

use App\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404, 'Page Not Found');
        }
        return view('dashboard.games.index');
    }

    public function createOrUpdate(Request $request, Game $game)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        //Set our action for our alert message
        $action = $game->exists ? "updated" : "created";

        if ($request->isMethod('post')) {

            $detailEN = $request->input('descriptionEN');
            $detailAR = $request->input('descriptionAR');
            $game_link = $request->input('game_link');
            $domEN = new \domdocument();
            $domAR = new \domdocument();
            $domEN->loadHtml($detailEN, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $domAR->loadHtml($detailAR, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $detailEN = $domEN->savehtml();
            $detailAR = utf8_decode($domAR->savehtml($domAR->documentElement));
            $image = $request->file('image');
            $image_banner = $request->file('image_banner');
            $fileName = "";
            $fileName_banner = "";

            if ($image != null) {
                $fileName = time() . '.' . $image->extension();
                $image->move(public_path('dash/images/games'), $fileName);
            }

            if ($image_banner != null) {
                $fileName_banner = time() . '.' . $image_banner->extension();
                $image_banner->move(public_path('dash/images/games'), $fileName_banner);
            }
            return \DB::transaction(function () use ($request, $game, $action, $fileName, $detailEN, $detailAR,$fileName_banner,$game_link) {

                $game->game_name = $request->input('name');
                $game->setTranslation('description', 'en', $detailEN);
                $game->setTranslation('description', 'ar', $detailAR);
                $game->pc_only = ($request->input('pc_check') == "yes") ? 1 : 0;
                $game->game_link = $game_link;
                if ($request->file('image') != null || $game->image == null)
                    $game->image = $fileName;

                    if ($request->file('image_banner') != null || $game->image_banner == null)
                        $game->image_banner = $fileName_banner;
                $game->save();
                //Redirect to the game index page
                return redirect(route('dashboard.games'))->with('success', 'The game has been ' . $action . '.');
            });
        }
        return view('dashboard.games.form', [
            'game' => $game->exists ? $game : null, //Only send our game if it exists(i.e we're editing it)
            'action' => ($action == "created") ? "Creating" : "Updating", //May aswell send the view what we're actually doing too!
        ]);
    }

    public function delete(Game $game)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        $game->delete();

        return redirect(route('dashboard.games'))->with('success', 'Game deleted.');
    }
}
