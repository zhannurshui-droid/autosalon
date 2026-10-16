<footer class="footer">
    © {{ date('Y') }} {{ config('app.name') }}
    <p>Запросов к БД: {{ count(\Illuminate\Support\Facades\DB::getQueryLog()) }}</p>
</footer>