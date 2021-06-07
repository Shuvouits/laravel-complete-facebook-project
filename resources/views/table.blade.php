<html>

<head>
    <title>This is the Table Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class='container text-center'>
        <h3>Students Information Data</h3>
    </div>
    <br>
    <table class=' container table table-bordered table-striped table-hover text-center table-dark'>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>City</th>
            <th>Phone</th>
            <th>
                <span>Action</span>
                <span><button class='btn btn-warning' style="margin-left: 10px;" data-toggle="modal"
                        data-target="#myModal">Add Data</button></span>
            </th>
        </thead>
        <tbody>
            <?php

            foreach ($data as $item) {
                $ID = $item->ID;
                $Name = $item->Name;
                $Department = $item->Department;
                $City = $item->City;
                $Phone = $item->Phone;
                echo "

                <tr>
                   <td>$ID</td>
                   <td>$Name</td>
                   <td>$Department</td>
                   <td>$City</td>
                   <td>$Phone</td>
                   <td>
                      <span>
                        <a href='#' data-toggle='modal' data-target='#e$ID' class='btn btn-primary'>Edit</a>
                        <a href='/delete/$ID' class='btn btn-danger'>Delete</a>
                     </span>
                    </td>
                </tr>

                <div class='modal' id='e$ID'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>

                              <!-- Modal Header -->
                            <div class='modal-header'>
                                <h4 class='modal-title'>Modal Heading</h4>
                                 <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            </div>

                            <!-- Modal Header -->

                
                            <div class='modal-body'>
                                <form method='post' action='edit/$ID'>
                                ";
                                      echo csrf_field();
                                echo "
                                    <div class='form-group'>
                                        <label>Name</label>
                                        <input type='text' name='Name' value='$Name' class='form-control' placeholder='Enter Your Name' required>
                                    </div>
                                    <div class='form-group'>
                                        <label>Department</label>
                                        <input type='text' name='Department' value='$Department' class='form-control' placeholder='Enter Your Name' required>
                                    </div>
                                    <div class='form-group'>
                                        <label>City</label>
                                        <input type='text' name='City' value='$City' class='form-control' placeholder='Enter Your Name' required>
                                    </div>
                                    <div class='form-group'>
                                        <label>Phone</label>
                                        <input type='text' name='Phone' value='$Phone' class='form-control' placeholder='Enter Your Name' required>
                                    </div>
                                    <input type='submit' value='Submit' class='btn btn-warning'>
                                </form>
                            </div>

                            <!----Modal-footer-->
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                             </div>

                       </div>
                    </div>
                </div>
            
                
                ";
            }

            ?>

        </tbody>
    </table>

    <!-- The Add Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method='post' action='store'>
                        {{@csrf_field()}}
                        <div class='form-group'>
                            <label>ID</label>
                            <input type='text' name='ID' class='form-control' placeholder="Enter Your ID" required>
                        </div>
                        <div class='form-group'>
                            <label>Name</label>
                            <input type='text' name='Name' class='form-control' placeholder="Enter Your Name" required>
                        </div>
                        <div class='form-group'>
                            <label>Department</label>
                            <input type='text' name='Department' class='form-control'
                                placeholder="Enter Your Department" required>
                        </div>
                        <div class='form-group'>
                            <label>City</label>
                            <input type='text' name='City' class='form-control' placeholder="Enter Your City" required>
                        </div>
                        <div class='form-group'>
                            <label>Phone</label>
                            <input type='text' name='Phone' class='form-control' placeholder="Enter Your Phone"
                                required>
                        </div>
                        <input type='submit' class='btn btn-warning'>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>





</body>

</html>