<div class="container mt-4">

    <h2>employee</h2>

    <form action="<?php echo site_url('employee/create'); ?>" method="post">
        <div class="form-group">
            <label for="name">name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="name">surname:</label>
            <input type="text" id="surname" name="surname" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="name">position:</label>
            <input type="text" id="position" name="position" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary" class="form-control" min="0" step="any" required>
        </div>


        <button type="submit" class="btn btn-primary">add</button>
    </form>
    </div>
