<?php

namespace App\Console\Commands;

use App\Models\Car;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class ImportCars extends Command
{
    protected $signature = 'cars:import {file : Путь к CSV-файлу}';

    protected $description = 'Импорт автомобилей из CSV (название;год;цена;id марки)';

    public function handle(): int
    {
        $path = $this->argument('file');

        if (! is_file($path)) {
            $this->error("Файл не найден: {$path}");

            return self::FAILURE;
        }

        $handle = fopen($path, 'r');

        $added = 0;
        $skipped = 0;
        $line = 0;

        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            $line++;

            // пустая строка
            if ($row === [null] || count(array_filter($row, fn ($v) => $v !== null && $v !== '')) === 0) {
                continue;
            }

            if (count($row) < 4) {
                $this->warn("Строка {$line}: ожидается 4 поля, найдено " . count($row));
                $skipped++;

                continue;
            }

            [$title, $year, $price, $brandId] = array_map('trim', $row);

            $validator = Validator::make(
                ['title' => $title, 'year' => $year, 'price' => $price, 'brand_id' => $brandId],
                [
                    'title'    => ['required', 'string', 'max:255'],
                    'year'     => ['required', 'integer', 'between:1950,' . (now()->year + 1)],
                    'price'    => ['required', 'numeric', 'min:0'],
                    'brand_id' => ['required', 'exists:brands,id'],
                ]
            );

            if ($validator->fails()) {
                $this->warn("Строка {$line}: " . $validator->errors()->first());
                $skipped++;

                continue;
            }

            Car::create([
                'title'    => $title,
                'year'     => (int) $year,
                'price'    => $price,
                'brand_id' => (int) $brandId,
                'mileage'  => 0,
                'in_stock' => true,
            ]);

            $added++;
        }

        fclose($handle);

        $this->info("Итог: добавлено {$added}, пропущено {$skipped}.");

        return self::SUCCESS;
    }
}