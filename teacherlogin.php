
<!DOCTYPE html>
<html lang-en>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="css/teacherlogin.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container-fluid mb-5">
            <h1 class="heading-1">Welcome Educator! 
            </h1>
            <div class="login" id="login" name="login">
                <div class="label-text">Please log in to your account</div>
                <form id="login-form" method="POST" action="teachervalidate.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">EmailID<span class="required">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>
                    <div class="mb-3">
                    <label for="password" class="form-label">Password<span class="required">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login </button><br><br>
                </form>         
            </div>
        </div>
    </body>
   
</html>