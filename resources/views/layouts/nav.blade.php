<div id="Header_wrapper">
    <header id="Header">
        <div id="Top_bar">
            <div class="row">
                <div class="column one">
                    <div class="top_bar_left clearfix">
                        <div class="logo">
                            <a id="logo" href="{{ route('index') }}" title="eParcel Sys" data-height="60"
                                data-padding="10"><img class="logo-main scale-with-grid"
                                    src="{{ asset('images/eparcel.png') }}" width="200" height="300"></a>
                        </div>
                        <div class="menu_wrapper">
                            <nav id="menu">
                                @guest
                                <ul id="menu-main-menu" class="menu menu-main">
                                    <li> <a href="{{route('parcel.login')}}"><span><span
                                                    style="color:#e6a94a">Log Masuk</span></span></a> </li>
                                </ul>
                                @else
                             
                                <ul id="menu-main-menu" class="menu menu-main">
                                    <li> <a href="{{route('students.index')}}"><span><span
                                        style="color:#e6a94a">Dashboard</span></span></a> </li>
                                    <li> <a href="{{route('students.logout')}}"><span><span
                                                    style="color:#e6a94a">Log Keluar</span></span></a> </li>
                                </ul>

                                @endguest
                            </nav><a class="responsive-menu-toggle" href="#"><i class="icon-menu-fine"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>