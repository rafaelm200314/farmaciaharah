<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['employee_id'])) {
    // Redirect to login page
    header('Location: login.php');
    exit;
}

// Get employee name from session
$employee_name = $_SESSION['employee_name'];

// Database connection details
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "pharmasee";

// Establish database connection
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch employee data
if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];
    $sql = "SELECT employee_id, employee_name, contact_number, address, email, password FROM employee_table WHERE employee_id = $employee_id";
} else {
    $sql = "SELECT employee_id, employee_name, contact_number, address, email, password FROM employee_table";
}

// Execute SQL query
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Pages/assets/css/table.css">
    <link rel="stylesheet" href="assets/css/Nunito.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="inventory.php">
                    <div class="sidebar-brand-icon rotate-n-15"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bandaid">
                            <path d="M14.121 1.879a3 3 0 0 0-4.242 0L8.733 3.026l4.261 4.26 1.127-1.165a3 3 0 0 0 0-4.242ZM12.293 8 8.027 3.734 3.738 8.031 8 12.293zm-5.006 4.994L3.03 8.737 1.879 9.88a3 3 0 0 0 4.241 4.24l.006-.006 1.16-1.121ZM2.679 7.676l6.492-6.504a4 4 0 0 1 5.66 5.653l-1.477 1.529-5.006 5.006-1.523 1.472a4 4 0 0 1-5.653-5.66l.001-.002 1.505-1.492.001-.002Z"></path>
                            <path d="M5.56 7.646a.5.5 0 1 1-.706.708.5.5 0 0 1 .707-.708Zm1.415-1.414a.5.5 0 1 1-.707.707.5.5 0 0 1 .707-.707M8.39 4.818a.5.5 0 1 1-.708.707.5.5 0 0 1 .707-.707Zm0 5.657a.5.5 0 1 1-.708.707.5.5 0 0 1 .707-.707ZM9.803 9.06a.5.5 0 1 1-.707.708.5.5 0 0 1 .707-.707Zm1.414-1.414a.5.5 0 1 1-.706.708.5.5 0 0 1 .707-.708ZM6.975 9.06a.5.5 0 1 1-.707.708.5.5 0 0 1 .707-.707ZM8.39 7.646a.5.5 0 1 1-.708.708.5.5 0 0 1 .707-.708Zm1.413-1.414a.5.5 0 1 1-.707.707.5.5 0 0 1 .707-.707"></path>
                        </svg></div>
                    <div class="sidebar-brand-text mx-3"><span>Pharmasee</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="medicinetable.php"><i class="fas fa-table"></i><span>Medicine Stock</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="suppliertable.php"><i class="fas fa-table"></i><span>Suppliers</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="employeetable.php"><i class="fas fa-table"></i><span>Employees</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="inventory.php"><i class="fas fa-window-maximize"></i><span>Inventory</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="medform.php"><i class="fas fa-tachometer-alt"></i><span>Medicine Form</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="supplierform.php"><i class="fas fa-tachometer-alt"></i><span>Supplier Form</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>


        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow mx-1"></li>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo htmlspecialchars($employee_name); ?></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"> <a class="dropdown-item" href="updateprofile.php"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Update Profile</a> <a class="dropdown-item" href="changepass.php"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Change Pass</a><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="table" id="customers_table">
                                    <section class="table__header">
                                        <h2 class="text-primary m-0 fw-bold">Employees</h2>
                                        <div class="input-group">

                                            <input type="search" placeholder="Search Data...">
                                        </div>
                                </div>
                            </div>

                            </section>

                            <div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID<span class="icon-arrow">&UpArrow;</span></th>
                                        <th>Name<span class="icon-arrow">&UpArrow;</span></th>
                                        <th>Number<span class="icon-arrow">&UpArrow;</span></th>
                                        <th>Address<span class="icon-arrow">&UpArrow;</span></th>
                                        <th>Email<span class="icon-arrow">&UpArrow;</span></th>
                                        <th>Password<span class="icon-arrow">&UpArrow;</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Check if there are rows in the result
                                    if ($result->num_rows > 0) {
                                        // Loop through each row of the result
                                        while ($row = $result->fetch_assoc()) {
                                            // Output table data for each employee
                                            echo "<tr>";
                                            echo "<td data-label='ID'>" . $row["employee_id"] . "</td>";
                                            echo "<td data-label='Name'>" . $row["employee_name"] . "</td>";
                                            echo "<td data-label='Number'>" . $row["contact_number"] . "</td>";
                                            echo "<td data-label='Address'>" . $row["address"] . "</td>";
                                            echo "<td data-label='Email'>" . $row["email"] . "</td>";
                                            // Display only the first character of the password
                                            echo "<td data-label='Password'><div class='password-circle'>" . substr($row["password"], 0, 1) . "</div></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // If no employees found, display a message in a single row with colspan 6
                                        echo "<tr><td colspan='6'>No employees found</td></tr>";
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                </section>

                </main>
                <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
                <script src="assets/js/bootstrap.min.js"></script>
                <script src="../Pages/assets/js/employee_crud.js" defer></script>
                <script src="../Pages/assets/js/script.js" defer></script>
                <script src="assets/js/bs-init.js"></script>
                <script src="assets/js/bold-and-bright.js"></script>
                <script src="assets/js/theme.js"></script>
</body>

</html>