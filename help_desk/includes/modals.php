    <!-- Submit Ticket Modal -->
<div class="modal fade" id="add_ticket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="raise_ticket_modal_title">Raise Ticket</h5>
                    <button type="button" id="close_edit_modal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row mt-3 d-flex" id="ticket_form" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="ticket_code" name="ticket_code">
                        <div class="mb-3 row">
                            <label for="ticket_type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-7">
                                <select name="ticket_type" id="ticket_type" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                    <?php foreach ($ticket_type as $row): ?>
                                        <option id="<?=str_replace(" ", "_", $row["type_description"])?>"><?=$row["type_description"]?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-10">
                                <input type="text" name="title" id="title" class="form-control form-control-sm" placeholder="Whats is the complain about?">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Message</label>
                            <div class="col-10">
                                <textarea class="form-control form-control-sm" name="description" id="description" rows="3" placeholder="Description of the complain"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="problem_category" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-7">
                                <select name="problem_category" id="problem_category" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                    <?php foreach ($problem_categories as $row): ?>
                                        <option id="<?=str_replace(" ", "_", $row["category_description"])?>"><?=$row["category_description"]?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="ticket_priority" class="col-sm-2 col-form-label">Priority</label>
                            <div class="col-7">
                                <select name="ticket_priority" id="ticket_priority" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                    <?php foreach ($ticket_priorities as $row): ?>
                                        <option id="<?=str_replace(" ", "_", $row["priority_description"])?>"><?=$row["priority_description"]?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div id="attachment_area"  class="text-center">
                            <input name="ticket_file" id="ticket_file" type="file" hidden>
                            <span>Add relivant attachements</span>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" id="add_file_btn" class="btn btn-link btn-sm px-5 add_file_btn" style="text-decoration: none;"><i class="far fa-paperclip"></i>&ensp;Add Files</button>
                            </div>
                        </div>
                        <div class="mb-2 container">
                            <div class="uploaded_file" id="progress_container" style="display:none;">
                                <span><i class="fas fa-file-alt"></i>&ensp; <name id="progress_file_name"></name></span>
                                <span id="progress_bar_parcentage">0%</span>
                            </div>
                            <div class="progress_bar" id="progress_bar"></div>
                        </div>
                        <div class="container uploaded_files_container">
                            
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="d-flex justify-content-center">
                            <button type="button" name="submit_ticket_btn" id="submit_ticket_btn" class="btn btn-success btn-sm px-5"><i class="far fa-paper-plane">&ensp;</i>Send</button>
                        </div>
                    </div>
                    </form>
            </div>
    </div>
</div>
   
   <!-- Delete Ticket Modal -->
<div class="modal fade" id="delete_ticket_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Ticket</h5>
                    <button type="button" id="delete_modal_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row mt-3 d-flex" id="delete_ticket_form" name="delete_form" method="post">
                        <input type="hidden" id="delete_ticket_input" name="ticket_code">
                    </form>
                    <h4 id="delete_ticket_code" class="text-center"></h4>
                    <h5 class="text-center">Are you sure want to delete this ticket?</h5>
                </div>
                    
                <div class="modal-footer">
                    <div class="d-flex justify-content-center">
                        <button type="button" name="delete_ticket" id="delete_ticket" class="btn btn-danger btn-sm px-5" onclick="delete_()"><i class="far fa-trash-alt">&ensp;</i>Delete</button>
                    </div>
                </div>
            </div>
    </div>
</div>
   
   <!-- close Ticket Modal -->
<div class="modal fade" id="close_ticket_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Close Ticket</h5>
                    <button id="close_modal_close" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 id="close_ticket_code" class="text-center"></h4>
                    <h5 class="text-center">Are you sure want to Close this ticket?</h5>
                </div>
                    
                <div class="modal-footer">
                    <div class="d-flex justify-content-center">
                        <button type="button" name="delete_ticket" id="delete_ticket" class="btn btn-info btn-sm px-3" onclick="close_()"><i class="fas fa-times">&ensp;</i> Close</button>
                    </div>
                </div>
            </div>
    </div>
</div>
   
   <!-- View Ticket Modal -->
<div class="modal fade" id="view_ticket_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 id="view_ticket_code" class="text-center"></h4>
                    <h5 class="text-center">Details here<h5>
                </div>
                    
                <div class="modal-footer">
                    <div class="d-flex justify-content-center">
                        <button type="button" name="delete_ticket" id="delete_ticket" class="btn btn-light btn-sm px-5" onclick="view_()"><i class="fas fa-times">&ensp;</i> Cancel</button>
                    </div>
                </div>
            </div>
    </div>
</div>
   
   <!-- Assign Ticket Modal -->
<div class="modal fade" id="assign_ticket_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Ticket</h5>
                    <button type="button" id="assign_modal_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row mt-3 d-flex" id="assign_ticket_form" name="delete_form" method="post">
                        <input type="hidden" id="assign_ticket_input" name="ticket_code">
                    </form>
                    <h4 id="assign_ticket_code" class="text-center"></h4>
                    <h5 class="text-center"> Assign to:</h5>
                    <div class="d-flex justify-content-center">
                        <form class="col-8 mt-2" id="login-form" method="post">
                            <div class="mb-2">
                                <label for="username" class="form-label">Department</label>
                                <select name="select_department" id="select_department" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                    <option value=""></option>
                                    <?php foreach ($departments as $row): ?>
                                        <option value="<?=$row["id"]?>"><?=$row["department_name"]?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="password" class="form-label">Assignee</label>
                                <select name="select_assignee" id="select_assignee" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" id="submit" name="submit" class="btn btn-success col-6" hidden>Login</button> 
                            </div>
                        </form>
                    </div>
                </div>
                    
                <div class="modal-footer">
                    <div class="d-flex justify-content-center">
                        <button type="button" name="assign_ticket" id="assign_ticket" class="btn btn-primary btn-sm px-5" onclick="assign()"><i class="far fa-share-square">&ensp;</i>Assign</button>
                    </div>
                </div>
            </div>
    </div>
</div>
       
       
    <!-- Add User Modal -->
<div class="modal fade" id="add_student" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" id="add_user_modal_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="registration_form" id="registration_form" class="row mt-3" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control form-control-sm" required>
                            <div class="invalid-feedback">
                                Username alresdy exist.
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-sm" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-sm" required>
                                <div class="invalid-feedback">
                                    Psssword does not match.
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" style="text-transform: capitalize;" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="surname" class="form-label">Surname</label>
                            <input type="text" name="surname" id="surname" class="form-control form-control-sm" style="text-transform: capitalize;" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="other_name" class="form-label">Other Name</label>
                            <input type="text" name="other_name" id="other_name" class="form-control form-control-sm" style="text-transform: capitalize;" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select form-select-sm">
                                    <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control form-control-sm" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="mb-3 img-upload-container">
                            <div class="img-upload">
                                <input type="file" name="inf-img" id="inf-img" hidden required>
                                <img class="img" src="../imgs/avatar.jpeg" alt="Passport" id="passport">
                                <div class="camera"><i class="fas fa-camera"></i></div>
                                <div class="" id="progress"></div>
                                <div id="progress-bar"></div>
                            </div>
                            <div id="img-error"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit_form" id="submit_form" class="btn btn-sm btn-success">Register</button>
            </div>
        </div>
    </div>
</div>
            
    <!-- Add Admin Modal -->
<div class="modal fade" id="add_admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
                <button type="button" id="submit_admin_close_btn" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form name="admin_registration_form" id="admin_registration_form" class="row mt-3" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="admin_username" class="form-label">Username</label>
                            <input type="text" name="admin_username" id="admin_username" class="form-control form-control-sm" required>
                            <div class="invalid-feedback">
                                Username alresdy exist.
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="admin_password" class="form-label">Password</label>
                                <input type="password" name="admin_password" id="admin_password" class="form-control form-control-sm" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="admin_confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="admin_confirm_password" id="admin_confirm_password" class="form-control form-control-sm" required>
                                <div class="invalid-feedback">
                                    Psssword does not match.
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="admin_first_name" class="form-label">First Name</label>
                            <input type="text" name="admin_first_name" id="admin_first_name" class="form-control form-control-sm" style="text-transform: capitalize;" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="admin_surname" class="form-label">Surname</label>
                            <input type="text" name="admin_surname" id="admin_surname" class="form-control form-control-sm" style="text-transform: capitalize;" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="admin_other_name" class="form-label">Other Name</label>
                            <input type="text" name="admin_other_name" id="admin_other_name" class="form-control form-control-sm" style="text-transform: capitalize;" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="admin_gender" class="form-label">Gender</label>
                            <select name="admin_gender" id="admin_gender" class="form-select form-select-sm">
                                    <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="admin_phone_number" class="form-label">Phone Number</label>
                            <input type="text" name="admin_phone_number" id="admin_phone_number" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="admin_email" class="form-label">Department</label>
                            <select name="admin_select_department" id="admin_select_department" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                <option value=""></option>
                                <?php foreach ($departments as $row): ?>
                                    <option value="<?=$row["id"]?>"><?=$row["department_name"]?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="admin_address" class="form-label">Role</label>
                            <select name="admin_select_role" id="admin_select_role" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                <option value=""></option>
                                <?php foreach ($roles as $row): ?>
                                    <option value="<?=$row["id"]?>"><?=$row["role_name"]?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" name="submit_admin_form" id="submit_admin_form" onclick="" class="btn btn-sm btn-success">Submit</button>
            </div>
        </div>
    </div>
</div>

    <!-- Support Modal -->
 <div class="modal fade" id="support_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="support_modal_title" class="modal-title"></h5>
                    <button id="support_modal_close" type="button" id="support_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="support_modal_body" class="modal-body">
                    
                </div>
                    
                <div class="modal-footer">
                    <div class="d-flex justify-content-center">
                        <button type="button" name="assign_ticket" id="support_model_ticket_btn" class="btn btn-sm px-5" onclick="open_()"><i class="far fa-folder-open">&ensp;</i> Opent</button>
                    </div>
                </div>
            </div>
    </div>
</div>

    <!-- System Users Modal -->
<div class="modal fade" id="users_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="users_modal_title" class="modal-title"></h5>
                <button id="users_modal_close" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="users_modal_body" class="modal-body">
            <h4 id="users_username" class="text-center"></h4>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center">
                    <button type="button" name="assign_ticket" id="users_modal_btn" class="btn btn-sm px-5"></button>
                </div>
            </div>
        </div>
    </div>
</div>