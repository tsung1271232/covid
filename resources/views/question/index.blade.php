@extends('layouts.master')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-success">
                        <h4 class="text-muted">Question List</h4>
                    </div>
                </div>
            </div>
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
                                    <button type="button" class="btn btn-primary" onclick="getQuestionContent({{$topic_id}}, {{$question->question_number}})">View</button>
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
        </div>
    </div>

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
                                <option value="R">Yes/No</option>
                                <option value="RS">Multi</option>
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
                            <input type="text" class="form-control" name='question_code' value="" id="add_question_code">
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
                            <input type="text" class="form-control" name='options_code' value='{"0":"Common_1", "1":"Common_2"}' id="add_options_code">
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
                    <h5 class="modal-title" id="exampleModalLabel">Modify question</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class='form-group'>
                        <div class="form-group">
                            <label for="edit_question_number">question_number:</label>
                            <input type="hidden" class="form-control" name="question_number" value="" id="ori_question_number">
                            <input type="text" class="form-control" name="question_number" value="" id="edit_question_number">
                        </div>
                        <div class="form-group">
                            <label for="question_type">question_type:</label>
                            <select name="question_type" id="edit_question_type">
                                <option value="R">Yes/No</option>
                                <option value="RS">Multi</option>
                                <option value="D">Date</option>
                                <option value="T">Text</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="topic_id">topic_id:</label>
                            <input type="text" class="form-control" name="topic_id" value={{$topic_id}} disabled id="edit_topic_id">
                        </div>
                        <div class="form-group">
                            <label for="question_id">question_id:</label>
                            <input type="text" class="form-control" name='question_code' value="" id="edit_question_code">
                        </div>
                        <div class="form-group">
                            <label for="question">question:</label>
                            <input type="text" class="form-control" name="question" value="" id="edit_question">
                        </div>
                        <div class="form-group">
                            <label for="question_en">question_en:</label>
                            <input type="text" class="form-control" name="question_en" value="" id="edit_question_en">
                        </div>
                        <div class="form-group">
                            <label for="options_id">options_id:</label>
                            <input type="text" class="form-control" name='options_code' value='{"0":"Common_1", "1":"Common_2"}' id="edit_options_code">
                        </div>
                        <div class="form-group">
                            <label for="options">options:</label>
                            <input type="text" class="form-control" name='options' value='{"0":"否", "1":"是"}' id="edit_options">
                        </div>
                        <div class="form-group">
                            <label for="options_en">options_en:</label>
                            <input type="text" class="form-control" name='options_en' value='{"0":"No", "1":"Yes"}' id="edit_options_en">
                        </div>
                        <div class="form-group">
                            <label for="required">required:</label>
                            <input type="text" class="form-control" name='required' value="" id="edit_required">
                        </div>
                        <div class="form-group">
                            <label for="next_question">next_question:</label>
                            <input type="text" class="form-control" name='next_question' value="" id="edit_next_question">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateQuestion(this)" data-dismiss="modal">Save Change</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getQuestionContent(topic_id, question_number){
            $('#editModal').modal('show');
            $.ajax({
                type: "POST",
                url: "/getQuestionContent",
                dataType: "json",
                data: {
                    topic_id: topic_id,
                    question_number: question_number
                },
                success: function (data) {
                    $('#ori_question_number').val(question_number);
                    $('#edit_question_number').val(question_number);
                    $('#edit_topic_number').val(topic_id);
                    $('#edit_question_code').val(data[0]['question_code']);
                    $('#edit_question').val(data[0]['question']);
                    $('#edit_question_en').val(data[0]['question_en']);
                    $('#edit_question_type').val(data[0]['question_type']);
                    $('#edit_options_code').val(data[0]['options_code']);
                    $('#edit_options').val(data[0]['options']);
                    $('#edit_options_en').val(data[0]['options_en']);
                    $('#edit_required').val(data[0]['required']);
                    $('#edit_next_question').val(data[0]['next_question']);
                },
                error: function () {
                    alert("not working");
                }
            });
        }

        function insertQuestion(element){
            $.ajax({
                type: "POST",
                url: "/insertQuestion",
                dataType: "json",
                data: {
                    question_number : $("#add_question_number").val(),
                    next_question : $("#add_next_question").val(),
                    topic_id: $("#add_topic_id").val(),
                    options : $("#add_options").val(),
                    options_en : $("#add_options_en").val(),
                    options_code : $("#add_options_code").val(),
                    question: $("#add_question").val(),
                    question_en : $("#add_question_en").val(),
                    question_code : $("#add_question_code").val(),
                    question_type : $("#add_question_type").val(),
                    required : $("#add_required").val(),
                },
                success: function () {
                    var index = parseInt($('#Content tr').last().attr('id'));
                    //TODO buttom
                    var append_data =
                        "<tr id={0}><th scope='col'>{1}</th><th scope='col'>{2}</th><th scope='col'>{3}</th><th scope='col'>{4}</th><th scope='col'>{5}</th><th><button type='button' class='btn btn-primary' onclick='getQuestionContent({6}, {7})'>View</button></th><tr>"
                            .format(index+1, $("#add_question_number").val(), $("#add_question_type").val(), $("#add_question").val(), $("#add_options").val(), $("#add_next_question").val(), $("#add_topic_id").val(), $("#add_question_number").val());
                    $("table tbody").append(append_data);
                },
                error: function () {
                    alert("not working");
                }
            });
        }

        function updateQuestion(element){
            $.ajax({
                type: "POST",
                url: "/updateQuestion",
                dataType: "json",
                data: {
                    ori_question_number : $("#ori_question_number").val(),
                    question_number : $("#edit_question_number").val(),
                    next_question : $("#edit_next_question").val(),
                    topic_id: $("#edit_topic_id").val(),
                    options : $("#edit_options").val(),
                    options_en : $("#edit_options_en").val(),
                    options_code : $("#edit_options_code").val(),
                    question: $("#edit_question").val(),
                    question_en : $("#edit_question_en").val(),
                    question_code : $("#edit_question_code").val(),
                    question_type : $("#edit_question_type").val(),
                    required : $("#edit_required").val(),
                },
                success: function () {
                    //TODO:
                    alert("success");
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


