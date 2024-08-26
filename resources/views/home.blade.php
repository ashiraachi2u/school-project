<!DOCTYPE html>
<html>

<head>
    <title>Student List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Include CSS for DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- Include Bootstrap CSS for styling the modal -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Student Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>Student List</h2>
        <button class="btn btn-primary my-3" data-toggle="modal" data-target="#addModal">Add New Student</button>
        <table id="students-table" class="display">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>Admission Date</th>
                    <th>Yearly Fees</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- Add Student Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addForm">
                        <div class="form-group">
                            <label for="student_name">Student Name</label>
                            <input type="text" class="form-control" id="student_name" required>
                        </div>
                        <div class="form-group">
                            <label for="class">Class</label>
                            <input type="text" class="form-control" id="class" required>
                        </div>
                        <div class="form-group">
                            <label for="yearly_fees">Yearly Fees</label>
                            <input type="number" class="form-control" id="yearly_fees" required>
                        </div>
                        <div class="form-group">
                            <label for="admission_date">Admission Date</label>
                            <input type="date" class="form-control" id="admission_date" required>
                        </div>
                        <div class="form-group">
                            <label for="class_teacher_id">Teacher</label>
                            <select class="form-control" id="class_teacher_id" required></select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="student_id">
                        <div class="form-group">
                            <label>Student Name:</label>
                            <input type="text" id="edit_student_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Class:</label>
                            <input type="text" id="edit_class" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Teacher:</label>
                            <select id="edit_teacher_id" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label>Yearly Fees:</label>
                            <input type="number" id="edit_yearly_fees" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- Include Bootstrap JS for modal -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize DataTable
            var table = $('#students-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('students.data') }}',
                columns: [
                    { data: 'student_name', name: 'student_name' },
                    { data: 'class', name: 'class' },
                    { data: 'teacher.name', name: 'teacher.name' },
                    { data: 'admission_date', name: 'admission_date' },
                    { data: 'yearly_fees', name: 'yearly_fees' },
                    {
                        data: null,
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `
                                <button class="btn btn-sm btn-primary edit-btn" data-id="${row.id}">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
                            `;
                        }
                    }
                ]
            });

            // Function to populate teacher dropdowns
            function populateTeacherDropdown() {
                $.ajax({
                    url: '{{ route('teachers.list') }}',
                    type: 'GET',
                    success: function (response) {
                        var $teacherSelect = $('#class_teacher_id, #edit_teacher_id');
                        $teacherSelect.empty();
                        $.each(response.teachers, function (index, teacher) {
                            $teacherSelect.append(
                                '<option value="' + teacher.id + '">' + teacher.name + '</option>'
                            );
                        });
                    },
                    error: function () {
                        alert('Failed to retrieve teachers.');
                    }
                });
            }

            // Call this function on document ready
            populateTeacherDropdown();

            // Open Edit Modal and populate with data
            $(document).on('click', '.edit-btn', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: '/students/' + id + '/edit',
                    type: 'GET',
                    success: function (response) {
                        if (response.error) {
                            alert(response.error);
                            return;
                        }

                        // Populate form fields
                        $('#student_id').val(response.student.id);
                        $('#edit_student_name').val(response.student.student_name);
                        $('#edit_class').val(response.student.class);
                        $('#edit_yearly_fees').val(response.student.yearly_fees);

                        // Select the current teacher
                        $('#edit_teacher_id').val(response.student.class_teacher_id);

                        $('#editModal').modal('show');
                    },
                    error: function () {
                        alert('Failed to retrieve student data.');
                    }
                });
            });

            // Handle Edit Form submission
            $('#editForm').submit(function (e) {
                e.preventDefault();
                var id = $('#student_id').val();
                var formData = {
                    student_name: $('#edit_student_name').val(),
                    class: $('#edit_class').val(),
                    yearly_fees: $('#edit_yearly_fees').val(),
                    class_teacher_id: $('#edit_teacher_id').val(),
                };

                $.ajax({
                    url: '/students/' + id,
                    type: 'PUT',
                    data: formData,
                    success: function (response) {
                        table.ajax.reload();
                        $('#editModal').modal('hide');
                    },
                    error: function () {
                        alert('Failed to update student data.');
                    }
                });
            });

            // Handle Delete button click
            $(document).on('click', '.delete-btn', function () {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this student?')) {
                    $.ajax({
                        url: '/students/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                table.ajax.reload();
                            } else {
                                alert('Failed to delete student.');
                            }
                        },
                        error: function () {
                            alert('Failed to delete student.');
                        }
                    });
                }
            });


            // Handle Add Form submission
            $('#addForm').submit(function (e) {
                e.preventDefault();
                var formData = {
                    student_name: $('#student_name').val(),
                    class: $('#class').val(),
                    yearly_fees: $('#yearly_fees').val(),
                    admission_date: $('#admission_date').val(),
                    class_teacher_id: $('#class_teacher_id').val(),
                };

                $.ajax({
                    url: '{{ route('students.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        table.ajax.reload();
                        $('#addModal').modal('hide');
                        $('#addForm')[0].reset(); // Clear the form
                    },
                    error: function () {
                        alert('Failed to add student.');
                    }
                });
            });
        });
    </script>
</body>

</html>