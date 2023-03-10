<!DOCTYPE html>
<html>
  <head>
    <title>User Registration Form</title>
    <link rel="stylesheet" href="../CSS/main.css">
  </head>
  <body>
    <div class="login-box">
        <h1>User Registration Form</h1>
        <form>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>

          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>

          <label for="confirm_password">Confirm Password:</label>
          <input type="password" id="confirm_password" name="confirm_password" required>

          <label for="photo">Profile Photo:</label>
          <input type="file" id="photo" name="photo" accept="image/*" required>

          <label for="photo">Aadhar card Photo:</label>
          <input type="file" id="aadharphoto" name="aadharphoto" accept="image/*" required>

          <input type="submit"></input>
        </form>
    </div>
  </body>
</html>
