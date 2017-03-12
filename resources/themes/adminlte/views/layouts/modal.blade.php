@yield('head')
@yield('js')

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">@yield('title')</h4>
</div>
<div class="modal-body">
    @yield('content')
</div>
<div class="modal-footer">
    @yield('footer')
</div>