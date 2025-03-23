<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sign up</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap1.min.css">
    <!-- JavaScript for password visibility -->
    <script src="../Pages/assets/js/pass.js" defer></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Pages/assets/css/signup.css">
</head>

<body>
     <!-- Navigation -->
    <nav class="navbar navbar-expand-md sticky-top navbar-shrink py-3 navbar-light" id="mainNav">
            <!-- Navbar content -->   
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="index.php"><span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bandaid-fill">
                        <path d="m2.68 7.676 6.49-6.504a4 4 0 0 1 5.66 5.653l-1.477 1.529-5.006 5.006-1.523 1.472a4 4 0 0 1-5.653-5.66l.001-.002 1.505-1.492.001-.002Zm5.71-2.858a.5.5 0 1 0-.708.707.5.5 0 0 0 .707-.707ZM6.974 6.939a.5.5 0 1 0-.707-.707.5.5 0 0 0 .707.707M5.56 8.354a.5.5 0 1 0-.707-.708.5.5 0 0 0 .707.708m2.828 2.828a.5.5 0 1 0-.707-.707.5.5 0 0 0 .707.707m1.414-2.121a.5.5 0 1 0-.707.707.5.5 0 0 0 .707-.707m1.414-.707a.5.5 0 1 0-.706-.708.5.5 0 0 0 .707.708Zm-4.242.707a.5.5 0 1 0-.707.707.5.5 0 0 0 .707-.707m1.414-.707a.5.5 0 1 0-.707-.708.5.5 0 0 0 .707.708m1.414-2.122a.5.5 0 1 0-.707.707.5.5 0 0 0 .707-.707M8.646 3.354l4 4 .708-.708-4-4zm-1.292 9.292-4-4-.708.708 4 4 .708-.708"></path>
                    </svg></span><span data-bs-toggle="tooltip" data-bss-tooltip="">Pharmasee</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto"></ul><a class="btn btn-primary shadow" role="button" href="login.php">Log in</a>
            </div>
        </div>
    </nav>
        <!-- End Navigation -->
    <!-- Signup Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-4 mb-lg-5">
                <!-- Signup Heading -->
                <div class="col-md-8 col-xl-6 offset-xl-4 text-center mx-auto" style="height: 107.3906px;width: 575px;">
                    <p class="fw-bold text-success mb-2" style="width: 601px;">Sign up</p>
                    <h2 class="fw-bold" style="width: 601px;">Welcome</h2>
                </div>
            </div>
              <!-- Signup Form -->
            <div class="row d-flex justify-content-center" style="margin: -58px;">
                <div class="col-md-6 col-xl-4" style="width: 532.656px;">
                    <form class="border rounded border-0 shadow-lg p-3 p-md-5" data-bs-theme="light" style="width: 564px;" onsubmit="addEmplo(event)" method="POST">
                       <!-- Name -->
                       <div class="mb-3">
                            <label class="form-label" for="employeeName">Name</label>
                            <input class="form-control" type="text" id="employeeName" name="employeeName" required>
                        </div>

                        <!-- Contact -->
                        <div class="mb-3">
                            <label class="form-label" for="employeeContact">Contact</label>
                            <input class="form-control" type="text" id="employeeContact" name="employeeContact" required>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label" for="employeeAddress">Address</label>
                            <input class="form-control" type="text" id="employeeAddress" name="employeeAddress" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label" for="employeeEmail">Email</label>
                            <input class="form-control" type="email" id="employeeEmail" name="employeeEmail" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3 password-container">
                            <label class="form-label" for="employeePassword">Password</label>
                            <div class="input-with-icon">
                                <input class="form-control" type="password" id="employeePassword" name="employeePassword" required minlength="8">
                                <i class="fas fa-eye toggle-password"></i>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-3">
                            <button class="btn btn-primary d-block w-100" type="submit">Add Employee</button>
                        </div>

                        <!-- Login Link -->
                        <div class="col offset-xl-3">
                            <p class="text-muted">Already have an account? <a href="login.php">Log in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Signup Section -->

    <!-- Bootstrap JavaScript -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="../Pages/assets/js/employee_crud.js" defer></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>

</html>