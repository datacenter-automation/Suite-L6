<?php

namespace App\Http\Controllers\API\V1;

use App\Events\FileUploaded;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoareCostin\FileVault\Facades\FileVault;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Illuminate\Support\Facades\File;

/**
 * Class UploadController
 *
 * @package App\Http\Controllers\API\V1
 *
 * @todo show(), index(), destroy()
 */
class UploadController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Perhaps run a job if just .file instead of .enc?
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // logged-in?
        // pull uploads from database
        // response->json
    }

    /**
     * Show a specific resource.
     *
     * @param string $upload
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function show(string $upload)
    {
        $encryptedFile = storage_path("uploads" . DIRECTORY_SEPARATOR . "{$upload}.file.enc");

        $decryptedFile = storage_path("uploads" . DIRECTORY_SEPARATOR . "{$upload}.file");

        if (! \File::exists($encryptedFile)) {
            throw new FileException("{$encryptedFile} not found!");
        }

        $m = FileVault::decrypt(basename($encryptedFile),  basename($decryptedFile), false);

        dd($m);

        $file = File::get($decryptedFile);

        return response()->download($file);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function store(Request $request)
    {
        $content = $request->getContent();

        $randomString = hash('sha256', time());

        $file = storage_path("uploads/{$randomString}.file");

        \File::put($file, base64_encode($content));

        event(new FileUploaded($fileBase = basename($file)));

        return $fileBase;
    }
}
