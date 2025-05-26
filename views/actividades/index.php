<div class="row justify-content-center p-3">
    <div class="col-lg-6">
        <div class="card custom-card shadow-lg" style="border-radius: 10px; border: 1px solid;">
            <div class="card-body">
                <div class="row mb-3">
                    <h4 class="text-center mb-2">REGISTRO DE ACTIVIDADES</h4>
                </div>

                <div class="row justify-content-center">

                    <form id="FormActividades">
                        <input type="hidden" id="act_id" name="act_id">

                        <div class="row mb-3 justify-content-center">

                            <label for="act_nombre" class="form-label">Ingrese el nombre de la activiad:</label>
                            <input type="text" class="form-control" id="act_nombre" name="act_nombre">

                            <label for="act_horario" class="form-label">Ingrese la fecha y hora:</label>
                            <input type="datetime-local" class="form-control" id="act_horario" name="act_horario">

                            <div class="row justify-content-center mt-5">
                                <div class="col-auto">
                                    <button class="btn btn-success" type="submit" id="BtnGuardar">
                                        Guardar
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-warning d-none" type="button" id="BtnModificar">
                                        Modificar
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-dark" type="reset" id="BtnLimpiar">
                                        Limpiar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center p-3">
    <div class="col-lg-10">
        <div class="card custom-card shadow-lg" style="border-radius: 10px; border: 1px solid #007bff;">
            <div class="card-body p-3">
                <h3 class="text-center">ACTIVIDADES REGISTRADAS</h3>

                <div class="table-responsive p-2">
                    <table class="table table-striped table-hover table-bordered w-100 table-sm" id="TablaActividades">
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="<?= asset('build/js/actividades/index.js') ?>"></script>