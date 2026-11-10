@props([
    'action',
    'title' => 'Konfirmasi tindakan',
    'message' => 'Apakah Anda yakin ingin melanjutkan?',
    'confirmLabel' => 'Konfirmasi',
    'method' => 'POST',
    'confirmClass' => 'btn-primary',
])

@php($modalId = 'confirmation-'.\Illuminate\Support\Str::uuid())

<span data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
    {{ $trigger }}
</span>

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}-title"
    aria-describedby="{{ $modalId }}-message">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body" id="{{ $modalId }}-message">{{ $message }}</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if (strtoupper($method) !== 'POST')
                        @method($method)
                    @endif
                    <button type="submit" class="btn {{ $confirmClass }}">{{ $confirmLabel }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.body.append(document.getElementById(@json($modalId)));
</script>