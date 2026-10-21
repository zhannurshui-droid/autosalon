<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateCatalogPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    public function catalog(Request $request)
    {
        GenerateCatalogPdf::dispatch($request->user());

        return back()->with('success', 'Каталог формируется, вы получите уведомление.');
    }

    public function download(string $file)
    {
        abort_unless(Storage::exists("exports/{$file}"), 404);

        return Storage::download("exports/{$file}", $file);
    }
}