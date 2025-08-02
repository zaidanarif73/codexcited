@extends('student.layouts.master')

@section('css')
<style>

    /* gaya umum */
    .sidebar{
        background:#23283a;
        padding:1rem;          /* jangan pakai padding:auto; */
    }

    /* --- HANYA untuk layar besar (desktop) --- */
    @media (min-width:992px){   /* ≥ lg */
        .sidebar{
            min-height:100vh;   /* tetap full‑height di desktop */
            overflow-y:auto;    /* bisa di‑scroll kalau lesson banyak */
        }
    }

    /* --- Untuk layar ≤ 991 px (tablet & mobile) --- */
    @media (max-width:991.98px){
        .sidebar{
            min-height:auto;    /* biarkan tingginya mengikuti konten */
        }
        /* rapatkan jarak antar lesson supaya tak terlalu panjang */
        .sidebar .my-4{ margin:1rem 0; }
        .sidebar .progress{ height:18px; }
    }

    .accordion-button {
        background: #06BBCC;
        color: #f0f0f0;
    }
    .accordion-button:not(.collapsed){
        background: #06BBCC;
        color: #f0f0f0;
    }
    .accordion-body img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0.5rem auto;
    }
    .accordion-body figcaption {
        display: none;
    }
      /* Dark mode for code blocks <pre> */
    .dark-mode pre{
        padding: 10px;
        color: lime !important;
        background: #181c25 !important;
    } 

    pre{
        padding: 10px;
        color: green !important;
        background: #e3eafc !important;
        border-radius: 5px;
        overflow-x: auto;
        font-size: 0.8rem;
    }
</style>
@endsection

@section('content')
<div class="py-2 container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 sidebar">
            <div class="course-header">
                Roadmap Materi - <span class="fw-bold">{{ $materi->title }}</span>
            </div>
            
                    {{-- ===== SIDEBAR ===== --}}
            @foreach($materiDetails as $row)
            <div class="my-3">
                <span class="fw-bold text-white">{{ $loop->iteration }}. {{ $row->title }}</span>
                <div class="progress" style="height:24px;background:#44436a;">
                <div class="progress-bar"
                    id="bar-{{ $row->id }}"
                    data-id="{{ $row->id }}"
                    style="width:0%;background:#7fffd4;color:#23223a;">0%</div>
                </div>
            </div>
            @endforeach

        </div>
        <!-- Main Content -->
        <div data-bs-spy="scroll" data-bs-smooth-scroll="true" class="col-lg-9">

            {{-- Satu container accordion saja --}}
            <div class="accordion" id="materiAccordion">
                    {{-- ===== ACCORDION ===== --}}
            @foreach($materiDetails as $row)
            @php $cid = 'collapse'.$row->id; @endphp
            <div class="accordion-item my-2">
                <h2 class="accordion-header" id="h{{ $row->id }}">
                <button class="accordion-button {{ $loop->first?'':'collapsed' }}"
                        data-bs-toggle="collapse"
                        data-bs-target="#{{ $cid }}">
                    {{ $loop->iteration }}.&nbsp;{{ $row->title }}
                </button>
                </h2>
                <div id="{{ $cid }}"
                    class="accordion-collapse collapse {{ $loop->first?'show':'' }}"
                    data-id="{{ $row->id }}">
                    <div class="accordion-body">{!! $row->description !!}
                    </div>
                </div>
            </div>
            @endforeach

            <!--kuis-->
            @if($kuis->count() > 0)
                <div class="accordion-item my-2">
                    <h2 class="accordion-header" id="headingKuis">
                        <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseKuis"
                                aria-expanded="false">
                            {{ $materiDetails->count() + 1 }}. Kuis
                        </button>
                    </h2>
                    <div id="collapseKuis" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p>Ada {{ $kuis->count() }} soal dalam kuis ini. Selamat Mengerjakan!</p>
                            <a href="{{ route('student.kuis.show', $materi->id) }}" class="btn btn-success">
                                Mulai Kuis
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
const progressFromServer = @json($progressMap);   // {id: %}
const updateUrl          = "{{ route('progress.update') }}";
const csrfToken          = "{{ csrf_token() }}";
$(function () {

    /* Konstanta */
    const TOTAL  = 60,                   // detik
          STEP   = 100 / TOTAL,
          prog   = {...progressFromServer}, // clone
          timers = {};                   // {id: intervalID}

    /* 1. Render posisi awal */
    $.each(prog, function (id, pct) {
        $('#bar-' + id)
            .css('width', pct + '%')
            .text(pct + '%');
    });

    /* 2. Kirim ke server (tiap 10 % atau 100 %) */
    function send(id, pct) {
        $.ajax({
            url: updateUrl,
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: { materi_detail_id: id, progress: pct },
            error: err => console.error('save‑err', err)
        });
    }

    /* 3. Timer per materi */
    function start(id) {
        if (timers[id] || (prog[id] || 0) >= 100) return;

        const $bar = $('#bar-' + id);

        timers[id] = setInterval(() => {
            prog[id] = (prog[id] || 0) + STEP;
            if (prog[id] >= 100) {
                prog[id] = 100;
                clearInterval(timers[id]);
                delete timers[id];
            }

            $bar.css('width', prog[id] + '%')
                .text(Math.round(prog[id]) + '%');

            if (prog[id] % 10 < STEP || prog[id] === 100) {
                send(id, Math.round(prog[id]));
            }
        }, 1000);
    }
    function stop(id) {
        if (timers[id]) {
            clearInterval(timers[id]);
            delete timers[id];
        }
    }

    /* 4. Kaitkan event Bootstrap collapse */
    $('.accordion-collapse')
        .on('shown.bs.collapse', function () { start($(this).data('id')); })
        .on('hide.bs.collapse',  function () { stop($(this).data('id')); });

    /* 5. Panel pertama (jika show) */
    const $first = $('.accordion-collapse.show').first();
    if ($first.length) start($first.data('id'));
});
</script>

<!-- Live Code Editor Button -->
<script>
$(function () {
    $('.accordion-body').each(function () {
        const $body = $(this);
        const id = $body.closest('.accordion-collapse').data('id');

        $body.find('pre').each(function (i) {
            const $pre = $(this);
            const uniqueKey = `${id}-${i}`; // ID MateriDetail + Index

            $pre.attr('data-index', uniqueKey); // bisa juga pakai id="pre-4-0"

            // Hindari duplikat tombol
            if ($pre.next('.live-code-btn').length === 0) {
                const encoded = btoa($pre.text()); // encode base64

                const $btn = $(`
                    <div class="text-start mt-2 live-code-btn my-3">
                        <a href="${liveCodeRoute(id, encoded)}" class="btn btn-secondary btn-sm">Live Code Editor</a>
                    </div>
                `);
                $pre.after($btn);
            }
        });
    });

    function liveCodeRoute(id, encodedCode) {
        return "{{ route('student.materi.code', ':id') }}".replace(':id', id) + '?code=' + encodeURIComponent(encodedCode);
    }
});
</script>
@endsection
