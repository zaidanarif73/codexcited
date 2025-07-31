@extends('student.layouts.master')
@section("title","Materi - CODEXCITED student")
@section("title_breadcumb","Materi")    
@section("breadcumb","Materi")
@section("breadcumb_child","Code")
@section('css')
<!-- CodeMirror Stylesheet -->
<link href="{{URL::to('/')}}/assets/student/lib/codemirror/codemirror.css" rel="stylesheet">
<link href="{{URL::to('/')}}/assets/student/lib/codemirror/theme/dracula.css" rel="stylesheet">
<style>
    .CodeMirror {
        font-size: 0.8rem;
    }
</style>
@endsection 
@section('content')
<div class="container-fluid py-3">
    <h4>Live Code Editor</h4>
    <p>Silakan tulis kode HTML/JS Anda. Tekan tombol "Run" untuk melihat hasilnya.</p>

    <div class="row">
        <!-- Code Editor -->
        <div class="col-12 col-md-6 mb-3">
            <div class=" border rounded" style="overflow-x: auto;">
                <textarea id="myTextarea" name="code" rows="10" cols="30" placeholder="Tulis kode Anda di sini...">{{ $code }}</textarea>
            </div>
            <button class="btn btn-primary mt-3" onclick="runCode()">Run</button>
        </div>

        <!-- Output -->
        <div class="col-12 col-md-6">
            <div class="border rounded bg-light" style="overflow: hidden;">
                <iframe id="output" style="width:100%; border:1px solid #ccc;" sandbox="allow-scripts"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- CodeMirror JavaScript -->
<script src="{{URL::to('/')}}/assets/student/lib/codemirror/codemirror.js"></script>
<script src="{{URL::to('/')}}/assets/student/lib/codemirror/edit/closebrackets.js"></script>
<script src="{{URL::to('/')}}/assets/student/lib/codemirror/mode/xml.js"></script>
<script src="{{URL::to('/')}}/assets/student/lib/codemirror/mode/javascript.js"></script>
<script src="{{URL::to('/')}}/assets/student/lib/codemirror/mode/css.js"></script>
<script src="{{URL::to('/')}}/assets/student/lib/codemirror/mode/htmlmixed.js"></script>

<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("myTextarea"), {
        mode: "htmlmixed",
        lineNumbers: true,
        theme: "dracula",
        autoCloseBrackets: true,
    });

    function adjustHeight() {
        // Hitung tinggi maksimum berdasarkan viewport
        const headerOffset = 230; // Sesuaikan dengan margin/padding atas halaman
        const dynamicHeight = window.innerHeight - headerOffset;

        // Set tinggi editor
        editor.setSize("100%", dynamicHeight + "px");

        // Set tinggi iframe
        document.getElementById("output").style.height = dynamicHeight + "px";
    }

    // Jalankan saat awal
    adjustHeight();

    // Jalankan kembali saat resize
    window.addEventListener("resize", adjustHeight);
    
    let lastSubmittedCode = "";
    function runCode() {
        const code = editor.getValue();
        const iframe = document.getElementById("output");
        iframe.srcdoc = code;

        // Scroll ke output setelah menjalankan kode
        document.getElementById("output").scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

        // Tambahkan score hanya jika isi kode berbeda dari sebelumnya
        if (code !== lastSubmittedCode) {
            lastSubmittedCode = code;
            addScore();
        } else {
            console.log("Kode tidak berubah, skor tidak ditambahkan.");
        }
    }

    // Tambahkan shortcut Ctrl+Enter untuk Run
    editor.setOption("extraKeys", {
        "Ctrl-Enter": function(cm) {
            runCode();
        }
    });

    //function add point while running code
    function addScore() {
        const route = "{{ route('student.materi.score.addScore') }}";
        $.ajax({
            url: route,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                score: 1 //tambahkan 1 poin setiap kali kode dijalankan
            },
            success: function(response) {
                console.log("Score updated:", response);
            },
            error: function(xhr, status, error) {
                console.error("Error adding score:", error);
            }
        });
    }

</script>
@endsection