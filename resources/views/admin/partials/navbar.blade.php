<nav class="flex justify-between items-center h3 col-p-bg">
    <div class="flex items-start">
        <a href="/admin"><img src="'/ogo/goes/here.jpg"
                              alt="Logo"
                              height="60px"
            >
        </a>
    </div>
    <div class="flex justify-end items-center h-100">
        <dropdown name="{{ auth()->user()->email }}">
            <div slot="dropdown">
                <reset-password url="/admin/me/password" button-text="Reset"></reset-password>
                {{--<a class="link mv2 ph4 pv2 nowrap col-p hv-bg-grey" href="">Reset Password</a>--}}
                <form action="{{ route('logout') }}" method="POST" class="mv2 ph4 hv-bg-grey pv2">
                    {!! csrf_field() !!}
                    <button class="link col-p bn col-bg-trans pa0 sans" type="submit">Logout</button>
                </form>
            </div>
        </dropdown>
    </div>
</nav>