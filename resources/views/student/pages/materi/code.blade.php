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
            <div class=" border rounded bg-light" style="max-height: 400px; overflow: auto;">
                <iframe id="output" style="width:100%; height:391px; border:1px solid #ccc;" sandbox="allow-scripts"></iframe>
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

    var width = window.innerWidth;
    editor.setSize("auto", "400px"); // Set width to 70% of the viewport width and height to 500px

    function runCode() {
        const code = editor.getValue();
        const iframe = document.getElementById("output");
        iframe.srcdoc = code;
    }

</script>
@endsection