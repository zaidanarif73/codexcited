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

</style>
@endsection

@section('content')
<div class="py-2 container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 sidebar">
            <div class="course-header">
                Roadmap Materi - <span class="fw-bold">Learn HTML</span>
            </div>
            
            <div class="my-4">
                <span class="fw-bold text-white">Lesson 1 What Code is Like</span>
                <div class="progress" style="height: 24px; background: #44436a;">
                <div class="progress-bar" role="progressbar" style="width: 100%; background: #7fffd4; color: #23223a;">100%</div>
                </div>
            </div>
            <div class="my-4">
                <span class="fw-bold text-white">Lesson 2 Your First Error</span>
                <div class="progress" style="height: 24px; background: #44436a;">
                <div class="progress-bar" role="progressbar" style="width: 100%; background: #7fffd4; color: #23223a;">100%</div>
                </div>
            </div>
            <div class="my-4">
                <span class="fw-bold text-white">Lesson 3 We Stand on the Shoulders of Gia</span>
                <div class="progress" style="height: 24px; background: #44436a;">
                <div class="progress-bar" role="progressbar" style="width: 100%; background: #7fffd4; color: #23223a;">100%</div>
                </div>
            </div>
            <div class="my-4">
                <span class="fw-bold text-white">Lesson 4 Drawing a Rectangle</span>
                <div class="progress" style="height: 24px; background: #44436a;">
                <div class="progress-bar" role="progressbar" style="width: 100%; background: #7fffd4; color: #23223a;">100%</div>
                </div>
            </div>
            <div class="my-4">
                <span class="fw-bold text-white">Lesson 5 Coding Your First Function</span>
                <div class="progress" style="height: 24px; background: #44436a;">
                <div class="progress-bar" role="progressbar" style="width: 52%; background: #7fffd4; color: #23223a;">52%</div>
                </div>
            </div>

        </div>
        <!-- Main Content -->
        <div data-bs-spy="scroll" data-bs-smooth-scroll="true" class="col-lg-9">

            {{-- Satu container accordion saja --}}
            <div class="accordion" id="materiAccordion">
                @forelse ($materiDetails as $index => $row)
                    @php
                        $headingId  = 'heading'.$index;
                        $collapseId = 'collapse'.$index;
                    @endphp

                    <div class="accordion-item my-3">
                        <h2 class="accordion-header" id="{{ $headingId }}">
                            <button
                                class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#{{ $collapseId }}"
                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                aria-controls="{{ $collapseId }}">
                                {{ $index + 1 }}.&nbsp;{{ $row->title }}
                            </button>
                        </h2>

                        {{--  HAPUS data-bs-parent supaya panel lain tak ditutup otomatis --}}
                        <div id="{{ $collapseId }}"
                            class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                            aria-labelledby="{{ $headingId }}">
                            <div class="accordion-body">
                                {{ $row->description }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No entries</p>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection