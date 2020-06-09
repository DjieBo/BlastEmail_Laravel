<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/css/jodit.min.css">
        <script src="/js/jodit.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>
<body>
@if(isset(Auth::user()->username))
<header>
    <div class="contain">
        <div class="col-end"><a href="{{ url('/logout') }}">Logout</a></div>
    </div>
</header>
@if($page = Session::get('message'))
    <script>alert("{{ $page }}")</script>
@endif
@if($sennder = Session::get('sennder'))
    <script>alert("{{ $sennder }}")</script>
@endif
<section>
    <div class="contain contain-style">
        <div class="col-email col-style">
            <h2>Form Blash Email</h2>
            <div class="form-style">
                <form method="post" action="{{ url('/sendemail')}}">
                {{ csrf_field() }}
                    <div class="sendTofrom">
                        <label>Kepada :</label>
                        <div class="sendto" id="formSendTo">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control" placeholder="Judul" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <textarea  class="form-control" placeholder="Pesan" id="editor" name="pesan"></textarea>
                        <script>
                            const editor = new Jodit('#editor', {
                                extraPlugins: ['emoji'],
                                extraButtons: ['emoji'],
                                tabIndex: 0,
                                uploader: {url: 'https://xdsoft.net/jodit/connector/index.php?action=fileUpload'},
                                filebrowser: {ajax: {url: 'https://xdsoft.net/jodit/connector/index.php'}}	
                            });
                        </script>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-list col-style">
            <h2>Tambah Penerima </h2>
            <div class="list-style" style="margin-bottom:3%">
                <form method="post" enctype="multipart/form-data" action="{{ url('/upload') }}">
                {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-field">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-field">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="line-space"><span>Or</span></div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Upload Excel</label>
                        <input type="file" name="excelfile" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>
            </div>
            <h2>List Penerima</h2>
            <div class="list-style list-detail">
                <div class="form-list">
                <?php $i = 0 ?>

                @foreach($mail as $datamail)
                <?php 
                    $i++;
                    $a = $datamail->email;
                    $IDmail = str_replace('@','_', str_replace('.', '_', $a));
                ?>
                    <script>
                        function CheckAll(){
                            var NameCh = document.getElementsByName("check[]");
                            var sendPlc = document.getElementById('formSendTo');
                            document.getElementById("CheckAll").style.display = "none";
                            document.getElementById("UncheckAll").style.display = "block";
                            for (var i = 0; i < NameCh.length; i++) {
                                NameCh[i].checked = true;
                                var IDName = NameCh[i].id;
                                var ClsName = NameCh[i].className;
                                var ValName = NameCh[i].value;
                                var IDName = NameCh[i].alt;
                                var PrmName = ValName.replace('@', '_');
                                var IDValName = PrmName.replace('.', '_');
                                
                                var sendPlc = document.getElementById('formSendTo');
                                var listMail = document.createElement('div');
                                listMail.setAttribute('class', 'list-inp-email');
                                listMail.setAttribute('id', IDName);
                                sendPlc.appendChild(listMail);

                                var sendPlc = document.getElementById(IDName);
                                var spanMail = document.createElement('span');
                                spanMail.setAttribute('class', 'label-name');
                                spanMail.innerHTML = ClsName;
                                sendPlc.appendChild(spanMail);

                                var mailCh = document.createElement('INPUT');
                                mailCh.setAttribute('type', 'hidden');
                                mailCh.setAttribute('name', 'nama[]');
                                mailCh.setAttribute('value', ClsName);
                                mailCh.setAttribute('id', IDValName);
                                mailCh.setAttribute('readonly', 'on');
                                sendPlc.appendChild(mailCh);

                                var mailCh = document.createElement('INPUT');
                                mailCh.setAttribute('type', 'hidden');
                                mailCh.setAttribute('name', 'email[]');
                                mailCh.setAttribute('value', ValName);
                                mailCh.setAttribute('id', IDValName + "_ID");
                                mailCh.setAttribute('readonly', 'on');
                                sendPlc.appendChild(mailCh);
                            }
                        }
                        function UncheckAll(){
                            var NameCh = document.getElementsByName("check[]");
                            for (var i = 0; i < NameCh.length; i++) {
                                NameCh[i].checked = false;
                            }
                            $(".list-inp-email").remove();
                            document.getElementById("UncheckAll").style.display = "none";
                            document.getElementById("CheckAll").style.display = "block";
                        }
                        function OnChangeCheck(value, className, alt, id){
                            if(document.getElementById(id).checked = true){
                                alert(value + " | " + className + " | " + alt + " | " + id);
                                var sendPlc = document.getElementById('formSendTo');
                                var listMail = document.createElement('div');
                                listMail.setAttribute('class', 'list-inp-email');
                                listMail.setAttribute('id', alt);
                                sendPlc.appendChild(listMail);

                                var sendPlc = document.getElementById(alt);
                                var spanMail = document.createElement('span');
                                spanMail.setAttribute('class', 'label-name');
                                spanMail.innerHTML = className;
                                sendPlc.appendChild(spanMail);

                                var mailCh = document.createElement('INPUT');
                                mailCh.setAttribute('type', 'hidden');
                                mailCh.setAttribute('name', 'nama[]');
                                mailCh.setAttribute('value', className);
                                mailCh.setAttribute('id', id);
                                mailCh.setAttribute('readonly', 'on');
                                sendPlc.appendChild(mailCh);

                                var mailCh = document.createElement('INPUT');
                                mailCh.setAttribute('type', 'hidden');
                                mailCh.setAttribute('name', 'email[]');
                                mailCh.setAttribute('value', value);
                                mailCh.setAttribute('id', id + "_ID");
                                mailCh.setAttribute('readonly', 'on');
                                sendPlc.appendChild(mailCh);
                            } else if(document.getElementById(id).checked = false){
                                $("#" + alt).remove();
                            }
                        }
                        $(function() {
                            $('#{{ $IDmail }}').on('change', function(e) {
                                if($('#{{ $IDmail }}').is(':checked')) {
                                    var sendPlc = document.getElementById('formSendTo');
                                    var listMail = document.createElement('div');
                                    listMail.setAttribute('class', 'list-inp-email');
                                    listMail.setAttribute('id', '{{ $datamail->id }}');
                                    sendPlc.appendChild(listMail);

                                    var sendPlc = document.getElementById('{{ $datamail->id }}');
                                    var spanMail = document.createElement('span');
                                    spanMail.setAttribute('class', 'label-name');
                                    spanMail.innerHTML = '{{ $datamail->nama }}';
                                    sendPlc.appendChild(spanMail);

                                    var mailCh = document.createElement('INPUT');
                                    mailCh.setAttribute('type', 'hidden');
                                    mailCh.setAttribute('name', 'nama[]');
                                    mailCh.setAttribute('value', '{{ $datamail->nama }}');
                                    mailCh.setAttribute('id', '{{ $IDmail }}');
                                    mailCh.setAttribute('readonly', 'on');
                                    sendPlc.appendChild(mailCh);

                                    var mailCh = document.createElement('INPUT');
                                    mailCh.setAttribute('type', 'hidden');
                                    mailCh.setAttribute('name', 'email[]');
                                    mailCh.setAttribute('value', '{{ $datamail->email }}');
                                    mailCh.setAttribute('id', '{{ $IDmail }}_ID');
                                    mailCh.setAttribute('readonly', 'on');
                                    sendPlc.appendChild(mailCh);
                                } else {
                                    $("#{{ $datamail->id }}").remove();
                                }
                            });
                        });
                    </script>
                    <li>
                        <div class="list-number">{{ $i }}.</div>
                        <div class="list-email">{{ $datamail->email }} ( {{ $datamail->nama}} )  </div>
                        <div class="list-check"><input type="checkbox" class="{{ $datamail->nama }}" alt="{{ $datamail->id }}" value="{{ $datamail->email }}" id="{{ $IDmail }}" name="check[]"></div>
                    </li>
                @endforeach
                    
                </div>
                <div class="row-list">
                    <span class="btn btn-primary btn-sm" id="CheckAll" onclick="CheckAll()" style="float:right">Check All</span>
                    <span class="btn btn-primary btn-sm" id="UncheckAll" onclick="UncheckAll()" style="float:right;display:none">Uncheck All</span>
                    <input type="submit" name="delete" value="Delete" class="btn btn-primary btn-sm" style="float:left">
                </div>
            </div>
        </div>
    </div>
</section>
@else
<script>window.location="/";</script>
@endif
</body>
</html>
