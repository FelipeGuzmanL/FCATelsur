
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo e(route('sitios.update', $sitio->id)); ?>" method="post" class="form-horizontal">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Sitio <?php echo e($sitio->nombre); ?> - <?php echo e($sitio->abreviacion); ?></h4>
                            <p class="card-category">Actualizar datos</p>
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
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre Sitio" value="<?php echo e(old('nombre', $sitio->nombre)); ?>" autofocus required oninvalid="this.setCustomValidity('Ingrese Nombre del Sitio')" oninput="this.setCustomValidity('')"/>
                                    <?php if($errors->has('nombre')): ?>
                                        <span class="error text-danger" for="input-nombre"><?php echo e($errors -> first('nombre')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="abreviacion" class="col-sm-2 col-form-label">Nemotécnico</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="abreviacion" placeholder="Ingrese Nemotécnico" value="<?php echo e(old('abreviacion', $sitio->abreviacion)); ?>" required oninvalid="this.setCustomValidity('Ingrese nemotécnico')" oninput="this.setCustomValidity('')"/>
                                    <?php if($errors->has('abreviacion')): ?>
                                        <span class="error text-danger" for="input-abreviacion"><?php echo e($errors -> first('abreviacion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="Ingrese Nemotécnico" value="<?php echo e(old('direccion', $sitio->direccion)); ?>" required oninvalid="this.setCustomValidity('Ingrese nemotécnico')" oninput="this.setCustomValidity('')"/>
                                    <?php if($errors->has('direccion')): ?>
                                        <span class="error text-danger" for="input-direccion"><?php echo e($errors -> first('direccion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="descripcion" rows="3" placeholder="Ingrese nombre descripcion"><?php echo e(old('descrpcion', $sitio->descripcion)); ?></textarea>
                                    <?php if($errors->has('descripcion')): ?>
                                        <span class="error text-danger" for="input-descripcion"><?php echo e($errors -> first('descripcion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="url" class="col-sm-2 col-form-label">Link GMaps</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="url" placeholder="Link Ubicación (opcional)" value="<?php echo e(old('url', $sitio->url)); ?>">
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

<?php echo $__env->make('layouts.app', ['activePage' => 'sitios', 'titlePage' => 'Actualizar Sitio'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/sitios/edit.blade.php ENDPATH**/ ?>