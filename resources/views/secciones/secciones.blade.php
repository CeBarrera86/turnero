<div class="col-md-4">
    <div id="username" data-username="{{ Auth::user()->username }}" style="display: none;"></div>
    <div class="card">
        <div class="card-header card-header-warning-sec">
            <h4 class="card-title-sec">Turno Solicitado</h4>
        </div>
        <div id="solicitado-body" class="card-body text-center">
        </div>
        <div id="solicitado-footer" class="card-footer m-auto">
            {{-- <div class="table-responsive">
                <table id="solicitado-table" class="table">
                    <tbody>
                    </tbody>
                </table>
            </div> --}}
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-header card-header-warning-sec">
            <h4 class="card-title-sec">Disponibles</h4>
        </div>
        <div id="body-disponibles" class="card-body">
            <div class="table-responsive">
                <table id="disponibles" class="table">
                    <thead class=" text-primary">
                        <th>Ticket</th>
                        <th class="text-right"></th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-header card-header-warning-sec">
            <h4 class="card-title-sec">Derivados</h4>
        </div>
        <div id="body-derivados" class="card-body">
            <div class="table-responsive">
                <table id="derivados" class="table">
                    <thead class=" text-primary">
                        <th>Ticket</th>
                        <th class="text-right"></th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
