<?php if ($register): ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Register</h2>
        <div id="message"></div>

        <form id="registerForm">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="mail">Email:</label>
                <input type="email" id="mail" name="mail" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" class="form-control">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <script>
    $(document).ready(function() {
        $('#registerForm').on('submit', function(event) {
            event.preventDefault();

            var email = $('#mail').val();
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                $('#message').html('<div class="alert alert-danger">Invalid email format</div>');
                return;
            }

            var formData = $(this).serialize();

            $.ajax({
                url: '<?php echo site_url('user/register_process'); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    var alertType = response.status === 'success' ? 'success' : 'danger';
                    var messageHtml = '<div class="alert alert-' + alertType + '">' + response.message + '</div>';
                    $('#message').html(messageHtml);

                    if (response.status === 'success') {
                        setTimeout(function() {
                            window.location.href = '<?php echo site_url('user/login'); ?>';
                        }, 2000);
                    }
                },
                error: function() {
                    $('#message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                }
            });
        });
    });

    </script>
</body>
</html>

<?php else: ?>
    <h3>xetaaa</h3>
<?php endif; ?>
