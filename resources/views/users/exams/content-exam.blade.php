<form action="{{ route('class.exams.submitExam', ['id' => $classRoom->id, 'examId' => $exam->id, 'studentId' => auth()->user()->id]) }}" method="post">
    @csrf
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
        <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Nộp bài</button>
    </div>            
    @endif
</form>