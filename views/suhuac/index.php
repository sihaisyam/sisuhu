
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISUHU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Barang</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>
        <div id="message">
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-sm-9">SUHU AC</div>
                    <div class="col col-sm-3">
                        <a href="#" class="btn btn-primary btn-sm float-end" id="generate">Generate</a>
                        <a href="#" class="btn btn-success btn-sm float-end" id="add_data">Add</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="sample_data">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Suhu Minimal</th>
                                <th>Suhu Tengah</th>
                                <th>Suhu Maximal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="action_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dynamic_modal_title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Suhu Min</label>
                                <input type="text" name="suhu_min" id="suhu_min" class="form-control" />
                                <span id="suhu_min_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Suhu Tengah</label>
                                <input type="suhu_mid" name="suhu_mid" id="suhu_mid" class="form-control" />
                                <span id="suhu_mid_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Suhu Atas</label>
                                <input type="suhu_max" name="suhu_max" id="suhu_max" class="form-control" />
                                <span id="suhu_max_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="action" id="action" value="Add" />
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="action_button">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="generate_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                        <div class="modal-header">
                            <h5 class="modal-title" id="dynamic_modal_title_generate"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <p>PT ABC melakukan percobaan terhadap responden sebanyak <b id="total"></b>
                        Kemudian, dari hasil pemodelan logika fuzzy dapat di simpulkan sebagai berikut :
                            <ul>
                                <li id='terendah'></li>
                                <li id='ternyaman'></li>
                                <li id='tertinggi'></li>
                            </ul>
                        </p>

                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        
                </div>
            </div>
        </div>
    </div>
    
    
    <script>
    $(document).ready(function() {
        showAll();

        $('#add_data').click(function(){
            $('#dynamic_modal_title').text('Add Data Suhu AC');
            $('#sample_form')[0].reset();
            $('#action').val('Add');
            $('#action_button').text('Add');
            $('.text-danger').text('');
            $('#action_modal').modal('show');
        });

        $('#generate').click(function(){
            $('#dynamic_modal_title_generate').text('Simpulan Simulasi Logika Fuzzy');
            $('.text-danger').text('');
            $('#generate_modal').modal('show');
            $.ajax({
                type: "GET",
                contentType: "application/json",
                url:
                "http://localhost/sisuhu/api/suhuac/generate-by-avg.php",
                success: function(response) {
                    $('#ternyaman').append(response.ternyaman);
                    $('#terendah').append(response.terendah);
                    $('#tertinggi').append(response.tertinggi);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
        
        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == "Add"){
                var formData = {
                'suhu_min' : $('#suhu_min').val(),
                'suhu_mid' : $('#suhu_mid').val(),
                'suhu_max' : $('#suhu_max').val()
                }

                $.ajax({
                    url:"http://localhost/sisuhu/api/suhuac/create.php",
                    method:"POST",
                    data: JSON.stringify(formData),
                    success:function(data){
                        $('#action_button').attr('disabled', false);
                        $('#message').html('<div class="alert alert-success">'+data+'</div>');
                        $('#action_modal').modal('hide');
                        $('#sample_data').DataTable().destroy();
                        showAll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }else if($('#action').val() == "Update"){
                var formData = {
                    'id' : $('#id').val(),
                    'suhu_min' : $('#suhu_min').val(),
                    'suhu_mid' : $('#suhu_mid').val(),
                    'suhu_max' : $('#suhu_max').val()
                }

                $.ajax({
                    url:"http://localhost/sisuhu/api/suhuac/update.php",
                    method:"PUT",
                    data: JSON.stringify(formData),
                    success:function(data){
                        $('#action_button').attr('disabled', false);
                        $('#message').html('<div class="alert alert-success">'+data+'</div>');
                        $('#action_modal').modal('hide');
                        $('#sample_data').DataTable().destroy();
                        showAll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
            });
    });

    function showAll() {
        $.ajax({
            type: "GET",
            contentType: "application/json",
            url:"http://localhost/sisuhu/api/suhuac/read.php",
            success: function(response) {
            // console.log(response);
                $('#total').html('');
                var json = response.body;
                var dataSet=[];
                for (var i = 0; i < json.length; i++) {
                    var sub_array = {
                        'no' : i+1,
                        'suhu_min' : json[i].suhu_min,
                        'suhu_mid' : json[i].suhu_mid,
                        'suhu_max' : json[i].suhu_max,
                        'action' : '<button onclick="deleteOne('+json[i].id+')" class="btn btn-sm btn-danger">Delete</button>'
                    };
                    dataSet.push(sub_array);
                }
                $('#sample_data').DataTable({
                    data: dataSet,
                    columns : [
                        { data : "no" },
                        { data : "suhu_min" },
                        { data : "suhu_mid" },
                        { data : "suhu_max" },
                        { data : "action" }
                    ]
                });
                $('#total').append(response.total)
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function showOne(id) {
        $('#dynamic_modal_title').text('Edit Data');
        $('#sample_form')[0].reset();
        $('#action').val('Update');
        $('#action_button').text('Update');
        $('.text-danger').text('');
        $('#action_modal').modal('show');

        $.ajax({
            type: "GET",
            contentType: "application/json",
            url:
            "http://localhost/sisuhu/api/suhuac/read.php?id="+id,
            success: function(response) {
                $('#id').val(response.id);
                $('#suhu_min').val(response.suhu_min);
                $('#suhu_mid').val(response.suhu_mid);
                $('#suhu_max').val(response.suhu_max).change();
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function deleteOne(id) {
        alert('Yakin untuk hapus data ?');
        $.ajax({
            url:"http://localhost/sisuhu/api/suhuac/delete.php",
            method:"DELETE",
            data: JSON.stringify({"id" : id}),
            success:function(data){
                $('#action_button').attr('disabled', false);
                $('#message').html('<div class="alert alert-success">'+data+'</div>');
                $('#action_modal').modal('hide');
                $('#sample_data').DataTable().destroy();
                showAll();
            },
            error: function(err) {
                console.log(err);
                $('#message').html('<div class="alert alert-danger">'+err.responseJSON+'</div>');  
            }
        });
    }
    </script>
</body>
</html>