<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
    <div class="container mt-4">

        <div class="d-flex justify-content-between mb-4">
            <h2>Test</h2>
            <div>
                <?php if ($is_admin): ?>
                <a href="<?php echo site_url('user/register'); ?>" class="btn btn-primary mr-2">Register New Employee</a>
                <?php endif; ?>
            </div>

            <div>
                <a href="<?php echo base_url('user/logout'); ?>" class="btn btn-danger" onclick="logout();">Logout</a>
            </div>
        </div>

        <p class="mb-4">
            <a href="<?php echo site_url('employee/create'); ?>" class="btn btn-primary">Add Employee</a>
        </p>

        <h3 class="mb-3">Search Employees</h3>

        <form id="search-form">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="query">Name/Surname:</label>
                    <input type="text" id="query" name="query" class="form-control" placeholder="Name surname..." />
                </div>

                <div class="form-group col-md-4">
                    <label for="min_salary">Min Salary:</label>
                    <input type="number" id="min_salary" name="min_salary" class="form-control" step="0.01" placeholder="Minimum salary" />
                </div>

                <div class="form-group col-md-4">
                    <label for="max_salary">Max Salary:</label>
                    <input type="number" id="max_salary" name="max_salary" class="form-control" step="0.01" placeholder="Maximum salary" />
                </div>
            </div>

            <div class="form-group">
                <label for="position">Position:</label>
                <select id="position" name="position" class="form-control">
                    <option value="">All Positions</option>
                    <?php foreach ($positions as $pos): ?>
                        <option value="<?php echo $pos['position']; ?>">
                            <?php echo $pos['position']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <table class="table table-striped table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Position</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody id="employee-table-body">
                <?php if (!empty($employees)): ?>
                    <?php foreach ($employees as $index => $employee): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
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

    <script src="<?php echo base_url('assets/js/employeeindex.js'); ?>"></script>

</body>
</html>
