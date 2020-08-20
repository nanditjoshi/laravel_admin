<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/AdminLTE.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admin.includes.header')

    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="https://via.placeholder.com/150" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ auth()->user()->getFullNameAttribute() }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu tree" data-widget="tree">
                @include('admin.includes.sidebar', ['items' => $adminNavigation->roots()])
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  @include('admin.includes.delete-modal')
  <!-- /.content-wrapper -->
  @include('admin.includes.footer')

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{!! csrf_token() !!}'
        }
    });
    function cciInitComplete($columns, $id) {
        var colCount = $columns[0].length;
        $columns.every(function () {
            var column = this;
            if (column.index() != 0 && column.index() != colCount-1)  {
                if(column.dataSrc() == 'role_id'){
                    var input = drawSelect('Role', $roles);
                } else {
                    var input = '<input type="text" class="form-control">';
                }

                $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val()).draw();
                });
            }
        });
        $('.paginate_button').addClass("btn btn-primary");
        $(`#${$id} thead`).append($(`#${$id}  tfoot tr`));
        $(`#${$id} tfoot`).hide();

    }

    function drawSelect($title, $options) {
        $select = '<select class="form-control">';
        $select += '<option value="">'+$title+'</option>';
        $.each($.parseJSON($options), function(key,value) {
            $select += '<option value="'+key+'">'+value+'</option>';
        });
        $select += '</select>';
        return $select;
    }

    $(document).ready( function () {
        $(document).on('click', '.action-delete', function(e){
            $('#modalDanger #deleteUrl').val($(this).data('action-url'));
            $('#modalDanger').modal('show');
        });

        $(document).on('click', '.btn-confirm-delete', function () {
            /*console.log($('#deleteUrl').val())*/
            $.ajax({
                url: $('#deleteUrl').val(),
                type: 'delete',
                success: function (data) {
                    alert(data.data);
                    $('#modalDanger').modal('hide');
                    window.location.reload();
                },
                error: function (data) {
                    alert('Something went wrong, please try again!!');
                    $('#modalDanger').modal('hide');
                }
            });
        });

        $('#modalDanger').on('hidden.bs.modal', function () {
            $('#modalDanger #deleteUrl').val('');
        })
    });

</script>
@yield('footer-script')
</body>
</html>