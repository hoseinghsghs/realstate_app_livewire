<div class="navbar-right">
    <ul class="navbar-nav">
        <li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i
                    class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        <li><a aria-disabled="true" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                class="mega-menu" title="Sign Out"><i class="zmdi zmdi-power"></i></a>
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</div>
