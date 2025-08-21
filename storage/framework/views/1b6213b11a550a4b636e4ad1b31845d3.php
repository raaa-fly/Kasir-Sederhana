<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Your App</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(115deg, #1f2c4c, #2a60c3);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    body::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle at center, rgba(255,255,255,0.03), transparent 70%);
      animation: moveBackground 20s linear infinite;
    }

    @keyframes moveBackground {
      from {
        transform: rotate(0deg);
      }
      to {
        transform: rotate(360deg);
      }
    }

    .login-container {
      z-index: 1;
      background-color: rgba(255, 255, 255, 0.95);
      padding: 2.5rem;
      border-radius: 18px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
      animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 2rem;
      color: #1f2c4c;
    }

    .form-group {
      position: relative;
      margin-bottom: 1.8rem;
    }

    .form-group input {
      width: 100%;
      padding: 1rem 1rem 0.5rem;
      border: none;
      border-bottom: 2px solid #ccc;
      background: transparent;
      font-size: 1rem;
      outline: none;
      transition: all 0.3s ease;
    }

    .form-group label {
      position: absolute;
      top: 1rem;
      left: 1rem;
      font-size: 1rem;
      color: #666;
      pointer-events: none;
      transition: 0.3s ease;
    }

    .form-group input:focus {
      border-color: #2a60c3;
    }

    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label {
      top: -0.5rem;
      left: 0.8rem;
      font-size: 0.8rem;
      color: #2a60c3;
      background: #fff;
      padding: 0 0.25rem;
    }

    button {
      width: 100%;
      padding: 0.9rem;
      border: none;
      border-radius: 10px;
      background: linear-gradient(to right, #2a60c3, #3d9be9);
      color: white;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(50, 115, 220, 0.4);
      transition: all 0.3s ease;
    }

    button:hover {
      background: linear-gradient(to right, #3d9be9, #2a60c3);
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(50, 115, 220, 0.6);
    }

    .error,
    .status {
      text-align: center;
      font-size: 0.9rem;
      margin-bottom: 1.2rem;
    }

    .error {
      color: #e74c3c;
    }

    .status {
      color: #27ae60;
    }

    @media (max-width: 480px) {
      .login-container {
        padding: 2rem;
        border-radius: 12px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>

    <?php if(session('status')): ?>
      <div class="status"><?php echo e(session('status')); ?></div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
      <div class="error"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login.post')); ?>">
      <?php echo csrf_field(); ?>

      <div class="form-group">
        <input type="email" name="email" id="email" placeholder=" " value="<?php echo e(old('email')); ?>" required autofocus />
        <label for="email">Email</label>
      </div>

      <div class="form-group">
        <input type="password" name="password" id="password" placeholder=" " required />
        <label for="password">Password</label>
      </div>

      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\kasir_19032\resources\views/login.blade.php ENDPATH**/ ?>