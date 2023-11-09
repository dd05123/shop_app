@extends('tab')
@section('main')
<div class="data-table-wrap">
<table class="table mb-0" id="datatable">
      <thead>
      <tr>
        <th scope="col">S.no</th>
        <!-- <th scope="col">Product_Id</th> -->
        <!-- <th>Body_html</th> -->
        <!-- <th scope="col">Blog_Id</th> -->
        <!-- <th scope="col">Page_Id</th> -->
        <th scope="col">Title</th>
        <th scope="col">Vendor</th>
        <!-- <th>Options</th> -->
        <!-- <th scope="col">Product_type</th> -->
        <!-- <th scope="col">Published_at</th> -->
        <th scope="col">Tags</th>
        <th scope="col">Admin_graphql_api_id</th>
        <th scope="col">Type</th>
        <!-- <th>Variants</th>
        <th>Product_dump</th> -->
        <th scope="col">created_at</th>
        <th scope="col">updated_at</th>
        <th scope="col" class="text-center">Action</th>
      </tr>
        </thead>
          <tbody id="response">
            @php $number=1 @endphp
          @foreach($products as $product)
             <tr>
            <!-- <td><span>{{$product->id}}</span></td> -->
            <td><span>{{$number++}}</span></td>
            <!-- <td><span>{{$product->product_id}}</span></td> -->
            <!-- <td><span>{{$product->body_html}}</span></td> -->
            <!-- <td><span>{{$product->blog_id}}</span></td> -->
            <!-- <td><span>{{$product->page_id}}</span></td> -->
            <td><span>{{$product->title}}</span></td>
            <td><span>{{$product->vendor}}</span></td>
            <!-- <td><span>{{$product->option}}</span></td> -->
            <!-- <td><span>{{$product->product_type}}</span></td> -->
            <!-- <td><span>{{$product->published_at}}</span></td> -->
            <td><span>{{$product->tags}}</span></td>
            <td><span>{{$product->admin_graphql_api_id}}</span></td>
            <td><span>{{$product->type}}</span></td>
            <!-- <td><span>{{$product->variants}}</span></td>
            <td><span>{{$product->product_dump}}</span></td> -->
            <td><span>{{$product->created_at}}</span></td>
            <td><span>{{$product->updated_at}}</span></td>
                 <td >
                     <div class="hstack gap-3 justify-content-center">
                         <button class="btn primary-btn-outline ">Add to list</button>
                           <!-- <button class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#searchModal" id="btn" >View Details</button>  -->
                           <button class="btn primary-btn btn_ajax" data-bs-toggle="modal"   id="btn" data-prod-id="{{$product->id}}" >View Details</button> 
                    </div>
                 </td>
           </tr>
           @endforeach
     </tbody> 
     
 </table>
</div>
   
 @endsection
 @section("footer")
 <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
    <!--popper.min.js  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script> -->
    <!-- bootstrap min.js -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
 <script>
     $(document).ready(function () {
        $(".btn_ajax").click(function(){
        // $("#searchModal").modal('show');
        var id=$(this).attr("data-prod-id");
        $.ajax({
             url:"https://localhost/shop_app/showdata",
             method:"post",
             data:{id:id},
             success: function (response){
               // console.log('here, Im test = ',$("#exampleModalLongTitle").html());
              // alert();
                  
               var modalContent = 
                    "<b>Image</b>:" + '<img src='+response.image+'>' + "<br>" +
                    "<b>Title</b>: " + response.title + "<br>" +
                    "<b>Vendor</b>: " + response.vendor + "<br>" +
                    //  "<b>Options</b>: " + data + "<br>" +
                    "<b>Options</b>: " + response.options + "<br>" +
                    "<b>Product_Type</b>: " + response.product_type+"<br>"+
                    "<b>Tags</b>:"+response.tags;
               $("#product_model").html(modalContent);
              // $("#product_model").text(response.body_html);
                $("#searchModal").modal("show");
             }

            

        });
       });
        });
 </script>
@endsection

