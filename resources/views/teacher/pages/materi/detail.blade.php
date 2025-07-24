@extends('teacher.layouts.master')
@section("title","Detail Materi - $materi->title ~ CODEXCITED teacher")
@section("title_breadcumb","Materi")
@section("breadcumb","Materi")
@section("breadcumb_child","Detail")
@section('css')
<style>
    .accordion-body img,
    ul li img,
    .trix-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0.5rem auto;
    }
    .accordion-body figcaption,
    ul li figcaption,
    .trix-content figcaption {
        display: none !important;
    }
    .border-4 {
        border-width: 4px !important;
    }
    .btn-xs {
        padding: 0.15rem 0.35rem;
        font-size: 0.75rem;
        line-height: 1;
        border-radius: 0.2rem;
    }
</style>
@endsection
@section('content')
<div class="container">
    <h4>Judul Materi: {{ $materi->title }}</h4>
    <p>{{ $materi->description }}</p>

    <hr>
    <h5>Submateri Saat Ini:</h5>
    <ul class="list-unstyled">
        @forelse($materi->details as $detail)
            <li class="position-relative border border-4 rounded p-3 mb-3 shadow-sm bg-white">
                {{-- Tombol di pojok kanan atas --}}
                <div class="position-absolute" style="top: 0.5rem; right: 0.5rem; z-index: 1;">
                    <a href="{{ route('teacher.materi.detail.edit', [$materi->id, $detail->id]) }}"
                    class="btn btn-xs btn-sm btn-outline-primary mr-1" title="Edit">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="{{ route('teacher.materi.detail.destroy', [$materi->id, $detail->id]) }}"
                        method="POST" class="d-inline" onsubmit="return confirm('Hapus submateri ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-sm btn-outline-danger" title="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>

                {{-- Konten Submateri --}}
                <strong class="d-block mb-2">{{ $detail->title }}</strong>
                {!! $detail->description !!}
            </li>
        @empty
            <li>Tidak ada submateri.</li>
        @endforelse
    </ul>

    <hr>
    <h5>Tambah Submateri</h5>
    <form action="{{ route('teacher.materi.detail.store', $materi->id) }}" method="POST">
        @csrf
        <div id="submateri-wrapper">
            <div class="submateri-block mb-4">
                <input type="text" name="submateri[0][title]" class="form-control mb-2" placeholder="Judul Submateri" required>
                <input id="submateri_0_description" type="hidden" name="submateri[0][description]">
                <trix-editor input="submateri_0_description"></trix-editor>
            </div>
        </div>

        <button type="button" class="btn btn-sm btn-secondary mb-3" id="add-submateri">+ Tambah Submateri</button>
        <br>
        <button type="submit" class="btn btn-primary">Simpan Submateri</button>
    </form>

    <!--appear if admin add more than one submateri-->
    <template id="trix-template">
        <div class="submateri-block mb-4">
            <input type="text" name="__TITLE__" class="form-control mb-2" placeholder="Judul Submateri" required>
            <input type="hidden" name="__DESCRIPTION_NAME__" id="__DESCRIPTION_ID__">
            <trix-editor input="__DESCRIPTION_ID__"></trix-editor>
        </div>
    </template>
</div>
@endsection

@section("script")
<script>
    let counter = 1;
    document.getElementById('add-submateri').addEventListener('click', function () {
        const wrapper = document.getElementById('submateri-wrapper');
        const template = document.getElementById('trix-template').innerHTML;

        const titleName = `submateri[${counter}][title]`;
        const descName = `submateri[${counter}][description]`;
        const descId = `submateri_${counter}_description`;

        const newBlock = template
            .replace(/__TITLE__/g, titleName)
            .replace(/__DESCRIPTION_NAME__/g, descName)
            .replace(/__DESCRIPTION_ID__/g, descId);

        wrapper.insertAdjacentHTML('beforeend', newBlock);
        counter++;

        wrapper.lastElementChild.scrollIntoView({ behavior: "smooth" });
    });
</script>

<!-- Include Trix editor for uploading image or file script -->
<script>
    document.addEventListener("trix-attachment-add", function(event) {
        if (event.attachment.file) {
            uploadAttachment(event.attachment);
        }
    });

    function uploadAttachment(attachment) {
        const file = attachment.file;
        const form = new FormData();
        form.append("attachment", file);
        form.append("_token", "{{ csrf_token() }}");

        fetch("{{ route('attachment.upload') }}", {
            method: "POST",
            body: form,
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                attachment.setAttributes({
                    url: result.url,
                    href: result.url
                });
            } else {
                alert('Gagal upload gambar');
            }
        })
        .catch(() => alert('Upload gagal'));
    }
</script>
@endsection