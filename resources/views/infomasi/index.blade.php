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
    <form id="infoForm">
        <label for="body">Body:</label>
        <input type="text" id="body" name="body" required><br><br>

        <label for="fb">Facebook:</label>
        <input type="text" id="fb" name="fb"><br><br>

        <label for="ig">Instagram:</label>
        <input type="text" id="ig" name="ig"><br><br>

        <label for="telegram">Telegram:</label>
        <input type="text" id="telegram" name="telegram"><br><br>

        <label for="tiktok">TikTok:</label>
        <input type="text" id="tiktok" name="tiktok"><br><br>

        <label for="wa">WhatsApp:</label>
        <input type="text" id="wa" name="wa"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Submit</button>
    </form>
    <h2>Data Table</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Body</th>
                <th>Facebook</th>
                <th>Instagram</th>
                <th>Telegram</th>
                <th>TikTok</th>
                <th>WhatsApp</th>
                <th>Email</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->body }}</td>
                    <td>{{ $item->fb }}</td>
                    <td>{{ $item->ig }}</td>
                    <td>{{ $item->telegram }}</td>
                    <td>{{ $item->tiktok }}</td>
                    <td>{{ $item->wa }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <a href="/informasi/{{ $item->id }}/edit"> edit</a>
                        <form id="deleteForm">
                            <input type="hidden" id="id" name="id" required value="{{ $item->id }}"><br><br>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#infoForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/api/informasi',
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

        $(document).ready(function() {
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();

                const id = $('#id').val();

                $.ajax({
                    url: `/api/informasi/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Laravel CSRF token
                    },
                    success: function(response) {
                        alert('Item deleted successfully!');
                        console.log(response);
                    },
                    error: function(xhr) {
                        alert('An error occurred!');
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    </script>
</body>

</html>
