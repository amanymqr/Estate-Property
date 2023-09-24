@php
    $setting = App\Models\Setting::find(1);
    $blog = App\Models\BlogPost::latest()
        ->limit(2)
        ->get();
@endphp

<footer class="main-footer">

    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-box clearfix">
                <figure class="footer-logo"><a href="index.html"><img
                            src="{{ asset('frontend/assets/images/footer-logo.png') }}" alt=""></a></figure>
                <div class="copyright pull-left">
                    <p><a href="index.html">{{ $setting->copyright }}</p>
                </div>
                <ul class="footer-nav pull-right clearfix">
                    <li><a href="index.html">Terms of Service</a></li>
                    <li><a href="index.html">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
