<footer class="footer mt-auto py-3" style="
    background-color: #f8f9fa;
    text-align: center;
    padding: 15px 0;
    border-top: 1px solid #e2e8f0;
">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 text-center">
                {{ $systemSettings?->copyright_text 
                    ?? "Copyright © ".date('Y')." ".($systemSettings?->site_name ?? 'Fire-Security').". Designed with ❤️ by ".($systemSettings?->designer_name ?? 'Spruko').". All rights reserved." }}
            </div>
        </div>
    </div>
</footer>

