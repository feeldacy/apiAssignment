<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body{
            padding: 15px;
        }
    </style>
    <title>Document</title>
</head>
<body>

    <table class="table table-bordered border-black" id="datatable">
        <thead class="table-primary">
            <tr class="text-center">
                <th>Students Name</th>
                <th>Students Number</th>
                <th>Students Major</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            const API_URL = 'http://127.0.0.1:8000/api/student';

            $.ajax({
                url: API_URL,
                method: 'GET',
                success: function (response) {
                    console.log(response);

                    const students = response.data.data || response;

                    const table = $('#datatable tbody');
                    table.empty();

                    students.forEach(student => {
                        table.append(`
                            <tr class="text-center">
                                <td>${student.student_name}</td>
                                <td>${student.student_number}</td>
                                <td>${student.student_major}</td>
                            </tr>
                        `);
                    });

                    $('#datatable').DataTable(); // Inisialisasi DataTables
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>
</body>
</html>
