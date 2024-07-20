<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Update Game</h2>
    <form id="game">
        <input type="hidden" id="id" name="id" value="{{ $data->id }}"> <!-- Hidden input to hold the ID -->
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $data->name }}" required><br><br>

        <button type="submit">Submit</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#game').on('submit', function(e) {
                e.preventDefault();

                const id = $('#id').val(); // Get the ID from the hidden input

                $.ajax({
                    url: `/api/game/${id}`, // Use the correct URL format
                    type: 'PUT', // HTTP method for update
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Form updated successfully!');
                        console.log(response);
                        window.location.href = '/game'; // Redirect after successful update
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