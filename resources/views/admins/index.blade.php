{{-- Extends layout --}}
@extends('layout.default')


{{-- Content --}}
@section('content')



    <div class="card card-custom">
      <div class="card-body">

            <table class="table table-bordered table-hover" id="admins_table">
                <thead>
                <tr>

                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>

                </tr>
                </thead>

            </table>

          </div>
        </div>


@endsection

@section('js')


@include('layout.datatable')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




 <script type="text/javascript">
   $(function () {

     var table = $('#admins_table').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{ url('admins/index') }}",
         columns: [
             {data: 'name', name: 'name'},
             {data: 'email', name: 'email'},
             {data: 'phone_number', name: 'phone_number'},
             {data: 'action', name: 'action', orderable: false, searchable: false},
         ]
     });

   });
 </script>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    {{-- Scripts Section --}}
        <script>
            $(document).ready(function() {

            });
        </script>
    {{-- page scripts --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
