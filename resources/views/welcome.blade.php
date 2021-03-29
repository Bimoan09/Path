<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
        <!-- Styles -->
        <style>
          .btn-success.active{
              background-color : #87B87F! important;
              border-radius: 1px;
          }
          .container-header{
              padding-top: 50px;
              padding-left: 40px;
              padding-bottom: 20px;
          }

        </style>
    </head>
    <body>
    <div class="container-header">
    </br>
    </br>
        <div class="container-fluid" style="border:1px solid #cecece;">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Path</th>
                    </tr>
         
                </thead>
                <tbody>
                    @foreach ($data as $datas)
                    <tr>
                        @if($datas->child == NULL)
                        <td>{{$datas->parent}}</td>
                    
                        @elseif($datas->child != NULL)
                        <td>{{$datas->parent}} / {{$datas->child}}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Path</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </br>
    </br>

    <form id="modalFormData" name="modalFormData" class="form-horizontal">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Parent Name</span>
          </div>
          <input type="text" class="form-control" name="parent" id="q" data-action="{{ route('path.search') }}">
        
        </div>  
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Child Name</span>
        </div>
        <input type="text" class="form-control" id="child" name="child" placeholder="Letter, number and space allowed" validate>
      </div>

      <button type="submit" class="btn btn-success btn-lg active" id="btn-save"><i class="fas fa-save"></i>Simpan</button>

      </form>
    </div>
<!--Import jQuery before export.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>


<!--Data Table-->
<script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://repo.rachmat.id/jquery-ui-1.12.1/jquery-ui.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">

var table = $('#example').DataTable();

$(function () {
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
});

$('body').on('click', '#btn-save', function (event) {
    event.preventDefault()
    $.ajax({
        data:$('#modalFormData').serialize(),
        url: "{{ route('path.store') }}",
        type: "POST",
        dataType: 'json',

        success: function (data) {
        
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Data Tersimpan',
            showConfirmButton: true,
            timer: 1500
        })
        setTimeout(function () {
        location.reload(true);
      }, 1600);
        $('#modalFormData').trigger("reset");
        
        },
        error: function (data) {
            console.log('Error:', data);
            $('#btn-save').html('Tersimpan');
        }
    });
});

$('#q').each(function() {
        var $this = $(this);
        var src = $this.data('action');

        $this.autocomplete({
            source: src,
            minLength: 1,
            select: function(event, ui) {
                $this.val(ui.item.value);
                $('#id').val(ui.item.id);
            }
        });
    });

</script>

    </body>
</html>


