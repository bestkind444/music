<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f0f0f0, #e4e4e4);
      font-family: Arial, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 15px;
    }

    .login-box {
      width: 100%;
      max-width: 400px;
      padding: 25px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    h3 {
      font-weight: 600;
      margin-bottom: 20px;
    }

    @media (max-width: 480px) {
      .login-box {
        padding: 20px;
        border-radius: 8px;
      }

      h3 {
        font-size: 1.25rem;
      }
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h3 class="text-center">Admin Login</h3>

    <form id="form">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required autofocus>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <button class="btn btn-primary w-100">Sign In</button>
    </form>
  </div>
</body>




 <script>
                    function sweatAlert(icon, title, text) {
                        Swal.fire({
                            icon: icon,
                            title: title,
                            text: text
                        })

                    }

                    const form = document.getElementById("form");
                    form.addEventListener("submit", async (e) => {
                        e.preventDefault();
                        try {
                            const formData = new FormData(e.target);
                            const response = await fetch("api/authentication/login.php", {
                                method: 'POST',
                                body: formData

                            })

                            if (!response.ok) {
                                throw new Error(response.statusText);
                            }

                            const data = await response.json();
                            if (data.status === "success") {
                                sweatAlert("Tips", "success", data.message);
                            } else {
                                sweatAlert("Tips", "error", data.message);
                            }
                            setTimeout(() => {
                                window.location.href = "./dashboard/";
                            }, 1500);


                        } catch (error) {
                            console.log(error);
                            sweatAlert("Tips", "error", error.message)
                        }


                    })
                </script>
                 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>