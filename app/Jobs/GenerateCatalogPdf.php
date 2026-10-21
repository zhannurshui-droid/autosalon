<?php

namespace App\Jobs;

use App\Models\Car;
use App\Models\User;
use App\Notifications\ExportReady;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GenerateCatalogPdf implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public function __construct(public User $user) {}

    public function handle(): void
    {
        $cars = Car::with('brand')->orderBy('title')->get();

        $file = 'catalog-' . now()->format('Ymd-His') . '.pdf';

        $pdf = Pdf::loadView('pdf.catalog', compact('cars'))->setPaper('a4');

        Storage::put("exports/{$file}", $pdf->output());

        $this->user->notify(new ExportReady($file));
    }

    public function failed(Throwable $e): void
    {
        Log::error("Не удалось сформировать PDF-каталог: {$e->getMessage()}");
    }
}