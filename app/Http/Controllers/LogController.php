<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Exception\UnsupportedOperationException;

class LogController extends Controller
{

    /**
     * @var array
     */
    public $data;

    /**
     * @var \Carbon\Carbon
     */
    public Carbon $date;

    /**
     * @var mixed
     */
    public $file;

    /**
     * @var string
     */
    public string $filePath;

    /**
     * @var int
     */
    public int $fileSize;

    /**
     * @var \Carbon\Carbon
     */
    public Carbon $lastModified;

    /**
     * Show Application Logs.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(Request $request)
    {
        $this->date = new Carbon($request->get('date', today()));

        $this->filePath = storage_path("logs" . DIRECTORY_SEPARATOR . "dcas-{$this->date->format('Y-m-d')}.log");

        if (File::exists($this->filePath)) {
            try {
                $this->file = File::get($this->filePath);

                $this->fileSize = File::size($this->filePath);

                $this->lastModified = new Carbon(File::lastModified($this->filePath));

                $this->data = [
                    'lastModified' => $this->lastModified,
                    'size'         => $this->fileSize,
                    'file'         => $this->file,
                ];
            } catch (\Exception $e) {
                throw new UnsupportedOperationException;
            }
        }

        return view('dashboard.logs', ['date' => $this->date, 'data' => $this->data]);
    }
}
