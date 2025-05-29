<div class="card">
    <div class="card-header card-header-warning-sec">
        <h4 class="card-title-sec">{{ $title }}</h4>
    </div>
    <div id="{{ $id }}-body" class="card-body @if (isset($class)) {{ $class }} @endif">
        @if (isset($tableId))
            <div class="table-responsive">
                <table id="{{ $tableId }}" class="table">
                    <thead class="text-primary">
                        <th>Ticket</th>
                        <th class="text-right"></th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    @if (isset($footer))
        <div id="{{ $id }}-footer" class="card-footer m-auto">
        </div>
    @endif
</div>
