<div class="col-md-7">
    <div class="card">
        <div class="card-header card-header-primary d-flex align-items-center justify-content-center">
            <span class="font-weight-bold" style="font-size: 2.5rem">Bienvenido/a</span>
        </div>
        <div class="card-body">
            <label class="card-category" for="campo">INGRESÁ TU DNI</label>
            <form id="searchForm" autocomplete="on">
                @csrf
                <div class="alert alert-success">
                    <div class="form-group">
                        <input id="campo" name="dni" class="form-control dni" type="number" readonly required>
                        <span id="dni-error-container" class="text-danger"></span> <!-- Mensajes de error -->
                    </div>
                    <button type="submit" id="submitBtn" class="btn btn-warning">{{ __('Continuar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
