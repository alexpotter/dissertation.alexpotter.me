<div class="col-md-2 col-sm-4 hidden-xs sidebar-outer side-nav">
    <div class="header"><a href="{{ url('admin') }}">SBCDS</a></div>
    <ul class="navigation">
        <li><i class="fa fa-sign-in"></i> {{ Auth::user()->username }}</li>
        <a href="{{ url( '/admin/timeline/settings' ) }}"><li>Time line settings <i class="fa fa-line-chart"></i></li></a>
        <a href="{{ url( '/admin/logout' ) }}"><li>Log out <i class="fa fa-lock"></i></li></a>
    </ul>
</div>
<div class="hidden-lg hidden-md hidden-sm col-xs-12">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('admin') }}">
                    <div class="navbar-brand-inner">
                        SBCDS
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" onclick="return false;"><i class="fa fa-sign-in"></i> {{ Auth::user()->username }}</a></li>
                    <li><a href="{{ url( '/admin/timeline/settings' ) }}"><i class="fa fa-line-chart"> Time line settings</i></a></li>
                    <li><a href="{{ url( '/admin/logout' ) }}"><i class="fa fa-lock"> Log out</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>