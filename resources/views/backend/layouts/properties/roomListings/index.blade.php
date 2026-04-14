@extends('backend.app')

@section('title', 'Room Listings Management')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between ">
                            <h5 class="card-title mb-0">Manage Room Listings</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="room-listing-table"  class="table table-bordered  table-striped"
                                    style="width:100%">
                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Images</th>
                                        <th>Property Title</th>
                                        <th>Room Type</th>
                                        <th>Move In Date</th>
                                        <th>Move Out Date</th>
                                        <th>Price / Week</th>
                                        <th>Action</th>
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
