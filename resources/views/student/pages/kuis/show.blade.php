@extends('student.layouts.master')

@section('navbar') {{-- kosongkan navbar --}} @endsection

@section('css')
<link href="{{URL::to('/')}}/assets/student/quizller/css/main.css" rel="stylesheet">
<link href="{{URL::to('/')}}/assets/student/quizller/css/quiz.css" rel="stylesheet">
<link href="{{URL::to('/')}}/assets/student/quizller/css/util.css" rel="stylesheet">

<style>
    .container-login100 {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to bottom, #0699cc, #06bbcc, #066acc);
        padding: 20px;
    }

    .quiz-wrapper {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        padding: 25px;
        max-width: 650px;
        width: 100%;
    }

    .loader {
        border: 12px solid #f3f3f3;
        border-radius: 50%;
        border-top: 12px solid #3498db;
        width: 80px;
        height: 80px;
        animation: spin 1.2s linear infinite;
        margin: 40px auto;
        display: none;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .question-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        gap: 10px;
        border-radius: 8px 8px 0 0;
    }

    .question-header span#qid {
        background-color: #ffc107;
        color: #fff;
        padding: 6px 12px;
        border-radius: 4px;
        font-weight: bold;
    }

    .question-header h5 {
        margin: 0;
        color: #00bcd4;
    }

    .quiz label {
        border: 2px solid #00bcd4;
        padding: 15px 20px;
        font-weight: bold;
        font-size: 1.1rem;
        border-radius: 10px;
        background-color: #ffffff;
        color: #00bcd4;
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .quiz label:hover {
        background-color: #e0f7fa;
    }

    .quiz input[type="radio"] {
        display: none;
    }

    .option-letter {
        display: inline-block;
        width: 28px;
        height: 28px;
        line-height: 28px;
        border-radius: 50%;
        text-align: center;
        font-weight: bold;
        background-color: #e0f7fa;
        color: #00bcd4;
        flex-shrink: 0;
    }

    .score-box {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: #00bcd4;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 1rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }

    .correct-answer {
        background-color: #c8e6c9 !important;
        border-color: #2e7d32 !important;
        color: #2e7d32 !important;
    }

    .wrong-answer {
        background-color: #ffcdd2 !important;
        border-color: #c62828 !important;
        color: #c62828 !important;
    }

    #explanation-box {
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }
</style>
@endsection

@section('content')
<section>
    <div class="container-login100">
        <div class="quiz-wrapper">

            <!-- Score Box -->
            <div class="score-box" id="score-box">
                Skor: <span id="score">0</span>
            </div>

            <!-- Loader -->
            <div id="loader" class="loader"></div>

            <!-- Quiz Content -->
            <div id="content">
                @if ($questions->isEmpty())
                    <div class="text-center">
                        <h3 class="mb-3">Kuis Tidak Tersedia</h3>
                        <p>Maaf, saat ini tidak ada kuis yang tersedia untuk materi ini.</p>
                        <a href="{{ route('student.materi.index') }}" class="btn btn-primary mt-4">Kembali ke Dashboard</a>
                    </div>
                @else
                    <div class="question-header mb-3">
                        <span id="qid"></span>
                        <h5 id="question"></h5>
                    </div>

                    <div class="modal-body p-0">
                        <div class="quiz" id="quiz"></div>

                        <div id="explanation-box" style="display:none; margin-top: 10px; padding: 15px; background-color: #f1f1f1; border-left: 5px solid #00bcd4; border-radius: 8px;">
                            <div class="text-muted fw-bold"><small>Penjelasan:</small></div>
                            <p id="explanation-text" style="margin: 0;"></p>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    const questions = @json($questions);
    
    let currentIndex = 0;
    let score = 0;
    let answered = Array(questions.length).fill(false);

    function loadQuestion(index) {
        const q = questions[index];
        document.getElementById("qid").innerText = index + 1;
        document.getElementById("question").innerText = q.question;

        const quizContainer = document.getElementById("quiz");
        quizContainer.innerHTML = "";
        const letters = ['A', 'B', 'C', 'D'];

        q.options.forEach((opt, i) => {
            quizContainer.innerHTML += `
                <label onclick="selectOption(${i})">
                    <input type="radio" name="q_answer" value="${i}">
                    <span class="option-letter">${letters[i]}</span> ${opt}
                </label>`;
        });
    }

    function selectOption(selected) {
        if (!answered[currentIndex]) {
            answered[currentIndex] = true;

            const correctIndex = questions[currentIndex].correct;
            const allLabels = document.querySelectorAll("#quiz label");

            allLabels.forEach((label, i) => {
                label.classList.remove('correct-answer', 'wrong-answer');
                if (i === correctIndex) label.classList.add('correct-answer');
                if (i === selected && i !== correctIndex) label.classList.add('wrong-answer');
            });

            if (selected == correctIndex) {
                score += 10;
                document.getElementById("score").innerText = score;
            }

            const explanationBox = document.getElementById("explanation-box");
            const explanationText = document.getElementById("explanation-text");
            explanationText.innerText = questions[currentIndex].explanation;
            explanationBox.style.display = 'block';

            setTimeout(() => {
                explanationBox.style.display = 'none';
                if (currentIndex < questions.length - 1) {
                    currentIndex++;
                    loadQuestion(currentIndex);
                } else {
                    showResult();
                }
            }, 2500);
        }
    }

    function showResult() {
        const content = document.getElementById("content");
        content.innerHTML = `
            <div class="text-center">
                <h3 class="mb-3">Kuis Selesai!</h3>
                <p>Skor Akhir Kamu:</p>
                <div class="text-danger display-6 fw-bold mb-0">${score}</div>
                <a href="{{ route('student.materi.index') }}" class="btn btn-primary mt-4">Kembali ke Dashboard</a>
            </div>
        `;
        addScore(); // Tambahkan skor ke database
    }

    function addScore() {
        const route = "{{ route('student.kuis.simpanSkor') }}";
        $.ajax({
            url: route,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                score: score, //tambahkan skore ke database
                materi_id: "{{ $materi_id }}",
            },
            success: function(response) {
                console.log("Score updated:", response);
            },
            error: function(xhr, status, error) {
                console.error("Error adding score:", error);
            }
        });
    }

    function showLoader() {
        document.getElementById('loader').style.display = 'block';
        document.getElementById('content').style.display = 'none';
    }

    function hideLoader() {
        document.getElementById('loader').style.display = 'none';
        document.getElementById('content').style.display = 'block';
    }

    showLoader();
    setTimeout(() => {
        hideLoader();
        loadQuestion(currentIndex);
    }, 1000);
</script>
@endsection