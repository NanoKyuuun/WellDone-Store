<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h2>Update Information</h2>
    <form id="infoForm">
        <input type="hidden" id="id" name="id" value="{{ $data->id }}">
        <!-- Hidden input to hold the ID -->

        <label for="user">user:</label>
        {{-- <input type="text" id="body" name="body" value="{{ $data->body }}" required><br><br> --}}
        <select name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $data->user_id ? 'selected' : '' }}>
                    {{ $user->name }}</option>
            @endforeach
        </select>

        <label for="game">game:</label>
        {{-- <input type="text" id="body" name="body" value="{{ $data->body }}" required><br><br> --}}
        <select name="game_id" id="game_id">
            @foreach ($games as $game)
                <option value="{{ $game->id }}" {{ $game->id == $data->game_id ? 'selected' : '' }}>
                    {{ $game->name }}</option>
            @endforeach
        </select>

        <label for="rank">rank:</label>
        {{-- <input type="text" id="body" name="body" value="{{ $data->body }}" required><br><br> --}}
        <select name="rank_id" id="rank_id">
            @foreach ($ranks as $rank)
                <option value="{{ $rank->id }}" {{ $rank->id == $data->rank_id ? 'selected' : '' }}>
                    {{ $rank->name }}</option>
            @endforeach
        </select>

        <label for="paket">paket:</label>
        {{-- <input type="text" id="body" name="body" value="{{ $data->body }}" required><br><br> --}}
        <select name="paket_id" id="paket_id">
            @foreach ($pakets as $paket)
                <option value="{{ $paket->id }}" {{ $paket->id == $data->paket_id ? 'selected' : '' }}>
                    {{ $paket->name }}</option>
            @endforeach
        </select>

        <label for="rank_awal">rank_awal:</label>
        <input type="text" id="rank_awal" name="rank_awal" value="{{ $data->rank_awal }}"><br><br>

        <label for="rank_tujuan">rank_tujuan:</label>
        <input type="text" id="rank_tujuan" name="rank_tujuan" value="{{ $data->rank_tujuan }}"><br><br>

        <label for="bintang">bintang:</label>
        <input type="text" id="bintang" name="bintang" value="{{ $data->bintang }}"><br><br>

        <label for="catatan">catatan:</label>
        <input type="text" id="catatan" name="catatan" value="{{ $data->catatan }}"><br><br>

        <label for="req_hero">req_hero:</label>
        <input type="text" id="req_hero" name="req_hero" value="{{ $data->req_hero }}"><br><br>

        <label for="password">password:</label>
        <input type="text" id="password" name="password" value="{{ $data->password }}"><br><br>

        <label for="methode_login">methode_login:</label>
        <input type="text" id="methode_login" name="methode_login" value="{{ $data->methode_login }}"><br><br>

        <label for="email">email:</label>
        <input type="text" id="email" name="email" value="{{ $data->email }}"><br><br>

        <label for="no_wa">no_wa:</label>
        <input type="text" id="no_wa" name="no_wa" value="{{ $data->no_wa }}"><br><br>

        <button type="submit">Submit</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#infoForm').on('submit', function(e) {
                e.preventDefault();

                const id = $('#id').val(); // Get the ID from the hidden input

                $.ajax({
                    url: `/api/order/${id}`, // Use the correct URL format
                    type: 'PUT', // HTTP method for update
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Form updated successfully!');
                        console.log(response);
                        window.location.href = '/order'; // Redirect after successful update
                    },
                    error: function(xhr) {
                        alert('An error occurred!');
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
