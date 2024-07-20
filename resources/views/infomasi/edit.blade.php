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
        <input type="hidden" id="id" name="id" value="{{ $data->id }}"> <!-- Hidden input to hold the ID -->
        
        <label for="body">Body:</label>
        <input type="text" id="body" name="body" value="{{ $data->body }}" required><br><br>

        <label for="fb">Facebook:</label>
        <input type="text" id="fb" name="fb"  value="{{ $data->fb }}"><br><br>

        <label for="ig">Instagram:</label>
        <input type="text" id="ig" name="ig"  value="{{ $data->ig }}"><br><br>

        <label for="telegram">Telegram:</label>
        <input type="text" id="telegram" name="telegram" value="{{ $data->telegram }}"><br><br>

        <label for="tiktok">TikTok:</label>
        <input type="text" id="tiktok" name="tiktok" value="{{ $data->tiktok }}"><br><br>

        <label for="wa">WhatsApp:</label>
        <input type="text" id="wa" name="wa" value="{{ $data->wa }}"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $data->email }}" required><br><br>

        <button type="submit">Submit</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#infoForm').on('submit', function(e) {
                e.preventDefault();

                const id = $('#id').val(); // Get the ID from the hidden input

                $.ajax({
                    url: `/api/informasi/${id}`, // Use the correct URL format
                    type: 'PUT', // HTTP method for update
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Form updated successfully!');
                        console.log(response);
                        window.location.href = '/informasi'; // Redirect after successful update
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
