@extends('admin.app')

@section('content')
<section class="content">
    @include('admin.includes.breadcumb', ['pageTitle' => 'Roles', 'pageSubTitle' => ''])
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('Roles') }}</h3>

                        <div class="box-tools">
                            <a href="{{ url('admin/roles/create') }}" class="btn btn-default"><i class="fa fa-add"></i>{{ __('Add Role') }}</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table id="rolesTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="nosort">ID</th>
                                    <th>Name</th>
                                    <th class="nosort">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</section>
@endsection

@section('footer-script')
    <script>
        $(document).ready( function () {
            $('#rolesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.roles.browse') }}',
                    method: 'POST'
                },
                columnDefs: [ {"targets": 'nosort',"orderable": false}],
                columns: [
                    {"data":"id","name":"id","searchable":false},
                    {"data":"name","name":"name","searchable":true},
                    {"data":"action","name":"action","searchable":false}
                ],
                pageLength: 10,
                initComplete: function () {
                    cciInitComplete(this.api().columns(), 'rolesTable');
                },
                fnDrawCallback: function () {

                }
            });
        });
    </script>
@endsection
