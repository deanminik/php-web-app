<?php include("../templates/header.php"); ?>
<?php include("../sections/students.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <div class="row">
                <div class="col-md-5">
                    <form action="" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h1>Students</h1>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">

                                    <label for="" class="form-label">ID</label>
                                    <input type="text" class="form-control" name="id" value="" id="id" aria-describedby="helpId" placeholder="ID">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="" id="name" aria-describedby="helpId" placeholder="Name of the student">
                                </div>
                                <div class="mb-3">
                                    <label for="Lastname" class="form-label">Lastname</label>
                                    <input type="text" class="form-control" name="Lastname" value="" id="Lastname" aria-describedby="helpId" placeholder="Lastname of the student">
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Courses</label>
                                    <select multiple class="form-control" name="courses[]" id="coursesList">
                                        <option>Select an option</option>
                                        <?php foreach($courses as $course) { ?>
                                        <option value="<?php echo $course['id'];?>"><?php echo $course['id'];?><?php echo $course['course_name'];?></option>
                                       
                                        <?php }?>
                                    </select>
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
                            <?php foreach ($students as $student) { ?>
                                <tr>
                                    <td><?php echo $student['id']; ?></td>
                                    <td>
                                        <?php echo $student['name']; ?>
                                        <?php echo $student['Lastname']; ?>
                                        <br/>
                                        <span><b>Courses List</b></span><br/>
                                        <!-- <?php print_r($student["courses"]) ?> -->
                                        <?php
                                        foreach ($student["courses"] as $course) {
                                            echo '<a href="#">'.$course['course_name']. '</a><br>';
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" id="id" value="<?php echo $student['id']; ?>" />
                                            <input type="hidden" name="name" id="name" value="<?php echo $student['name']; ?>" />
                                            <input type="submit" name="action" value="Select" class="btn btn-info">
                                        </form>
                                    </td>
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