@extends('layouts.master')

@section('content')

    <form>
        <div class="container-fluid">
            <table class="table" id="Content">
                <thead>
                <tr>
                    <th>question_number</th>
                    <th>question_type</th>
                    <th>question</th>
                    <th>options</th>
                    <th>next_question</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($questions as $question)
                    <tr id={{$loop->index}}>
                        <th scope="col">{{$question->question_number}}</th>

                        <th scope="col">{{$question->question_type}}</th>

                        <th scope="col">{{$question->question}}</th>

                        <th scope="col">{{$question->options}}</th>

                        <th scope="col">{{$question->next_question}}</th>

                        <th>
{{--                        <form>--}}
{{--                            <button id="modifyModalBtn" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modifyModal"--}}
{{--                                    data-id={{ $question->id }} data-question_number={{ $question->question_number }} data-question_type={{ $question->question_type }} data-next_question={{ $question->next_question }}--}}
{{--                                    data-topic_id={{ $question->topic_id }} data-question_id={{ $question->question_id }} data-question={{ $question->question }} data-question_en={{ $question->question_en }}--}}
{{--                                    data-required={{ $question->required }} data-options_id={{ $question->options_id }} data-options={{ $question->options }} data-question={{ $question->options__en }}--}}
{{--                                    >--}}
{{--                                Edit--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                            <button class="btn btn-primary" onclick="test()">Load</button>--}}
                        </th>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Insert new question
            </button>
        </div>
    </form>

    <!-- Modal -->
    <div id="exampleModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insert new question</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class='form-group'>
                        <div class="form-group">
                            <label for="insert_question_number">question_number:</label>
                            <input type="text" class="form-control" name="question_number" value="" id="add_question_number">
                        </div>
                        <div class="form-group">
                            <label for="question_type">question_type:</label>
                            <select name="question_type" id="add_question_type">
                                <option value="R">Radio Button</option>
                                <option value="D">Date</option>
                                <option value="T">Text</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="topic_id">topic_id:</label>
                            <input type="text" class="form-control" name="topic_id" value={{$topic_id}} id="add_topic_id">
                        </div>
                        <div class="form-group">
                            <label for="question_id">question_id:</label>
                            <input type="text" class="form-control" name='question_id' value="" id="add_question_id">
                        </div>
                        <div class="form-group">
                            <label for="question">question:</label>
                            <input type="text" class="form-control" name="question" value="" id="add_question">
                        </div>
                        <div class="form-group">
                            <label for="question_en">question_en:</label>
                            <input type="text" class="form-control" name="question_en" value="" id="add_question_en">
                        </div>
                        <div class="form-group">
                            <label for="options_id">options_id:</label>
                            <input type="text" class="form-control" name='options_id' value='{"0":"Common_1", "1":"Common_2"}' id="add_options_id">
                        </div>
                        <div class="form-group">
                            <label for="options">options:</label>
                            <input type="text" class="form-control" name='options' value='{"0":"否", "1":"是"}' id="add_options">
                        </div>
                        <div class="form-group">
                            <label for="options_en">options_en:</label>
                            <input type="text" class="form-control" name='options_en' value='{"0":"No", "1":"Yes"}' id="add_options_en">
                        </div>
                        <div class="form-group">
                            <label for="required">required:</label>
                            <input type="text" class="form-control" name='required' value="" id="add_required">
                        </div>
                        <div class="form-group">
                            <label for="next_question">next_question:</label>
                            <input type="text" class="form-control" name='next_question' value="" id="add_next_question">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="insertQuestion(this)" data-dismiss="modal">Inert</button>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insert new question</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body edit-content">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // function test(){
        //     console.log("why");
        // }

        function insertQuestion(element){
            $.ajax({
                type: "POST",
                url: "/covid/insertQuestion",
                dataType: "json",
                data: {
                    question_number : $("#add_question_number").val(),
                    next_question : $("#add_next_question").val(),
                    topic_id: $("#add_topic_id").val(),
                    options : $("#add_options").val(),
                    options_en : $("#add_options_en").val(),
                    options_id : $("#add_options_id").val(),
                    question: $("#add_question").val(),
                    question_en : $("#add_question_en").val(),
                    question_id : $("#add_question_id").val(),
                    question_type : $("#add_question_type").val(),
                    required : $("#add_required").val(),
                },
                success: function () {
                    var index = parseInt($('#Content tr').last().attr('id'));

                    var append_data =
                        "<tr id={0}><th scope='col'>{1}</th><th scope='col'>{2}</th><th scope='col'>{3}</th><th scope='col'>{4}</th><th scope='col'>{5}</th><tr>".format(index+1, $("#add_question_number").val(), $("#add_question_type").val(), $("#add_question").val(), $("#add_options").val(), $("#add_question_number").val());
                    $("table tbody").append(append_data);
                },
                error: function () {
                    alert("not working");
                }
            });
        }
        String.prototype.format = function () {
            var a = this;
            for (var k in arguments) {
                a = a.replace(new RegExp("\\{" + k + "\\}", 'g'), arguments[k]);
            }
            return a
        };
    </script>

@endsection


