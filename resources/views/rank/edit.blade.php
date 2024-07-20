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

        <label for="game">game:</label>
        {{-- <input type="text" id="body" name="body" value="{{ $data->body }}" required><br><br> --}}
        <select name="game_id" id="game_id">
            @foreach ($games as $game)
                <option value="{{ $game->id }}" {{ $game->id == $data->game_id ? 'selected' : '' }}>
                    {{ $game->name }}</option>
            @endforeach
        </select>

        <label for="name">nama:</label>
        <input type="text" id="name" name="name" value="{{ $data->name }}"><br><br>

        <label for="harga">harga:</label>
        <input type="text" id="harga" name="harga" value="{{ $data->harga }}"><br><br>

        <button type="submit">Submit</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#infoForm').on('submit', function(e) {
                e.preventDefault();

                const id = $('#id').val(); // Get the ID from the hidden input

                $.ajax({
                    url: `/api/rank/${id}`, // Use the correct URL format
                    type: 'PUT', // HTTP method for update
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Form updated successfully!');
                        console.log(response);
                        window.location.href = '/rank'; // Redirect after successful update
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
