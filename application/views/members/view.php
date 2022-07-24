<div class="container">
    <br>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h3>Crud Operation</h3>
            </div>
        </div>
    </div>

    <br>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <div class="d-flex flex-row mb-3">
                    <h4>Members Table</h4>
                </div>

            </div>
            <div class="col">

                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Member+
                    </button>
                </div>
            </div>
        </div>

        <br>

        <table id="Table_ID" class="table border">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $row) {
                ?>
                    <tr>
                        <td><?= $row->firstName ?></td>
                        <td><?= $row->lastName ?></td>
                        <td>
                            <button type="button" data-firstname="<?= $row->firstName ?>" data-lastname="<?= $row->lastName ?>" value="<?= $row->id ?>" class="edit btn btn-success">Edit</button>
                            <button type="button" value="<?= $row->id ?>" class="delete btn btn-danger">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <!-- modal for adding-->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a member</h5>

                </div>
                <form id="addMember" action="" method="Post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first" id="firstName" placeholder="First Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last" id="lastName" placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="addMemberSub btn btn-primary" />
                        <button type="button" class="addMemberClose  btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal for adding-->

    <!-- modal for editing-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit a member</h5>
                </div>
                <form id="editMember" action="" method="Post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" value='' class="form-control" name="firstname" id="editfirstName" placeholder="First Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" value='' class="form-control" name="lastname" id="editlastName" placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="editMemberSub btn btn-primary" />
                        <button type="button" class="editMemberClose  btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal for editing-->



    <script>
        var editId = -1;

        $(document).ready(function() {
            $('#Table_ID').DataTable({
                "columnDefs": [{
                    "targets": [2],
                    "orderable": false,
                    "searching": false,
                }]
            });

            $(".delete").click(function(e) {
                var id = $(this).val();
                $.ajax({
                    url: "/delete/" + id,
                    type: 'DELETE', // replaced from put

                    success: function(response) {
                        console.log(response); // see the reponse sent
                        window.location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        // do something here because of error
                    }
                });
            });


            $("#addMember").submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this); // grab the form value

                $.ajax({
                    type: "POST", // send post request to make file or dir
                    url: "/addMember",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        // return response;
                        window.location.reload();
                    },
                })
            });



            $(".edit").click(function(e) {
                editId = $(this).val();
                var firstname = $(this).data("firstname");
                var lastname = $(this).data("lastname");
                $("#editfirstName").val(firstname);
                $("#editlastName").val(lastname);
                $('#editModal').modal('show');
            });


            $("#editMember").submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this); // grab the form value

                $.ajax({
                    type: "POST", // send post request to make file or dir
                    url: "/editMember/" + editId,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        // return response;
                        window.location.reload();
                    },
                })
            });
        });
    </script>