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
        <div data-bs-spy="scroll"  data-bs-smooth-scroll="true" class="col-lg-9">
            <div>
                @forelse ($materiDetails as $index => $row)
                    <h1>{{ $row->title }}</h1>
                    <p>{{ $row->description }}</p>
                @empty
                @endforelse
                <p>
                    
                
                    {{-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum sunt obcaecati quo blanditiis magni eos hic, voluptatem ad laudantium exercitationem cupiditate quibusdam et saepe, repellendus, culpa praesentium animi quam? Quis!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores recusandae doloribus nesciunt nostrum temporibus, nemo autem atque nihil magni impedit? Consequuntur repellat maiores, tenetur quibusdam illo harum tempore alias enim.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto possimus molestias quos aspernatur, provident eveniet aperiam iure magnam praesentium, molestiae alias blanditiis dignissimos, cum omnis vero rem dicta? Ad, natus!
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum sunt obcaecati quo blanditiis magni eos hic, voluptatem ad laudantium exercitationem cupiditate quibusdam et saepe, repellendus, culpa praesentium animi quam? Quis!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores recusandae doloribus nesciunt nostrum temporibus, nemo autem atque nihil magni impedit? Consequuntur repellat maiores, tenetur quibusdam illo harum tempore alias enim.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto possimus molestias quos aspernatur, provident eveniet aperiam iure magnam praesentium, molestiae alias blanditiis dignissimos, cum omnis vero rem dicta? Ad, natus!

                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum sunt obcaecati quo blanditiis magni eos hic, voluptatem ad laudantium exercitationem cupiditate quibusdam et saepe, repellendus, culpa praesentium animi quam? Quis!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores recusandae doloribus nesciunt nostrum temporibus, nemo autem atque nihil magni impedit? Consequuntur repellat maiores, tenetur quibusdam illo harum tempore alias enim.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto possimus molestias quos aspernatur, provident eveniet aperiam iure magnam praesentium, molestiae alias blanditiis dignissimos, cum omnis vero rem dicta? Ad, natus!

                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum sunt obcaecati quo blanditiis magni eos hic, voluptatem ad laudantium exercitationem cupiditate quibusdam et saepe, repellendus, culpa praesentium animi quam? Quis!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores recusandae doloribus nesciunt nostrum temporibus, nemo autem atque nihil magni impedit? Consequuntur repellat maiores, tenetur quibusdam illo harum tempore alias enim.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto possimus molestias quos aspernatur, provident eveniet aperiam iure magnam praesentium, molestiae alias blanditiis dignissimos, cum omnis vero rem dicta? Ad, natus!

                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum sunt obcaecati quo blanditiis magni eos hic, voluptatem ad laudantium exercitationem cupiditate quibusdam et saepe, repellendus, culpa praesentium animi quam? Quis!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores recusandae doloribus nesciunt nostrum temporibus, nemo autem atque nihil magni impedit? Consequuntur repellat maiores, tenetur quibusdam illo harum tempore alias enim.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto possimus molestias quos aspernatur, provident eveniet aperiam iure magnam praesentium, molestiae alias blanditiis dignissimos, cum omnis vero rem dicta? Ad, natus!

                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum sunt obcaecati quo blanditiis magni eos hic, voluptatem ad laudantium exercitationem cupiditate quibusdam et saepe, repellendus, culpa praesentium animi quam? Quis!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores recusandae doloribus nesciunt nostrum temporibus, nemo autem atque nihil magni impedit? Consequuntur repellat maiores, tenetur quibusdam illo harum tempore alias enim.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto possimus molestias quos aspernatur, provident eveniet aperiam iure magnam praesentium, molestiae alias blanditiis dignissimos, cum omnis vero rem dicta? Ad, natus!

                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum sunt obcaecati quo blanditiis magni eos hic, voluptatem ad laudantium exercitationem cupiditate quibusdam et saepe, repellendus, culpa praesentium animi quam? Quis!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores recusandae doloribus nesciunt nostrum temporibus, nemo autem atque nihil magni impedit? Consequuntur repellat maiores, tenetur quibusdam illo harum tempore alias enim.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto possimus molestias quos aspernatur, provident eveniet aperiam iure magnam praesentium, molestiae alias blanditiis dignissimos, cum omnis vero rem dicta? Ad, natus!

                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum sunt obcaecati quo blanditiis magni eos hic, voluptatem ad laudantium exercitationem cupiditate quibusdam et saepe, repellendus, culpa praesentium animi quam? Quis!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores recusandae doloribus nesciunt nostrum temporibus, nemo autem atque nihil magni impedit? Consequuntur repellat maiores, tenetur quibusdam illo harum tempore alias enim.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto possimus molestias quos aspernatur, provident eveniet aperiam iure magnam praesentium, molestiae alias blanditiis dignissimos, cum omnis vero rem dicta? Ad, natus! --}}

                </p>
            </div>
            
        </div>
    </div>
</div>
@endsection

