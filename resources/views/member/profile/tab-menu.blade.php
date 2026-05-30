<!-- Admin Tab Menu Start -->
<div class="nav flex-column nav-pills admin-tab-menu">
    <a href="{{ $data['url_overview'] }}" class="{{ isset($data['overview']) ? $data['overview'] : '' }}">Overview</a>
    {{-- <a href="{{ $data['url_history'] }}" class="{{ isset($data['history']) ? $data['history'] : '' }}">History</a> --}}
    <a href="{{ $data['url_payment'] }}" class="{{ isset($data['payment']) ? $data['payment'] : '' }}">Payment</a>
    <a href="{{ $data['url_certificate'] }}" class="{{ isset($data['certificate']) ? $data['certificate'] : '' }}">Certificate</a>
    <a href="{{ $data['url_edit'] }}" class="{{ isset($data['edit']) ? $data['edit'] : ''}}">Edit Profile</a>
    <a href="{{ $data['url_creation'] }}" class="{{ isset($data['creation']) ? $data['creation'] : ''}}">Karya Saya</a>
    <a href="{{ $data['url_cart'] }}" class="{{ isset($data['cart']) ? $data['cart'] : ''}}">Keranjang <span>{{ isset($data['cart_count']) ? $data['cart_count'] : 0 }}</span></a>
    {{-- <a href="{{ $data['url_report'] }}" class="{{ isset($data['report']) ? $data['report'] : '' }}">Report</a> --}}
</div>
<!-- Admin Tab Menu End -->
