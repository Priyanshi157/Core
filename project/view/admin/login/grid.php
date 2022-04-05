<div class="login- w-75 p-5 d-flex justify-content-center">
  <div class="card card-outline card-primary d-flex justify-content-center">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b></a>
    </div>
    <div class="card-body">

		<form action="<?php echo $this->getUrl('loginPost','admin_login') ?>" method="post">
	        <div class="input-group mb-3">
	          <input type="email" name="admin[email]" class="form-control" placeholder="Email">
	          <div class="input-group-append">
	            <div class="input-group-text">
	              <span class="fas fa-envelope"></span>
	            </div>
	          </div>
	        </div>
	        <div class="input-group mb-3">
	          <input type="password" name="admin[password]" class="form-control" placeholder="Password">
	          <div class="input-group-append">
	            <div class="input-group-text">
	              <span class="fas fa-lock"></span>
	            </div>
	          </div>
	        </div>
	        <div class="row">
	          <div class="col-8">
	          </div>
	          <!-- /.col -->
	          <div class="col-4">
	            <input type="submit" class="btn btn-primary btn-block" value="Sign In">
	          </div>
	          <!-- /.col -->
	        </div>
      </form>

		<div class="social-auth-links text-center mt-2 mb-3">
	        <a href="" class="btn btn-block btn-primary">
	          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
	        </a>
	        <a href="" class="btn btn-block btn-danger">
	          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
	        </a>
	     </div>
	      <p class="mb-1">
        <a href="">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="" class="text-center">Register a new membership</a>
      </p>
	</div>
  </div>
</div>