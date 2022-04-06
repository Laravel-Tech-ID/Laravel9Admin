<?php

namespace Modules\File\Http\Controllers\Web\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function publicShow($filename)
    {
        return file_show($filename);
    }

    public function publicOpen($filename)
    {
        return file_open($filename);
    }

    public function publicDownload($filename)
    {
        return file_download($filename);
    }

    public function privateShow($filename)
    {
        return file_show($filename);
    }

    public function privateOpen($filename)
    {
        return file_open($filename);
    }

    public function privateDownload($filename)
    {
        return file_download($filename);
    }

    public function index()
    {
        return view('file::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('file::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('file::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('file::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
