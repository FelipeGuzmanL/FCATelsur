
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Cable <?php echo e($cables->nombre_cable); ?> de Fibra Óptica</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="<?php echo e(route('equiposmsan.slots.olt.cables.index', [$equipo,$slot,$olt,$cables])); ?>" method="get">
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
                                            <a href="<?php echo e(route('equiposmsan.slots.olt.index', [$equipo,$slot])); ?>" class="btn btn-primary"><i class="material-icons">arrow_back</i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Nombre</th>
                                                <th>Sitio</th>
                                                <th>Cantidad Filamentos</th>
                                                <th>Tipo de Cable</th>
                                                <th>Detalles</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <td><?php echo e($cables->nombre_cable); ?></td>
                                                    <td><?php echo e($cables->sitio->nombre); ?></td>
                                                    <td><?php echo e($cables->cant_filam); ?></td>
                                                    <td><?php echo e($cables->tipocable->tipo); ?></td>
                                                    <td><a href="<?php echo e(route('cable.detallecable.index', $cables->id)); ?>">Ver Cable</a></td>
                                                    <td class="td-actions text-right">
                                                        <?php if( $cables->sitio->url == NULL): ?>
                                                            <?php elseif( $cables->sitio->url != NULL): ?>
                                                                <a href="<?php echo e($cables->sitio->url); ?>" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                            <?php endif; ?>
                                                        <a href="<?php echo e(route('cable.edit', $cables->id)); ?>" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                        <form action="<?php echo e(route('cable.destroy', $cables->id)); ?>" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        </form>
                                                    </td>
                                                </tr>
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

<?php echo $__env->make('layouts.app', ['activePage' => 'equiposmsan', 'titlePage' => 'Lista de Cables de Fribra'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/cable/index_cable.blade.php ENDPATH**/ ?>