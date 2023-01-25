
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de Slots MSAN <?php echo e($equipo->numero); ?></h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="<?php echo e(route('equiposmsan.slots.index', $equipo->id)); ?>" method="get">
                                                <div class="form-row">
                                                    <div class="col-sm-4 align-self-center" style="text-align: right">
                                                        <input type="text" class="form-control float-right" name="texto" value="<?php echo e($texto ?? ''); ?>" placeholder="Buscar...">
                                                    </div>
                                                    <div class="col-auto align-self-center">
                                                        <input type="submit" class="btn btn-primary float-right" value="Buscar">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="card-category">Datos de Slots MSAN <?php echo e($equipo->numero); ?></p>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 text-right">
                                        <a href="<?php echo e(url()->route('equiposmsan.index')); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                    </div>
                                    <?php if(session('success')): ?>
                                        <div class="alert alert-success" role="success">
                                            <?php echo e(session('success')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <form action="<?php echo e(route('equiposmsan.slots.store', $equipo->id)); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-tittle text-center text-primary">Añadir Slot MSAN <?php echo e($equipo->numero); ?></h4>
                                                <div class="row">
                                                <label for="slot_msan" class="col-sm-2 col-form-label">Slot MSAN</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" name="slot_msan" placeholder="Slot MSAN  ejemplo: (1-1, 1-2, ...)" value="<?php echo e(old('slot_msan')); ?>" autofocus required oninvalid="this.setCustomValidity('Ingrese Slot del MSAN')" oninput="this.setCustomValidity('')"/>
                                                        <?php if($errors->has('slot_msan')): ?>
                                                            <span class="error text-danger" for="input-slot_msan"><?php echo e($errors -> first('slot_msan')); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="id_estado" class="col-sm-2 col-form-label">Estado</label>
                                                    <div class="col-sm-7">
                                                        <div class="form-group">
                                                            <select class="form-control " data-style="btn btn-link" id="exampleFormControlSelect1" name="id_estado">
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
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead class="text-primary">
                                                <th>Slot</th>
                                                <th>Estado</th>
                                                <th>Tarjeta</th>
                                                <th>Acciones</th>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($slot->id_msan == $equipo->id): ?>
                                            <tr>
                                                <td><?php echo e($slot->equiposmsan->Ubicacion->ciudad->abreviacion); ?> <?php echo e($slot->slot_msan); ?></td>
                                                <?php
                                                    $contador = $slot->slotmsan;
                                                    $ocupado = count($slot->slotmsan);
                                                    for ($i=1;$i<=count($contador);$i++)
                                                    {
                                                        if ($slot->slotmsan[$i-1]->estad->id == "1")
                                                            $ocupado -= 1;
                                                    }
                                                ?>
                                                <?php if($slot->estado->id == "1"): ?>
                                                    <td class="text-success"><?php echo e($slot->estado->estado); ?></td>
                                                <?php endif; ?>
                                                <?php if($slot->estado->id == "2"): ?>
                                                    <td class="text-danger"><?php echo e($slot->estado->estado); ?></td>
                                                <?php endif; ?>
                                                <td><h5><a href="<?php echo e(route('equiposmsan.slots.olt.index', [$equipo,$slot])); ?>">Ver Tarjeta</a></h5></td>
                                                <td class="td-actions text-center">
                                                    <a href="<?php echo e(route('equiposmsan.slots.edit', [$equipo,$slot])); ?>" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                    <form action="<?php echo e(route('equiposmsan.slots.destroy', [$equipo,$slot])); ?>" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?, Si elimina este Slot, eliminará todas las OLT registradas')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button class="btn btn-danger" type="submit" rel="tooltip">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Lista de Slot MSAN'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/slots/index.blade.php ENDPATH**/ ?>