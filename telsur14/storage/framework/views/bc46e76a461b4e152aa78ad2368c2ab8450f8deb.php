

<?php $__env->startSection('content'); ?>
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>

        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong><?php echo e(__('Register')); ?></strong></h4>
            <!--div class="social-line">
              <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                <i class="fa fa-facebook-square"></i>
              </a>
              <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                <i class="fa fa-twitter"></i>
              </a>
              <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                <i class="fa fa-google-plus"></i>
              </a>
            </div-->
          </div>
          <div class="card-body ">
            <div class="bmd-form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="text" name="name" class="form-control" placeholder="<?php echo e(__('Nombre...')); ?>" value="<?php echo e(old('name')); ?>" required>
              </div>
              <?php if($errors->has('name')): ?>
                <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                  <strong><?php echo e($errors->first('name')); ?></strong>
                </div>
              <?php endif; ?>
            </div>
            <div class="bmd-form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?> mt-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">face</i>
                    </span>
                  </div>
                  <input type="text" name="rut" class="form-control" placeholder="<?php echo e(__('Rut...')); ?>" value="<?php echo e(old('rut')); ?>" required>
                </div>
                <?php if($errors->has('rut')): ?>
                  <div id="rut-error" class="error text-danger pl-3" for="rut" style="display: block;">
                    <strong><?php echo e($errors->first('rut')); ?></strong>
                  </div>
                <?php endif; ?>
              </div>
            <div class="bmd-form-group<?php echo e($errors->has('email') ? ' has-danger' : ''); ?> mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="<?php echo e(__('Correo...')); ?>" value="<?php echo e(old('email')); ?>" required>
              </div>
              <?php if($errors->has('email')): ?>
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong><?php echo e($errors->first('email')); ?></strong>
                </div>
              <?php endif; ?>
            </div>
            <div class="bmd-form-group<?php echo e($errors->has('password') ? ' has-danger' : ''); ?> mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo e(__('Contraseña...')); ?>" required>
              </div>
              <?php if($errors->has('password')): ?>
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong><?php echo e($errors->first('password')); ?></strong>
                </div>
              <?php endif; ?>
            </div>
            <div class="bmd-form-group<?php echo e($errors->has('password_confirmation') ? ' has-danger' : ''); ?> mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="<?php echo e(__('Confirmar Contraseña...')); ?>" required>
              </div>
              <?php if($errors->has('password_confirmation')): ?>
                <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                  <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                </div>
              <?php endif; ?>
            </div>
            <!--div class="form-check mr-auto ml-3 mt-3">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="policy" name="policy" <?php echo e(old('policy', 1) ? 'checked' : ''); ?> >
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
                <?php echo e(__('I agree with the ')); ?> <a href="#"><?php echo e(__('Privacy Policy')); ?></a>
              </label>
            </div>
          </div-->
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg"><?php echo e(__('Crear Cuenta')); ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Material Dashboard')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/auth/register.blade.php ENDPATH**/ ?>