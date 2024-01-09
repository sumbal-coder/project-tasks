@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <button class="btn btn-dark mt-5 mb-5" href="" id="createNewTask">Create Task</button>
    <div class="card card-preview">
        <div class="card-inner">
            <table class="data_table table table-bordered table-striped dataTable" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Due Date</th>
                        <th>Completed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body" id="task_form">
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    var table = null;
    $(function() {

        /*------------------------------------------
         --------------------------------------------
         Pass Header Token
         --------------------------------------------
         --------------------------------------------*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /*------------------------------------------
        --------------------------------------------
        Render DataTable
        --------------------------------------------
        --------------------------------------------*/
        table = $('.data_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('tasks.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'priority',
                    name: 'priority'
                },
                {
                    data: 'due_date',
                    name: 'due_date'
                },
                {
                    data: 'completed',
                    name: 'completed'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Create Button
        --------------------------------------------
        --------------------------------------------*/
        $('#createNewTask').click(function() {
            console.log('sdsd');
            $.ajax({
                type: "GET",
                url: "{{ route('tasks.create') }}",
                success: function(response) {
                    $('#modelHeading').html("Create New Task");
                    $('#task_form').html(response);
                    $('#saveBtn').val("create-task");
                    $('#ajaxModel').modal('show');
                }
            });
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.editTask', function() {
            var task_id = $(this).data('id');
            var url = '{{ route("tasks.edit", ":id") }}';
            url = url.replace(':id', task_id);
            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    $('#modelHeading').html("Edit Task Inoformation");
                    $('#task_form').html(data);
                    $('#ajaxModel').modal('show');
                },

            });
        });

        /*------------------------------------------
        --------------------------------------------
        Delete Task
        --------------------------------------------
        --------------------------------------------*/
        $(document).on('click', '.deleteTask', function() {
            var task_id = $(this).data('id');

            Swal.fire({
                title: 'Do you want to delete it?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                customClass: {
                    actions: 'my-actions',
                    cancelButton: 'order-1 right-gap',
                    confirmButton: 'order-2',
                },
                icon: 'warning',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    var url = '{{ route("tasks.destroy", ":id") }}';
                    url = url.replace(':id', task_id);

                    return $.ajax({
                        type: 'DELETE',
                        url: url,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                    }).then(function(response) {
                        if (response.success) {
                            table.draw();
                            return response;
                        } else {
                            throw new Error('Failed to delete the task.');
                        }
                    }).catch(function(error) {
                        Swal.fire({
                            title: 'Error',
                            text: error.message || 'Failed to delete the task.',
                            icon: 'error',
                        });
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleted',
                        text: 'The task has been deleted.',
                        icon: 'success',
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
        });


    });

    /*------------------------------------------
    --------------------------------------------
    Create Task
    --------------------------------------------
    --------------------------------------------*/
    function saveTask(e) {
        e.preventDefault();

        $('#saveBtn').html('Sending..');
        let form = new FormData(e.target);
        var task_id = $("#task_id").val();
        var url = '{{ route("tasks.store") }}';
        var method = "POST";

        if (task_id) {
            url = "{{ route('tasks.update' , ':id') }}";
            url = url.replace(':id', task_id);
            method = "POST";
            form.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            type: method,
            data: form,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#taskForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();

                Swal.fire({
                    title: 'Success',
                    text: response.message,
                    icon: 'success',
                });

                $('#saveBtn').html('Save Changes');
            },
            error: function(data) {
                $('#saveBtn').html('Save Changes');
                var errors = data.responseJSON.errors;
                var message = errors[Object.keys(errors)[0]];
                message = message[0];

                Swal.fire({
                    title: 'Error',
                    text: message,
                    icon: 'error',
                });

                $('#saveBtn').html('Save Changes');
            }
        });
    }
</script>
@endpush