<?php
include 'partiels/menu.php';
?>

        <!-- Main-->
        <div class = "main-content">
            <div class = "wrapper">
            <h1>Manage Admin</h1>
            <br/><br/><br/>
            
            <!---- BUTTON TO ADD ADMIN ---->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
             <!----END BUTTON TO ADD ADMIN ---->
            <br/><br/><br/>
            
            <table class ="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <tr>
                    <td>1.</td>
                    <td>Juan Manoel</td>
                    <td>juanmanoel</td>
                    <td>
                   n    <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>

                <tr>
                    <td>2.</td>
                    <td>Juan Manoel</td>
                    <td>juanmanoel</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>

                <tr>
                    <td>3.</td>
                    <td>Juan Manoel</td>
                    <td>juanmanoel</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
            </table>
     
            <div class="clearfixe"></div>
            </div>
        </div>
        <!--fin Main-->

<?php
include 'partiels/footer.php';
?>
  