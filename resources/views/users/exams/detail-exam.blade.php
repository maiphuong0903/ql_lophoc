@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
    <header class="bg-white border-b p-5 w-full mt-2">
        <nav>
            <ul class="flex flex-1 gap-3 items-center">
                <li class="font-bold">
                    <a href="{{ route('class.exams', $classRoom->id) }}">Bài kiểm tra</a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                </li>
                <li>{{ $exam->title }}</li>
            </ul>
        </nav>
    </header>
    @if (auth()->user()->role == 3)        
        <div class="flex gap-3 justify-end px-10 pb-5 pt-3 text-xl fixed right-0 ">
            <p class="text-[15px]">Thời gian còn lại: </p>
            <div id="countdownTimer">00:00:00</div>
        </div>
    @endif
    {{--  nội dung bài kiểm tra --}}
    <div class="max-w-screen-lg mx-auto mb-3 mt-7 p-6">
        <form action="{{ route('class.exams.submitExam', ['id' => $classRoom->id, 'examId' => $exam->id, 'studentId' => auth()->user()->id]) }}" method="post">
            @csrf
            <input type="hidden" name="exam_time" value="{{ $exam->time }}">
            @foreach($questions as $key => $question)
                <div class="bg-white mb-5 p-4 border border-gray-300 rounded-lg"> 
                    <h1 class="font-medium text-blue-500 text-[17px]">Câu hỏi {{ $key + 1 }}:</h1>
                    <p class="font-medium py-2">{{ $question->content }}</p>
                    <ul>
                        @foreach($question->answers as $index => $answer)
                            <li class="mb-1.5">
                                @if (auth()->user()->role != 2)
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->answer_index }}" id="answer_{{ $answer->id }}" class="mr-2">
                                @endif
                                <label for="">{{ $answer->answer_index }}. {{ $answer->answer_content }}</label>
                            </li>
                        @endforeach
                    </ul>
                    @if (auth()->user()->role == 2)  
                        @foreach($correctAnswerQuestions as $correctAnswer)
                            @if($correctAnswer->id == $question->id)
                                <p class="font-medium text-green-500 mt-3">Đáp án đúng: {{ $correctAnswer->answers->first()->answer_index }}</p>
                            @endif
                        @endforeach                       
                    @endif
                </div>
            @endforeach
            @if (auth()->user()->role == 3)   
            <div class="border-gray-200 rounded-b flex gap-3 justify-end">
                <a href="{{ route('class.exams', $classRoom->id) }}" class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Hủy</a>
                <button id="submitBtn" class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Nộp bài</button>
            </div>            
            @endif
        </form>
    </div>    
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    @if (auth()->user()->role == 3)   
        // Lấy thời gian từ cột 'time' của bảng 'exam' (đơn vị là phút)
        let examTimeInMinutes = {{ $exam->time }};
        
        // Convert thời gian thành giờ, phút và giây
        let hours = Math.floor(examTimeInMinutes / 60);
        let minutes = examTimeInMinutes % 60;
        let seconds = 0; // Bắt đầu từ 0 giây

        // Tính thời gian bắt đầu
        let startTime = new Date();

        // Cập nhật đồng hồ đếm ngược mỗi giây
        let timerInterval = setInterval(updateTimer, 1000);

        function updateTimer() {
            let currentTime = new Date();
            let elapsedTimeInSeconds = Math.floor((currentTime - startTime) / 1000);

            // Tính thời gian còn lại
            let remainingSeconds = (hours * 3600 + minutes * 60 + seconds) - elapsedTimeInSeconds;

            if (remainingSeconds <= 0) {
                clearInterval(timerInterval); 
                document.getElementById('countdownTimer').innerHTML = "<span style='color: red; font-size: 15px;'>Hết giờ</span>";
                console.log(1);
                // Tự động nộp bài 
                submitExam();
            } else {
                // Format thời gian còn lại thành giờ, phút và giây
                let remainingHours = Math.floor(remainingSeconds / 3600);
                let remainingMinutes = Math.floor((remainingSeconds % 3600) / 60);
                let remainingSecondsFormatted = remainingSeconds % 60;

                // Hiển thị thời gian còn lại trên đồng hồ đếm ngược
                document.getElementById('countdownTimer').innerHTML = remainingHours.toString().padStart(2, '0') + ':' + remainingMinutes.toString().padStart(2, '0') + ':' + remainingSecondsFormatted.toString().padStart(2, '0');
            }
        }

        function submitExam() {
            console.log(2);
            // Lấy các thông tin cần thiết như id của lớp, id của bài kiểm tra, id của học sinh
            var classRoomId = "{{ $classRoom->id }}";
            var examId = "{{ $exam->id }}";
            var studentId = "{{ auth()->user()->id }}";

            // Lấy danh sách các câu trả lời của học sinh
            var answers = {};

            // Lặp qua tất cả các input radio và lấy giá trị của các câu trả lời
            $('input[name^="answers"]').each(function() {
                var questionId = $(this).attr('name').replace('answers[', '').replace(']', '');
                var answer = $('input[name="' + $(this).attr('name') + '"]:checked').val();
                answers[questionId] = answer;
            });

            // Gửi yêu cầu POST bằng AJAX
            $.ajax({
                type: "POST",
                url: "{{ route('class.exams.submitExam', ['id' => $classRoom->id, 'examId' => $exam->id, 'studentId' => auth()->user()->id]) }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    answers: answers 
                },
                success: function(response) {
                    window.location.href = "{{ route('class.exams', ['id' => $classRoom->id]) }}";
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi nếu có
                }
            });
        }
    @endif
</script>



