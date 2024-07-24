<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Table</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Submit Information</h2>
    <form id="game">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <button type="submit">Submit</button>
    </form>
    <h2>Data Table</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="/game/{{ $item->id }}/edit"> edit</a>
                        <a data-id="{{ $item->id }}" class="btn btn-danger btn-hapus">hapus</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#game').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/api/game',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Form submitted successfully!');
                        console.log(response);
                    },
                    error: function(xhr) {
                        alert('An error occurred!');
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        $(document).on('click', '.btn-hapus', function() {
            const id = $(this).data('id')
            const token = localStorage.getItem('token')

            confirm_dialog = confirm('Apakah anda yakin?');

            if (confirm_dialog) {
                $.ajax({
                    url: '/api/game/' + id,
                    type: "DELETE",
                    headers: {
                        "Authorization": 'Bearer ' + token
                    },
                    success: function(response) {
                        alert('Form submitted successfully!');
                        console.log(response);
                    },
                });
            }
        });
    </script>
</body>

</html>
