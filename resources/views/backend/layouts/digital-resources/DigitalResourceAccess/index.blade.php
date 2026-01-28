@extends('backend.app')

@section('title', 'Digital Resource Access Information*')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Page Title --}}
            <div class="row">
                <div class="col-12 m-4">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('digitals.resources.access') }}">Table</a>
                                </li>
                                <li class="breadcrumb-item active">Digital Resource Access Information</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card with table --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Digital Resource Access Information***</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered text-center table-striped align-middle"
                                    style="width:100%">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">User Name</th>
                                            <th class="text-center">User Email</th>
                                            <th class="text-center">Resource Name</th>
                                            <th class="text-center">Access Count</th>
                                            <th class="text-center">IP Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Dynamic Data --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var dTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('digitals.resources.access') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user_name',
                        name: 'user.first_name'
                    },
                    {
                        data: 'user_email',
                        name: 'user.email'
                    },
                    {
                        data: 'resource_name',
                        name: 'digital_resource.title'
                    },

                    {
                        data: 'access_count',
                        name: 'access_count'
                    },
                    {
                        data: 'ip_address',
                        name: 'ip_address'
                    }
                ],
                order: [
                    [0, 'desc']
                ],
            });
        });
    </script>
@endpush
