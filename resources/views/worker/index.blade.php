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
        <label for="game">Game</label> 
        <select name="game_id" id="game">
            <option value="" selected>Select Game</option>
            @foreach ($game as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select><br><br>
        <label for="name">name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="no_wa">no_wa:</label>
        <input type="number" id="no_wa" name="no_wa"><br><br>
        <label for="email">email:</label>
        <input type="email" id="email" name="email"><br><br>

        <button type="submit">Submit</button>
    </form>
    <h2>Data Table</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>game</th>
                <th>name</th>
                <th>wa</th>
                <th>email</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->game->name }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->no_wa }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <a href="/worker/{{ $item->id }}/edit"> edit</a>
                        <form id="deleteForm">
                            <input type="hidden" id="id" name="id" required
                                value="{{ $item->id }}"><br><br>
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
                    url: '/api/worker',
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
                    url: `/api/worker/${id}`,
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
