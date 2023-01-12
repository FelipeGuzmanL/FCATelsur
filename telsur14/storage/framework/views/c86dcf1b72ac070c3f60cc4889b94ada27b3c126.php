
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo e(route('cable.update', $cable->id)); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Cable <?php echo e($cable->nombre_cable); ?></h4>
                            <p class="card-category">Actualizar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row card-header card-header-warning">
                                <div>
                                    <h4>AVISO: Si cambia la cantidad de filamentos, los detalles del cable que se hayan guardado se perderán.</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="nombre_cable" class="col-sm-2 col-form-label">Nombre Cable</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre_cable" placeholder="Nombre cable" value="<?php echo e(old('nombre_cable', $cable->nombre_cable)); ?>" required oninvalid="this.setCustomValidity('Ingrese Nombre del Cable')" oninput="this.setCustomValidity('')"/>
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
                                            <option value="<?php echo e($sitio->id); ?>" <?php echo e($sitio->id == $cable->sitio->id ? 'selected' : ''); ?>><?php echo e($sitio->nombre); ?> - <?php echo e($sitio->abreviacion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                            <label for="cant_filam" class="col-sm-2 col-form-label">Cantidad Filamentos</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="cant_filam" placeholder="Cantidad" value="<?php echo e(old('cant_filam', $cable->cant_filam)); ?>">
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
                                            <option value="<?php echo e($tipo->id); ?>" <?php echo e($tipo->id == $cable->tipocable->id ? 'selected' : ''); ?>><?php echo e($tipo->tipo); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="descripcion" rows="3" placeholder="Ingrese nombre descripcion"><?php echo e(old('descripcion', $cable->descripcion)); ?></textarea>
                                    <?php if($errors->has('descripcion')): ?>
                                        <span class="error text-danger" for="input-descripcion"><?php echo e($errors -> first('descripcion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Guardar')); ?></button>
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
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Actualizar Cable'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/cable/edit.blade.php ENDPATH**/ ?>