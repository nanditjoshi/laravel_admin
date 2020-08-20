@extends('admin.app')

@section('content')
    <section class="content">
        @include('admin.includes.breadcumb', ['pageTitle' => 'Users', 'pageSubTitle' => ''])
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{ __('Users') }}</h3>
                            <div class="box-tools">
                                <a href="{{ url('admin/users/create') }}" class="btn btn-default"><i class="fa fa-add"></i>{{ __('Add Users') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table id="usersTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="nosort">ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="nosort">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
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
            $roles = '{!! json_encode(\App\Helpers\Helpers::getRoleList()) !!}';
            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.users.browse') }}',
                    method: 'POST'
                },
                columnDefs: [ {"targets": 'nosort',"orderable": false}],
                columns: [
                    {"data":"id","name":"id","searchable":false},
                    {"data":"first_name","name":"first_name","searchable":true},
                    {"data":"last_name","name":"last_name","searchable":true},
                    {"data":"email","name":"email","searchable":true},
                    {"data":"role_id","name":"role_id","searchable":true},
                    {"data":"action","name":"action","searchable":false}
                ],
                initComplete: function () {
                    cciInitComplete(this.api().columns(), 'usersTable');
                },
                fnDrawCallback: function () {

                }
            });
        });
    </script>
@endsection
