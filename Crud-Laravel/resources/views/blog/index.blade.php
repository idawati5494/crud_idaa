@extends('layouts.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" > Form &nbsp &nbsp
                    <a href="{{ route ('forms.create')}}" class="btn btn-success">Add new</a>

                    <button class="btn btn-danger delete_all" data-url="{{ url('myproductsDeleteAll') }}">Bulk Delete</button>
                        <table class="table table-bordered">

                    <a href="#" class="btn btn-primary">Refresh</a>
                    <nav class="navbar navbar-light bg-light"><br><br>
                    <form class="form-inline"> 
                        <input class="col-md-6" name="cari" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success btn-sm" style="margin-left:20px;" type="submit">Cari</button>
                    </form>
                    </nav>
                </div>

                    <table class="table">
                        <thead class="thead-dark" >
                            <tr>

                        
                            <th width="50px"><input type="checkbox" id="master"></th>
                            <th scope="col">Title</th>
                            <th scope="col">Desc</th>
                            <th scope="Col">Created At</th>
                            <th scope="Col">Updated At</th>
                            <th csope ="Col" >Action</th>
                            </tr>
                            @if($forms->count())
                            @foreach($forms as $item)
                            <tr id="tr_{{$item->id}}">
                            <td><input type="checkbox" class="sub_chk" data-id="{{$item->id}}"></td>
                            <td>{{$item->title}} </td>
                            <td>{{$item->description}} </td>
                            <td>{{$item->created_at}} </td>
                            <td>{{$item->updated_at}} </td>
                            <td>

                            <form method="POST" action="{{ route('forms.destroy',$item->id) }}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <a href="{{ route('forms.show',$item->id) }}" class="btn btn-primary">View</a>
                                <a href="{{ route('forms.edit',$item->id) }}" class="btn btn-warning">Edit</a>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('yakin mau dihapus ?')">Delete</button>
                                </td>
                            </form>
                            @endforeach
                            @endif
                        </thead>
                    </table>
            </div>
            {{$forms->links()}}

        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    $(document).ready(function () {
        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true); 
         } else {  
            $(".sub_chk").prop('checked',false); 
         }  
        });

        $('.delete_all').on('click', function(e) {
            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  

            if(allVals.length <=0)  
            {  
                alert("Please select row."); 
            }  else {  
                var check = confirm("Are you sure you want to delete this row?"); 
                if(check == true){  
                    var join_selected_values = allVals.join(","); 

                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                } 
            }  
        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();

            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
            return false;
        });
    });
</script>