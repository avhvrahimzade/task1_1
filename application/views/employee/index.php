<div class="container mt-4">
    <h2 class="mb-4">Employee</h2>

    <p class="mb-4">
        <a href="<?php echo site_url('employee/create'); ?>" class="btn btn-primary">Add Employee</a>
    </p>

    <h3 class="mb-3">Employee:</h3>

    <form id="search-form" method="get" action="<?php echo site_url('employee/search'); ?>">
        <div class="mt-3">
            <label for="query">Name/Surname:</label>
            <input type="text" id="query" name="query" placeholder="Name surname..." />
        </div>

        <div class="mt-3">
            <label for="min_salary">Min Salary:</label>
            <input type="number" id="min_salary" name="min_salary" step="0.01" placeholder="Minimum salary" />
        </div>

        <div class="mt-3">
            <label for="max_salary">Max Salary:</label>
            <input type="number" id="max_salary" name="max_salary" step="0.01" placeholder="Maximum salary" />
        </div>

        <div class="mt-3">
            <label for="position">Position:</label>
            <select id="position" name="position">
                <option value="">All Positions</option>
                <?php foreach ($positions as $pos): ?>
                    <option value="<?php echo $pos['position']; ?>">
                        <?php echo $pos['position']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Search</button>
    </form>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Position</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($employees)): ?>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo $employee['id']; ?></td>
                        <td><?php echo $employee['name']; ?></td>
                        <td><?php echo $employee['surname']; ?></td>
                        <td><?php echo $employee['position']; ?></td>
                        <td><?php echo $employee['salary']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No employees found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
