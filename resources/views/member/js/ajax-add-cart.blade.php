<script type="text/javascript">


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#add-carts").click(function(e){

        e.preventDefault();

        var class_id = $("input[name=class_id]").val();
        var url = '{{ route('carts.store') }}';

        $.ajax({
        url:url,
        method:'POST',
        data:{
                class_id:class_id,
                },
        success:function(response){
            if(response.success){
                alert(response.message) //Message come from controller
            }else{
                alert("Error")
            }
        },
        error:function(error){
            console.log(error)
        }
        });
    });

</script>
