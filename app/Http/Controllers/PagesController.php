<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::all();
        $success = (session('success')) ? session('success') : false;
        $error = (session('error')) ? session('error') : false;

        $datas = array('pages' => $pages);
        
        if ($success != false) $datas['success'] = $success;
        if ($error != false) $datas['error'] = $error;

        return view('admin/pages/index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageNumber = Pages::all()->count();
        return view('admin/pages/create',
                [ 'newPageNumber' => $pageNumber + 1 ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dump($request->all());
        $request->validate([
            'name' => 'required|unique:pages|max:255',
          ]);
        $page = new Pages([
            'name' => $request->name,
          ]);
        if($page->save()) {
            
            return redirect('admin/pages')->with('success', 'Page ajoutée');
            
        } else {
            
            return redirect('admin/pages')->with('error', 'La page n\'a pas pu être créer');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'voir une page';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'éditer une page';
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Pages::find($id);
        $page->delete();

        return redirect('/admin/pages')->with('success', 'La page a bien été supprimée');
    }
}