<div class="row justify-content-center p-3">
    <div class="col-lg-6">
        <div class="card custom-card shadow-lg" style="border-radius: 10px; border: 1px solid;">
            <div class="card-body">
                <div class="row mb-3">
                    <h4 class="text-center mb-2">REGISTRO DE ASISTENCIAS</h4>
                </div>

                <div class="row justify-content-center">

                    <form id="FormAsistencias">
                        <input type="hidden" id="asi_id" name="asi_id">

                        <div class="row mb-3 justify-content-center">

                            <label for="asi_actividad" class="form-label">Seleccione la actividad</label>
                            <select name="asi_actividad" id="asi_actividad" class="form-select">
                                <option value="" selected disabled>Seleccione...</option>
                                <?php foreach ($actividades as $c): ?>
                                    <?php if ($c->act_situacion == 1): ?>
                                        <option value="<?= $c->act_id ?>"><?= $c->act_nombre ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

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
                <h3 class="text-center">ASISTENCIAS REGISTRADAS</h3>

                <div class="table-responsive p-2">
                    <table class="table table-striped table-hover table-bordered w-100 table-sm" id="TablaAsistencias">
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="<?= asset('build/js/asistencias/index.js') ?>"></script>