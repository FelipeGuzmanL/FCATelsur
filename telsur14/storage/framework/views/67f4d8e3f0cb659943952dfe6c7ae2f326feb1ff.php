
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de OLT <?php echo e($slot->equiposmsan->Ubicacion->ciudad->abreviacion); ?> <?php echo e($slot->slot_msan); ?></h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="<?php echo e(route('equiposmsan.slots.olt.index', [$equipo,$slot])); ?>" method="get">
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
                                    <p class="card-category">Datos de OLT <?php echo e($slot->equiposmsan->Ubicacion->ciudad->abreviacion); ?> <?php echo e($slot->slot_msan); ?></p>
                                </div>
                                <div class="card-body">
                                    <?php if(session('success')): ?>
                                        <div class="alert alert-success" role="success">
                                            <?php echo e(session('success')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(session('failure')): ?>
                                        <div class="alert alert-danger" role="failure">
                                            <?php echo e(session('failure')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="<?php echo e(route('equiposmsan.slots.olt.create', [$equipo,$slot])); ?>" class="btn btn-primary">Generar OLTs</a>
                                            <a href="<?php echo e(route('equiposmsan.slots.index', $equipo->id)); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary text-center">
                                                <th>OLT</th>
                                                <th>Sitio FCA</th>
                                                <th>SPL</th>
                                                <th>Descripción Sitio</th>
                                                <th>Cable</th>
                                                <th>Filam</th>
                                                <th>Estado</th>
                                                <th>Fecha Modificación</th>
                                                <th>Modificado por</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                            <?php if(count($olts)<=0): ?>
                                                <div class="alert alert-danger" style="text-align:center" role="alert">
                                                    <h4>No se han encontrado olt</h4>
                                                </div>
                                            <?php endif; ?>
                                            <?php $__currentLoopData = $olts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $olt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($olt->id_slot == $slot->id): ?>
                                                <tr class="text-center">
                                                    <td><?php echo e($olt->olt); ?></td>
                                                    <td><?php echo e($olt->sitio_fca); ?></td>
                                                    <td><?php echo e($olt->spl); ?></td>
                                                    <td><?php echo e($olt->descripcion_fca); ?></td>
                                                    <?php if($olt->cable->id > "1"): ?>
                                                        <?php
                                                            $cables = $olt->cable
                                                        ?>
                                                        <td><a href="<?php echo e(route('equiposmsan.slots.olt.cables.index', [$equipo,$slot,$olt,$cables])); ?>"><?php echo e($olt->cable->nombre_cable); ?></a></td>
                                                    <?php endif; ?>
                                                    <?php if($olt->cable->id == "1"): ?>
                                                        <td></td>
                                                    <?php endif; ?>
                                                    <td><?php echo e($olt->filam); ?></td>
                                                    <?php if($olt->estad->id == "1"): ?>
                                                        <td class="text-success"><?php echo e($olt->estad->estado); ?></td>
                                                    <?php endif; ?>
                                                    <?php if($olt->estad->id == "2"): ?>
                                                        <td class="text-danger"><?php echo e($olt->estad->estado); ?></td>
                                                    <?php endif; ?>
                                                    <td><?php echo e($olt->updated_at); ?></td>
                                                    <td><?php echo e($olt->usuario->name); ?></td>
                                                    <td class="td-actions text-right">
                                                        <?php if( $olt->link_sitio_fca == NULL): ?>
                                                        <?php elseif( $olt->link_sitio_fca != NULL): ?>
                                                            <a href="<?php echo e($olt->link_sitio_fca); ?>" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo e(route('equiposmsan.slots.olt.edit', [$equipo,$slot,$olt])); ?>" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                        <form action="<?php echo e(route('equiposmsan.slots.olt.destroy', [$equipo,$slot,$olt])); ?>" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
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

<?php echo $__env->make('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Lista de OLT MSAN'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/olt/index.blade.php ENDPATH**/ ?>