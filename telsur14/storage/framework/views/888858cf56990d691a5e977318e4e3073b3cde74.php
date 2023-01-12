
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo e(route('cable.detallecable.store', $cable->id)); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Guardar Datos del Cable <?php echo e($cable->sitio->abreviacion); ?> <?php echo e($cable->nombre_cable); ?></h4>
                            <p class="card-category">Ingresar datos del Cable <?php echo e($cable->sitio->abreviacion); ?> <?php echo e($cable->nombre_cable); ?></p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="filamento" class="col-sm-2 col-form-label">Filamento</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="filamento" placeholder="Número del filamento" value="<?php echo e(old('filamento')); ?>" required oninvalid="this.setCustomValidity('Ingrese numero del filamento')" oninput="this.setCustomValidity('')"/>
                                    <?php if($errors->has('filamento')): ?>
                                        <span c lass="error text-danger" for="input-filamento"><?php echo e($errors -> first('filamento')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="Dirección del filamento" value="<?php echo e(old('direccion')); ?>" required oninvalid="this.setCustomValidity('Ingrese direccion del filamento')" oninput="this.setCustomValidity('')"/>
                                    <?php if($errors->has('direccion')): ?>
                                        <span class="error text-danger" for="input-direccion"><?php echo e($errors -> first('direccion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="servicio" class="col-sm-2 col-form-label">Servicios</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="servicio" placeholder="Servicios" value="<?php echo e(old('servicio')); ?>">
                                    <?php if($errors->has('servicio')): ?>
                                        <span class="error text-danger" for="input-servicio"><?php echo e($errors -> first('servicio')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="longitud" class="col-sm-2 col-form-label">Longitud filamento</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="longitud" placeholder="Longitud en Metros (ej: 8000, 5000, 200)" value="<?php echo e(old('longitud')); ?>">
                                    <?php if($errors->has('longitud')): ?>
                                        <span class="error text-danger" for="input-longitud"><?php echo e($errors -> first('longitud')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="cruzada" class="col-sm-2 col-form-label">Cruzada</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="cruzada" placeholder="Cruzada" value="<?php echo e(old('cruzada')); ?>">
                                    <?php if($errors->has('cruzada')): ?>
                                        <span class="error text-danger" for="input-cruzada"><?php echo e($errors -> first('cruzada')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="observaciones" rows="3" placeholder="Observaciones" value="<?php echo e(old('observaciones')); ?>"></textarea>
                                    <?php if($errors->has('observaciones')): ?>
                                        <span class="error text-danger" for="input-observaciones"><?php echo e($errors -> first('observaciones')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="gmaps" class="col-sm-2 col-form-label">Link GMaps</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="gmaps" placeholder="Link Ubicación en GMaps (opcional)" value="<?php echo e(old('gmaps')); ?>">
                                    <?php if($errors->has('gmaps')): ?>
                                        <span class="error text-danger" for="input-gmaps"><?php echo e($errors -> first('gmaps')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_estado" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control sitios" data-style="btn btn-link" id="sitios" name="id_estado">
                                        <?php $__currentLoopData = $estado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $est): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($est->id); ?>"><?php echo e($est->estado); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
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

<?php echo $__env->make('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Detalles del Cable'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/cabledetalles/create.blade.php ENDPATH**/ ?>