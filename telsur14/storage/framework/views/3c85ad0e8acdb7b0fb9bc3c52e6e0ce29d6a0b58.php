
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo e(route('equiposmsan.store')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Guardar MSAN</h4>
                            <p class="card-category">Ingresar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                            <label for="numero" class="col-sm-2 col-form-label">Numero MSAN</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="numero" placeholder="Numero MSAN" value="<?php echo e(old('numero')); ?>" autofocus required oninvalid="this.setCustomValidity('Ingrese numero del MSAN')" oninput="this.setCustomValidity('')"/>
                                    <?php if($errors->has('numero')): ?>
                                        <span class="error text-danger" for="input-numero"><?php echo e($errors -> first('numero')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_tecnologia" class="col-sm-2 col-form-label">Tecnología</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1" name="id_tecnologia" required oninvalid="this.setCustomValidity('Seleccione tecnología')" oninput="this.setCustomValidity('')"/>
                                            <option disabled selected value="">Seleccione Tecnología</option>
                                        <?php $__currentLoopData = $tecnologias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tecnologia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tecnologia->id); ?>" ><?php echo e($tecnologia->nombre_tec); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_slotec" class="col-sm-2 col-form-label">Slots de Tecnología</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1" name="id_slotec" required oninvalid="this.setCustomValidity('Seleccione tecnología')" oninput="this.setCustomValidity('')"/>
                                            <option disabled selected value="">Seleccione Tecnología</option>
                                        <?php $__currentLoopData = $slotstec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slotec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($slotec->id); ?>" ><?php echo e($slotec->slots); ?> - <?php echo e($slotec->tecnologia->nombre_tec); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_ubicacion" class="col-sm-2 col-form-label">Sitio</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control micoso" data-style="btn btn-link" id="micoso" name="id_ubicacion">
                                        <?php $__currentLoopData = $sitio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sitio->id); ?>"><?php echo e($sitio->nombre); ?> - <?php echo e($sitio->abreviacion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="Ingrese dirección" value="<?php echo e(old('direccion')); ?>">
                                    <?php if($errors->has('direccion')): ?>
                                        <span class="error text-danger" for="input-direccion"><?php echo e($errors -> first('direccion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="link_gmaps" class="col-sm-2 col-form-label">Link GMaps</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="link_gmaps" placeholder="Link a Google Maps" value="<?php echo e(old('link_gmaps')); ?>">
                                    <?php if($errors->has('link_gmaps')): ?>
                                        <span class="error text-danger" for="input-link_gmaps"><?php echo e($errors -> first('link_gmaps')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="sitio_fca" class="col-sm-2 col-form-label">Sitio FCA</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitio_fca" placeholder="Ingrese Sitio FCA" value="<?php echo e(old('sitio_fca')); ?>">
                                    <?php if($errors->has('sitio_fca')): ?>
                                        <span class="error text-danger" for="input-sitio_fca"><?php echo e($errors -> first('sitio_fca')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="descripcion_sitio" class="col-sm-2 col-form-label">Descripcion Sitio FCA</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="descripcion_sitio" placeholder="Descripción" value="<?php echo e(old('descripcion_sitio')); ?>">
                                    <?php if($errors->has('descripcion_sitio')): ?>
                                        <span class="error text-danger" for="input-descripcion_sitio"><?php echo e($errors -> first('descripcion_sitio')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Guardar')); ?></button>
                        </div>
                    </div>
                </form>
                <script>
                    $("#micoso").select2({
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
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Guardar Equipo MSAN'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/equiposmsan/create.blade.php ENDPATH**/ ?>