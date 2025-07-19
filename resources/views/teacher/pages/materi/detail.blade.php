@extends('teacher.layouts.master')
@section("title","Detail Materi")

@section('content')
<div class="container">
    <h4>Judul Materi: {{ $materi->title }}</h4>
    <p>{{ $materi->description }}</p>

    <hr>
    <h5>Submateri Saat Ini:</h5>
    <ul>
        @forelse($materi->details as $detail)
            <li>
                <strong>{{ $detail->title }}</strong><br>
                {!! $detail->description !!}
            </li>
        @empty
            <li>Belum ada submateri.</li>
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