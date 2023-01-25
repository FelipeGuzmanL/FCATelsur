
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de Equipos MSAN</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="<?php echo e(route('equiposmsan.index')); ?>" method="get">
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
                                    <p class="card-category">Datos de Equipos MSAN</p>
                                </div>
                                <div class="card-body">
                                    <?php if(session('success')): ?>
                                        <div class="alert alert-success" role="success">
                                            <?php echo e(session('success')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="<?php echo e(route('equiposmsan.create')); ?>" class="btn btn-primary">Añadir MSAN</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary text-center">
                                                <th>Sitio</th>
                                                <th>Nombre</th>
                                                <th>Slots</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                            <?php if(count($equipos)<=0): ?>
                                                <div class="alert alert-danger" style="text-align:center" role="alert">
                                                    <h4>No se han encontrado equipos</h4>
                                                </div>
                                            <?php endif; ?>
                                            <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="text-center">
                                                    <td><?php echo e($equipo->Ubicacion->ciudad->nombre); ?></td>
                                                    <td><?php echo e($equipo->Ubicacion->ciudad->abreviacion); ?> <?php echo e($equipo->numero); ?></td>
                                                    <td><a href="<?php echo e(route('equiposmsan.slots.index', $equipo->id)); ?>">Slots <?php echo e($equipo->Ubicacion->ciudad->abreviacion); ?> <?php echo e($equipo->numero); ?></a></td>
                                                    <td class="td-actions text-right">
                                                        <?php if( $equipo->Ubicacion->link_gmaps == NULL): ?>
                                                        <?php elseif( $equipo->Ubicacion->link_gmaps != NULL): ?>
                                                            <a href="<?php echo e($equipo->Ubicacion->link_gmaps); ?>" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                        <?php endif; ?>
                                                        <!--a href="<?php echo e(route('equiposmsan.show', $equipo->id)); ?>" class="btn btn-info"><i class="material-icons">library_books</i></a-->
                                                        <a href="<?php echo e(route('equiposmsan.edit', $equipo->id)); ?>" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                        <form action="<?php echo e(route('equiposmsan.destroy', $equipo->id)); ?>" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            <?php echo $equipos->links("pagination::bootstrap-4"); ?>

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

<?php echo $__env->make('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Lista de Equipos MSAN'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/equiposmsan/index.blade.php ENDPATH**/ ?>