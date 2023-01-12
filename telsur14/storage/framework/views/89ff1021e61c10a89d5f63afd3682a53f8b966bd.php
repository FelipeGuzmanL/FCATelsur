
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo e(route('equiposmsan.slots.olt.update', [$equipo,$slot,$olt])); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Slot <?php echo e($slot->slot_msan); ?> OLT: <?php echo e($olt->olt); ?></h4>
                            <p class="card-category">Actualizar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <!--div class="row">
                                <label for="olt" class="col-sm-2 col-form-label">OLT</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="olt" placeholder="Numero OLT" value="<?php echo e(old('olt', $olt->olt)); ?>" required oninvalid="this.setCustomValidity('Ingrese el numero OLT')" oninput="this.setCustomValidity('')">
                                    <?php if($errors->has('olt')): ?>
                                        <span class="error text-danger" for="input-olt"><?php echo e($errors -> first('olt')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div-->
                            <div class="row">
                                <label for="id_cable" class="col-sm-2 col-form-label">Cable</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control micoso" data-style="btn btn-link" id="micoso" name="id_cable">
                                        <?php $__currentLoopData = $cables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($cable->id == "1"): ?>
                                                <option value="<?php echo e($cable->id); ?>" <?php echo e($cable->id == $olt->cable->id ? 'selected' : ''); ?>><?php echo e($cable->nombre_cable); ?></option>
                                            <?php elseif($cable->id > "1"): ?>
                                                <option value="<?php echo e($cable->id); ?>" <?php echo e($cable->id == $olt->cable->id ? 'selected' : ''); ?>><?php echo e($cable->nombre_cable); ?> - <?php echo e($cable->sitio->abreviacion); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="filam" class="col-sm-2 col-form-label">Filam</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="filam" placeholder="Filamento" value="<?php echo e(old('filam', $olt->filam)); ?>">
                                    <?php if($errors->has('filam')): ?>
                                        <span class="error text-danger" for="input-filam"><?php echo e($errors -> first('filam')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="spl" class="col-sm-2 col-form-label">SPL</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="spl" placeholder="Spliter" value="<?php echo e(old('spl', $olt->spl)); ?>">
                                    <?php if($errors->has('spl')): ?>
                                        <span class="error text-danger" for="input-spl"><?php echo e($errors -> first('spl')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                            <label for="sitio_fca" class="col-sm-2 col-form-label">Sitio FCA</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitio_fca" placeholder="Sitio FCA" value="<?php echo e(old('sitio_fca', $olt->sitio_fca)); ?>">
                                    <?php if($errors->has('sitio_fca')): ?>
                                        <span class="error text-danger" for="input-sitio_fca"><?php echo e($errors -> first('sitio_fca')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <label for="link_sitio_fca" class="col-sm-2 col-form-label">Link GMaps</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="link_sitio_fca" placeholder="Link GMaps del Sitio FCA" value="<?php echo e(old('link_sitio_fca', $olt->link_sitio_fca)); ?>">
                                        <?php if($errors->has('link_sitio_fca')): ?>
                                            <span class="error text-danger" for="input-link_sitio_fca"><?php echo e($errors -> first('link_sitio_fca')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <div class="row">
                                <label for="descripcion_fca" class="col-sm-2 col-form-label">Descripción Sitio</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="descripcion_fca" placeholder="Descripción sitio FCA" value="<?php echo e(old('descripcion_fca', $olt->descripcion_fca)); ?>">
                                    <?php if($errors->has('descripcion_fca')): ?>
                                        <span class="error text-danger" for="input-descripcion_fca"><?php echo e($errors -> first('descripcion_fca')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!--div class="row">
                                <label for="id_estado" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control " data-style="btn btn-link" id="exampleFormControlSelect1" name="id_estado">
                                        <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $est): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($est->id); ?>" <?php echo e($est->id == $olt->estad->id ? 'selected' : ''); ?>><?php echo e($est->estado); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                </div>
                            </div-->
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

<?php echo $__env->make('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Actualizar OLT'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/olt/edit.blade.php ENDPATH**/ ?>