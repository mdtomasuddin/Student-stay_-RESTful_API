@extends('backend.app')

@section('title', 'Room Listings Management')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Manage Room Listings</h5>
                        </div>
                        <div class="card-body">
                            <table id="room-listing-table" class="table table-bordered table-striped align-middle"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Images</th>
                                        <th class="text-center">Property Title</th>
                                        <th class="text-center">Room Type</th>
                                        <th class="text-center">Move In Date</th>
                                        <th class="text-center">Move Out Date</th>
                                        <th class="text-center">Price / Week</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
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
            let table = $('#room-listing-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('room-listings.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'images',
                        name: 'images',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'property_title',
                        name: 'property_title'
                    },
                    {
                        data: 'room_type_name',
                        name: 'room_type_name'
                    },
                    {
                        data: 'move_in_date',
                        name: 'move_in_date'
                    },
                    {
                        data: 'move_out_date',
                        name: 'move_out_date'
                    },
                    {
                        data: 'price_per_week',
                        name: 'price_per_week'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
