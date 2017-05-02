
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Top Navigation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="./../AdminLTE-2.3.11/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./../AdminLTE-2.3.11/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="./../AdminLTE-2.3.11/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{url('/')}}" class="navbar-brand"><b>Home Page</b></a>
                    <a href="{{url('/AllBlog')}}" class="navbar-brand"><b>Blog List</b></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    {{$blog[0]->title}}
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Box Comment -->
                        <div class="box box-widget">
                            <div class="box-header with-border">
                                <div class="user-block">
                                    <img class="img-circle" src="../AdminLTE-2.3.11/xiaohui2.jpg" alt="User Image">
                                    <span class="username">{{$blog[0]->name}}</span>
                                    <span class="description">{{$blog[0]->updated_at}}</span>
                                </div>
                                <!-- /.user-block -->

                            </div>
                            <!-- /.box-header -->
                            @foreach($blog as $blogs)
                                <div class="box-body">
                                    <!-- post text -->
                                    <p>{{$blogs->content}}</p>

                                    <!-- Attachment -->

                                    <!-- Social sharing buttons -->
                                    @if($uid == $blogs->uid || $is_admin == 1)
                                        <button onclick="{location.href='{{url('/article/update')}}{{'/'.$blogs->id}}'}" type="button" class="btn btn-default btn-xs">
                                            Update</button>
                                        <button onclick="{if(confirm('Are you sure to delete?'))location.href='{{url('article/delete')}}{{'/'.$blogs->id}}'}" type="button" class="btn btn-default btn-xs">
                                            Delete</button>
                                    @endif
                                </div>
                        @endforeach
                        <!-- /.box-body -->

                            <div class="box-footer box-comments">
                                @foreach($comment as $comments)
                                    <div class="box-comment">
                                        <!-- User image -->
                                        <img class="img-circle img-sm" src="../AdminLTE-2.3.11/xiaohui.jpg" alt="User Image">
                                        <div class="comment-text">
                      <span class="username">
                        {{$comments->name}}
                          <span class="text-muted pull-right">{{$comments->updated_at}}</span>
                      </span><!-- /.username -->
                                            {{$comments->comment}}
                                        </div>
                                        <!-- /.comment-text -->
                                        @if($uid == $comments->uid || $is_admin == 1)
                                            <button onclick="{location.href='{{url('/comment/update')}}{{'/'.$blog[0]->id}}{{'/'.$comments->id}}'}" type="button" class="btn btn-default btn-xs">
                                                Update</button>
                                            <button onclick="{if(confirm('Are you sure to delete?'))location.href='{{url('comment/delete')}}{{'/'.$blog[0]->id}}{{'/'.$comments->id}}'}" type="button" class="btn btn-default btn-xs">
                                                Delete</button>
                                        @endif
                                    </div>
                            @endforeach
                            <!-- /.box-comment -->
                            </div>
                            <!-- /.box-footer -->
                            <div class="box-footer">
                                {{--<button onclick="{location.href='{{url('/comment')}}{{'/'.$blog[0]->id}}'}" type="button" class="btn btn-default btn-xs">--}}
                                {{--Add my comment</button>--}}
                                <form action="{{url('/comment')}}{{'/'.$blog[0]->id}}" method="post">
                                    {{csrf_field()}}
                                    <div class="img-push">
                                        <input type="text" name="comment" class="form-control input-sm" placeholder="Press enter to post comment">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
        </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.container -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.8
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </div>
    <!-- /.container -->
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="./../AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="./../AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="./../AdminLTE-2.3.11/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="./../AdminLTE-2.3.11/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="./../AdminLTE-2.3.11/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./../AdminLTE-2.3.11/dist/js/demo.js"></script>
</body>
</html>
