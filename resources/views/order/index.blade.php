<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Table Order</title>
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
        <label for="user">user</label>
        <select name="user_id" id="user">
            <option value="" selected>Select user</option>
            @foreach ($user as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select><br><br>

        <label for="game">Game</label>
        <select name="game_id" id="game">
            <option value="" selected>Select Game</option>
            @foreach ($game as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select><br><br>

        <label for="rank">Rank</label>
        <select name="rank_id" id="rank">
            <option value="" selected>Select rank</option>
            @foreach ($rank as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select><br><br>

        <label for="paket">paket</label>
        <select name="paket_id" id="paket">
            <option value="" selected>Select paket</option>
            @foreach ($paket as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select><br><br>

        <label for="rank_awal">rank_awal:</label>
        <input type="text" id="rank_awal" name="rank_awal" required><br><br>

        <label for="rank_tujuan">rank_tujuan:</label>
        <input type="text" id="rank_tujuan" name="rank_tujuan"><br><br>

        <label for="bintang">bintang:</label>
        <input type="text" id="bintang" name="bintang"><br><br>

        <label for="catatan">catatan:</label>
        <input type="text" id="catatan" name="catatan"><br><br>

        <label for="req_hero">req_hero:</label>
        <input type="text" id="req_hero" name="req_hero"><br><br>

        <label for="password">password:</label>
        <input type="text" id="password" name="password"><br><br>

        <label for="methode_login">methode_login:</label>
        <input type="text" id="methode_login" name="methode_login"><br><br>

        <label for="email">email:</label>
        <input type="text" id="email" name="email"><br><br>

        <label for="no_wa">no_wa:</label>
        <input type="text" id="no_wa" name="no_wa"><br><br>

        <button type="submit">Submit</button>
    </form>
    <h2>Data Table</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>user</th>
                <th>game</th>
                <th>rank</th>
                <th>paket</th>
                <th>rank_awal</th>
                <th>rank_tujuan</th>
                <th>bintang</th>
                <th>catatan</th>
                <th>req_hero</th>
                <th>password</th>
                <th>methode_login</th>
                <th>email</th>
                <th>no_wa</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->game->name }}</td>
                    <td>{{ $item->rank->name }}</td>
                    <td>{{ $item->paket->name }}</td>
                    <td>{{ $item->rank_awal }}</td>
                    <td>{{ $item->rank_tujuan }}</td>
                    <td>{{ $item->bintang }}</td>
                    <td>{{ $item->catatan }}</td>
                    <td>{{ $item->req_hero }}</td>
                    <td>{{ $item->password }}</td>
                    <td>{{ $item->methode_login }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_wa }}</td>
                    <td>
                        <a href="/order/{{ $item->id }}/edit"> edit</a>
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
                    url: '/api/order',
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
                    url: `/api/order/${id}`,
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
