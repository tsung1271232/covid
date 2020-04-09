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
                    <table class="table" id="questionTable">
                        <thead>
                        <tr>
                            <th>question_number</th>
                            <th>question_type</th>
                            <th>question</th>
                            <th>options</th>
                            <th>next_question</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($questions as $question)
                            <tr id = "row{{$loop->index}}" >
                                <th scope="col">{{$question->question_number}}</th>

                                <th scope="col">{{$question->question_type}}</th>

                                <th scope="col" width="30%">{{$question->question}}</th>

                                <th scope="col" width="30%">{{$question->options}}</th>

                                <th scope="col">{{$question->next_question}}</th>

                                <td>
                                    <button type="button" class="btn btn-primary" onclick="getQuestionContent({{$topic_id}}, {{$question->question_number}}, this)">View</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="insertModal">
                        Insert new question
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="insertModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Insert new question</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class='form-group'>
                        <div class="form-group">
                            <input type="hidden" id="insertCurRowId">
                        </div>
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
                    <h5 class="modal-title" id="editModalLabel">Modify question</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class='form-group'>
                        <div class="form-group">
                            <input type="hidden" class="form-control" value="" id="editRowIDX">
                        </div>
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
        function getQuestionContent(topic_id, question_number, x){
            axios.post( "{{ route('questions.getContent') }}" , {
                    topic_id: topic_id,
                    question_number: question_number
                })
                .then(function (response) {
                    console.log(response['data'][0], x.parentNode.parentNode.rowIndex);
                    document.getElementById('editRowIDX').value = x.parentNode.parentNode.rowIndex;
                    document.getElementById('ori_question_number').value = response['data'][0]['question_number'];
                    document.getElementById('edit_question_number').value = response['data'][0]['question_number'];
                    document.getElementById('edit_topic_id').value = response['data'][0]['topic_id'];
                    document.getElementById('edit_question_code').value = response['data'][0]['question_code'];
                    document.getElementById('edit_question').value = response['data'][0]['question'];
                    document.getElementById('edit_question_en').value = response['data'][0]['question_en'];
                    document.getElementById('edit_question_type').value = response['data'][0]['question_type'];
                    document.getElementById('edit_options_code').value = (response['data'][0]['options_code'] == null)?"":response['data'][0]['options_code'];
                    document.getElementById('edit_options').value = (response['data'][0]['options'] == null)?"":response['data'][0]['options'];
                    document.getElementById('edit_options_en').value = (response['data'][0]['options_en'] == null)?"":response['data'][0]['options_en'];
                    document.getElementById('edit_required').value = (response['data'][0]['required'] == null)?"":response['data'][0]['required'];
                    document.getElementById('edit_next_question').value = (response['data'][0]['next_question'] == null)?"":response['data'][0]['next_question'];
                })
                .catch(function (error) {
                    console.log(error);
                });
            var myModal = new coreui.Modal(document.getElementById('editModal'), {
            });
            myModal.show();
        }

        function updateQuestion(element){
            axios.post('{{route('questions.update')}}', {
                ori_question_number : document.getElementById("ori_question_number").value,
                question_number : document.getElementById("edit_question_number").value,
                next_question : document.getElementById("edit_next_question").value,
                topic_id: document.getElementById("edit_topic_id").value,
                options : document.getElementById("edit_options").value,
                options_en : document.getElementById("edit_options_en").value,
                options_code : document.getElementById("edit_options_code").value,
                question: document.getElementById("edit_question").value,
                question_en : document.getElementById("edit_question_en").value,
                question_code : document.getElementById("edit_question_code").value,
                question_type : document.getElementById("edit_question_type").value,
                required : document.getElementById("edit_required").value,
            })
            .then(function(response) {
                var x = document.getElementsByTagName("tr")[document.getElementById('editRowIDX').value].id;
                console.log(document.getElementById('editRowIDX').value, document.getElementsByTagName("tr")[document.getElementById('editRowIDX').value].id);
                var row = document.getElementById(x);

                var append_data =
                    "<tr id={0}><th scope='col'>{1}</th><th scope='col'>{2}</th><th scope='col'>{3}</th><th scope='col'>{4}</th><th scope='col'>{5}</th><th><button type='button' class='btn btn-primary' onclick='getQuestionContent({6}, {7}, {8})'>View</button></th><tr>"
                        .format(document.getElementById("editRowIDX").value, document.getElementById("edit_question_number").value,
                            document.getElementById("edit_question_type").value, document.getElementById("edit_question").value,
                            document.getElementById("edit_options").value, document.getElementById("edit_next_question").value,
                            document.getElementById("edit_topic_id").value, document.getElementById("edit_question_number").value, "this");
                row.innerHTML = append_data;
            })
            .catch(function (error) {
                alert(error);
            });
        }

        function insertQuestion(element){
            axios.post( '{{route('questions.insert')}}', {
                question_number : document.getElementById("add_question_number").value,
                next_question : document.getElementById("add_next_question").value,
                topic_id: document.getElementById("add_topic_id").value,
                options : document.getElementById("add_options").value,
                options_en :document.getElementById("add_options_en").value,
                options_code :document.getElementById("add_options_code").value,
                question: document.getElementById("add_question").value,
                question_en : document.getElementById("add_question_en").value,
                question_code : document.getElementById("add_question_code").value,
                question_type : document.getElementById("add_question_type").value,
                required : document.getElementById("add_required").value,
            })
            .then(function(response) {
                var table = document.getElementById("questionTable");
                var lastRow = table.rows.length;
                //TODO buttom
                // var append_data =
                //     "<tr id={0}><th scope='col'>{1}</th><th scope='col'>{2}</th><th scope='col'>{3}</th><th scope='col'>{4}</th><th scope='col'>{5}</th><th><button type='button' class='btn btn-primary' onclick='getQuestionContent({6}, {7})'>View</button></th><tr>"
                //         .format(lastRow, document.getElementById("#add_question_number").value, document.getElementById("#add_question_type").value,
                //         document.getElementById("#add_question").value, document.getElementById("#add_options").value, document.getElementById("#add_next_question").value,
                //             document.getElementById("#add_topic_id").value, document.getElementById("#add_question_number").value);
                // $("table tbody").append(append_data);


            })
            .catch(function (error) {
                console.log(error);
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


