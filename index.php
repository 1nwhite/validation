<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Document</title>
</head>
<body class="h-100">
    <main class="main bg-light h-100" role="main">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 col-md-9 col-lg-6 m-auto align-items-center">
                    <div class="form-wrapper">
                        <div class="form-header">
                            <h1 class="text-center mb-3">SIGNUP TO BITCOIN EVOLUTION</h1>
                        </div>
                        <form action="" method="POST" class="form">
                            <div class="form-fullname d-flex justify-content-between">
                                <div class="input-row w-100">
                                    <input class="first-name" type="text" name="first_name" placeholder="First Name" required>
                                    <p class="text-error text-white bg-danger" id="errorFirstName"></p>
                                </div>
                                <div class="input-row w-100">
                                    <input class="last-name" type="text" name="last_name" placeholder="Last Name" required>
                                    <p class="text-error text-white bg-danger" id="errorLastName"></p>
                                </div>
                            </div>
                            <div class="input-row">
                                <input class="email" type="email" name="email" placeholder="Email" required>
                                <p class="text-error text-white bg-danger" id="errorEmail"></p>
                            </div>
                            <div class="input-row">
                                <input class="password" type="password" name="password" placeholder="Password" required>
                                <p class="text-error text-white bg-danger" id="errorPassword"></p>
                            </div>
                            <div class="input-row mb-3">
                                <input class="phone" type="phone" name="phone" placeholder="Phone" required>
                                <p class="text-error text-white bg-danger" id="errorPhone"></p>
                            </div>
                            <div class="input-row mb-3">
                                <div class="checkbox">
                                    <label>
                                        <input class="terms" class="pointer" type="checkbox" name="terms">
                                        <span class="text-white">I agree to the Terms & Conditions</span>
                                        <p class="text-error text-white bg-danger" id="errorTerms"></p>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="pointer" type="checkbox" name="newslatter">
                                        <span class="text-white">Join our mailing list and receive emails with resources. You can Unsubscribe at any point in the future. To learn more please see our Privacy Policy</span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success form-submit text-uppercase font-weight-bold">Get started now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="module" src="js/main.js"></script>
</body>
</html>