<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Invoice | Notika - Notika Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/theme.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/font-awesome.min.css" crossorigin="anonymous">

</head>

<body>
  <!-- Invoice Print Area End -->
    <!-- Start Header Top Area -->
  <div class="container-fluid">
    <div class="row" style="  background: #0d0035;">
        <div class="col-6 col-lg-2">
          <a href="/" style="color:#FFFFFF;">TKYS</a>
        </div>
        <div class="col-6 col-lg-10 text-right" id="notification-div">
          <div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html" style="color:#FFFFFF;">
                <i class="fa fa-bell" ></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-right notifications" role="menu" aria-labelledby="dLabel">

                <div class="notification-heading"><h4 class="menu-title">Notifications</h4><h4 class="menu-title pull-right">View all<i class="glyphicon glyphicon-circle-arrow-right"></i></h4>
                </div>
              <li class="divider"></li>
             <div class="notifications-wrapper">
               <a class="content" href="#">

                 <div class="notification-item">
                  <h4 class="item-title">Evaluation Deadline 1 · day ago</h4>
                  <p class="item-info">Marketing 101, Video Assignment</p>
                </div>

              </a>
               <a class="content" href="#">
                <div class="notification-item">
                  <h4 class="item-title">Evaluation Deadline 1 · day ago</h4>
                  <p class="item-info">Marketing 101, Video Assignment</p>
                </div>
              </a>
               <a class="content" href="#">
                <div class="notification-item">
                  <h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
                  <p class="item-info">Marketing 101, Video Assignment</p>
                </div>
              </a>
               <a class="content" href="#">
                <div class="notification-item">
                  <h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
                  <p class="item-info">Marketing 101, Video Assignment</p>
                </div>

              </a>
               <a class="content" href="#">
                <div class="notification-item">
                  <h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
                  <p class="item-info">Marketing 101, Video Assignment</p>
                </div>
              </a>
               <a class="content" href="#">
                <div class="notification-item">
                  <h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
                  <p class="item-info">Marketing 101, Video Assignment</p>
                </div>
              </a>

             </div>
              <li class="divider"></li>
              <div class="notification-footer"><h4 class="menu-title">View all<i class="glyphicon glyphicon-circle-arrow-right"></i></h4></div>
            </ul>
          </div>
        </div>
    </div>
  </div>

    <!-- End Header Top Area -->

<div class="navbar navbar-expand-md navbar-light bg-light mb-4" role="navigation">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Anasayfa <span class="sr-only">(current)</span></a>
            </li>
              @foreach (Helper::getMenuItemsForAction() as $key=>$value)
              @if (is_array($value))
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="{{$key}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans("messages.".$key)}}</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown1">
                    @foreach ($value as $altkey=>$altvalue)
                    <li class="dropdown-item dropdown">
                        <a class="dropdown-toggle" id="dropdown1-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans("messages.".$altkey)}}</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown1-1">
                          @foreach ($altvalue as $altaltkey=>$altaltvalue)
                            <li class="dropdown-item" href="{{$altaltvalue}}"><a>{{trans("messages.".$altkey."-".$altaltkey)}}</a></li>
                          @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </li>

              @else
                <li class="nav-item active">
                    <a class="nav-link" href="#">{{trans("messages.".$key)}}</a>
                </li>
              @endif
              @endforeach
        </ul>
    </div>
</div>

  <!-- Invoice area End-->
  <div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-12">

        </div>
    </div>
  </div>


  <div class="footer-copyright-area">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="footer-copy-right">
                      <p>Copyright © {{\Carbon\Carbon::parse("Y")->format("Y")}}. All rights reserved  BSY Bilgi Teknolojileri</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- TODO -->
	  <!-- Invoice area Start-->

    <!-- Start Footer area-->

    <!-- End Footer area-->
    <!-- jquery
		============================================ -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.js" ></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.js" ></script>
     <script src="/assets/js/theme.js" ></script>
</body>

</html>
