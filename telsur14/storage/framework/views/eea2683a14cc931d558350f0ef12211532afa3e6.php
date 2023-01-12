
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Detalles del cable <?php echo e($cable->sitio->abreviacion); ?> <?php echo e($cable->nombre_cable); ?></h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="<?php echo e(route('cable.detallecable.index', $cable->id)); ?>" method="get">
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
                                    <p class="card-category">Datos de Cables de Fibra Óptica</p>
                                </div>
                                <div class="card-body">
                                    <?php if(session('success')): ?>
                                        <div class="alert alert-success text-center" role="success">
                                            <?php echo e(session('success')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(session('warning')): ?>
                                        <div class="alert alert-warning text-center" role="warning">
                                            <?php echo e(session('warning')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="<?php echo e(route('cable.index')); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary text-center">
                                                <th>Filam</th>
                                                <th>DIR</th>
                                                <th>Servicio</th>
                                                <th>Cruzada</th>
                                                <th>Observaciones</th>
                                                <th>Estado</th>
                                                <th>Longitud</th>
                                                <th>Fecha Modificación</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($detalle->cable->id == $cable->id): ?>
                                                    <tr class="text-center">
                                                        <td><?php echo e($detalle->filamento); ?></td>
                                                        <td><?php echo e($detalle->direccion); ?></td>
                                                        <td><?php echo e($detalle->servicio); ?></td>
                                                        <td><?php echo e($detalle->cruzada); ?></td>
                                                        <td><?php echo e($detalle->observaciones); ?></td>
                                                        <?php if($detalle->estado->id == "1"): ?>
                                                            <td class="text-success"><?php echo e($detalle->estado->estado); ?></td>
                                                        <?php elseif($detalle->estado->id == "2"): ?>
                                                            <td class="text-danger"><?php echo e($detalle->estado->estado); ?></td>
                                                        <?php endif; ?>
                                                        <td><?php echo e($detalle->longitud); ?> mts</td>
                                                        <td><?php echo e($detalle->updated_at); ?> <br> por <?php echo e($detalle->user->name); ?></td>
                                                        <td class="td-actions text-right">
                                                            <?php if( $detalle->gmaps == NULL): ?>
                                                            <?php elseif( $detalle->gmaps != NULL): ?>
                                                                <a href="<?php echo e($detalle->gmaps); ?>" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                            <?php endif; ?>
                                                            <a href="<?php echo e(route('cable.detallecable.edit', [$cable,$detalle])); ?>" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                            <form action="<?php echo e(route('cable.detallecable.destroy', [$cable,$detalle])); ?>" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
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

<?php echo $__env->make('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Detalles del Cable'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/cabledetalles/index.blade.php ENDPATH**/ ?>