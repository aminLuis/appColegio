<template>
    <div class="contenedor">
          <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevaBebida">Nueva bebida</button>
          <br><br>

          <table class="table table-sm">

              <thead>
                  <tr>
                      <th>Descripción</th>
                      <th>Marca</th>
                      <th>Unidades</th>
                      <th>Costo/unidad</th>
                      <th>Precio venta</th>
                      <th>Tamaño</th>
                      <th>Total costo</th>
                      <th>Acción</th>
                  </tr>
              </thead>

              <tbody>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                            <button class="btn btn-primary btn-sm">
                                <i class="ni ni-ruler-pencil text-secondary"></i>
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="ni ni-fat-remove text-secondary"></i>
                            </button>
                      </td>
                  </tr>
              </tbody>

          </table>


            <div class="modal fade" tabindex="-1" id="nuevaBebida">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white">Nueva bebida</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       

                        <form submit.prevent="">

                            <div class="row">

                                <div class="col">
                                    <label for="" class="form-control-sm">Descripción</label>
                                    <input type="text" class="form-control form-control-sm" required>
                                </div>

                                <div class="col">
                                    <label for="" class="form-control-sm">Marca</label>
                                    <input type="text" class="form-control form-control-sm" required>
                                </div>

                                <div class="col">
                                    <label for="" class="form-control-sm">Unidades</label>
                                    <input type="number" class="form-control form-control-sm" required>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col">
                                    <label for="" class="form-control-sm">Costo unidad</label>
                                    <input type="number" step="any" class="form-control form-control-sm" required>
                                </div>

                                <div class="col">
                                    <label for="" class="form-control-sm">Precio venta</label>
                                    <input type="number" step="any" class="form-control form-control-sm" required>
                                </div>

                                <div class="col">
                                    <label for="" class="form-control-sm">Tamaño</label>
                                    <input type="text" class="form-control form-control-sm" required>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col">
                                    <label for="" class="form-control-sm">Total costo</label>
                                    <input type="number" step="any" class="form-control form-control-sm" required>
                                </div>

                                <div class="col">
                                </div>

                                <div class="col">
                                </div>

                            </div>


                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
           </div>


    </div>
</template>