

<?php $__env->startSection('content'); ?>
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="<?php echo e(route('password.email')); ?>">
        <?php echo csrf_field(); ?>

        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong><?php echo e(__('Forgot Password')); ?></strong></h4>
          </div>
          <div class="card-body">
            <?php if(session('status')): ?>
              <div class="row">
                <div class="col-sm-12">
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span><?php echo e(session('status')); ?></span>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <div class="bmd-form-group<?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="<?php echo e(__('Email...')); ?>" value="<?php echo e(old('email')); ?>" required>
              </div>
              <?php if($errors->has('email')): ?>
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong><?php echo e($errors->first('email')); ?></strong>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg"><?php echo e(__('Send Password Reset Link')); ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'email', 'title' => __('Material Dashboard')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>