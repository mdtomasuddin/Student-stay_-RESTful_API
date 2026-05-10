@extends('backend.app')

@section('title', 'Property Enquiries')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Page Title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('property-enquiry.index') }}">Table</a>
                                </li>
                                <li class="breadcrumb-item active">Property Enquiries</li>
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
                            <h5 class="card-title mb-0">Property Enquiries</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-striped align-middle"
                                    style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Submitted At</th>
                                            <th class="text-center" style="width: 100px;">Action</th>
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

    {{-- Modal for viewing details --}}
    <div class="modal fade" id="viewEnquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="enquiryModalLabel" class="modal-title">Enquiry Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="enquiryDetailsBody">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                ajax: "{{ route('property-enquiry.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'full_name',
                        name: 'full_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ],
                order: [
                    [5, 'desc']
                ],
            });
        });

        // Show details in modal
        async function showEnquiryDetails(id) {
            let url = '{{ route('property-enquiry.show', ':id') }}'.replace(':id', id);
            let modalBody = document.getElementById('enquiryDetailsBody');

            modalBody.innerHTML =
                `<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>`;

            try {
                let response = await axios.get(url);
                if (response.data.success) {
                    let data = response.data.data;
                    let propertyName = 'N/A';
                    if (data.property) {
                        propertyName = data.property.title || 'N/A';
                    } else if (data.room_listings) {
                        propertyName = data.room_listings.name || 'N/A';
                    }

                    modalBody.innerHTML = `
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-bold mb-1">Full Name</label>
                                <p class="mb-3 text-dark font-medium">${data.first_name} ${data.last_name}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold mb-1">Email</label>
                                <p class="mb-3 text-dark font-medium">${data.email || 'N/A'}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold mb-1">Phone</label>
                                <p class="mb-3 text-dark font-medium">${data.phone || 'N/A'}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold mb-1">University</label>
                                <p class="mb-3 text-dark font-medium">${data.university || 'N/A'}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold mb-1">Preferred Move-in Date</label>
                                <p class="mb-3 text-dark font-medium">${data.preferred_move_in_date || 'N/A'}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold mb-1">Preferred Contact Method</label>
                                <p class="mb-3 text-dark font-medium text-uppercase">${data.preferred_contact_method || 'N/A'}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold mb-1">Property/Room</label>
                                <p class="mb-3 text-dark font-medium">${propertyName}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold mb-1">Status</label>
                                <p class="mb-3"><span class="badge bg-info-subtle text-info text-uppercase">${data.status}</span></p>
                            </div>
                            <div class="col-12">
                                <label class="fw-bold mb-1">Message</label>
                                <div class="p-3 bg-light rounded border text-dark" style="white-space: pre-wrap;">${data.message || 'No message provided.'}</div>
                            </div>
                        </div>
                    `;
                } else {
                    toastr.error(response.data.message);
                }
            } catch (error) {
                toastr.error('Could not fetch details.');
            }
        }

        // Delete confirmation
        function deleteRecord(event, id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id);
                }
            })
        }

        function deleteItem(id) {
            let url = '{{ route('property-enquiry.destroy', ':id') }}'.replace(':id', id);
            $.ajax({
                type: "DELETE",
                url: url,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(resp) {
                    $('#datatable').DataTable().ajax.reload();
                    if (resp['t-success']) {
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error('Something went wrong!');
                }
            });
        }
    </script>
@endpush
