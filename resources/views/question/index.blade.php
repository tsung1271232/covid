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
                            <th>Insert</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($questions as $question)
                            <tr id = "row{{$loop->index}}" >
                                <th scope="col" width="10%">{{$question->question_number}}</th>

                                <th scope="col" width="10%">{{$question->question_type}}</th>

                                <th scope="col" width="30%">{{$question->question}}</th>

                                <th scope="col" width="20%">{{$question->options}}</th>

                                <th scope="col" width="10%">{{$question->next_question}}</th>

                                <td scope="col" width="5%">
                                    <button type="button" class="btn btn-primary" onclick="clickViewButton({{$topic_id}}, {{$question->question_number}}, this)">View</button>
                                </td>
                                <td scope="col" width="5%">
                                    <button type="button" class="btn btn-primary" onclick="clickInsertButton(this)">Insert</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="questionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Modify question</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class='form-group'>
                        <div class="form-group">
                            <input type="hidden" class="form-control" value="" id="curRowIDX">
                        </div>
                        <div class="form-group">
                            <label for="modal_question_number">question_number:</label>
                            <input type="hidden" class="form-control" value="" id="ori_question_number">
                            <input type="text" class="form-control" value="" id="modal_question_number">
                        </div>
                        <div class="form-group">
                            <label for="modal_question_type">question_type:</label>
                            <select id="modal_question_type">
                                <option value="R">Yes/No</option>
                                <option value="RS">Multi</option>
                                <option value="D">Date</option>
                                <option value="T">Text</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="modal_topic_id">topic_id:</label>
                            <input type="text" class="form-control" value={{$topic_id}} disabled id="modal_topic_id">
                        </div>
                        <div class="form-group">
                            <label for="modal_question_id">question_id:</label>
                            <input type="text" class="form-control" value="" id="modal_question_code">
                        </div>
                        <div class="form-group">
                            <label for="modal_question">question:</label>
                            <input type="text" class="form-control" value="" id="modal_question">
                        </div>
                        <div class="form-group">
                            <label for="modal_question_en">question_en:</label>
                            <input type="text" class="form-control" value="" id="modal_question_en">
                        </div>
                        <div class="form-group">
                            <label for="modal_options_id">options_id:</label>
                            <input type="text" class="form-control" value='{"0":"Common_1", "1":"Common_2"}' id="modal_options_code">
                        </div>
                        <div class="form-group">
                            <label for=modal_options">options:</label>
                            <input type="text" class="form-control"value='{"0":"否", "1":"是"}' id="modal_options">
                        </div>
                        <div class="form-group">
                            <label for="modal_options_en">options_en:</label>
                            <input type="text" class="form-control" value='{"0":"No", "1":"Yes"}' id="modal_options_en">
                        </div>
                        <div class="form-group">
                            <label for="modal_required">required:</label>
                            <input type="text" class="form-control" value="" id="modal_required">
                        </div>
                        <div class="form-group">
                            <label for="modal_next_question">next_question:</label>
                            <input type="text" class="form-control" value="" id="modal_next_question">
                        </div>
                    </div>
                </div>

                <div class="modal-footer" id = "modalFooter">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateQuestion(this)" data-dismiss="modal">Save Change</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function clickViewButton(topic_id, question_number, x){
            axios.post( "{{ route('questions.getContent') }}" , {
                    topic_id: topic_id,
                    question_number: question_number
                })
                .then(function (response) {
                    document.getElementById('curRowIDX').value = x.parentNode.parentNode.rowIndex;
                    document.getElementById('ori_question_number').value = response['data'][0]['question_number'];
                    document.getElementById('modal_question_number').value = response['data'][0]['question_number'];
                    document.getElementById('modal_topic_id').value = response['data'][0]['topic_id'];
                    document.getElementById('modal_question_code').value = response['data'][0]['question_code'];
                    document.getElementById('modal_question').value = response['data'][0]['question'];
                    document.getElementById('modal_question_en').value = response['data'][0]['question_en'];
                    document.getElementById('modal_question_type').value = response['data'][0]['question_type'];
                    document.getElementById('modal_options_code').value = (response['data'][0]['options_code'] == null)?"":response['data'][0]['options_code'];
                    document.getElementById('modal_options').value = (response['data'][0]['options'] == null)?"":response['data'][0]['options'];
                    document.getElementById('modal_options_en').value = (response['data'][0]['options_en'] == null)?"":response['data'][0]['options_en'];
                    document.getElementById('modal_required').value = (response['data'][0]['required'] == null)?"":response['data'][0]['required'];
                    document.getElementById('modal_next_question').value = (response['data'][0]['next_question'] == null)?"":response['data'][0]['next_question'];
                })
                .catch(function (error) {
                    console.log(error);
                });
            var myModal = new coreui.Modal(document.getElementById('questionModal'), {
            });
            var modalTitle = document.getElementById("modalTitle");
            modalTitle.innerHTML = "Modify question";
            var footer = document.getElementById("modalFooter");
            var footer_html =
                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n" +
                "<button type=\"button\" class=\"btn btn-primary\" onclick=\"updateQuestion(this)\" data-dismiss=\"modal\">Save Change</button>";
            footer.innerHTML = footer_html;
            myModal.show();
        }

        function updateQuestion(element){
            axios.post('{{route('questions.update')}}', {
                ori_question_number : document.getElementById("ori_question_number").value,
                question_number : document.getElementById("modal_question_number").value,
                next_question : document.getElementById("modal_next_question").value,
                topic_id: document.getElementById("modal_topic_id").value,
                options : document.getElementById("modal_options").value,
                options_en : document.getElementById("modal_options_en").value,
                options_code : document.getElementById("modal_options_code").value,
                question: document.getElementById("modal_question").value,
                question_en : document.getElementById("modal_question_en").value,
                question_code : document.getElementById("modal_question_code").value,
                question_type : document.getElementById("modal_question_type").value,
                required : document.getElementById("modal_required").value,
            })
            .then(function(response) {
                var x = document.getElementsByTagName("tr")[document.getElementById('curRowIDX').value].id;
                var row = document.getElementById(x);
                var append_data =
                    "<th scope=\"col\">{0}</th>".format(document.getElementById("modal_question_number").value) +
                    "<th scope=\"col\">{0}</th>".format(document.getElementById("modal_question_type").value) +
                    "<th scope=\"col\">{0}</th>".format(document.getElementById("modal_question").value) +
                    "<th scope=\"col\">{0}</th>".format(document.getElementById("modal_options").value) +
                    "<th scope=\"col\">{0}</th>".format(document.getElementById("modal_next_question").value) +
                    "<th><button type='button' class='btn btn-primary' onclick='clickViewButton({0}, {1}, this)'>View</button></th>".format(document.getElementById("modal_topic_id").value, document.getElementById("modal_question_number").value) +
                    "<th><button type='button' class='btn btn-primary' onclick='clickInsertButton(this)'>Insert</button></th>";
                row.innerHTML = append_data;
            })
            .catch(function (error) {
                alert(error);
            });
        }

        function clickInsertButton(x){
            console.log("total ", document.getElementById("questionTable").rows.length);
            console.log("cur index ", x.parentNode.parentNode.rowIndex);

            document.getElementById('curRowIDX').value = x.parentNode.parentNode.rowIndex;
            document.getElementById("modal_question_number").value = "";
            document.getElementById("modal_next_question").value = "";
            document.getElementById("modal_options").value = "{\"0\":\"否\", \"1\":\"是\"}";
            document.getElementById("modal_options_en").value = "{\"0\":\"No\", \"1\":\"Yes\"}";
            document.getElementById("modal_options_code").value = "{\"0\":\"Common_1\", \"1\":\"Common_2\"}";
            document.getElementById("modal_question").value = "";
            document.getElementById("modal_question_en").value = "";
            document.getElementById("modal_question_code").value = "";
            document.getElementById("modal_question_type").value = "R";
            document.getElementById("modal_required").value = "Y";

            var myModal = new coreui.Modal(document.getElementById('questionModal'), {
            });
            var footer = document.getElementById("modalFooter");
            var footer_html =
                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n" +
                "<button type=\"button\" class=\"btn btn-primary\" onclick=\"insertQuestion(this)\" data-dismiss=\"modal\">Insert</button>";

            footer.innerHTML = footer_html;
            myModal.show();
        }

        function insertQuestion(element){
            axios.post( '{{route('questions.insert')}}', {
                question_number : document.getElementById("modal_question_number").value,
                next_question : document.getElementById("modal_next_question").value,
                topic_id: document.getElementById("modal_topic_id").value,
                options : document.getElementById("modal_options").value,
                options_en :document.getElementById("modal_options_en").value,
                options_code :document.getElementById("modal_options_code").value,
                question: document.getElementById("modal_question").value,
                question_en : document.getElementById("modal_question_en").value,
                question_code : document.getElementById("modal_question_code").value,
                question_type : document.getElementById("modal_question_type").value,
                required : document.getElementById("modal_required").value,
            })
            .then(function(response) {
                var curRow = document.getElementsByTagName("tr")[document.getElementById('curRowIDX').value];
                var append_data =
                    "<th scope=\"col\">{0}</th>".format(document.getElementById("modal_question_number").value) +
                    "<th scope=\"col\">{0}</th>".format(document.getElementById("modal_question_type").value) +
                    "<th scope=\"col\">{0}</th>".format(document.getElementById("modal_question").value) +
                    "<th scope=\"col\">{0}</th>".format(document.getElementById("modal_options").value) +
                    "<th scope=\"col\">{0}</th>".format(document.getElementById("modal_next_question").value) +
                    "<th><button type='button' class='btn btn-primary' onclick='clickViewButton({0}, {1}, this)'>View</button></th>".format(document.getElementById("modal_topic_id").value, document.getElementById("modal_question_number").value) +
                    "<th><button type='button' class='btn btn-primary' onclick='clickInsertButton(this)'>Insert</button></th>";
                curRow.insertAdjacentHTML("afterend", append_data);
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


