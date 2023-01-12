

<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php echo e(route('profile.update')); ?>" autocomplete="off" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title"><?php echo e(__('Editar Perfil')); ?></h4>
                <p class="card-category"><?php echo e(__('Información del usuario')); ?></p>
              </div>
              <div class="card-body ">
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
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Nombre')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" id="input-name" type="text" placeholder="<?php echo e(__('Name')); ?>" value="<?php echo e(old('name', auth()->user()->name)); ?>" required="true" aria-required="true"/>
                      <?php if($errors->has('name')): ?>
                        <span id="name-error" class="error text-danger" for="input-name"><?php echo e($errors->first('name')); ?></span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Correo')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" id="input-email" type="email" placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e(old('email', auth()->user()->email)); ?>" required />
                      <?php if($errors->has('email')): ?>
                        <span id="email-error" class="error text-danger" for="input-email"><?php echo e($errors->first('email')); ?></span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary"><?php echo e(__('Guardar')); ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php echo e(route('profile.password')); ?>" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title"><?php echo e(__('Cambiar Contraseña')); ?></h4>
                <p class="card-category"><?php echo e(__('Contraseña')); ?></p>
              </div>
              <div class="card-body ">
                <?php if(session('status_password')): ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span><?php echo e(session('status_password')); ?></span>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-current-password"><?php echo e(__('Contraseña Actual')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('old_password') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('old_password') ? ' is-invalid' : ''); ?>" input type="password" name="old_password" id="input-current-password" placeholder="<?php echo e(__('Contraseña Actual')); ?>" value="" required />
                      <?php if($errors->has('old_password')): ?>
                        <span id="name-error" class="error text-danger" for="input-name"><?php echo e($errors->first('old_password')); ?></span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password"><?php echo e(__('Nueva Contraseña')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('password') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" id="input-password" type="password" placeholder="<?php echo e(__('Nueva Contraseña')); ?>" value="" required />
                      <?php if($errors->has('password')): ?>
                        <span id="password-error" class="error text-danger" for="input-password"><?php echo e($errors->first('password')); ?></span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation"><?php echo e(__('Confirmar Nueva Contraseña')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="<?php echo e(__('Confirmar Nueva Contraseña')); ?>" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary"><?php echo e(__('Guardar Cambio')); ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'profile', 'titlePage' => __('User Profile')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/profile/edit.blade.php ENDPATH**/ ?>