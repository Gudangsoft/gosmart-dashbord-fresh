 <div class="sidebar-wrapper">
    <div class="menu-list">
        <a href="/learning/dashboard/{{ auth()->user()->id }}"><strong>New</strong></a>
        <a href="{{ $data['profile']['url'] }}"><strong>Profile</strong></a>
        <a href="{{ $data['url_history'] }}"><strong>History</strong></a>
    </div>
</div>
