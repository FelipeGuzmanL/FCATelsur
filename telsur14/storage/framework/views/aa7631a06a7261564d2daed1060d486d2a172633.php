
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo e(route('cable.store')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Guardar Cable</h4>
                            <p class="card-category">Ingresar datos de Cable</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="nombre_cable" class="col-sm-2 col-form-label">Nombre Cable</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre_cable" placeholder="Nombre cable" value="<?php echo e(old('nombre_cable')); ?>" required oninvalid="this.setCustomValidity('Ingrese Nombre del Cable')" oninput="this.setCustomValidity('')"/>
                                    <?php if($errors->has('nombre_cable')): ?>
                                        <span class="error text-danger" for="input-nombre_cable"><?php echo e($errors -> first('nombre_cable')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_sitio" class="col-sm-2 col-form-label">Sitio</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control sitios" data-style="btn btn-link" id="sitios" name="id_sitio">
                                        <?php $__currentLoopData = $sitio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sitio->id); ?>"><?php echo e($sitio->nombre); ?> - <?php echo e($sitio->abreviacion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                            <label for="cant_filam" class="col-sm-2 col-form-label">Cantidad Filamentos</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="cant_filam" placeholder="Cantidad" value="<?php echo e(old('cant_filam')); ?>">
                                    <?php if($errors->has('cant_filam')): ?>
                                        <span class="error text-danger" for="input-cant_filam"><?php echo e($errors -> first('cant_filam')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_tipo_cable" class="col-sm-2 col-form-label">Tipo de Cable</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control tipocables" data-style="btn btn-link" id="tipocables" name="id_tipo_cable">
                                        <?php $__currentLoopData = $tipocable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tipo->id); ?>"><?php echo e($tipo->tipo); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="descripcion" rows="3" placeholder="Ingrese descripcion del cable" value="<?php echo e(old('descripcion')); ?>"></textarea>
                                    <?php if($errors->has('descripcion')): ?>
                                        <span class="error text-danger" for="input-descripcion"><?php echo e($errors -> first('descripcion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Guardar')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
            <script>
                $("#sitios").select2({
                });
            </script>
            <script>
                $("#tipocables").select2({
                });
            </script>
            <style>
                .select2 {
                    width: 100% !important;
                }
            </style>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Guardar Cable'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/cable/create.blade.php ENDPATH**/ ?>