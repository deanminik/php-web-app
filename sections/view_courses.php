<?php include("../templates/header.php"); ?>
<?php include("../sections/courses.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <div class="row">
                <div class="col-md-5">
                    <form action="" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h1>Courses</h1>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">

                                    <label for="" class="form-label">ID</label>
                                    <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                                </div>
                                <div class="mb-3">
                                    <label for="course_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="course_name" id="course_name" aria-describedby="helpId" placeholder="Name of the course">
                                </div>
                                <div class="btn-group" role="group" aria-label="">
                                    <button type="submit" name="action" value="add" class="btn btn-success">Add</button>
                                    <button type="submit" name="action" value="edit" class="btn btn-warning">Edit</button>
                                    <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-7">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($coursesList as $course) { ?>
                                <tr>
                                    <td><?php echo $course['id']; ?></td>
                                    <td><?php echo $course['course_name']; ?></td>
                                    <td>Select</td>
                                </tr>
                                <tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("../templates/footer.php"); ?>