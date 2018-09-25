<?php

namespace App\Http\Controllers;

use App\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class CandidatsController extends Controller
{
    public function index() {
//        $candidats = Candidat::get();
        $candidats = DB::table('candidats')
            ->orderByRaw('vote DESC')
            ->get();

        return view('candidats.list', ['candidats' => $candidats]);
    }

    public function new() {
        return view('candidats.form');
    }

    public function save(Request $request) {
        $candidat = new Candidat();

        $candidat = $candidat->create($request->all());

        \Session::flash('message_success', 'Candidato cadastrado com sucesso!');

        return Redirect::to('candidats/new');
    }

    public function edit($id) {
        $candidat = Candidat::findOrFail($id);

        return view('candidats.form', ['candidat' => $candidat]);
    }

    public function update($id, Request $request) {
        $candidat = Candidat::findOrFail($id);

        $candidat->update($request->all());

        \Session::flash('message_success', 'Candidato editado com sucesso!');

        return Redirect::to('candidats/'.$candidat->id.'/edit');
    }

    public function delete($id) {
        $candidat = Candidat::findOrFail($id);

        $candidat->delete();

        \Session::flash('message_success', 'Candidato deletado com sucesso!');

        return Redirect::to('candidats');
    }

    public function vote($id) {

        session_start();
        if (isset($_SESSION['ja_votou'])) {
            return view("ja_votou");
        } else {
            $_SESSION['ja_votou'] = 1;
            session_commit();
            $candidat = Candidat::findOrFail($id);

            $candidat = DB::table('candidats')->where('id', '=', $id)->increment('vote');

            \Session::flash('message_success', 'Voto realizado com sucesso!');
        }

        return Redirect::to('candidats');
    }
}
