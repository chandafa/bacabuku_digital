<?php // index.php

/*
* genelify.com
*/

// Read and display customer data to the front-end
include 'database_conn.php';

$query = "SELECT * FROM users limit 200";
$result = mysqli_query($db_connect, $query); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Simple CRUD Using PHP, MySQL and Bootstrap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php include 'message.php'; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="float-left mb-4">
                    <h2>List Pengguna</h2>
                </div>
                <div class="float-right">
                    <a href="add.php" class="btn btn-success">Tambah Pengguna</a>
                </div>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama Pengguna</th>
                            <th scope="col">Email</th>

                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fetch customer data with associative array -->
                        <?php if ($result->num_rows > 0) : ?>
                        <?php while ($customer_data = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <th scope="row"><?php echo $customer_data['id']; ?></th>
                            <td><?php echo $customer_data['username']; ?></td>
                            <td><?php echo $customer_data['name']; ?></td>
                            <td><?php echo $customer_data['email']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $customer_data['id']; ?>"
                                    class="btn btn-primary">Edit</a>
                                <a href="delete.php?id=<?php echo $customer_data['id']; ?>"
                                    class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="3" rowspan="1" headers="">No data found!</td>
                        </tr>
                        <?php endif; ?>
                        <?php mysqli_free_result($result); ?>
                    </tbody>
                </table>
                <a href="../index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>