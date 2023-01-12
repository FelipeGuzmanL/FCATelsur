
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo e(route('sitios.store')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Guardar Sitio</h4>
                            <p class="card-category">Ingresar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre Sitio</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo e(old('nombre')); ?>" autofocus required oninvalid="this.setCustomValidity('Ingrese nombre del Sitio')" oninput="this.setCustomValidity('')"/>
                                    <?php if($errors->has('nombre')): ?>
                                        <span class="error text-danger" for="input-nombre"><?php echo e($errors -> first('nombre')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="abreviacion" class="col-sm-2 col-form-label">Abreviación</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="abreviacion" placeholder="Ingrese nombre abreviacion" value="<?php echo e(old('abreviacion')); ?>" required oninvalid="this.setCustomValidity('Ingrese nemotécnico')" oninput="this.setCustomValidity('')"/>
                                    <?php if($errors->has('abreviacion')): ?>
                                        <span class="error text-danger" for="input-abreviacion"><?php echo e($errors -> first('abreviacion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="Ingrese nombre direccion" value="<?php echo e(old('direccion')); ?>">
                                    <?php if($errors->has('direccion')): ?>
                                        <span class="error text-danger" for="input-direccion"><?php echo e($errors -> first('direccion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="descripcion" rows="3" placeholder="Ingrese nombre descripcion" value="<?php echo e(old('descripcion')); ?>"></textarea>
                                    <?php if($errors->has('descripcion')): ?>
                                        <span class="error text-danger" for="input-descripcion"><?php echo e($errors -> first('descripcion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="url" class="col-sm-2 col-form-label">Link GMaps</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="url" placeholder="Link Ubicación (opcional)" value="<?php echo e(old('url')); ?>">
                                    <?php if($errors->has('url')): ?>
                                        <span class="error text-danger" for="input-url"><?php echo e($errors -> first('url')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Guardar')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'sitios', 'titlePage' => 'Guardar Sitio'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/sitios/create.blade.php ENDPATH**/ ?>