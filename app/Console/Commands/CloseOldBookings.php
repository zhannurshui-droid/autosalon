<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class CloseOldBookings extends Command
{
    protected $signature = 'bookings:close-old
                            {--days=7 : Закрывать заявки старше N дней}
                            {--dry-run : Только показать, ничего не менять}';

    protected $description = 'Закрывает (отклоняет) необработанные заявки старше N дней';

    public function handle(): int
    {
        $days = (int) $this->option('days');

        $bookings = Booking::with(['user', 'car'])
            ->where('status', 'new')
            ->where('created_at', '<', now()->subDays($days))
            ->get();

        if ($bookings->isEmpty()) {
            $this->info("Устаревших заявок (старше {$days} дн.) нет.");

            return self::SUCCESS;
        }

        $this->table(
            ['№', 'Клиент', 'Автомобиль', 'Создана'],
            $bookings->map(fn ($b) => [
                $b->id,
                $b->user->name,
                $b->car->title,
                $b->created_at->format('d.m.Y H:i'),
            ])->all()
        );

        if ($this->option('dry-run')) {
            $this->warn("Режим dry-run: найдено {$bookings->count()}, изменения не сохранены.");

            return self::SUCCESS;
        }

        if (! $this->confirm("Закрыть заявок: {$bookings->count()}?", true)) {
            $this->warn('Отменено.');

            return self::SUCCESS;
        }

        $this->withProgressBar($bookings, fn ($b) => $b->update(['status' => 'rejected']));

        $this->newLine(2);
        $this->info("Закрыто заявок: {$bookings->count()}.");

        return self::SUCCESS;
    }
}