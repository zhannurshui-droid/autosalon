<footer class="footer">
    © {{ date('Y') }} {{ config('app.name') }}
    <p>{{ __('DB queries: :count', ['count' => count(\Illuminate\Support\Facades\DB::getQueryLog())]) }}</p>
</footer>