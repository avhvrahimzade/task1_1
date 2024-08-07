<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    <?php if ($this->session->flashdata('error')): ?>
        <p style="color: red;">
            <?= $this->session->flashdata('error'); ?>
        </p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;">
            <?= $this->session->flashdata('success'); ?>
        </p>
    <?php endif; ?>

    <form action="<?= site_url('user/register_process'); ?>" method="post">
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?= set_value('username'); ?>" />
        </p>

        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" />
        </p>

        <p>
            <label for="role">Role:</label>
            <input type="text" name="role" id="role" />
        </p>

        <p>
            <input type="submit" value="Register" />
        </p>
    </form>
</body>
</html>
