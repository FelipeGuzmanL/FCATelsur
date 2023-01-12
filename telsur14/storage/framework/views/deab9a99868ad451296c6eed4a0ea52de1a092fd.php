
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-tittle">Lista de Sitios</h4>
                                    <div class="row">
                                        <div class="col-7 text-right d-felx">
                                            <form action="<?php echo e(route('sitios.index')); ?>" method="get">
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
                                    <p class="card-category">Datos de Sitios</p>
                                </div>
                                <div class="card-body">
                                    <?php if(session('success')): ?>
                                        <div class="alert alert-success" role="success">
                                            <?php echo e(session('success')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="<?php echo e(route('sitios.create')); ?>" class="btn btn-primary">Añadir Sitio</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary text-center">
                                                <th>Nombre</th>
                                                <th>Nemotécnico</th>
                                                <th>Dirección</th>
                                                <th>Descripción</th>
                                                <th>Cables</th>
                                                <th>MSAN</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                            <?php if(count($sitios)<=0): ?>
                                                <div class="alert alert-danger" style="text-align:center" role="alert">
                                                    <h4>No se han encontrado sitios</h4>
                                                </div>
                                            <?php endif; ?>
                                            <?php $__currentLoopData = $sitios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="text-center">
                                                    <td><?php echo e($sitio->nombre); ?></td>
                                                    <td><?php echo e($sitio->abreviacion); ?></td>
                                                    <td><?php echo e($sitio->direccion); ?></td>
                                                    <td><?php echo e($sitio->descripcion); ?></td>
                                                    <td><a href="<?php echo e(route('sitios.index_cable', $sitio->id)); ?>">Ver Cables</a></td>
                                                    <td><a href="<?php echo e(route('sitios.index_equipo', $sitio->id)); ?>">Ver MSANs</a></td>
                                                    <td class="td-actions text-right">
                                                        <?php if( $sitio->url == NULL): ?>
                                                        <?php elseif( $sitio->url != NULL): ?>
                                                            <a href="<?php echo e($sitio->url); ?>" target="_blank" class="btn btn-success"><i class="material-icons">location_on</i></a>
                                                        <?php endif; ?>
                                                        <!--a href="<?php echo e(route('sitios.show', $sitio->id)); ?>" class="btn btn-info"><i class="material-icons">library_books</i></a-->
                                                        <a href="<?php echo e(route('sitios.edit', $sitio->id)); ?>" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                        <form action="<?php echo e(route('sitios.destroy', $sitio->id)); ?>" method="post" style="display: inline-block" onsubmit="return confirm('¿Estás seguro?')">
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
                                            <?php echo $sitios->links("pagination::bootstrap-4"); ?>

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

<?php echo $__env->make('layouts.app', ['activePage' => 'sitios', 'titlePage' => 'Lista de Sitios'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feli_\BitacorasVehiculosTelsur\resources\views/sitios/index.blade.php ENDPATH**/ ?>