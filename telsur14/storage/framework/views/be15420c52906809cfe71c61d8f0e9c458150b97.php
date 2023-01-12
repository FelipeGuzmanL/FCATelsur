
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de Cables de Fibra Óptica</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="<?php echo e(route('cable.index')); ?>" method="get">
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
                                        <div class="alert alert-success" role="success">
                                            <?php echo e(session('success')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="<?php echo e(route('cable.create')); ?>" class="btn btn-primary">Añadir Cable</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary text-center">
                                                <th>N° Cable</th>
                                                <th>Sitio</th>
                                                <th>Cant. Filam</th>
                                                <th>Tipo de Cable</th>
                                                <th>Descripción</th>
                                                <th>Detalles</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                            <?php if(count($cables)<=0): ?>
                                                <div class="alert alert-danger" style="text-align:center" role="alert">
                                                    <h4>No se han encontrado cables</h4>
                                                </div>
                                            <?php endif; ?>
                                            <?php $__currentLoopData = $cables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($cable->id > "1"): ?>
                                                <tr class="text-center">
                                                    <td><?php echo e($cable->nombre_cable); ?></td>
                                                    <td><?php echo e($cable->sitio->abreviacion); ?></td>
                                                    <td><?php echo e($cable->cant_filam); ?></td>
                                                    <td><?php echo e($cable->tipocable->tipo); ?></td>
                                                    <td><?php echo e($cable->descripcion); ?></td>
                                                    <td><a href="<?php echo e(route('cable.detallecable.index', $cable->id)); ?>">Ver Cable</a></td>
                                                    <td class="td-actions text-right">
                                                        <?php if( $cable->sitio->url == NULL): ?>
                                                            <?php elseif( $cable->sitio->url != NULL): ?>
                                                                <a href="<?php echo e($cable->sitio->url); ?>" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                            <?php endif; ?>
                                                        <a href="<?php echo e(route('cable.edit', $cable->id)); ?>" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                        <form action="<?php echo e(route('cable.destroy', $cable->id)); ?>" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
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
                                        <div class="d-flex justify-content-center">
                                            <?php echo $cables->links("pagination::bootstrap-4"); ?>

                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'cable', 'titlePage' => 'Lista de Cables de Fibra'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/cable/index.blade.php ENDPATH**/ ?>