<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    function openModal() {
        $("#customer_add_modal").modal('show')
    }
    $(document).ready(function (){
        {{--$(document).on('click','.add-customer',function (e){
            e.preventDefault();
            let name = $('#name').val();
            let mobile = $('#mobile').val();
            // console.log(name+mobile);
            $.ajax({
                url:"",
                method: 'post',
                data: {name:name, mobile:mobile},
                success:function (res){
                    $("#customer_add_modal").modal('hide');
                    $("#addCustomerForm")[0].reset();
                    $('.table').load(location.href+' .table');
                    Command: toastr["success"]("Customer Added Successfully")

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                },error:function (err){
                    let error = err.responseJSON;
                    $.each(error.errors,function (index, value){
                        $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>')
                    });
                }
            })
        }) --}}

        //pagination
        $(document).on('click','.pagination a', function (e){
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            product(page)
        })
        function product(page){
            $.ajax({
                url:"{{ route('paginate') }}" +"?page=" + page,
                success:function (res){
                    $('.table-data').html(res);
                }
            })
        }

        //search product
        $(document).on('keyup',function (e){
            e.preventDefault();
            let search_string = $('#search').val();
            // console.log(search_string);
            $.ajax({
                url: "{{ route('customer.search') }}",
                method: 'GET',
                data:{search_string:search_string},
                success:function (res){
                    $('.table-data').html(res);
                    if(res.status=='nothing_found'){
                        $('.table-data').html('<span class="text-danger">'+'Nothing Found'+'</span>')
                    }
                }
            });
        })
    });
</script>
