<?php
session_start();

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION['employee_id'])) {
    header('Location: login.php');
    exit;
}

// Retrieve user information from session variables
$employee_name = $_SESSION['employee_name'];
$contact_number = $_SESSION['contact_number'];
$address = $_SESSION['address'];
$email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Nunito.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="../Pages/assets/css/table.css">
    <script src="../Pages/assets/js/update_profile.js" defer></script>
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
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"> <a class="dropdown-item" href="updateprofile.php"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Update Profile</a> <a class="dropdown-item" href="changepass.php"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Change Pass</a> <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>


                <main class="page hire-me-page">
                    <section class="portfolio-block hire-me">
                        <div class="container">
                            <div class="heading">
                                <h2 style="margin: 15px;">Update Profile</h2>
                                <!-- Edit Form -->
                                <form id="editForm" action="updateprof.php" method="post" class="border rounded border-0 shadow-lg p-3 p-md-5" data-bs-theme="light">
                                    <div class="mb-3">
                                        <label for="editEmployeeName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="editEmployeeName" name="employeeName" value="<?php echo htmlspecialchars($_SESSION['employee_name']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmployeeContact" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="editEmployeeContact" name="employeeContact" value="<?php echo htmlspecialchars($_SESSION['contact_number']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmployeeAddress" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="editEmployeeAddress" name="employeeAddress" value="<?php echo htmlspecialchars($_SESSION['address']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6 col-xl-12 offset-xl-0 button">
                                                <button class="btn btn-primary d-block w-100" type="submit">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </div>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>