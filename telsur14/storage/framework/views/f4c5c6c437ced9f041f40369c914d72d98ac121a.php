
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo e(route('equiposmsan.slots.update', [$equipo, $slot])); ?>" method="post" class="form-horizontal">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Slot <?php echo e($slot->slot_msan); ?></h4>
                            <p class="card-category">Actualizar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <label for="slot_msan" class="col-sm-2 col-form-label">Slot MSAN</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="slot_msan" placeholder="Slot MSAN" value="<?php echo e(old('slot_msan',$slot->slot_msan)); ?>" autofocus required oninvalid="this.setCustomValidity('Ingrese Slot MSAN')" oninput="this.setCustomValidity('')"/>
                                        <?php if($errors->has('slot_msan')): ?>
                                            <span class="error text-danger" for="input-slot_msan"><?php echo e($errors -> first('slot_msan')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="id_estado" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1" name="id_estado">
                                            <?php $__currentLoopData = $estado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $est): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($est->id); ?>" <?php echo e($slot->id_estado == $est->id ? 'selected' : ''); ?>><?php echo e($est->estado); ?></option>
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
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'sitios', 'titlePage' => 'Actualizar Slot'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/slots/edit.blade.php ENDPATH**/ ?>